<?php
/*
Plugin Name: RC Developers Plugin
Description: Custom functionality (Authentication, OTP, Payments) for the RC Developers theme.
Version: 1.0
Author: Paras Patil
*/

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/utils.php';
require_once plugin_dir_path(__FILE__) . 'includes/userdata.php';
require_once plugin_dir_path(__FILE__) . 'includes/authentication.php';
require_once plugin_dir_path(__FILE__) . 'includes/payments.php';
require_once plugin_dir_path(__FILE__) . 'includes/statuses.php';

register_activation_hook(__FILE__, 'create_payments_table');
register_activation_hook(__FILE__, 'create_status_table');

add_action('admin_post_nopriv_auth_signin', 'auth_handle_signin');
add_action('admin_post_auth_signin', 'auth_handle_signin');

add_action('admin_post_nopriv_auth_associate_signup', 'auth_handle_associate_signup');
add_action('admin_post_auth_associate_signup', 'auth_handle_associate_signup');

add_action('admin_post_nopriv_auth_customer_signup', 'auth_handle_customer_signup');
add_action('admin_post_auth_customer_signup', 'auth_handle_customer_signup');

add_action('rest_api_init', function () {
    register_rest_route('razorpay/v1', '/webhook', [
        'methods' => 'POST',
        'callback' => 'razorpay_webhook_handler',
    ]);
});

add_action('admin_menu', 'rcdevelopers_plugin_menu');

function rcdevelopers_plugin_menu()
{
    add_menu_page(
        'RC Developers Plugin Settings',
        'RC Developers Settings',
        'manage_options',
        'rcdevelopers-plugin-settings',
        'rcdevelopers_plugin_settings_page',
        'dashicons-admin-generic',
        81
    );

    add_submenu_page(
        'rcdevelopers-plugin-settings',
        'Authentication Settings',
        'Authentication',
        'manage_options',
        'rcdevelopers-authentication-settings',
        'rcdevelopers_authentication_settings_page'
    );

    add_submenu_page(
        'rcdevelopers-plugin-settings',
        'User Data Settings',
        'User Data',
        'manage_options',
        'rcdevelopers-userdata-settings',
        'rcdevelopers_userdata_settings_page'
    );

    add_submenu_page(
        'rcdevelopers-plugin-settings',
        'Payments Settings',
        'Payments',
        'manage_options',
        'rcdevelopers-payments-settings',
        'rcdevelopers_payments_settings_page'
    );

    add_submenu_page(
        'rcdevelopers-plugin-settings',
        'Statuses Settings',
        'Statuses',
        'manage_options',
        'rcdevelopers-statuses-settings',
        'rcdevelopers_statuses_settings_page'
    );
}

function rcdevelopers_plugin_settings_page()
{
    echo '<h1>RC Developers Plugin Settings</h1>';
    echo '<p>Configure the settings for the RC Developers Plugin.</p>';
}

function rcdevelopers_authentication_settings_page()
{
?>
    <div class="wrap">
        <h1>Authentication Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('rcdevelopers_authentication_settings_group');
            do_settings_sections('rcdevelopers-authentication-settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

add_action('admin_init', 'rcdevelopers_authentication_settings_init');

function rcdevelopers_authentication_settings_init()
{
    register_setting('rcdevelopers_authentication_settings_group', 'rcdevelopers_authentication_settings');

    add_settings_section(
        'rcdevelopers_authentication_settings_section',
        'Authentication Settings',
        'rcdevelopers_authentication_settings_section_callback',
        'rcdevelopers-authentication-settings'
    );

    add_settings_field(
        'rcdevelopers_authentication_successful_sign_in_redirect_associate',
        'Successful Sign-in Redirect (Associate)',
        'rcdevelopers_authentication_successful_sign_in_redirect_associate_callback',
        'rcdevelopers-authentication-settings',
        'rcdevelopers_authentication_settings_section'
    );

    add_settings_field(
        'rcdevelopers_authentication_successful_sign_in_redirect_client',
        'Successful Sign-in Redirect (Client)',
        'rcdevelopers_authentication_successful_sign_in_redirect_client_callback',
        'rcdevelopers-authentication-settings',
        'rcdevelopers_authentication_settings_section'
    );

    add_settings_field(
        'rcdevelopers_authentication_failure_sign_in_redirect',
        'Failure Sign-in Redirect',
        'rcdevelopers_authentication_failure_sign_in_redirect_callback',
        'rcdevelopers-authentication-settings',
        'rcdevelopers_authentication_settings_section'
    );

    $options = get_option('rcdevelopers_authentication_settings');
    if (false === $options) {
        $options = array(
            'rcdevelopers_authentication_successful_sign_in_redirect_associate' => '/dashboard',
            'rcdevelopers_authentication_failure_sign_in_redirect' => '/sign_in',
            'rcdevelopers_authentication_successful_sign_in_redirect_client' => '/client_dashboard'
        );
        update_option('rcdevelopers_authentication_settings', $options);
    }
}



function rcdevelopers_authentication_settings_section_callback()
{
    echo '<p>Configure the authentication settings below.</p>';
}

function rcdevelopers_authentication_successful_sign_in_redirect_associate_callback()
{
    $options = get_option('rcdevelopers_authentication_settings');
?>
    <input type="text"
        name="rcdevelopers_authentication_settings[rcdevelopers_authentication_successful_sign_in_redirect_associate]"
        value="<?php echo isset($options['rcdevelopers_authentication_successful_sign_in_redirect_associate'])
                    ? esc_attr($options['rcdevelopers_authentication_successful_sign_in_redirect_associate']) : ''; ?>" />
<?php
}

function rcdevelopers_authentication_failure_sign_in_redirect()
{
    $options = get_option('rcdevelopers_authentication_settings');
?>
    <input type="text"
        name="rcdevelopers_authentication_settings[authentication_failure_sign_in_redirect]"
        value="<?php echo isset($options['rcdevelopers_authentication_failure_sign_in_redirect']) ?
                    esc_attr($options['rcdevelopers_authentication_failure_sign_in_redirect']) : ''; ?>" />
<?php
}

function rcdevelopers_authentication_successful_sign_in_redirect_client_callback()
{
    $options = get_option('rcdevelopers_authentication_settings');
?>
    <input type="text" name="rcdevelopers_authentication_settings[rcdevelopers_authentication_successful_sign_in_redirect_client]"
        value="<?php echo isset($options['rcdevelopers_authentication_successful_sign_in_redirect_client']) ?
                    esc_attr($options['rcdevelopers_authentication_successful_sign_in_redirect_client']) : ''; ?>" />
<?php
}

function rcdevelopers_userdata_settings_page()
{
    echo '<h1>User Data Settings</h1>';
    echo '<p>Configure the user data settings.</p>';
}

function rcdevelopers_payments_settings_page()
{
    echo '<h1>Payments Settings</h1>';
    echo '<p>Configure the payments settings.</p>';
}

function rcdevelopers_statuses_settings_page()
{
    echo '<h1>Statuses Settings</h1>';
    echo '<p>Configure the statuses settings.</p>';
}

?>