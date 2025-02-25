<?php

/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png">
    <title><?php wp_title('|', true, 'right');
            bloginfo('name'); ?></title>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header>
        <div class="header-container">
            <div class="navbar-container">
                <div class="navbar-fullscreen">
                    <div class="navbar">
                        <div class="navbar-brand">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logo_inline.png" alt="<?php bloginfo('name'); ?>">
                            </a>
                        </div>

                        <div class="navbar-brand-mobile hidden">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/lilleyfield_text.png" alt="<?php bloginfo('name'); ?>">
                            </a>
                        </div>


                        <div class="navbar-toggler hidden">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bars-solid.svg" alt="Menu button">
                        </div>
                        <?php

                        ?>
                    </div>
                </div>
            </div>

            <?php
            /**
             * Mobile-friendly navigation menu implementation
             */
            ?>
            <div class="header-navigation-wrapper">
                <!-- Mobile menu toggle button -->
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="menu-toggle-icon"></span>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'your-theme-name'); ?></span>
                </button>

                <!-- Navigation menu container -->
                <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Primary Menu', 'your-theme-name'); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_class'     => 'primary-menu',
                            'menu_id'        => 'primary-menu',
                            'fallback_cb'    => false,
                        )
                    );
                    ?>
                </nav>
            </div>

            <!-- shop info banner -->
            <div class="info-banner">
                <p><?php echo sprintf(
                        __('Monday to Saturday, from 0900 to 1700, at <a href="%s" target="_blank">Lemon Street Market</a>, Lemon Street, Truro, TR1 2QD', 'your-theme-domain'),
                        'https://www.lemonstreetmarket.co.uk/'
                    ); ?></p>
            </div>

    </header>