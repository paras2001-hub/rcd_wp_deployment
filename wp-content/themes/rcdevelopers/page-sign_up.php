<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sign Up">
    <meta name="author" content="https://paras2001-hub.github.io/">
    <link rel="shortcut icon" href="images/logo.png">

    <?php wp_head(); ?>
</head>

<body>

    <?php get_header(); ?>
    <div class="main-wrapper full-page-wrapper">
        <div class="sign-up-container major-right-container" id="signup-form">
            <div class="form-description left">
                <div class="form-title title"> Sign Up Form<br>
                    <?php
                    $key = get_query_var('invite_code', '');
                    $meta_data = get_user_id_by_any_invite_code($key);
                    $user_id = $meta_data['user_id'];
                    $full_name = $meta_data['full_name'];
                    $code_type = $meta_data['code_type'];

                    if ($code_type === 'associate') {
                    ?>
                        <div class="highlight">(Associate)</div>
                    <?php
                    } else if ($code_type === 'customer') {
                    ?>
                        <div class="highlight">(Customer)</div>
                    <?php
                    }
                    ?>
                </div>
                <div class="form-text body">Join us and unlock exclusive benefits! Create your account in just 5 steps to view listings, checkouts, and the latest updates.</div>
                <div class="invite-code heading">
                    <?php
                    if ($key) {
                        echo "Invite Code: " . esc_html($key);
                    } else {
                        echo "Invite Code: Not Found!";
                    }
                    ?>
                </div>
                <div class="associate-details body">
                    <?php
                    if ($user_id) {
                        echo "<div class='associate-name'>Associate Name: " . esc_html($full_name) . "</div>";
                    } else {
                        echo "
                        <div class='invite-code-alert'>
                            <i class='fas fa-exclamation-triangle'></i> 
                            You need a valid invite code to sign up as a user. Please contact your associate for the invite code.
                        </div>";
                    }
                    ?>
                </div>
            </div>
            <div class="sign-up-form right">
                <?php
                if ($code_type === 'associate') {
                ?>
                    <form id="signup-form" class="associate-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
                        <div class="form-inputs">
                            <div id="form-input-1" class="personal-details form-input">
                                <div class="form-input-title subtitle">Step 1. Enter your personal details</div>
                                <div class="names horizontal">
                                    <div class="input-group first-name body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="first-name-input">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="first-name" placeholder="First Name" aria-label="first-name" aria-describedby="first-name-input" required>
                                    </div>
                                    <div class="input-group last-name body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="last-name-input">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="last-name" placeholder="Last Name" aria-label="last-name" aria-describedby="last-name-input" required>
                                    </div>
                                </div>
                                <div class="input-group phoneNo body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="phoneNo-input">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="phoneNo" placeholder="Contact Number" aria-label="phoneNo" aria-describedby="phoneNo-input" required>
                                </div>
                                <div class="input-group email body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="email-input">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="email" placeholder="Email Address" aria-label="email" aria-describedby="email-input" required>
                                </div>
                                <div class="input-group password body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="password-input">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password" placeholder="Password" aria-label="password" aria-describedby="password-input" required>
                                </div>
                                <div class="input-group date-of-birth body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="dob-input">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" name="dob" placeholder="Date of Birth" aria-label="dob" aria-describedby="dob-input" required>
                                </div>
                            </div>
                            <div id="form-input-2" class="addresses form-input">
                                <div class=" form-input-title subtitle">Step 2. Enter your addresses</div>
                                <div class="location horizontal">
                                    <div class="input-group state-dropdown body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="state-dropdown-input">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" name="state" aria-label="state" aria-describedby="state-dropdown-input" required>
                                            <option value="" disabled selected>Select State</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="New Delhi">New Delhi</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        </select>
                                    </div>
                                    <div class="input-group city body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="city-input">
                                                <i class="fa fa-building" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="city" placeholder="City/Town/Village" aria-label="city" aria-describedby="city-input" required>
                                    </div>
                                </div>
                                <div class="business-address body textarea-group">
                                    <textarea class="form-control" name="business-address" rows="5" placeholder="Business Address (for Communication)" aria-label="business-address" id="business-address-input" required></textarea>
                                </div>
                                <div class="residential-address body textarea-group">
                                    <textarea class="form-control" name="residential-address" rows="5" placeholder="Residential Address" aria-label="residential-address" id="residential-address-input" required></textarea>
                                </div>
                            </div>
                            <div id="form-input-3" class="kyc-documents form-input">
                                <div class=" form-input-title subtitle">Step 3. Upload KYC Documents</div>
                                <div class="input-group profile-pic body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="profile-pic-input">
                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control" name="profile-pic" id="profile-upload" aria-label="profile-pic" aria-describedby="profile-pic-input" accept="image/*" required>
                                </div>
                                <div class="input-group aadhar-card body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="aadhar-card-input">
                                            <i class="fa fa-id-card" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control" name="aadhar-card" id="aadhar-upload" aria-label="aadhar-card" aria-describedby="aadhar-card-input" accept="application/pdf" required>
                                </div>
                                <div class="input-group pan-card body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="pan-card-input">
                                            <i class="fa fa-id-card" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control" name="pan-card" id="pan-upload" aria-label="pan-card" aria-describedby="pan-card-input" accept="application/pdf" required>
                                </div>
                            </div>
                            <div id="form-input-4" class="bank-details form-input">
                                <div class=" form-input-title subtitle">Step 4. Enter your bank details</div>
                                <div class="input-group bank-username body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="bank-username-input">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="bank-username" placeholder="Account Holder Name" aria-label="bank-username" aria-describedby="bank-username-input" required>
                                </div>
                                <div class="input-group bank-name body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="bank-name-input">
                                            <i class="fa fa-university" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="bank-name" placeholder="Bank Name" aria-label="bank-name" aria-describedby="bank-name-input" required>
                                </div>
                                <div class="location horizontal">
                                    <div class="input-group branch-name body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="branch-name-input">
                                                <i class="fa fa-text" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="branch-name" placeholder="Branch Name" aria-label="branch-name" aria-describedby="branch-name-input" required>
                                    </div>
                                    <div class="input-group ifsc-code body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="ifsc-code-input">
                                                <i class="fa fa-code" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="ifsc-code" placeholder="IFSC Code" aria-label="ifsc-code" aria-describedby="ifsc-code-input" required>
                                    </div>
                                </div>
                                <div class="input-group account-number body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="account-number-input">
                                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="account-number" placeholder="Account Number" aria-label="account-number" aria-describedby="account-number-input" required>
                                </div>
                            </div>
                            <div id="form-input-5" class="professional-details form-input">
                                <div class=" form-input-title subtitle">Step 5. Enter your professional details</div>
                                <div class="input-group experience body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="experience-input">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="experience" placeholder="No. of years of Real-estate Experience" aria-label="experience" aria-describedby="experience-input">
                                </div>
                                <div class="location horizontal">
                                    <div class="input-group existing-business-dropdown body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="existing-business-input">
                                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" name="existing-business" aria-label="existing-business" aria-describedby="existing-business-input" required>
                                            <option value="" disabled selected>Existing business</option>
                                            <option value="yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="input-group languages-dropdown body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="languages-input">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" name="languages" aria-label="languages" aria-describedby="languages-input">
                                            <option value="" disabled selected>Languages Known</option>
                                            <option value="Hindi">Hindi</option>
                                            <option value="English">English</option>
                                            <option value="Marathi">Marathi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="auth_associate_signup">
                        <input type="hidden" name="invite-code" value="<?php echo esc_attr($key); ?>">
                        <div class="horizontal-sliding-button">
                            <div class="back-button"></div>
                            <button id="progress-button" type="button" class="subheading btn btn-primary ml-auto">Proceed <i class="fas fa-arrow-right body"></i></button>
                            <button id="submit-button" type="submit" class="subheading btn btn-primary ml-auto">Submit <i class="fas fa-check body"></i></button>
                        </div>
                    </form>
                <?php
                } else if ($code_type === 'customer') {
                ?>
                    <form id="signup-form" class="customer-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
                        <div class="form-inputs">
                            <div id="form-input" class="customer-details form-input">
                                <div class="names horizontal">
                                    <div class="input-group first-name body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="first-name-input">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="first-name" placeholder="First Name" aria-label="first-name" aria-describedby="first-name-input" required>
                                    </div>
                                    <div class="input-group last-name body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="last-name-input">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="last-name" placeholder="Last Name" aria-label="last-name" aria-describedby="last-name-input" required>
                                    </div>
                                </div>
                                <div class="input-group phoneNo body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="phoneNo-input">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="phoneNo" placeholder="Contact Number" aria-label="phoneNo" aria-describedby="phoneNo-input" required>
                                </div>
                                <div class="input-group email body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="email-input">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="email" placeholder="Email Address" aria-label="email" aria-describedby="email-input" required>
                                </div>
                                <div class="input-group password body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="password-input">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password" placeholder="Password" aria-label="password" aria-describedby="password-input" required>
                                </div>
                                <div class="input-group profile-pic body">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="profile-pic-input">
                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control" name="profile-pic" id="profile-upload" aria-label="profile-pic" aria-describedby="profile-pic-input" accept="image/*" required>
                                </div>
                                <div class="location horizontal">
                                    <div class="input-group state-dropdown body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="state-dropdown-input">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" name="state" aria-label="state" aria-describedby="state-dropdown-input" required>
                                            <option value="" disabled selected>Select State</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="New Delhi">New Delhi</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        </select>
                                    </div>
                                    <div class="input-group city body">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="city-input">
                                                <i class="fa fa-building" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="city" placeholder="City/Town/Village" aria-label="city" aria-describedby="city-input" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="auth_customer_signup">
                        <input type="hidden" name="invite-code" value="<?php echo esc_attr($key); ?>">
                        <div class="terms-agreement body">
                            By clicking 'Submit,' you agree to our <a href="<?php echo home_url(); ?>">Terms & Conditions</a> and confirm that the information provided is accurate and consent to our use of your data as described in our <a href="<?php echo home_url(); ?>">Privacy Policy</a>.
                        </div>
                        <button type="submit" class="subheading btn btn-primary">Submit <i class="fas fa-check body"></i></button>
                    </form>
                <?php
                } else {
                ?>
                    <div class="invalid-invite-description subheading">
                        No invite code found.
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <?php get_footer(); ?>
</body>

</html>