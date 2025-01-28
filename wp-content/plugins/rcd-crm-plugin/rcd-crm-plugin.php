<?php
/**
 * Plugin Name: Real Estate CRM
 * Description: Real estate CRM and lead Management.
 * Version: 0.1
 * Author: TA Digiweb Solutions
 * License: TAAJ09212002
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('RCD_CRM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('RCD_CRM_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once RCD_CRM_PLUGIN_DIR . 'includes/enqueue-scripts.php';   // Enqueue scripts and styles
require_once RCD_CRM_PLUGIN_DIR . 'includes/template-loader.php';    // Load templates
require_once RCD_CRM_PLUGIN_DIR . 'admin/admin-menu.php';            // Admin menu and settings
require_once RCD_CRM_PLUGIN_DIR . 'admin/admin-settings.php';        // Admin settings functionality

// Initialize the plugin
function rcd_crm_plugin_init() {
    // Register custom post types
    rcd_crm_register_custom_post_types();
}
add_action('init', 'rcd_crm_plugin_init');

// Activation hook
function rcd_crm_plugin_activate() {
    // Code to run on activation, such as creating database tables
    rcd_crm_register_custom_post_types();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'rcd_crm_plugin_activate');

// Deactivation hook
function rcd_crm_plugin_deactivate() {
    // Code to run on deactivation, such as cleanup
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'rcd_crm_plugin_deactivate');

// Register Custom Post Types
function rcd_crm_register_custom_post_types() {
    register_post_type('associate', array(
        'labels' => array(
            'name' => __('Associates'),
            'singular_name' => __('Associate')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_position' => 5,
    ));

    register_post_type('customer', array(
        'labels' => array(
            'name' => __('Customers'),
            'singular_name' => __('Customer')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_position' => 6,
    ));
}

// Shortcode for the Associate Dashboard
function rcd_crm_associate_dashboard_shortcode() {
    ob_start();
    rcd_crm_load_template('associate-dashboard.php'); // Load the dashboard template
    return ob_get_clean();
}
add_shortcode('rcd_crm_associate_dashboard', 'rcd_crm_associate_dashboard_shortcode');

// User Registration Functionality
function rcd_crm_register_user($user_data) {
    if (!empty($user_data['username']) && !empty($user_data['password']) && !empty($user_data['role'])) {
        $user_id = wp_create_user($user_data['username'], $user_data['password'], $user_data['email']);
        if (!is_wp_error($user_id)) {
            // Add user role
            $user = new WP_User($user_id);
            $user->set_role($user_data['role']);
            return true;
        }
    }
    return false;
}

// Added to admin/admin-menu.php
// // Admin Menu
// function rcd_crm_add_admin_menu() {
//     add_menu_page('Real Estate CRM', 'Real Estate CRM', 'manage_options', 'rcd_crm', 'rcd_crm_settings_page');
// }
// add_action('admin_menu', 'rcd_crm_add_admin_menu');

// function rcd_crm_settings_page() {
//     echo '<h1>Real Estate CRM Settings</h1>';
//     // You can add settings form or functionality here
// }


// ALREADY DEFINED IN enqueue-scripts.php
// // Enqueue Scripts and Styles
// function rcd_crm_enqueue_scripts() {
//     wp_enqueue_style('rcd-crm-style', RCD_CRM_PLUGIN_URL . 'assets/css/style.css');
//     wp_enqueue_script('rcd-crm-script', RCD_CRM_PLUGIN_URL . 'assets/js/script.js', array('jquery'), null, true);
// }
// add_action('wp_enqueue_scripts', 'rcd_crm_enqueue_scripts');

// Include Additional Files
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/user-registration.php';
require_once plugin_dir_path(__FILE__) . 'includes/plugin-activation.php';

// Include Additional Files
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/user-registration.php';
require_once plugin_dir_path(__FILE__) . 'includes/plugin-activation.php';
require_once plugin_dir_path(__FILE__) . 'includes/kyc-management.php';
require_once plugin_dir_path(__FILE__) . 'includes/roles-capabilities.php';

// Include Additional Files
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/user-registration.php';
require_once plugin_dir_path(__FILE__) . 'includes/plugin-activation.php';
require_once plugin_dir_path(__FILE__) . 'includes/kyc-management.php';
require_once plugin_dir_path(__FILE__) . 'includes/roles-capabilities.php';
require_once plugin_dir_path(__FILE__) . 'includes/referral-system.php'; // Add this line
require_once plugin_dir_path(__FILE__) . 'includes/commission-management.php'; // Add this line

// Include Additional Files
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/user-registration.php';
require_once plugin_dir_path(__FILE__) . 'includes/plugin-activation.php';
require_once plugin_dir_path(__FILE__) . 'includes/kyc-management.php'; // Add this line
require_once plugin_dir_path(__FILE__) . 'includes/roles-capabilities.php';
require_once plugin_dir_path(__FILE__) . 'includes/referral-system.php'; 
require_once plugin_dir_path(__FILE__) . 'includes/commission-management.php'; 


