<?php
// Commission Tracking Functionality

function rcd_crm_calculate_commissions($user_id) {
    // Example commission calculation logic
    $leads = get_posts(array(
        'post_type' => 'lead',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'associate_id',
                'value' => $user_id,
                'compare' => '='
            )
        )
    ));

    $commission = 0;
    foreach ($leads as $lead) {
        $lead_status = get_post_meta($lead->ID, 'lead_status', true);
        if ($lead_status === 'closed') {
            $commission += 100; // Example: Fixed commission for closed leads
        }
    }
    return $commission;
}

// Function to display commission earnings
function rcd_crm_display_commission($user_id) {
    $commission = rcd_crm_calculate_commissions($user_id);
    echo '<h2>Your Total Commissions: $' . number_format($commission, 2) . '</h2>';
}
