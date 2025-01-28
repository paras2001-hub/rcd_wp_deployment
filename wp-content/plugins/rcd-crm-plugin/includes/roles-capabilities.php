<?php
// Roles and Capabilities Management

function rcd_crm_add_roles() {
    add_role('associate', __('Associate'), array(
        'read' => true,
        'edit_posts' => false,
        'delete_posts' => false,
        'publish_posts' => false,
    ));

    add_role('customer', __('Customer'), array(
        'read' => true,
        'edit_posts' => false,
        'delete_posts' => false,
        'publish_posts' => false,
    ));
}
add_action('init', 'rcd_crm_add_roles');

// Cleanup on plugin deactivation
function rcd_crm_remove_roles() {
    remove_role('associate');
    remove_role('customer');
}
register_deactivation_hook(__FILE__, 'rcd_crm_remove_roles');
