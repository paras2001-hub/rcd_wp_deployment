<?php
// KYC Document Upload Functionality

function rcd_crm_handle_kyc_upload() {
    if (isset($_POST['rcd_crm_upload_kyc'])) {
        $user_id = get_current_user_id();
        $uploaded_file = $_FILES['kyc_file'];

        if ($uploaded_file['error'] === UPLOAD_ERR_OK) {
            $upload_overrides = array('test_form' => false);
            $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

            if ($movefile && !isset($movefile['error'])) {
                update_user_meta($user_id, 'kyc_document', $movefile['url']);
                echo '<p>KYC document uploaded successfully!</p>';
            } else {
                echo '<p>Error uploading KYC document. Please try again.</p>';
            }
        }
    }
}
add_action('init', 'rcd_crm_handle_kyc_upload');

// Function to display KYC status
function rcd_crm_display_kyc_status($user_id) {
    $kyc_url = get_user_meta($user_id, 'kyc_document', true);
    if ($kyc_url) {
        echo '<p>KYC Document: <a href="' . esc_url($kyc_url) . '" target="_blank">View Document</a></p>';
    } else {
        echo '<p>No KYC Document uploaded.</p>';
    }
}
