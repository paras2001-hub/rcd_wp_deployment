<?php
function auth_handle_signin()
{
    $auth_options = get_option('rcdevelopers_authentication_settings');

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $username = sanitize_text_field($_POST['email']);
        $password = sanitize_text_field($_POST['password']);
        $remember = isset($_POST['keep-signed-in']) ? true : false;

        $credentials = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => $remember
        );

        $user = wp_signon($credentials, false);

        if (is_wp_error($user)) {
            wp_redirect(home_url($auth_options['rcdevelopers_authentication_failure_sign_in_redirect']));
        } else {
            if (user_can($user, 'administrator')) {
                wp_redirect(home_url($auth_options['rcdevelopers_authentication_successful_sign_in_redirect_associate']));
                exit;
            }

            $user_role = get_user_meta($user->ID, 'associate_role', true);
            if ($user_role) {
                wp_redirect(home_url($auth_options['rcdevelopers_authentication_successful_sign_in_redirect_associate']));
            } else {
                wp_redirect(home_url($auth_options['rcdevelopers_authentication_successful_sign_in_redirect_client']));
            }
        }
        exit;
    }
}

function auth_handle_associate_signup()
{
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);
        $username = $email;
        $user_id = username_exists($username);

        if (!$user_id && email_exists($email) == false) {
            $user_id = wp_create_user($username, $password, $email);
            if (!is_wp_error($user_id)) {

                // Generate unique invite codes for the associate
                $invite_codes = generate_unique_code_for_user($user_id);

                // Create linked account for the associate
                $linked_account_result = create_linked_account(
                    sanitize_email($_POST['email']),
                    sanitize_text_field($_POST['phoneNo']),
                    sanitize_text_field($_POST['first-name']) . ' ' . sanitize_text_field($_POST['last-name']),
                    sanitize_text_field($_POST['ifsc-code']),
                    sanitize_text_field($_POST['account-number'])
                );

                if ($linked_account_result) {
                    error_log('Linked account created successfully');

                    $data = [
                        'first_name' => sanitize_text_field($_POST['first-name']),
                        'last_name' => sanitize_text_field($_POST['last-name']),
                        'email' => sanitize_email($_POST['email']),
                        'password' => sanitize_text_field($_POST['password']),
                        'phone_no' => sanitize_text_field($_POST['phoneNo']),
                        'dob' => sanitize_text_field($_POST['dob']),
                        'state' => sanitize_text_field($_POST['state']),
                        'city' => sanitize_text_field($_POST['city']),
                        'business_address' => sanitize_textarea_field($_POST['business-address']),
                        'residential_address' => sanitize_textarea_field($_POST['residential-address']),
                        'aadhar_card' => $_FILES['aadhar-card'],
                        'pan_card' => $_FILES['pan-card'],
                        'profile_pic' => $_FILES['profile-pic'],
                        'bank_username' => sanitize_text_field($_POST['bank-username']),
                        'bank_name' => sanitize_text_field($_POST['bank-name']),
                        'branch_name' => sanitize_text_field($_POST['branch-name']),
                        'account_number' => sanitize_text_field($_POST['account-number']),
                        'ifsc_code' => sanitize_text_field($_POST['ifsc-code']),
                        'existing_business' => sanitize_text_field($_POST['existing-business']),
                        'languages' => sanitize_text_field($_POST['languages']),
                        'experience' => sanitize_text_field($_POST['experience']),
                        'linked_code' => isset($_POST['invite-code']),
                        'associate_invite_code' => $invite_codes['associate'],
                        'customer_invite_code' => $invite_codes['customer'],
                        'username' => sanitize_email($_POST['email']),
                        'associate_role' => 'Associate',
                        'linked_account_id' => $linked_account_result,
                        'lead_pending' => 0,
                        'lead_booked' => 0,
                        'lead_confirmed' => 0,
                        'lead_completed' => 0,
                        'date_of_joining' => date('d/m/Y'),
                        'total_earnings' => 0,
                        'area_sold' => 0
                    ];
                    error_log('Data: ' . json_encode($data));

                    update_user_data($user_id, $data);
                    error_log('User data updated successfully');
                    wp_redirect(home_url('/sign_in'));
                } else {

                    // Delete the user if linked account creation failed
                    wp_delete_user($user_id);
                    wp_redirect(home_url('/sign_up?signup=linked_account_failed'));
                }
            } else {
                wp_redirect(home_url('/sign_up?signup=failed'));
            }
        } else {
            wp_redirect(home_url('/sign_up?signup=user_exists'));
        }
        exit;
    }
}

function auth_handle_customer_signup()
{
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $first_name = sanitize_text_field($_POST['first-name']);
        $last_name = sanitize_text_field($_POST['last-name']);
        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);
        $phone_no = sanitize_text_field($_POST['phoneNo']);

        $state = sanitize_text_field($_POST['state']);
        $city = sanitize_text_field($_POST['city']);

        $profile_upload = $_FILES['profile-pic'];

        $linked_code = $_POST['invite-code'];
        $username = $email;

        $status = 'Pending';

        $user_id = username_exists($username);
        if (!$user_id && email_exists($email) == false) {
            $user_id = wp_create_user($username, $password, $email);
            if (!is_wp_error($user_id)) {

                // Update user meta
                update_user_meta($user_id, 'first_name', $first_name);
                update_user_meta($user_id, 'last_name', $last_name);
                update_user_meta($user_id, 'phone_no', $phone_no);

                update_user_meta($user_id, 'state', $state);
                update_user_meta($user_id, 'city', $city);

                update_user_meta($user_id, 'linked_code', $linked_code);

                update_user_meta($user_id, 'status', $status);

                if (!function_exists('wp_handle_upload')) {
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                }

                user_file_upload($user_id, $profile_upload, 'profile_pic');

                wp_redirect(home_url('/sign_in'));
            } else {
                wp_redirect(home_url('/sign_up?signup=failed'));
            }
        } else {
            wp_redirect(home_url('/sign_up?signup=user_exists'));
        }
        exit;
    }
}
