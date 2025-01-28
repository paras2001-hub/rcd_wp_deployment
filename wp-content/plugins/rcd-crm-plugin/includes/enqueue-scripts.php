<?php
// Enqueue styles and scripts for the plugin
function rcd_crm_enqueue_scripts() {
    wp_enqueue_style('rcd-crm-style', RCD_CRM_PLUGIN_URL . 'assets/css/style.css');
    wp_enqueue_script('rcd-crm-script', RCD_CRM_PLUGIN_URL . 'assets/js/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'rcd_crm_enqueue_scripts');
