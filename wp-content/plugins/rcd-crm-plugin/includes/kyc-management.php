<?php
// KYC Management

// Handle KYC Document Upload
function rcd_crm_handle_kyc_upload() {
    if (isset($_POST['rcd_crm_upload_kyc']) && isset($_FILES['kyc_file'])) {
        $user_id = get_current_user_id();
        
        // Check if the user has already uploaded KYC
        $existing_kyc = get_user_meta($user_id, 'kyc_document', true);
        if ($existing_kyc) {
            // Optionally, you can overwrite the existing document or return an error
            delete_user_meta($user_id, 'kyc_document'); // Remove existing document
        }

        // File handling
        $uploaded_file = $_FILES['kyc_file'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);
        
        if ($movefile && !isset($movefile['error'])) {
            // Save the KYC document URL in user meta
            update_user_meta($user_id, 'kyc_document', $movefile['url']);
            echo '<div class="updated"><p>KYC document uploaded successfully!</p></div>';
        } else {
            echo '<div class="error"><p>Error uploading document: ' . esc_html($movefile['error']) . '</p></div>';
        }
    }
}
add_action('init', 'rcd_crm_handle_kyc_upload');

// Display KYC Status
function rcd_crm_display_kyc_status($user_id) {
    $kyc_document = get_user_meta($user_id, 'kyc_document', true);
    
    if ($kyc_document) {
        echo '<p>KYC Document: <a href="' . esc_url($kyc_document) . '" target="_blank">View Document</a></p>';
    } else {
        echo '<p>No KYC document uploaded.</p>';
    }
}
