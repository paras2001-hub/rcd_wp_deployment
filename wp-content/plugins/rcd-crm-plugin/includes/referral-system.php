<?php

// Display referral link for a user
function rcd_crm_display_referral_link($user_id) {
    $referral_link = home_url('?ref=' . get_user_meta($user_id, 'rcd_crm_referral_code', true));
    echo esc_url($referral_link) . '" target="_blank">' . esc_html($referral_link) . '</a></p>';
}

// Track referrals when a new user registers
function rcd_crm_track_referral() {
    if (isset($_GET['ref'])) {
        $referral_code = sanitize_text_field($_GET['ref']);
        $referrer = get_users(array(
            'meta_key' => 'rcd_crm_referral_code',
            'meta_value' => $referral_code,
            'fields' => 'ID'
        ));

        if ($referrer) {
            // Associate the new user with the referrer
            $referrer_id = $referrer[0];
            // Add a referral relationship (You can store this in a custom table if needed)
            update_user_meta($referrer_id, 'referrals', get_user_meta($referrer_id, 'referrals', true) + 1);
        }
    }
}
add_action('user_register', 'rcd_crm_track_referral');

// Function to display referral stats
function rcd_crm_display_referral_stats($user_id) {
    $referrals = get_user_meta($user_id, 'referrals', true);
    echo '<p>Total Referrals: ' . esc_html($referrals ? $referrals : 0) . '</p>';
}
