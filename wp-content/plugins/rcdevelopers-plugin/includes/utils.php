<?php

function user_file_upload($user_id, $file_upload, $meta_key)
{
    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }
    
    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($file_upload, $upload_overrides);
    if ($movefile && !isset($movefile['error'])) {
        update_user_meta($user_id, $meta_key, $movefile['url']);
    } else {
        wp_redirect(home_url('/signup?signup=failed&error=file_upload'));
        exit;
    }
}