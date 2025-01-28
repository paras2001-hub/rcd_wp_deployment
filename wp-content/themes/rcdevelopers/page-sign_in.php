<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign In</title>
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
        <div class="sign-in-container major-left-container" id="signin-form">
            <div class="left">
                <div class="form-title title"> Sign In</div>
                <div class="form-text body">Welcome to Realty Creative Developers. Please enter your details below to log into your system.</div>
                <form class="sign-in-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
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
                    <div class="additional-options">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="keep-signed-in" id="keep-signed-in" name="keep_signed_in">
                            <label class="form-check-label body" for="keep-signed-in">Keep me signed in</label>
                        </div>
                        <a href="<?php echo wp_lostpassword_url(); ?>" class="forgot-password body">Forgot Password?</a>
                    </div>
                    <input type="hidden" name="action" value="auth_signin">
                    <button id="signin-button" type="submit" class="subheading btn btn-primary sign-in">Sign In <i class="fas fa-sign-in-alt"></i></button>
                </form>
            </div>
            <div class="sign-in-image-container right">
                <img id="sign-in-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/sign-in-checkers.png" alt="Sign In" class="sign-in-image">
            </div>
        </div>
    </div>

    <?php get_footer(); ?>
</body>

</html>