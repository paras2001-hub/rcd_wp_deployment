<?php
/*
Plugin Name: Document Generator Plugin
Description: A plugin to generate PDFs using mPDF and add custom text.
Author: Paras Patil
*/

if (! defined('ABSPATH')) exit;

require_once ABSPATH . 'vendor/autoload.php';

ini_set('allow_url_fopen', '1');

function document_generator_create_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'document_generator_templates';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        template_name VARCHAR(255) NOT NULL,
        template_type VARCHAR(255) NOT NULL,
        width INT(255) NOT NULL,
        height INT(255) NOT NULL,
        template_doc_address TEXT NOT NULL,
        personal_details_x INT(255) NOT NULL,
        personal_details_y INT(255) NOT NULL,
        additional_details BOOLEAN NOT NULL,
        additional_details_x INT(255),
        additional_details_y INT(255),
        font_color VARCHAR(255),
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'document_generator_create_table');

function document_generator_add_templates_menu()
{
    add_menu_page(
        'Document Generator Templates',
        'Document Generator Templates',
        'manage_options',
        'document-generator-templates',
        'document_generator_templates_page_callback',
        'dashicons-media-document',
        20
    );
}
add_action('admin_menu', 'document_generator_add_templates_menu');


function document_generator_templates_page_callback()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'document_generator_templates';

    $upload_overrides = array('test_form' => false);
    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_template'])) {
            error_log(print_r($_FILES, true));
            $movefile = wp_handle_upload($_FILES['template_doc'], $upload_overrides);
            error_log(print_r($movefile, true));

            $wpdb->insert($table_name, [
                'template_name' => sanitize_text_field($_POST['template_name']),
                'template_type' => sanitize_text_field($_POST['template_type']),
                'width' => sanitize_text_field($_POST['width']),
                'height' => sanitize_text_field($_POST['height']),
                'template_doc_address' => $movefile['url'],
                'personal_details_x' => intval($_POST['personal_details_x']),
                'personal_details_y' => intval($_POST['personal_details_y']),
                'additional_details' => isset($_POST['additional_details']),
                'additional_details_x' => intval($_POST['additional_details_x']),
                'additional_details_y' => intval($_POST['additional_details_y']),
                'font_color' => sanitize_text_field($_POST['font_color']),
            ]);
        } elseif (isset($_POST['delete_template'])) {
            $wpdb->delete($table_name, ['id' => intval($_POST['template_id'])]);
        }
    }

    // Fetch all templates
    $templates = $wpdb->get_results("SELECT * FROM $table_name");

?>
    <div class="wrap">
        <h1>Manage Templates</h1>

        <!-- Add Template Form -->
        <h2>Add New Template</h2>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th><label for="template_name">Template Name</label></th>
                    <td><input type="text" name="template_name" required class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="template_type">Type</label></th>
                    <td>
                        <select name="template_type" required class="regular-text">
                            <option value="card">Card</option>
                            <option value="brochure">Brochure</option>
                            <option value="poster">Poster</option>
                        </select>
                    </td>
                    </td>
                </tr>
                <tr>
                    <th><label for="width">Document Width</label></th>
                    <td><input type="text" name="width" required class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="height">Document Height</label></th>
                    <td><input type="text" name="height" required class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="template_doc">Template Document</label></th>
                    <td><input type="file" name="template_doc" required accept="image/*"></td>
                </tr>
                <tr>
                    <th><label for="personal_details_x">Personal Details (X)</label></th>
                    <td><input name="personal_details_x" required class="regular-text"></input></td>
                </tr>
                <tr>
                    <th><label for="personal_details_y">Personal Details (Y)</label></th>
                    <td><input name="personal_details_y" required class="regular-text"></input></td>
                </tr>
                <tr>
                    <th><label for="additional_details">Additional Details</label></th>
                    <td><input type="checkbox" name="additional_details" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="additional_details_x">Additional Details (X)</label></th>
                    <td><input name="additional_details_x" class="regular-text"></input></td>
                </tr>
                <tr>
                    <th><label for="additional_details_y">Additional Details (Y)</label></th>
                    <td><input name="additional_details_y" class="regular-text"></input></td>
                </tr>
                <tr>
                    <th><label for="font_color">Font Color</label></th>
                    <td><input name="font_color" class="regular-text"></input></td>
                </tr>
            </table>
            <p class="submit"><button type="submit" name="add_template" class="button button-primary">Add Template</button></p>
        </form>
        <h2>Existing Templates</h2>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>Image Address</th>
                    <th>Personal Details (X)</th>
                    <th>Personal Details (Y)</th>
                    <th>Additional Details</th>
                    <th>Additional Details (X)</th>
                    <th>Additional Details (Y)</th>
                    <th>Font Color</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($templates as $template): ?>
                    <tr>
                        <td><?php echo esc_html($template->template_name); ?></td>
                        <td><?php echo esc_html($template->template_type); ?></td>
                        <td><?php echo esc_html($template->width); ?></td>
                        <td><?php echo esc_html($template->height); ?></td>
                        <td><?php echo esc_html($template->template_doc_address); ?></td>
                        <td><?php echo esc_html($template->personal_details_x); ?></td>
                        <td><?php echo esc_html($template->personal_details_y); ?></td>
                        <td><?php echo esc_html($template->additional_details); ?></td>
                        <td><?php echo esc_html($template->additional_details_x); ?></td>
                        <td><?php echo esc_html($template->additional_details_y); ?></td>
                        <td><?php echo esc_html($template->font_color); ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="template_id" value="<?php echo intval($template->id); ?>">
                                <button type="submit" name="delete_template" class="button button-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php
}


function generate_pdf()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'document_generator_templates';

    $template_id = intval($_POST['template_id']);
    $template = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $template_id));

    $user = wp_get_current_user();
    $email = $user->user_email;
    $first_name = get_user_meta($user->ID, 'first_name', true);
    $last_name = get_user_meta($user->ID, 'last_name', true);
    $full_name = $first_name . ' ' . $last_name;
    if($first_name == '' && $last_name == '') {
        $full_name = 'Undefined';
    }
    $business_address = get_user_meta($user->ID, 'business_address', true);
    if($business_address == '') {
        $business_address = 'No address provided';
    }
    $associate_role = get_user_meta($user->ID, 'associate_role', true);
    if($associate_role == '') {
        $associate_role = 'No role provided';
    }

    if ($template) {
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf',
            'mode' => 'utf-8',
            'format' => [$template->width, $template->height],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
        ]);
        $mpdf->curlAllowUnsafeSslRequests = true;
        $mpdf->showImageErrors = true;
        $mpdf->debug = true;

        $local_path = str_replace(site_url(), ABSPATH, $template->template_doc_address);

        $style = "
        <style>
            .card-details {
                width: {$template->width}mm;
                height: {$template->height}mm;
                padding-left: {$template->personal_details_x}mm;
                padding-top: {$template->personal_details_y}mm;
                background-image: url('$local_path');
                background-repeat: no-repeat;
                background-size: cover;
            }
            .heading {
                font-size: 10rem;
                font-weight: 600;
                font-family: 'Trebuchet MS', sans-serif;
                color: {$template->font_color};
            }
            .subheading {
                font-size: 5rem;
                font-weight: 500;
                font-family: 'Trebuchet MS', sans-serif;
                color: {$template->font_color};
            }
            .body {
                font-size: 4rem;
                font-weight: 400;
                font-family: 'Trebuchet MS', sans-serif;
                color: {$template->font_color};
            }
        </style>
        ";
        switch ($template->template_type) {
            case 'card':
                $html_content =
                    "<!DOCTYPE html>
                <html>
                <body>
                " . $style . "
                    <div class='card'>
                        
                        <div class='card-details'>
                            <div class='heading'>$full_name</div>
                            <div class='subheading'>$associate_role</div>
                            <div class='body'>$business_address</div>
                            <div class='body'>$email</div>
                        </div>
                    </div>
                </body>
                </html>";
                break;
        }

        $mpdf->WriteHTML($html_content);

        $gen_time = time();
        $timed_identifier = substr(md5($gen_time), 0, 5);

        $mpdf->Output('generated_promo_' . $timed_identifier . '.pdf', 'I');
    }
}

add_action('admin_post_generate_pdf', 'generate_pdf');
add_action('admin_post_nopriv_generate_pdf', 'generate_pdf');

?>