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
    <div class="full-page-wrapper main-wrapper even-padded">
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sliding News Headlines</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                }

                .news-container {
                    width: 100%;
                    overflow: hidden;
                    background-color: #f1f1f1;
                    border: 1px solid #ccc;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    white-space: nowrap;
                    position: relative;
                }

                .news-marquee {
                    display: inline-block;
                    white-space: nowrap;
                    animation: slide 10s linear infinite;
                }

                .news-item {
                    display: inline-block;
                    padding: 10px 20px;
                    color: #333;
                    text-decoration: none;
                }

                .news-item:hover {
                    color: #007BFF;
                    text-decoration: underline;
                }

                @keyframes slide {
                    from {
                        transform: translateX(100%);
                    }

                    to {
                        transform: translateX(-100%);
                    }
                }
            </style>
        </head>

        <body>
            <div class="news-container">
                <div class="news-marquee">
                    <a href="#" class="news-item">Breaking: New technology unveiled today!</a>
                    <a href="#" class="news-item">Sports: Local team wins championship!</a>
                    <a href="#" class="news-item">Weather: Sunny skies expected tomorrow.</a>
                    <a href="#" class="news-item">Business: Stocks hit record highs.</a>
                </div>
            </div>
        </body>

        </html>

        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('template-parts/content', 'article');
            }
        }
        ?>
        <?php get_footer(); ?>
    </div>
</body>

</html>