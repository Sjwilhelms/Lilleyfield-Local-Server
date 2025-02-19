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
                    </div>
                </div>
            </div>

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
                    <ul class="dropdown-menu shop-dropdown">
                        <?php
                        // Get all product categories
                        $categories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                            'parent' => 0,
                            'exclude' => get_term_by('slug', 'uncategorized', 'product_cat')->term_id
                        ]);

                        if (!empty($categories) && !is_wp_error($categories)) {
                            foreach ($categories as $category) {
                                // Get subcategories
                                $subcategories = get_terms([
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => $category->term_id
                                ]);

                                if (!empty($subcategories) && !is_wp_error($subcategories)) {
                                    // Category with subcategories
                                    echo '<li class="has-children">';
                                    echo '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . ' <span class="submenu-arrow">›</span></a>';
                                    echo '<ul class="sub-dropdown">';
                                    foreach ($subcategories as $subcategory) {
                                        echo '<li><a href="' . esc_url(get_term_link($subcategory)) . '">' . esc_html($subcategory->name) . '</a></li>';
                                    }
                                    echo '</ul>';
                                    echo '</li>';
                                } else {
                                    // Category without subcategories
                                    echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
                                }
                            }
                        }
                        ?>
                        <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"><?php esc_html_e('View All Products', 'your-theme-domain'); ?></a></li>
                    </ul>
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
                    <ul class="dropdown-menu account-dropdown">
                        <?php if (is_user_logged_in()) : ?>
                            <li><a href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')); ?>"><?php esc_html_e('My Account', 'your-theme-domain'); ?></a></li>
                            <li><a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>"><?php esc_html_e('Orders', 'your-theme-domain'); ?></a></li>
                            <li><a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>"><?php esc_html_e('Addresses', 'your-theme-domain'); ?></a></li>
                            <li><a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>"><?php esc_html_e('Account Details', 'your-theme-domain'); ?></a></li>
                            <li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Logout', 'your-theme-domain'); ?></a></li>
                        <?php else : ?>
                            <li><a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php esc_html_e('Login', 'your-theme-domain'); ?></a></li>
                            <li><a href="<?php echo esc_url(add_query_arg('action', 'register', wc_get_page_permalink('myaccount'))); ?>"><?php esc_html_e('Register', 'your-theme-domain'); ?></a></li>
                        <?php endif; ?>
                    </ul>
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

        <div class="info-banner">
            <p><?php echo sprintf(
                    __('Monday to Saturday, from 0900 to 1700, at <a href="%s" target="_blank">Lemon Street Market</a>, Lemon Street, Truro, TR1 2QD', 'your-theme-domain'),
                    'https://www.lemonstreetmarket.co.uk/'
                ); ?></p>
        </div>
    </header>