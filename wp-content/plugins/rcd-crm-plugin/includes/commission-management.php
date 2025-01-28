<?php
// Commission Management

function rcd_crm_calculate_commission($user_id) {
    // Logic to calculate commissions based on your business rules
    // This example uses a simple flat rate per referral
    $referrals = get_user_meta($user_id, 'referrals', true);
    $commission_rate = 100; // Example flat commission for each referral
    $total_commission = $referrals * $commission_rate;

    // Save the commission total to user meta
    update_user_meta($user_id, 'total_commission', $total_commission);
}

// Hook into the referral tracking to calculate commission
add_action('user_register', function($user_id) {
    rcd_crm_calculate_commission($user_id);
});

// Function to display user commission
function rcd_crm_display_commission($user_id) {
    $total_commission = get_user_meta($user_id, 'total_commission', true);
    echo '<p>Your Total Commission: $' . esc_html($total_commission ? $total_commission : 0) . '</p>';
}
