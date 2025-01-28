<?php
// User Registration

// ALREADY EXISTS IN roles-capabilities.php
// // Register custom roles for Associates and Customers
// function rcd_crm_add_roles() {
//     add_role('associate', 'Associate', array(
//         'read' => true,
//         'edit_posts' => false,
//         'delete_posts' => false,
//         'upload_files' => true,
//     ));
    
//     add_role('customer', 'Customer', array(
//         'read' => true,
//         'edit_posts' => false,
//         'delete_posts' => false,
//         'upload_files' => false,
//     ));
// }
// add_action('init', 'rcd_crm_add_roles');

// Registration form shortcode
function rcd_crm_registration_form() {
    ob_start();
    ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="associate">Associate</option>
            <option value="customer">Customer</option>
        </select>
        <button type="submit" name="rcd_crm_register">Register</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('rcd_crm_registration', 'rcd_crm_registration_form');

// Handle user registration
function rcd_crm_handle_registration() {
    if (isset($_POST['rcd_crm_register'])) {
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];
        $role = $_POST['role'];

        $errors = new WP_Error();

        // Validate username and email
        if (username_exists($username)) {
            $errors->add('username_exists', 'Username already exists.');
        }
        if (!is_email($email)) {
            $errors->add('invalid_email', 'Email is not valid.');
        } elseif (email_exists($email)) {
            $errors->add('email_exists', 'Email already exists.');
        }

        // If there are no errors, create the user
        if (empty($errors->get_error_messages())) {
            $user_id = wp_create_user($username, $password, $email);
            if (!is_wp_error($user_id)) {
                $user = new WP_User($user_id);
                $user->set_role($role);
                wp_redirect(home_url()); // Redirect to home or desired page
                exit;
            }
        } else {
            foreach ($errors->get_error_messages() as $error) {
                echo '<div class="error"><p>' . esc_html($error) . '</p></div>';
            }
        }
    }
}
add_action('init', 'rcd_crm_handle_registration');
