<?php
// Widgets

class RCD_CRM_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'rcd_crm_widget',
            __('RCD CRM Widget', 'rcd_crm'),
            array('description' => __('A widget to display CRM info', 'rcd_crm'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo __('Hello, this is RCD CRM Widget!', 'rcd_crm');
        echo $args['after_widget'];
    }
}

function rcd_crm_register_widget() {
    register_widget('RCD_CRM_Widget');
}
add_action('widgets_init', 'rcd_crm_register_widget');
