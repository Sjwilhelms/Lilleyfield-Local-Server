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
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
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
                
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="<?php echo $current_shop; ?>">
                    <li class="navbar-item">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                        <?php esc_html_e('Shop', 'your-theme-domain'); ?>
                    </li>
                </a>
                
                <?php if (get_page_by_path('visit')): ?>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('visit'))); ?>" class="<?php echo is_page('visit') ? 'active' : ''; ?>">
                    <li class="navbar-item">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                        <?php esc_html_e('Visit', 'your-theme-domain'); ?>
                    </li>
                </a>
                <?php endif; ?>
                
                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="<?php echo $current_account; ?>">
                    <li class="navbar-item">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                        <?php esc_html_e('Account', 'your-theme-domain'); ?>
                    </li>
                </a>
                
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="<?php echo $current_cart; ?> cart-contents fragment_refresh">
                    <li class="navbar-item">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                        <?php esc_html_e('Cart', 'your-theme-domain'); ?>
                        <?php echo WC()->cart->get_cart_total(); ?>
                    </li>
                </a>
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
                
                <?php if (get_page_by_path('visit')): ?>
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
            <p><?php echo sprintf(__('Monday to Saturday, from 0900 to 1700, at <a href="%s" target="_blank">Lemon Street Market</a>, Lemon Street, Truro, TR1 2QD', 'your-theme-domain'), 
                'https://www.lemonstreetmarket.co.uk/'); ?></p>
        </div>
    </header>