<?php
// Plugin Activation

function rcd_crm_activate() {
    // Here you can create custom database tables if needed
    // Or perform any initial setup for your plugin
    flush_rewrite_rules(); // Ensure permalinks are refreshed
}
register_activation_hook(__FILE__, 'rcd_crm_activate');
