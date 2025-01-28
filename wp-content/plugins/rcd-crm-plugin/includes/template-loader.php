<?php
// Load template files
function rcd_crm_load_template($template_name) {
    $template_path = RCD_CRM_PLUGIN_DIR . 'templates/' . $template_name;

    if (file_exists($template_path)) {
        include($template_path);
    } else {
        echo '<p>Template not found.</p>';
    }
}
