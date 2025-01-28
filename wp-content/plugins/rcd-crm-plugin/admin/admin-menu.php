<?php
// Admin Menu

// function rcd_crm_add_admin_menu() {
//     add_menu_page(
//         'RCD CRM',                  // Page title
//         'RCD CRM',                  // Menu title
//         'manage_options',           // Capability
//         'rcd_crm',                  // Menu slug
//         'rcd_crm_admin_page',       // Callback function
//         'dashicons-admin-users',    // Icon
//         20                          // Position
//     );
// }

// function rcd_crm_admin_page() {
//     echo '<h1>Welcome to RCD CRM</h1>';
//     // Include additional admin settings here
// }

// add_action('admin_menu', 'rcd_crm_add_admin_menu');

//From main plugin file
function rcd_crm_add_admin_menu() {
    add_menu_page('Real Estate CRM', 'Real Estate CRM', 'manage_options', 'rcd_crm', 'rcd_crm_settings_page');
}
add_action('admin_menu', 'rcd_crm_add_admin_menu');

function rcd_crm_settings_page() {
    echo '<h1>Real Estate CRM Settings</h1>';
    // You can add settings form or functionality here
}
