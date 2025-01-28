<?php

function create_payments_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'payments_table';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        payment_id VARCHAR(255) NOT NULL,
        client_id BIGINT(20) UNSIGNED NOT NULL,
        associate_id BIGINT(20) UNSIGNED NOT NULL,
        associate_name VARCHAR(255) NOT NULL,
        date_of_payment DATE NOT NULL,
        plot_price_range VARCHAR(255) NOT NULL,
        purpose VARCHAR(255) NOT NULL,
        amount DECIMAL(10, 2) NOT NULL,
        payment_method VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

function add_payment_data($params_array)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'payments_table';

    $wpdb->insert(
        $table_name,
        $params_array
    );
}

function get_payment_details_by_client_id($client_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'payments_table';

    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE client_id = %d",
            $client_id
        )
    );

    return $results;
}

function get_payment_details_by_associate_id($associate_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'payments_table';

    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE associate_id = %d",
            $associate_id
        )
    );

    return $results;
}


// Razorpay Linked Account for Associates (done along with account creation)
function create_linked_account($email, $phone, $name, $ifsc, $account_number)
{
    $response = wp_remote_post('https://api.razorpay.com/v1/accounts', [
        'headers' => [
            'Authorization' => 'Basic ' . base64_encode('YOUR_KEY:YOUR_SECRET'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'type' => 'route',
            'email' => $email,
            'contact' => $phone,
            'business_type' => 'individual',
            'business_name' => $name,
            'customer_facing_business_name' => 'Rising Crown Developers',
            'bank_account' => [
                'name' => $name,
                'ifsc' => $ifsc,
                'account_number' => $account_number,
            ],
        ]),
    ]);

    if (is_wp_error($response)) {
        error_log('Error creating linked account: ' . $response->get_error_message());
        return false;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (isset($data['id'])) {
        return $data['id']; // Return Linked Account ID
    }

    error_log('Failed to create linked account: ' . wp_remote_retrieve_body($response));
    return false;
}

// Function to create Razorpay order (returns Order Id)
// Example Usage
// $order_id = create_razorpay_order(500);
function create_razorpay_order($amount, $currency = 'INR')
{
    $response = wp_remote_post('https://api.razorpay.com/v1/orders', [
        'headers' => [
            'Authorization' => 'Basic ' . base64_encode('YOUR_KEY:YOUR_SECRET'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'amount' => $amount * 100, // Convert to paise
            'currency' => $currency,
            'receipt' => 'rcpt_' . uniqid(),
        ]),
    ]);

    if (is_wp_error($response)) {
        error_log('Error creating Razorpay order: ' . $response->get_error_message());
        return false;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (isset($data['id'])) {
        return $data['id'];
    }

    error_log('Failed to create Razorpay order: ' . wp_remote_retrieve_body($response));
    return false;
}

// Distribute payments to linked accounts (Associates)
// Example Usage
// $commissions = [
//     [
//         "account" => "acc_xxxxxxxxxxx", // Linked account ID for Associate 1
//         "amount" => 20000, // Amount in paise (e.g., ₹200)
//         "currency" => "INR",
//         "notes" => [
//             "description" => "Commission for John Doe",
//         ],
//     ],
//     [
//         "account" => "acc_yyyyyyyyyy", // Linked account ID for Associate 2
//         "amount" => 10000, // Amount in paise (e.g., ₹100)
//         "currency" => "INR",
//         "notes" => [
//             "description" => "Commission for Jane Doe",
//         ],
//     ],
// ];
// $payment_id = "pay_xyz123"; // Razorpay Payment ID
// distribute_commissions($payment_id, $commissions);
function distribute_commissions($payment_id, $commissions)
{
    $response = wp_remote_post("https://api.razorpay.com/v1/payments/$payment_id/transfers", [
        'headers' => [
            'Authorization' => 'Basic ' . base64_encode('YOUR_KEY:YOUR_SECRET'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode($commissions),
    ]);

    if (is_wp_error($response)) {
        error_log('Error distributing commissions: ' . $response->get_error_message());
        return false;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (!empty($data['id'])) {
        return true; // Success
    }

    error_log('Failed to distribute commissions: ' . wp_remote_retrieve_body($response));
    return false;
}

function razorpay_webhook_handler() {
    $payload = file_get_contents('php://input');
    $webhook_data = json_decode($payload, true);

    if ($webhook_data['event'] === 'payment.captured') {
        $payment_id = $webhook_data['payload']['payment']['entity']['id'];
        $amount = $webhook_data['payload']['payment']['entity']['amount']; // In paise

        // Process payment (e.g., mark order as paid, send email, etc.)
        // global $wpdb;
        // $table_name = $wpdb->prefix . 'payments_table';

        // $wpdb->insert(
        //     $table_name,
        //     [
        //         'payment_id' => $payment_id,
        //         'client_id' => 0, // Replace with actual client ID
        //         'associate_id' => 0, // Replace with actual associate ID
        //         'associate_name' => '', // Replace with actual associate name
        //         'date_of_payment' => current_time('mysql'),
        //         'plot_price_range' => '', // Replace with actual plot price range
        //         'purpose' => '', // Replace with actual purpose
        //         'amount' => $amount / 100, // Convert from paise to rupees
        //         'payment_method' => 'Razorpay',
        //     ]
        // );
    }
}
