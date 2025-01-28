<?php

require_once '/var/www/html/vendor/autoload.php';

// Load configuration
$config = require __DIR__ . '/config.php';

// Add Dynamic Title Tag Support
function rcdevelopers_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

function rcdevelopers_menus()
{
    $locations = array(
        'primary' => "Desktop Primary Left Sidebar",
        'footer' => "Footer Menu Items"
    );

    register_nav_menus($locations);
}

function rcdevelopers_enqueue_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style(
        'bootstrap-style',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
        array(),
        '5.3.3'
    );
    wp_enqueue_style(
        'custom-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('bootstrap-style'),
        rand(111, 9999) //dev mode only, replace with $version in production
    );
    wp_enqueue_style(
        'fontawesome-style',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css',
        array('custom-style'),
        '6.7.1'
    );
}

function rcdevelopers_enqueue_scripts()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_script(
        'jquery-script',
        'https://code.jquery.com/jquery-3.7.1.slim.min.js',
        array(),
        '3.7.1',
        true
    );
    wp_enqueue_script(
        'popper-script',
        'https://cdn.jsdelivr.net/npm/popper.js@2.11.8/dist/umd/popper.min.js',
        array(),
        '2.11.8',
        true
    );
    wp_enqueue_script(
        'bootstrap-script',
        'https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js',
        array(),
        '5.3.3',
        true
    );
    wp_enqueue_script(
        'main-script',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        array(),
        rand(111, 9999), //dev mode only, replace with $version in production,
        true
    );
}

function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action('wp_enqueue_scripts', 'rcdevelopers_enqueue_styles');
add_action('wp_enqueue_scripts', 'rcdevelopers_enqueue_scripts');
add_action('after_setup_theme', 'rcdevelopers_theme_support');
add_action('after_setup_theme', 'remove_admin_bar');
add_action('init', 'rcdevelopers_menus');

// Adding custom Query variables (which will be accessible) within the URLs
function add_custom_query_vars($vars)
{
    $vars[] = 'invite_code';
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars');

// Checking if the invite code is assigned to any user
// Return the user id if the invite code is used
// DEPRECATED: Use get_user_id_by_any_invite_code instead
function get_user_id_by_invite_code($invite_code)
{
    $users = get_users([
        'meta_key'   => 'associate_invite_code',
        'meta_value' => $invite_code,
        'fields'     => ['ID'],
    ]);

    return !empty($users) ? $users[0]->ID : false;
}

// Checking if the invite code is assigned to any user
// Returns a dictionary of user id, first-name + last-name and the type of code if the invite code is matches
function get_user_id_by_any_invite_code($invite_code)
{
    $users = get_users([
        'meta_query' => [
            'relation' => 'OR',
            [
                'key'     => 'associate_invite_code',
                'value'   => $invite_code,
                'compare' => '='
            ],
            [
                'key'     => 'customer_invite_code',
                'value'   => $invite_code,
                'compare' => '='
            ]
        ],
        'fields' => ['ID']
    ]);

    if (!empty($users)) {
        $user_id = $users[0]->ID;
        $first_name = get_user_meta($user_id, 'first_name', true);
        $last_name = get_user_meta($user_id, 'last_name', true);

        $meta_value = get_user_meta($user_id, 'associate_invite_code', true);
        $code_type = ($meta_value === $invite_code) ? 'associate' : 'customer';
        return [
            'user_id' => $user_id,
            'full_name' => $first_name . ' ' . $last_name,
            'code_type' => $code_type
        ];
    }

    return [
        'user_id' => false,
        'full_name' => false,
        'code_type' => false
    ];
}

// Get the user ID, first name, last name and status of customer from linked code
function get_customers_by_linked_code($linked_code)
{
    $args = array(
        'meta_query' => array(
            array(
                'key'     => 'linked_code',
                'value'   => $linked_code,
                'compare' => '='
            )
        ),
        'role' => 'customer',
        'fields' => array('ID')
    );

    $user_query = new WP_User_Query($args);
    $users = $user_query->get_results();

    $customers = array();

    if (!empty($users)) {
        foreach ($users as $user) {
            $user_id = $user->ID;
            $first_name = get_user_meta($user_id, 'first_name', true);
            $last_name = get_user_meta($user_id, 'last_name', true);
            $status = get_user_meta($user_id, 'status', true);
            $state = get_user_meta($user_id, 'state', true);
            $city = get_user_meta($user_id, 'city', true);
            $satbara = get_user_meta($user_id, 'satbara', true);


            $customers[] = array(
                'user_id' => $user_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'status' => $status,
                'state' => $state,
                'city' => $city,
                'satbara' => $satbara
            );
        }
    }
    return $customers;
}

// Generate unique invite codes for the user
function generate_unique_code_for_user($user_id)
{
    if (empty($user_id)) {
        return false;
    }

    // Generate the first unique code by hashing user ID + timestamp + salt
    $random_number1 = wp_rand(10000, 99999);
    $unique_part1 = substr(md5($user_id . time() . 'associate'), 0, 5);
    $associate_code = $random_number1 . '-' . $unique_part1;

    // Different salt for uniqueness
    $random_number2 = wp_rand(10000, 99999);
    $unique_part2 = substr(md5($user_id . time() . 'customer'), 0, 5);
    $customer_code = $random_number2 . '-' . $unique_part2;

    return [
        'associate' => $associate_code,
        'customer' => $customer_code,
    ];
}

function upload_satbara() {
    if (!is_user_logged_in()) {
        wp_redirect(home_url('/signin'));
        exit;
    }

    $user_id = get_current_user_id();

    if (isset($_FILES['satbara'])) {
        user_file_upload($user_id, $_FILES['satbara'], 'satbara');
    }
    exit;
}

add_action('admin_post_upload_satbara', 'upload_satbara');
add_action('admin_post_nopriv_upload_satbara', 'upload_satbara');

// Generate the lead statistics report
function generate_lead_report()
{
    global $config;

    ob_start(); // Start output buffering
    include __DIR__ . '/leads-report-template.php'; // Include the template
    $html = ob_get_clean(); // Get the buffered output as a string

    // Create mPDF instance and generate the PDF
    $mpdf = new \Mpdf\Mpdf([
        'tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf',
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 20, // Adjusted for header
        'margin_bottom' => 20, // Adjusted for footer
        'margin_header' => 10,
        'margin_footer' => 10
    ]);

    $gen_time = time();
    $gen_salt = $config['gen_salt'];
    $digital_signature = substr(md5($gen_time . $gen_salt), 0, 15);

    // Set header
    $mpdf->SetHTMLHeader('
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="font-size: 10px;">
            RCD Developers / ' . $digital_signature . ' / Generated at ' . date('Y-m-d H:i:s', $gen_time) . '
            </div>
        </div>
    ');

    // Set footer
    $mpdf->SetHTMLFooter('
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="text-align: right; font-size: 10px; ">
                Page {PAGENO} of {nb}
            </div>
        </div>
    ');

    $mpdf->WriteHTML($html);
    $mpdf->Output('lead_report_' . $digital_signature . '.pdf', 'I');
}

// Ensure the hook name matches the action used in the form or URL
add_action('admin_post_generate_lead_report', 'generate_lead_report');
add_action('admin_post_nopriv_generate_lead_report', 'generate_lead_report');

function rcdevelopers_handle_update_user()
{
    if (!is_user_logged_in()) {
        wp_redirect(home_url('/signin'));
        exit;
    }

    $current_user = wp_get_current_user();

    if (isset($_POST['update-username']) && isset($_POST['update-email'])) {
        $username = sanitize_text_field($_POST['update-username']);
        $email = sanitize_email($_POST['update-email']);
        $dob = isset($_POST['update-dob']) ? sanitize_text_field($_POST['update-dob']) : '';
        $address = isset($_POST['update-address']) ? sanitize_text_field($_POST['update-address']) : '';
        $experience = isset($_POST['update-experience']) ? sanitize_text_field($_POST['update-experience']) : '';

        $userdata = array(
            'ID'           => $current_user->ID,
            'user_login'   => $username,
            'user_email'   => $email,
        );

        $user_id = wp_update_user($userdata);

        if (is_wp_error($user_id)) {
            wp_redirect(home_url('/profile?update=failed'));
        } else {
            // Update user meta
            update_user_meta($user_id, 'date_of_birth', $dob);
            update_user_meta($user_id, 'address', $address);
            update_user_meta($user_id, 'years_of_experience', $experience);

            wp_redirect(home_url('/profile?update=success'));
        }
        exit;
    }
}
add_action('admin_post_nopriv_rcdevelopers_update_user', 'rcdevelopers_handle_update_user');
add_action('admin_post_rcdevelopers_update_user', 'rcdevelopers_handle_update_user');

function handle_update_kyc_documents() {
    if (!is_user_logged_in()) {
        wp_redirect(home_url('/signin'));
        exit;
    }

    $user_id = get_current_user_id();

    if (isset($_FILES['aadhar_card'])) {
        user_file_upload($user_id, $_FILES['aadhar_card'], 'aadhar_card');
    }

    if (isset($_FILES['pan_card'])) {
        user_file_upload($user_id, $_FILES['pan_card'], 'pan_card');
    }

    if (isset($_FILES['profile_pic'])) {
        user_file_upload($user_id, $_FILES['profile_pic'], 'profile_pic');
    }

    wp_redirect(home_url('/dashboard?update=success'));
    exit;
}

add_action('admin_post_update_kyc_documents', 'handle_update_kyc_documents');
add_action('admin_post_nopriv_update_kyc_documents', 'handle_update_kyc_documents');