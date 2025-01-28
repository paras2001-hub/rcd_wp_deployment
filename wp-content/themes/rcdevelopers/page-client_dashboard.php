<!DOCTYPE html>
<html lang="en">

<head>
    <title>RCD Dashboard</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Site Template">
    <meta name="author" content="https://paras2001-hub.github.io/">
    <link rel="shortcut icon" href="images/logo.png">

    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>

    <?php
    $user = wp_get_current_user();

    if (!$user->exists()) {
        wp_redirect(site_url('/sign-in'));
        exit;
    }

    if (!($user->roles && in_array('administrator', $user->roles))) {
        if (metadata_exists('user', $user->ID, 'associate_role')) {
            wp_redirect(site_url('/sign-in'));
            exit;
        }
    }

    $user_id = $user->ID;

    $first_name = get_user_meta($user_id, 'first_name', true);
    $last_name = get_user_meta($user_id, 'last_name', true);
    $email = $user->display_name;
    $phone_no = get_user_meta($user_id, 'phone_no', true);

    $state = get_user_meta($user_id, 'state', true);
    $city = get_user_meta($user_id, 'city', true);

    $linked_code = get_user_meta($user_id, 'linked_code', true);
    $status = get_user_meta($user_id, 'status', true);

    $profile_pic = get_user_meta($user_id, 'profile_pic', true);
    if ($profile_pic) {
        $profile_pic_temp = explode('/', $profile_pic);
        $profile_pic_file_name = end($profile_pic_temp);
    } else {
        $profile_pic_file_name = 'No file uploaded';
    }

    ?>
    <div class="full-page-wrapper main-wrapper even-padded">
        <div class="dashboard-wrapper">
            <div class="dashboard-navigation label">
                <div class="dashboard-content">
                    <div class="close-button">
                        <a href="#">
                            <i class="fas fa-times midhighheading"></i>
                        </a>
                    </div>
                    <ul class="nav-menu-client">
                        <li class="nav-item current" data-target="tisari-mumbai"><a href="#"><i class="fas fa-home submidheading"></i>Tisari Mumbai</a></li>
                        <li class="nav-item" data-target="manage-client-profile"><a href="#"><i class="fas fa-user submidheading"></i>Manage Profile</a></li>
                        <li class="nav-item" data-target="investment-options"><a href="#"><i class="fas fa-chart-line submidheading"></i>Investment Options</a></li>
                        <li class="nav-item" data-target="investor-psychology"><a href="#"><i class="fas fa-brain submidheading"></i>Investor's Psychology</a></li>
                        <li class="nav-item" data-target="news-and-updates-client"><a href="#"><i class="fas fa-newspaper submidheading"></i>News and Updates</a></li>
                        <li class="nav-item" data-target="booking-details"><a href="#"><i class="fas fa-calendar-check submidheading"></i>Booking Details</a></li>
                        <li class="nav-item" data-target="payment-receipts"><a href="#"><i class="fas fa-receipt submidheading"></i>Payment Receipts</a></li>
                        <li class="nav-item" data-target="my-satbara"><a href="#"><i class="fas fa-file-alt submidheading"></i>My 7/12</a></li>
                    </ul>
                </div>
            </div>
            <div class="dashboard-content">
                <div id="tisari-mumbai" class="client-dashboard-section dashboard-tisari-mumbai active">
                    <div class="tisari-mumbai-information">
                        <div class="tisari-mumbai-description major-left-container about-tisari-mumbai">
                            <div class="title">
                                About <div class="highlight">Tisari Mumbai</div>
                            </div>
                            <div class="body">
                                Tisari Mumbai (NAINA) is a proposed smart city in the Raigad district of Maharashtra, planned around the Navi Mumbai International Airport. The acronym stands for "Navi Mumbai Airport Influence Notified Area" and covers approximately 600 square kilometers within a 25-kilometer radius of the airport. CIDCO is the designated planning authority for this area, which includes around 170 villages in Pen, Panvel, and Uran talukas.
                            </div>
                            <div class="tisari-mumbai-logo">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tisari-mumbai-logo.png" alt="Tisari Mumbai Logo">
                            </div>
                            <div class="body">The city is envisioned as India's largest smart city and a financial hub, integrating agro-farming, education, trade, IT services, healthcare, and more.</div>
                        </div>
                        <div class="tisari-mumbai-images">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tisari_mumbai_map_view.png" alt="Map View">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/introduction.png" alt="Map View">
                        </div>
                    </div>
                    <div class="naina major-left-container about-tisari-mumbai">
                        <div class="naina-description left">
                            <div class="body">New Town</div>
                            <div class="title">NAINA</div>
                            <div class="naina-text body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <btn class="subheading btn btn-primary" href="<?php echo get_template_directory_uri(); ?>/assets/files/naina_document.pdf">Additional Details <i class="fas fa-info-circle"></i></btn>
                        </div>
                        <div class="naina-map right">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/naina_image.png" alt="Naina Image">
                        </div>
                    </div>
                    <div class="khopta major-left-container about-tisari-mumbai">
                        <div class="khopta-description left">
                            <div class="body">New Town</div>
                            <div class="title">Khopta</div>
                            <div class="khopta-text body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <btn class="subheading btn btn-primary" href="<?php echo get_template_directory_uri(); ?>/assets/files/khopta_document.pdf">Additional Details <i class="fas fa-info-circle"></i></btn>
                        </div>
                        <div class="khopta-map right">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/khopta_image.png" alt="Khopta Image">
                        </div>
                    </div>

                </div>
                <div id="manage-client-profile" class="client-dashboard-section manage-profile hidden">
                    <div class="main-section">
                        <div class="dashboard-title title">
                            Manage Profile
                        </div>
                        <div class="dashboard-description body">
                            You can edit any information by <b>double-tapping</b> the field. Sensitive fields such as KYC Documents require additional OTP verification.
                        </div>
                        <div class="profile-section">
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">First Name</div>
                                    <div class="value midheading editable" data-field="first_name">
                                        <?php echo $first_name; ?>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">Last Name</div>
                                    <div class="value midheading editable" data-field="last_name">
                                        <?php echo $last_name; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">Phone No.</div>
                                    <div class="value midheading editable" data-field="phone_no">
                                        <?php echo $phone_no; ?>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">Email Address</div>
                                    <div class="value midheading editable" data-field="email">
                                        <?php echo $email; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">State</div>
                                    <div class="value midheading editable" data-field="state">
                                        <?php echo $state; ?>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">City</div>
                                    <div class="value midheading editable" data-field="city">
                                        <?php echo $city; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="minor-section dashboard-tile">
                        <div class="edit-description body">
                            An OTP will be sent to your email for identity verification. Please enter the OTP to confirm your changes.
                        </div>
                        <button type="submit" class="subheading btn btn-primary profile-edit">Finish Editing <i class="fas fa-check"></i></button>
                    </div>
                </div>
                <div id="investment-options" class="client-dashboard-section hidden">Investment Options Content</div>

                <div id="investor-psychology" class="client-dashboard-section hidden">Investor's Psychology Content</div>
                <div id="news-and-updates-client" class="client-dashboard-section hidden">
                    <div class="latest-news">
                        <div class="latest-title label">
                            <b>Latest News</b>
                        </div>
                        <div class="vertical-spacer"></div>
                        <div class="latest-news-carousel label">
                            <?php
                            $query = array(
                                'post_type' => 'post',
                                'posts_per_page' => 5,
                                'order' => 'DESC'
                            );
                            $wp_query = new WP_Query($query);

                            if (have_posts()) : while (have_posts()) : the_post(); ?>
                                    <a class="latest-news-titles" href="<?php the_permalink() ?>" title="Link to <?php the_title_attribute() ?>">
                                        <?php the_title(); ?>
                                    </a>
                                <?php endwhile; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="trending-section">
                        <div class="primary-trending">
                            <?php
                            $query = array(
                                'post_type' => 'post',
                                'posts_per_page' => 1,
                                'order' => 'DESC'
                            );
                            $wp_query = new WP_Query($query);

                            if (have_posts()) : while (have_posts()) : the_post(); ?>
                                    <a href="<?php the_permalink() ?>" title="Link to <?php the_title_attribute() ?>">
                                        <?php
                                        if (has_post_thumbnail()) { ?>
                                            <img class="primary-news-image" src="<?php the_post_thumbnail_url(); ?>" alt="Featured Image" class="featured-image">
                                        <?php } else {
                                            echo 'No featured image available.';
                                        }
                                        ?>
                                        <div class='primary-news-details'>
                                            <?php the_title('<div class="primary-news-title midhighheading">', '</div>'); ?>
                                            <div class="primary-news-date label"><?php echo get_the_date() . ' ' . get_the_time(); ?></div>
                                        </div>
                                    </a>
                                <?php endwhile;
                            else: ?>
                                <p><?php _e('Sorry, no posts published so far.'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="secondary-trending">
                            <div class="trending-title midhighheading">
                                Trending Now
                            </div>
                            <div class="news-tile over-image">

                                <?php
                                $query = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 3,
                                    'meta_key'       => 'post_views',
                                    'orderby'        => 'meta_value_num',
                                    'order'          => 'DESC',
                                );
                                $wp_query = new WP_Query($query);

                                if (have_posts()) : while (have_posts()) : the_post(); ?>
                                        <a class="secondary-news-container" href="<?php the_permalink() ?>" title="Link to <?php the_title_attribute() ?>">
                                            <?php
                                            if (has_post_thumbnail()) { ?>
                                                <img class="secondary-news-image" src="<?php the_post_thumbnail_url(); ?>" alt="Featured Image" class="featured-image">
                                            <?php } else { ?>
                                                <img class="secondary-news-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/tisari-mumbai-logo.png" alt="Featured Image" class="featured-image">
                                            <?php } ?>
                                            <div class='secondary-news-details'>
                                                <?php the_title('<div class="secondary-news-title o-body">', '</div>'); ?>
                                                <div class="secondary-news-date label"><?php echo get_the_date() . ' ' . get_the_time(); ?></div>
                                            </div>
                                        </a>
                                    <?php endwhile; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="featured-section">
                        <div class="featured-title title">
                            Featured News
                            <div class="navigation-buttons">
                                <button class="btn btn-transparent" id="featured-prev-button"><i class="fas fa-arrow-left"></i></button>
                                <button class="btn btn-transparent" id="featured-next-button"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="featured-news" id="featured-container">
                            <?php
                            $query = array(
                                'post_type'      => 'post',
                                'posts_per_page' => -1,
                                'order' => 'DESC',
                                'category_name' => 'featured'
                            );
                            $wp_query = new WP_Query($query);

                            if (have_posts()) : while (have_posts()) : the_post(); ?>
                                    <div class="news-tile side-image featured-news-tile">
                                        <?php
                                        if (has_post_thumbnail()) { ?>
                                            <img class="news-side-image" src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="Featured Image" class="featured-image">
                                        <?php } else { ?>
                                            <img class="news-side-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/tisari-mumbai-logo.png" alt="Featured Image" class="featured-image">
                                        <?php } ?>
                                        <div class="news-description">
                                            <a class="subheading" href="<?php the_permalink() ?>" title="Link to <?php the_title_attribute() ?>">
                                                <?php the_title(); ?>
                                            </a>
                                            <div class="news-meta-data">
                                                <div class="news-tags label">
                                                    <?php the_tags(); ?>
                                                </div>
                                                <div class="news-date-time label">
                                                    <?php echo get_the_date() . ' ' . get_the_time(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                            else: ?>
                                <p><?php _e('Sorry, no posts published so far.'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="editors-section">
                        <div class="editors-title title">
                            Editor's Choice
                            <div class="navigation-buttons">
                                <button class="btn btn-transparent" id="editors-prev-button"><i class="fas fa-arrow-left"></i></button>
                                <button class="btn btn-transparent" id="editors-next-button"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="editors-news" id="editors-container">
                            <?php
                            $query = array(
                                'post_type'      => 'post',
                                'posts_per_page' => -1,
                                'order' => 'DESC',
                                'category_name' => 'editor'
                            );
                            $wp_query = new WP_Query($query);

                            if (have_posts()) : while (have_posts()) : the_post(); ?>
                                    <div class="news-tile side-image editor-news-tile">
                                        <?php
                                        if (has_post_thumbnail()) { ?>
                                            <img class="news-side-image" src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="Featured Image" class="featured-image">
                                        <?php } else { ?>
                                            <img class="news-side-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/tisari-mumbai-logo.png" alt="Featured Image" class="featured-image">
                                        <?php } ?>
                                        <div class="news-description">
                                            <a class="subheading" href="<?php the_permalink() ?>" title="Link to <?php the_title_attribute() ?>">
                                                <?php the_title(); ?>
                                            </a>
                                            <div class="news-meta-data">
                                                <div class="news-tags label">
                                                    <?php the_tags(); ?>
                                                </div>
                                                <div class="news-date-time label">
                                                    <?php echo get_the_date() . ' ' . get_the_time(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                            else: ?>
                                <p><?php _e('Sorry, no posts published so far.'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="booking-details" class="client-dashboard-section booking-details hidden">
                    <div class="dashboard-section-half">
                        <div class="dashboard-title self-brand-title title">
                            Booking Details
                        </div>
                        <div class="dashboard-description self-brand-description body">
                            You can view your latest bookings here. If any changes are required, please contact our associate.
                        </div>
                    </div>
                    <div class="leads-search">
                        <?php
                        $booking_statuses = get_status_details_by_client_id($user_id);
                        $sr_no = 0;
                        ?>
                        <div class="search-bar">
                            <input type="text" id="booking-search" class="search-input label" placeholder="Search by any field">
                            <i class="fas fa-search subheading"></i>
                        </div>
                        <div id="booking-results-count" class="results-count label">Showing 0 result/s</div>
                        <div class="filler"></div>
                    </div>

                    <div class="leads-tabular-list dashboard-tile">
                        <table class="leads-table" id="booking-table">
                            <thead>
                                <tr class="label">
                                    <th>Sr. No.</th>
                                    <th>Associate name</th>
                                    <th>Area/Locality</th>
                                    <th>Plot Price Range</th>
                                    <th>Date of Booking</th>
                                    <th>Booking Amt.</th>
                                    <th>Date of Confirmation</th>
                                    <th>Confirmation Amt.</th>
                                </tr>
                            </thead>
                            <tbody id="booking-table-body">
                                <?php if (!empty($payment_receipts)) : ?>
                                    <?php foreach ($payment_receipts as $receipt) : ?>
                                        <tr>
                                            <td><?php echo $sr_no++; ?></td>
                                            <td><?= htmlspecialchars($customer['associate_name']) ?></td>
                                            <td><?= htmlspecialchars($customer['locality']) ?></td>
                                            <td><?= htmlspecialchars($customer['plot_price_range']) ?></td>
                                            <td><?= htmlspecialchars($customer['date_of_booking']) ?></td>
                                            <td><?= htmlspecialchars($customer['booking_amount']) ?></td>
                                            <td><?= htmlspecialchars($customer['date_of_confirmation'] ?? '--') ?></td>
                                            <td><?= htmlspecialchars($customer['confirmation_amount']) ?? '--'?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td class="body empty-result" colspan="8">It seems like you haven't purchased anything yet!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="payment-receipts" class="client-dashboard-section payment-receipts hidden">
                    <div class="dashboard-section-half">
                        <div class="dashboard-title self-brand-title title">
                            Payment Receipts
                        </div>
                        <div class="dashboard-description self-brand-description body">
                            You can view all your payments as well as download their receipts in this section.
                        </div>
                    </div>
                    <div class="leads-search">
                        <?php
                        $payment_receipts = get_payment_details_by_client_id($user_id);
                        $sr_no = 0;
                        ?>
                        <div class="search-bar">
                            <input type="text" id="payment-search" class="search-input label" placeholder="Search by any field">
                            <i class="fas fa-search subheading"></i>
                        </div>
                        <div id="payments-results-count" class="results-count label">Showing 0 result/s</div>
                        <div class="filler"></div>
                    </div>

                    <div class="leads-tabular-list dashboard-tile">
                        <table class="leads-table" id="payments-table">
                            <thead>
                                <tr class="label">
                                    <th>Sr. No.</th>
                                    <th>Payment ID</th>
                                    <th>Associate Name</th>
                                    <th>Date</th>
                                    <th>Plot Price</th>
                                    <th>Purpose</th>
                                    <th>Booking Amt.</th>
                                    <th>Confirmation Amt.</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="payments-table-body">
                                <?php if (!empty($payment_receipts)) : ?>
                                    <?php foreach ($payment_receipts as $receipt) : ?>
                                        <tr>
                                            <td><?php echo $sr_no++; ?></td>
                                            <td><?= htmlspecialchars($customer['payment_id']) ?></td>
                                            <td><?= htmlspecialchars($customer['associate_name']) ?></td>
                                            <td><?= htmlspecialchars($customer['date_of_payment']) ?></td>
                                            <td><?= htmlspecialchars($customer['plot_price_range']) ?></td>
                                            <td><?= htmlspecialchars($customer['purpose']) ?></td>
                                            <td><?= htmlspecialchars($customer['amount']) ?></td>
                                            <td><?= htmlspecialchars($customer['payment_method']) ?></td>
                                            <td><a href="<?= htmlspecialchars($customer['receipt_url']) ?? '--' ?>" download class="btn btn-primary"><i class="fas fa-download"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td class="body empty-result" colspan="8">It seems like you haven't purchased anything yet!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="my-satbara" class="client-dashboard-section my-satbara hidden">
                    <div class="dashboard-section-half">
                        <div class="dashboard-title self-brand-title title">
                            My 7/12
                        </div>
                        <div class="dashboard-description self-brand-description body">
                            You can view the 7/12 (satbara) of all owned lands as well as download the same in this section.
                        </div>
                    </div>
                    <div class="satbara-data-section">
                        <?php
                        $user = wp_get_current_user();
                        $satbara_url = get_user_meta($user->ID, 'satbara', true)
                        ?>
                        <btn class="subheading btn btn-primary" href="<?php echo $satbara_url; ?>" download>Download as PDF<i class="fas fa-download"></i></btn>
                    </div>
                </div>

                <div id="image-modal" class="modal">
                    <span class="close-modal">&times;</span>
                    <img class="modal-content" id="modal-image" src="" alt="Image Preview">
                </div>
                <?php get_footer(); ?>
</body>

</html>