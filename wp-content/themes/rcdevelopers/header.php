<header class="header d-flex align-items-center">
    <nav class="navbar navbar-expand-lg navbar-dark d-flex justify-content-between align-items-center w-100">
        <a class="heading site-title" href="<?php echo home_url() ?>">RCD</a>
        <?php
        if (is_page('front_page') || is_page('careers') || is_page('branch_network')) {
        ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span> -->
            </button>
            <div id="navigation" class="subheading collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav text-sm-center text-md-left">
                    <li class="nav-item nav-class-home <?php if (is_page('home')) echo 'active'; ?>">
                        <a class="nav-link" href="<?php home_url() ?>/#nav-class-home">Home</a>
                    </li>
                    <li class="nav-item nav-class-about-us">
                        <a class="nav-link" href="<?php home_url() ?>/#nav-class-about-us">About Us</a>
                    </li>
                    <li class="nav-item nav-class-branch-network <?php if (is_page('branch_network')) echo 'active'; ?>">
                        <a class="nav-link" href="<?php home_url() ?>/branch_network">Branch Network</a>
                    </li>
                    <li class="nav-item nav-class-careers <?php if (is_page('careers')) echo 'active'; ?>">
                        <a class="nav-link" href="<?php home_url() ?>/careers">Careers</a>
                    </li>
                    <li class="nav-item nav-class-contact-us">
                        <a class="nav-link" href="<?php home_url() ?>/#nav-class-contact-us">Contact Us</a>
                    </li>
                </ul>
            </div>
            <a class="subheading btn btn-primary ml-auto sign-in" href="<?php echo home_url(); ?>/<?php echo is_user_logged_in() ? (metadata_exists('user', wp_get_current_user()->ID, 'associate_role') ? 'dashboard' : 'client_dashboard') : 'sign_in'; ?>">
                <?php echo is_user_logged_in() ? 'Dashboard <i class="fas fa-home"></i>' : 'Sign In <i class="fas fa-sign-in-alt"></i>'; ?>
            </a>
        <?php
        } else if (is_page('sign_up') || is_page('sign_in')) {
        ?>
            <a class="subheading btn btn-primary inverted-btn ml-auto go-back" href="<?php echo home_url(); ?>">Go Back <i class="fas fa-reply"></i></a>
        <?php
        } else {
        ?>
            <a class="subheading btn btn-primary inverted-btn ml-auto sign-out" href="<?php echo wp_logout_url('/'); ?>">Sign Out <i class="fas fa-sign-out-alt"></i></a>
        <?php } ?>
    </nav>
</header>