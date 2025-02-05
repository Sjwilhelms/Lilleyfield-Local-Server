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
    <title>Lilleyfield Cheese Co.</title>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <!-- header container -->
    <header>
        <div class="header-container">
            <div class="navbar-container">
                <div class="navbar-fullscreen">
                    <!-- brand and toggler -->
                    <div class="navbar">
                        <!-- navbar brand -->
                        <div class="navbar-brand">
                            <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logo_inline.png" alt="Lilleyfield Cheese Co. logo"></a>
                        </div>
                        <div class="navbar-brand-mobile hidden">
                            <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/lilleyfield_text.png" alt="Lilleyfield Cheese Co. logo"></a>
                        </div>
                        <!-- navbar toggler -->
                        <div class="navbar-toggler hidden">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese.png" alt="Menu button">
                        </div>
                    </div>
                </div>
            </div>
            <!-- full screen navlinks -->
            <ul class="navbar-list-flex ">
                <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">
                    <li class="navbar-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt=""> Shop</li>
                </a>
                <a href="#">
                    <li class="navbar-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt=""> Visit</li>
                </a>
                <a href="<?php echo wc_get_page_permalink('myaccount'); ?>">
                    <li class="navbar-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt=""> Account</li>
                </a>
                <a href="<?php echo wc_get_cart_url(); ?>">
                    <li class="navbar-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt=""> Cart £0.00</li>
                </a>
            </ul>
            <!-- mobile navlinks -->
            <ul class="navbar-list-flex-mobile hidden">
                <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">
                    <li class="navbar-item-mobile"><img src="assets/cheese_favicon_1.png" class="active-icon" alt=""> Shop</li>
                </a>
                <a href="#">
                    <li class="navbar-item-mobile"><img src="assets/cheese_favicon_1.png" class="active-icon" alt=""> Visit</li>
                </a>
                <a href="<?php echo wc_get_page_permalink('myaccount'); ?>">
                    <li class="navbar-item-mobile"><img src="assets/cheese_favicon_1.png" class="active-icon" alt=""> Account</li>
                </a>
                <a href="<?php echo wc_get_cart_url(); ?>">
                    <li class="navbar-item-mobile"><img src="assets/cheese_favicon_1.png" class="active-icon" alt=""> Cart £0.00</li>
                </a>
            </ul>
        </div>
        <!-- info banner -->
        <div class="info-banner">
            <p>Monday to Saturday, from 0900 to 1700, at <a href="https://www.lemonstreetmarket.co.uk/" target="_blank">Lemon Street Market</a>, Lemon Street, Truro, TR1 2QD</p>
        </div>

    </header>