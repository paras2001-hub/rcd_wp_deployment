<?php
// Custom Post Types

function rcd_crm_register_post_types() {
    // Lead Post Type
    register_post_type('lead', array(
        'labels' => array(
            'name' => __('Leads'),
            'singular_name' => __('Lead'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor'),
    ));

    // Associate Post Type
    register_post_type('associate', array(
        'labels' => array(
            'name' => __('Associates'),
            'singular_name' => __('Associate'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor'),
    ));

    // Customer Post Type
    register_post_type('customer', array(
        'labels' => array(
            'name' => __('Customers'),
            'singular_name' => __('Customer'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor'),
    ));
}
add_action('init', 'rcd_crm_register_post_types');
