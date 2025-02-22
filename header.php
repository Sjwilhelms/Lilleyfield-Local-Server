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
        <!-- Video Section -->
        <?php if (is_front_page()) : ?>
            <div class="parallax-container">
                <div class="video-container">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/d3oltSUePs4?autoplay=1&mute=1&loop=1&playlist=d3oltSUePs4&controls=0&showinfo=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
            </div>
        <?php endif; ?>

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

                        <?php
                        // Check if the shop page exists and is published
                        $shop_page_id = wc_get_page_id('shop');
                        $show_woocommerce_nav = ($shop_page_id > 0 && get_post_status($shop_page_id) === 'publish');

                        // Only display WooCommerce navigation elements if shop is published
                        if ($show_woocommerce_nav) {
                        ?>
                            <div class="navbar-toggler hidden">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bars-solid.svg" alt="Menu button">
                            </div>
                        <?php
                        }
                        // If shop is not published, none of these navigation elements will be shown
                        ?>

                    </div>
                </div>
            </div>

            <?php
            // Check if the shop page exists and is published
            $shop_page_id = wc_get_page_id('shop');
            $show_woocommerce_nav = ($shop_page_id > 0 && get_post_status($shop_page_id) === 'publish');

            // Only display WooCommerce navigation elements if shop is published
            if ($show_woocommerce_nav) {
            ?>


                <!-- Desktop Navigation -->
                <ul class="navbar-list-flex">
                    <?php
                    $current_shop = is_shop() ? 'active' : '';
                    $current_account = is_account_page() ? 'active' : '';
                    $current_cart = is_cart() ? 'active' : '';
                    ?>

                    <!-- Shop dropdown -->
                    <li class="navbar-item dropdown-parent">
                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="shop-toggle <?php echo $current_shop; ?>">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                            <?php esc_html_e('Shop', 'your-theme-domain'); ?>
                        </a>
                    </li>

                    <!-- Visit link -->
                    <?php if (get_page_by_path('visit')) : ?>
                        <li class="navbar-item">
                            <a href="<?php echo esc_url(get_permalink(get_page_by_path('visit'))); ?>" class="<?php echo is_page('visit') ? 'active' : ''; ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                                <?php esc_html_e('Visit', 'your-theme-domain'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Account dropdown -->
                    <li class="navbar-item dropdown-parent">
                        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="account-toggle <?php echo $current_account; ?>">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                            <?php esc_html_e('Account', 'your-theme-domain'); ?>
                        </a>

                    </li>

                    <!-- Cart link -->
                    <li class="navbar-item">
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="<?php echo $current_cart; ?> cart-contents fragment_refresh">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                            <?php esc_html_e('Cart', 'your-theme-domain'); ?>
                            <?php echo WC()->cart->get_cart_total(); ?>
                        </a>
                    </li>
                </ul>





            <?php
            }
            // If shop is not published, none of these navigation elements will be shown
            ?>

            <?php
            // Check if the shop page exists and is published
            $shop_page_id = wc_get_page_id('shop');
            $show_woocommerce_nav = ($shop_page_id > 0 && get_post_status($shop_page_id) === 'publish');

            // Only display WooCommerce navigation elements if shop is published
            if ($show_woocommerce_nav) {
            ?>
                <!-- Mobile Navigation -->
                <ul class="navbar-list-flex-mobile hidden">
                    <?php
                    // Reuse the same active states from desktop
                    ?>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="<?php echo $current_shop; ?>">
                        <li class="navbar-item-mobile">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                            <?php esc_html_e('Shop', 'your-theme-domain'); ?>
                        </li>
                    </a>

                    <?php if (get_page_by_path('visit')) : ?>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('visit'))); ?>" class="<?php echo is_page('visit') ? 'active' : ''; ?>">
                            <li class="navbar-item-mobile">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                                <?php esc_html_e('Visit', 'your-theme-domain'); ?>
                            </li>
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="<?php echo $current_account; ?>">
                        <li class="navbar-item-mobile">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                            <?php esc_html_e('Account', 'your-theme-domain'); ?>
                        </li>
                    </a>

                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="<?php echo $current_cart; ?> cart-contents fragment_refresh">
                        <li class="navbar-item-mobile">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                            <?php esc_html_e('Cart', 'your-theme-domain'); ?>
                            <?php echo WC()->cart->get_cart_total(); ?>
                        </li>
                    </a>
                </ul>
        </div>
    <?php
            }
    ?>




    <?php if (!is_page('home')) : ?>
        <div class="info-banner">
            <p><?php echo sprintf(
                    __('Monday to Saturday, from 0900 to 1700, at <a href="%s" target="_blank">Lemon Street Market</a>, Lemon Street, Truro, TR1 2QD', 'your-theme-domain'),
                    'https://www.lemonstreetmarket.co.uk/'
                ); ?></p>
        </div>
    <?php endif; ?>
    </header>