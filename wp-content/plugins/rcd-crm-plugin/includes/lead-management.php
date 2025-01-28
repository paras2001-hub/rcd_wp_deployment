<?php
// Lead Management Functionality

function rcd_crm_add_lead($lead_data) {
    $lead_id = wp_insert_post(array(
        'post_title'   => $lead_data['name'],
        'post_content' => $lead_data['details'],
        'post_status'  => 'publish',
        'post_type'    => 'lead',
    ));

    if (!is_wp_error($lead_id)) {
        // Save custom fields for the lead
        update_post_meta($lead_id, 'lead_status', $lead_data['status']);
        update_post_meta($lead_id, 'associate_id', $lead_data['associate_id']);
        return $lead_id;
    }

    return false;
}

// Handle Lead Submission
function rcd_crm_handle_lead_submission() {
    if (isset($_POST['rcd_crm_add_lead'])) {
        $lead_data = array(
            'name'        => sanitize_text_field($_POST['lead_name']),
            'details'     => sanitize_textarea_field($_POST['lead_details']),
            'status'      => sanitize_text_field($_POST['lead_status']),
            'associate_id' => get_current_user_id(),
        );

        if (rcd_crm_add_lead($lead_data)) {
            echo '<p>Lead added successfully!</p>';
        } else {
            echo '<p>Error in adding lead. Please try again.</p>';
        }
    }
}
add_action('init', 'rcd_crm_handle_lead_submission');

// Function to display leads
function rcd_crm_display_leads($associate_id) {
    $args = array(
        'post_type'   => 'lead',
        'post_status' => 'publish',
        'meta_query'  => array(
            array(
                'key'     => 'associate_id',
                'value'   => $associate_id,
                'compare' => '='
            )
        )
    );

    $leads = new WP_Query($args);

    if ($leads->have_posts()) {
        echo '<ul>';
        while ($leads->have_posts()) {
            $leads->the_post();
            echo '<li>' . get_the_title() . ' - Status: ' . get_post_meta(get_the_ID(), 'lead_status', true) . '</li>';
        }
        echo '</ul>';
        wp_reset_postdata();
    } else {
        echo '<p>No leads found.</p>';
    }
}
