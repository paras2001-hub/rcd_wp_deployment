<?php

function create_status_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'status_table';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        client_id BIGINT(20) UNSIGNED NOT NULL,
        associate_id BIGINT(20) UNSIGNED NOT NULL,
        associate_name VARCHAR(255) NOT NULL,
        client_status VARCHAR(255) NOT NULL,
        locality VARCHAR(255) NOT NULL,
        plot_price_range VARCHAR(255) NOT NULL,
        booking_payment_id VARCHAR(255) NOT NULL,
        date_of_booking DATE NOT NULL,
        booking_amount DECIMAL(10, 2) NOT NULL,
        confirmation_payment_id VARCHAR(255),
        date_of_confirmation DATE,
        confirmation_amount DECIMAL(10, 2),
        satbara VARCHAR(255),
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}


function add_status_data($params_array)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'status_table';

    $wpdb->insert(
        $table_name,
        $params_array
    );
}

function get_status_details_by_client_id($client_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'status_table';

    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE client_id = %d",
            $client_id
        )
    );

    return $results;
}

function get_status_details_by_associate_id($associate_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'status_table';

    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE associate_id = %d",
            $associate_id
        )
    );

    return $results;
}
