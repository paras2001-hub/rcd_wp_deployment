<?php
// Admin Settings

function rcd_crm_settings_init() {
    register_setting('rcd_crm', 'rcd_crm_options');

    add_settings_section(
        'rcd_crm_section_developers',
        __('Your section description', 'rcd_crm'),
        null,
        'rcd_crm'
    );

    add_settings_field(
        'rcd_crm_field_example',
        __('Example Field', 'rcd_crm'),
        'rcd_crm_field_example_render',
        'rcd_crm',
        'rcd_crm_section_developers'
    );
}

function rcd_crm_field_example_render() {
    $options = get_option('rcd_crm_options');
    ?>
    <input type='text' name='rcd_crm_options[example]' value='<?php echo $options['example']; ?>'>
    <?php
}

add_action('admin_init', 'rcd_crm_settings_init');
