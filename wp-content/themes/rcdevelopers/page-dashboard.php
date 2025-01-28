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

    $user_id = $user->ID;

    $first_name = get_user_meta($user_id, 'first_name', true);
    $last_name = get_user_meta($user_id, 'last_name', true);
    $email = $user->display_name;
    $phone_no = get_user_meta($user_id, 'phone_no', true);
    $dob = get_user_meta($user_id, 'dob', true);

    $state = get_user_meta($user_id, 'state', true);
    $city = get_user_meta($user_id, 'city', true);
    $business_address = get_user_meta($user_id, 'business_address', true);
    $residential_address = get_user_meta($user_id, 'residential_address', true);


    $profile_pic = get_user_meta($user_id, 'profile_pic', true);
    if ($profile_pic) {
        $profile_pic_temp = explode('/', $profile_pic);
        $profile_pic_file_name = end($profile_pic_temp);
    } else {
        $profile_pic_file_name = 'No file uploaded';
    }
    $aadhar_card = get_user_meta($user_id, 'aadhar_card', true);
    if ($aadhar_card) {
        $aadhar_temp = explode('/', $aadhar_card);
        $aadhar_card_file_name = end($aadhar_temp);
    } else {
        $aadhar_card_file_name = 'No file uploaded';
    }
    $pan_card = get_user_meta($user_id, 'pan_card', true);
    if ($pan_card) {
        $pan_card_temp = explode('/', $pan_card);
        $pan_card_file_name = end($pan_card_temp);
    } else {
        $pan_card_file_name = 'No file uploaded';
    }

    $bank_username = get_user_meta($user_id, 'bank_username', true);
    $bank_name = get_user_meta($user_id, 'bank_name', true);
    $branch_name = get_user_meta($user_id, 'branch_name', true);
    $account_number = get_user_meta($user_id, 'account_number', true);
    $ifsc_code = get_user_meta($user_id, 'ifsc_code', true);

    $existing_business = get_user_meta($user_id, 'existing_business', true);
    $languages = get_user_meta($user_id, 'languages', true);
    $experience = get_user_meta($user_id, 'experience', true);

    ?>

    <script>
        function unsecuredCopyToClipboard(text) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.focus({
                preventScroll: true
            });
            textArea.select();
            try {
                document.execCommand('copy');
            } catch (err) {
                console.error('Unable to copy to clipboard', err);
            }
            document.body.removeChild(textArea);
        }

        function copyToClip(copyText) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(copyText);
            } else {
                unsecuredCopyToClipboard(copyText);
            }
        }
    </script>
    <div class="full-page-wrapper main-wrapper even-padded">
        <div class="dashboard-wrapper">
            <div class="dashboard-navigation label">
                <div class="dashboard-content">
                    <div class="close-button">
                        <a href="#">
                            <i class="fas fa-times midhighheading"></i>
                        </a>
                    </div>
                    <ul class="nav-menu">
                        <li class="nav-item current" data-target="dashboard-home"><a href="#"><i class="fas fa-home submidheading"></i>Dashboard</a></li>
                        <li class="nav-item" data-target="manage-profile"><a href="#"><i class="fas fa-user submidheading"></i>Manage Profile</a></li>
                        <li class="nav-item" data-target="payment-manager"><a href="#"><i class="fas fa-credit-card submidheading"></i>Payment Manager</a></li>
                        <li class="nav-item" data-target="all-leads"><a href="#"><i class="fas fa-list submidheading"></i>All Leads</a></li>
                        <li class="nav-item" data-target="organization-structure"><a href="#"><i class="fas fa-sitemap submidheading"></i>Organization Structure</a></li>
                        <li class="nav-item" data-target="news-and-updates"><a href="#"><i class="fas fa-newspaper submidheading"></i>News and Updates</a></li>
                        <li class="nav-item" data-target="promotional-materials"><a href="#"><i class="fas fa-bullhorn submidheading"></i>Promotional Materials</a></li>
                        <li class="nav-item" data-target="self-brand"><a href="#"><i class="fas fa-id-badge submidheading"></i>Self-Branding Materials</a></li>
                    </ul>
                </div>
            </div>
            <div class="dashboard-content">
                <div id="dashboard-home" class="dashboard-section dashboard-home active">
                    <div class="dashboard-column-1">
                        <div class="about-user dashboard-tile">
                            <?php
                            $user = wp_get_current_user();
                            $user_name = $user->display_name;
                            $user_id = $user->ID;
                            $user_email = $user->user_email;

                            $user_avatar = get_user_meta($user_id, 'profile_pic', true);
                            $user_date_of_joining = get_user_meta($user_id, 'date_of_joining', true);
                            $user_date_of_activation = get_user_meta($user_id, 'date_of_activation', true);
                            $user_first_name = get_user_meta($user_id, 'first_name', true);
                            $user_last_name = get_user_meta($user_id, 'last_name', true);
                            $user_rank = get_user_meta($user_id, 'associate_role', true);
                            $associate_invite_code = get_user_meta($user_id, 'associate_invite_code', true);
                            $customer_invite_code = get_user_meta($user_id, 'customer_invite_code', true);

                            ?>

                            <?php
                            $total_earnings = get_user_meta($user_id, 'total_earnings', true);
                            $area_sold = get_user_meta($user_id, 'area_sold', true);
                            ?>

                            <?php
                            $pending = get_user_meta($user_id, 'lead_pending', true);
                            $booked = get_user_meta($user_id, 'lead_booked', true);
                            $confirmed = get_user_meta($user_id, 'lead_confirmed', true);
                            $completed = get_user_meta($user_id, 'lead_completed', true);

                            if ($pending) {
                                $pending = (int) $pending;
                            } else {
                                $pending = 0;
                            }

                            if ($booked) {
                                $booked = (int) $booked;
                            } else {
                                $booked = 0;
                            }

                            if ($confirmed) {
                                $confirmed = (int) $confirmed;
                            } else {
                                $confirmed = 0;
                            }

                            if ($completed) {
                                $completed = (int) $completed;
                            } else {
                                $completed = 0;
                            }

                            $total_leads = $pending + $booked + $confirmed + $completed;
                            ?>
                            <div class="user-information">
                                <div class="user-avatar">
                                    <img src="<?php echo $user_avatar; ?>" alt="User Avatar">
                                </div>
                                <div class="user-details">
                                    <div class="user-name midheading">
                                        <?php if ($user_first_name && $user_last_name) {
                                            echo $user_first_name . ' ' . $user_last_name;
                                        } else {
                                            echo 'Invalid Username';
                                        } ?>
                                    </div>
                                    <div class="user-id label"><?php echo $user_id; ?></div>
                                    <div class="user-rank label">
                                        Rank:
                                        <?php if ($user_rank) {
                                            echo $user_rank;
                                        } else {
                                            echo 'Unassigned';
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="user-dates">
                                <div class="date-of-joining midheading">
                                    <div class="date-title label">Date of Joining:</div>
                                    <?php if ($user_date_of_joining) {
                                        echo $user_date_of_joining;
                                    } else {
                                        echo '00/00/0000';
                                    } ?>
                                </div>
                                <div class="date-of-activation midheading">
                                    <div class="date-title label">Date of Activation:</div>
                                    <?php if ($user_date_of_activation) {
                                        echo $user_date_of_activation;
                                    } else {
                                        echo '00/00/0000';
                                    } ?>
                                </div>
                            </div>
                            <div class="ref-link-tile">
                                <div class="link-details">
                                    <div class="link-title label">Customer Code:</div>
                                    <div class="link midheading">
                                        <?php if ($customer_invite_code) {
                                            echo $customer_invite_code;
                                        } else {
                                            echo 'Insufficient rank';
                                        } ?>
                                    </div>
                                </div>
                                <?php if ($customer_invite_code) { ?>
                                    <div class="copy-button">
                                        <i class="fas fa-copy link-icon midheading" onclick="copyToClip('<?php echo get_home_url() . '/sign_up/?invite_code=' . $customer_invite_code; ?>')"></i>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="ref-link-tile">
                                <div class="link-details">
                                    <div class="link-title label">Associate Code:</div>
                                    <div class="link midheading">
                                        <?php if ($associate_invite_code) {
                                            echo $associate_invite_code;
                                        } else {
                                            echo 'Insufficient rank';
                                        } ?>
                                    </div>
                                </div>
                                <?php if ($associate_invite_code) { ?>
                                    <div class="copy-button">
                                        <i class="fas fa-copy link-icon midheading" onclick="copyToClip('<?php echo get_home_url() . '/sign_up/?invite_code=' . $associate_invite_code; ?>')"></i>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="stats">
                            <div class="total-earnings">
                                <div class="stats-title midheading">Total Earnings</div>
                                <div class="stats-number title">
                                    <?php
                                    if ($total_earnings) {
                                        echo 'Rs. ' . $total_earnings;
                                    } else {
                                        echo '--';
                                    } ?>
                                </div>
                            </div>
                            <div class="area-sold">
                                <div class="stats-title midheading">Area Sold</div>
                                <div class="stats-number title">
                                    <?php
                                    if ($area_sold) {
                                        echo $area_sold . 'R';
                                    } else {
                                        echo '--';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-column-2">
                        <div class="lead-statistics dashboard-tile">
                            <div class="tile-title midheading">Lead Summary</div>
                            <div class="tile-content">
                                <div class="pie-chart-wrapper">
                                    <div class="leads-pie-chart"></div>
                                </div>
                                <div class="leads-summary">
                                    <div class="leads-summary-title subheading">All Statistics</div>
                                    <div class="summary-row">
                                        <div class="entry pending">
                                            <div class="entry-icon"><i class="fas fa-hourglass-half midheading"></i></div>
                                            <div class="entry-details">
                                                <div class="entry-title label">Pending</div>
                                                <div class="entry-count midheading"><?php echo $pending; ?></div>
                                            </div>
                                        </div>
                                        <div class="entry booked">
                                            <div class="entry-icon"><i class="fas fa-book midheading"></i></div>
                                            <div class="entry-details">
                                                <div class="entry-title label">Booked</div>
                                                <div class="entry-count midheading"><?php echo $booked; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-row">
                                        <div class="entry confirmed">
                                            <div class="entry-icon"><i class="fas fa-check-circle midheading"></i></div>
                                            <div class="entry-details">
                                                <div class="entry-title label">Confirmed</div>
                                                <div class="entry-count midheading"><?php echo $confirmed; ?></div>
                                            </div>
                                        </div>
                                        <div class="entry completed">
                                            <div class="entry-icon"><i class="fas fa-check midheading"></i></div>
                                            <div class="entry-details">
                                                <div class="entry-title label">Completed</div>
                                                <div class="entry-count midheading"><?php echo $completed; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
                                    <input type="hidden" name="action" value="generate_lead_report">
                                    <button type="submit" class="subheading btn btn-primary inverted-btn lead-report">Download Report <i class="fas fa-sign-out-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="manage-profile" class="dashboard-section manage-profile hidden">
                    <div class="main-section">
                        <div class="dashboard-title title">
                            Manage Profile
                        </div>
                        <div class="dashboard-description body">
                            You can edit any information by <b>double-tapping</b> the field. Sensitive fields such as KYC Documents require additional OTP verification.
                        </div>
                        <div class="profile-section">
                            <div class="section-title heading">
                                Personal Details
                            </div>
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
                        </div>
                        <hr class="separator-line">
                        <div class="profile-section">
                            <div class="section-title heading">
                                Address Details
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
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">Business Address</div>
                                    <div class="value midheading editable" data-field="business_address">
                                        <?php echo $business_address; ?>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">Residential Address</div>
                                    <div class="value midheading editable" data-field="residential_address">
                                        <?php echo $residential_address; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="separator-line">
                        <div class="profile-section">
                            <div class="section-title heading">
                                KYC Documents
                            </div>
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">Aadhar Card</div>
                                    <div class="value midheading decorated-file-upload">
                                        <a href="<?php echo $aadhar_card; ?>" target="_blank"><?php echo $aadhar_card_file_name ?></a>
                                        <label for="aadhar-card-input">
                                            <i class="fas fa-upload subheading"></i>
                                        </label>
                                        <input id="aadhar-card-input" type="file" name="aadhar_card" accept="image/*,application/pdf">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">PAN Card</div>
                                    <div class="value midheading decorated-file-upload">
                                        <a href="<?php echo $pan_card; ?>" target="_blank"><?php echo $pan_card_file_name ?></a>
                                        <label for="pan-card-input">
                                            <i class="fas fa-upload subheading"></i>
                                        </label>
                                        <input id="pan-card-input" type="file" name="pan_card" accept="image/*,application/pdf">
                                    </div>
                                </div>
                            </div>
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">Profile Picture</div>
                                    <div class="value midheading decorated-file-upload">
                                        <a href="<?php echo $profile_pic; ?>" target="_blank"><?php echo $profile_pic_file_name ?></a>
                                        <label for="profile-pic-input">
                                            <i class="fas fa-upload subheading"></i>
                                        </label>
                                        <input id="profile-pic-input" type="file" name="profile_pic" accept="image/*,application/pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="separator-line">
                        <div class="profile-section">
                            <div class="section-title heading">
                                Bank Details
                            </div>
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">Bank Username</div>
                                    <div class="value midheading editable" data-field="bank_username">
                                        <?php echo $bank_username; ?>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">Bank Name</div>
                                    <div class="value midheading editable" data-field="bank_name">
                                        <?php echo $bank_name; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">Branch Name</div>
                                    <div class="value midheading editable" data-field="branch_name">
                                        <?php echo $branch_name; ?>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">Account Number</div>
                                    <div class="value midheading editable" data-field="account_number">
                                        <?php echo $account_number; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">IFSC Code</div>
                                    <div class="value midheading editable" data-field="ifsc_code">
                                        <?php echo $ifsc_code; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="separator-line">
                        <div class="profile-section">
                            <div class="section-title heading">
                                Professional Details
                            </div>
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">Existing Business</div>
                                    <div class="value midheading editable" data-field="existing_business">
                                        <?php echo $existing_business; ?>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">Languages</div>
                                    <div class="value midheading editable" data-field="languages">
                                        <?php echo $languages; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="two-fields">
                                <div class="field">
                                    <div class="label">Experience</div>
                                    <div class="value midheading editable" data-field="experience">
                                        <?php echo $experience; ?>
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
                <div id="payment-manager" class="dashboard-section hidden">
                    <div class="payment-title title">Payment Manager</div>
                    <div class="purpose"></div>
                    <div class="area-range"></div>
                    <div class="payment-button"></div>
                </div>
                <div id="all-leads" class="dashboard-section all-leads hidden">
                    <div class="leads-summary-bar dashboard-tile">
                        <div class="entry-details total-leads">
                            <div class="entry-title label">Total leads</div>
                            <div class="entry-count title"><?php echo $total_leads; ?></div>
                        </div>
                        <div class="stats-and-visuals">
                            <?php
                            if ($total_leads !== 0) {
                                $color_percentages = array(
                                    'pending' => $pending / $total_leads * 100,
                                    'booked' => ($pending + $booked) / $total_leads * 100,
                                    'confirmed' => ($pending + $booked + $confirmed) / $total_leads * 100,
                                    'completed' => 100
                                ); ?>
                                <div class="leads-bar" style="background: linear-gradient(90deg, #EC7979 <?php echo $color_percentages['pending']; ?>%, #FFE733 <?php echo $color_percentages['booked']; ?>%, #14852E <?php echo $color_percentages['confirmed']; ?>%, #6F76F6 <?php echo $color_percentages['completed']; ?>%);"></div>
                            <?php } else { ?>
                                <script>
                                    console.log('Empty');
                                </script>
                                <div class="leads-bar" style="background: linear-gradient(90deg, #E54A4A, #EC7979, #E54A4A);"></div>
                            <?php } ?>
                            <div class="individual-stats summary-row">
                                <div class="entry pending">
                                    <div class="entry-icon"><i class="fas fa-hourglass-half midheading"></i></div>
                                    <div class="entry-details">
                                        <div class="entry-title label">Pending</div>
                                        <div class="entry-count midheading"><?php echo $pending; ?></div>
                                    </div>
                                </div>
                                <div class="entry booked">
                                    <div class="entry-icon"><i class="fas fa-book midheading"></i></div>
                                    <div class="entry-details">
                                        <div class="entry-title label">Booked</div>
                                        <div class="entry-count midheading"><?php echo $booked; ?></div>
                                    </div>
                                </div>
                                <div class="entry confirmed">
                                    <div class="entry-icon"><i class="fas fa-check-circle midheading"></i></div>
                                    <div class="entry-details">
                                        <div class="entry-title label">Confirmed</div>
                                        <div class="entry-count midheading"><?php echo $confirmed; ?></div>
                                    </div>
                                </div>
                                <div class="entry completed">
                                    <div class="entry-icon"><i class="fas fa-check midheading"></i></div>
                                    <div class="entry-details">
                                        <div class="entry-title label">Completed</div>
                                        <div class="entry-count midheading"><?php echo $completed; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="leads-search">
                        <?php
                        $customer_invite_code = get_user_meta(get_current_user_id(), 'customer_invite_code', true);
                        $customers = get_customers_by_linked_code($customer_invite_code);
                        $sr_no = 0;
                        ?>
                        <div class="search-bar">
                            <input type="text" id="client-search" class="search-input label" placeholder="Search by Client Name">
                            <i class="fas fa-search subheading"></i>
                        </div>
                        <div id="results-count" class="results-count label">Showing 0 result/s</div>
                        <div class="report-download">
                            <form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
                                <input type="hidden" name="action" value="generate_lead_report">
                                <button type="submit" class="subheading btn btn-primary inverted-btn lead-report">Download Report <i class="fas fa-download"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="leads-tabular-list dashboard-tile">
                        <table class="leads-table" id="leads-table">
                            <thead>
                                <tr class="label">
                                    <th>Sr. No.</th>
                                    <th>Client ID</th>
                                    <th>Client Name</th>
                                    <th>Status</th>
                                    <th>7/12</th>
                                </tr>
                            </thead>
                            <tbody id="leads-table-body">
                                <?php if (!empty($customers)) : ?>
                                    <?php foreach ($customers as $customer) : ?>
                                        <tr>
                                            <td><?php echo $sr_no++; ?></td>
                                            <td><?= htmlspecialchars($customer['user_id']) ?></td>
                                            <td class="client-name"><?= htmlspecialchars($customer['first_name']) . ' ' . htmlspecialchars($customer['last_name']) ?></td>
                                            <td><?= htmlspecialchars($customer['state']) ?></td>
                                            <td><?= htmlspecialchars($customer['city']) ?></td>
                                            <?php
                                            if ($customer['status'] == 'Completed') {
                                                $status_class = 'gr';
                                            } elseif ($customer['status'] == 'Booked') {
                                                $status_class = 'yw';
                                            } elseif ($customer['status'] == 'Confirmed') {
                                                $status_class = 'bl';
                                            } else {
                                                $status_class = 'rd';
                                            }
                                            ?>
                                            <td class="status">
                                                <div class="status-circle <?= $status_class ?>"></div><?= htmlspecialchars($customer['status']) ?>
                                            </td>
                                            <?php
                                            if ($customer['satbara']) {
                                                $satbara_temp = explode('/', $customer['satbara']);
                                                $satbara_file_name = end($satbara_temp); ?>
                                                <td class="7-12"><a href="<?php echo $customer['satbara'] ?>"><?php echo $satbara_file_name; ?></a></td>
                                                <?php } else {
                                                if ($customer['status'] == 'Completed') { ?>
                                                    <td class="7-12 decorated-file-upload">
                                                        <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" enctype="multipart/form-data">
                                                            <input type="hidden" name="action" value="upload_satbara">
                                                            <label for="satbara-input">
                                                                <i class="fas fa-upload subheading"></i>
                                                            </label>
                                                            <input id="satbara-input" type="file" name="satbara" accept="image/*,application/pdf" onchange="this.form.submit()">
                                                        </form>
                                                    </td>
                                            <?php } else {
                                                    echo '<td class="7-12"> -- </td>';
                                                }
                                            }
                                            ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td class="body empty-result" colspan="5">It seems like you haven't found any leads yet!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="organization-structure" class="dashboard-section hidden">Organization Structure Content</div>
                <div id="news-and-updates" class="dashboard-section hidden">
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
                <div id="promotional-materials" class="dashboard-section promotional-materials hidden">

                    <div class="gallery-container">
                        <?php
                        // Query to fetch all images grouped by upload date
                        $args = array(
                            'post_type'      => 'attachment',
                            'post_mime_type' => 'image',
                            'post_status'    => 'inherit',
                            'posts_per_page' => -1,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        );

                        $images = new WP_Query($args);

                        if ($images->have_posts()) :
                            $current_date = '';
                            while ($images->have_posts()) : $images->the_post();
                                $image_url = wp_get_attachment_url(get_the_ID());
                                $image_date = get_the_date('F Y');

                                if ($current_date !== $image_date) {
                                    if ($current_date !== '') {
                                        echo '</div>';
                                    }
                                    echo "<div class='gallery-date heading'>{$image_date}</div>";
                                    echo '<div class="gallery-grid">';
                                    $current_date = $image_date;
                                }
                        ?>
                                <div class="gallery-item">
                                    <a href="#" class="preview-link" data-image="<?php echo $image_url; ?>">
                                        <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
                                    </a>
                                    <!-- <a href="<?php echo $image_url; ?>" download class="download-link">Download</a> -->
                                </div>
                        <?php
                            endwhile;
                            echo '</div>'; // Close the last date group
                            wp_reset_postdata();
                        else :
                            echo '<div class="body">No images found.</div>';
                        endif;
                        ?>
                    </div>
                </div>
                <div id="self-brand" class="dashboard-section self-brand hidden">
                    <div class="main-section">
                        <div class="dashboard-title self-brand-title title">
                            Self-Branding
                        </div>
                        <div class="dashboard-description self-brand-description body">
                            You can get your self-branding material by selecting one from the templates and downloading its pdf file.
                        </div>
                        <div class="template-grid" id="template-grid">
                            <?php
                            global $wpdb;
                            $table_name = $wpdb->prefix . 'document_generator_templates';
                            $templates = $wpdb->get_results("SELECT * FROM $table_name");
                            $index = 0;

                            if ($templates) {
                                foreach ($templates as $template) { ?>
                                    <div class="template-preview"
                                        data-id="<?php echo $template->id; ?>"
                                        data-template_name="<?php echo $template->template_name; ?>"
                                        data-template_style="<?php echo $template->template_type; ?>"
                                        data-width="<?php echo $template->width; ?>"
                                        data-height="<?php echo $template->height; ?>"
                                        data-template_doc_address="<?php echo $template->template_doc_address; ?>">
                                        <div class="template-image-wrapper"><img src="<?php echo $template->template_doc_address; ?>" alt="Template Preview"></div>
                                        <div class="template-title label"><?php echo $template->template_name; ?></div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="minor-section template-section">
                        <div class="template-view">
                            <img id="template-view" src="" alt="">
                        </div>
                        <div class="template-title label">Template Title:</div>
                        <div class="heading" id="template-title"></div>
                        <div class="template-style label">Template Style:<div id="template-style"></div>
                        </div>
                        <div class="template-resolution label">Resolution:<div id="template-resolution"></div>
                        </div>
                        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                            <input type="hidden" id="template-input" name="template_id">
                            <input type="hidden" name="action" value="generate_pdf">
                            <button type="submit" class="subheading btn btn-primary inverted-btn">Download as PDF <i class="fas fa-download"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="image-modal" class="modal">
            <span class="close-modal">&times;</span>
            <img class="modal-content" id="modal-image" src="" alt="Image Preview">
        </div>
        <?php get_footer(); ?>
</body>

</html>