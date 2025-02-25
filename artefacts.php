<?php
define("CHI_THEME_DIR_URI", get_template_directory_uri());
define("CHI_THEME_BASE_DIR", get_template_directory());

class Storefront_Child_Theme
{

    private static $instance = null;

    private function __construct()
    {
        add_action("wp_enqueue_scripts", [$this, "enqueue_styles"]);
    }

    public function enqueue_styles()
    {
        // Enqueue the main child theme stylesheet
        wp_enqueue_style("storefront-child", get_stylesheet_uri(), [], filemtime(get_stylesheet_directory() . '/style.css'));

        // Enqueue WooCommerce-specific styles if WooCommerce is active
        if (class_exists('WooCommerce')) {
            wp_enqueue_style(
                'storefront-child-woocommerce',
                get_stylesheet_directory_uri() . '/woocommerce.css',
                [],
                filemtime(get_stylesheet_directory() . '/woocommerce.css')
            );
        }
    }

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

Storefront_Child_Theme::get_instance();

// logic for serving javascript files 
// each function in the directory needs adding to the scripts array in class-enqueue-scripts.php

// Load classes
require_once CHI_THEME_BASE_DIR . '/includes/class-enqueue-scripts.php';

// Initialize classes
CHI_Enqueue_Scripts::get_instance();

// add woocommerce support

function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

// remove woocommerce default css

// add_filter('woocommerce_enqueue_styles', 'jk_dequeue_styles');
// function jk_dequeue_styles($enqueue_styles)
// {
//     unset($enqueue_styles['woocommerce-general']);
//     unset($enqueue_styles['woocommerce-layout']);
//     unset($enqueue_styles['woocommerce-smallscreen']);
//     return $enqueue_styles;
// }

// remove wordpress default css

function remove_default_styles()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'remove_default_styles', 100);

// remove storefront built in header

// add_action('init', 'remove_storefront_header');
// function remove_storefront_header()
// {
//     remove_action('storefront_header', 'storefront_header_container', 0);
//     remove_action('storefront_header', 'storefront_skip_links', 5);
//     remove_action('storefront_header', 'storefront_site_branding', 20);
//     remove_action('storefront_header', 'storefront_secondary_navigation', 30);
//     remove_action('storefront_header', 'storefront_primary_navigation', 50);
// }


// remove storefront built in footer

// add_action('init', 'remove_storefront_footer');
// function remove_storefront_footer()
// {
//     remove_action('storefront_footer', 'storefront_footer_widgets', 10);
//     remove_action('storefront_footer', 'storefront_credit', 20);
// }

// add_filter('template_include', function ($template) {
//     if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
//         $new_template = locate_template(['woocommerce.php']);
//         if (!empty($new_template)) {
//             return $new_template;
//         }
//     }
//     return $template;
// }, 99);

// my-account.php customise account navlinks

function custom_wc_account_menu_items($menu_items)
{
    unset($menu_items['downloads']);
    unset($menu_items['dashboard']);
    return $menu_items;
}
add_filter('woocommerce_account_menu_items', 'custom_wc_account_menu_items');

// ajax add to cart

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
?>
    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="<?php echo is_cart() ? 'active' : ''; ?> cart-contents fragment_refresh">
        <li class="navbar-item">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
            <?php esc_html_e('Cart', 'your-theme-domain'); ?>
            <?php echo WC()->cart->get_cart_total(); ?>
        </li>
    </a>
    <?php
    $fragments['a.cart-contents-desktop'] = ob_get_clean();

    // Mobile cart fragment
    ob_start();
    ?>
    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="<?php echo $current_cart; ?> cart-contents fragment_refresh">
        <li class="navbar-item-mobile">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
            <?php esc_html_e('Cart', 'your-theme-domain'); ?>
            <?php echo WC()->cart->get_cart_total(); ?>
        </li>
    </a>
    <?php
    $fragments['a.cart-contents-desktop'] = ob_get_clean();

    // Mobile cart fragment
    ob_start();
    ?>
    <li class="nav-item">
        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="<?php echo $current_cart; ?>  cart-contents fragment_refresh">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
            <?php esc_html_e('Cart', 'your-theme-domain'); ?>
            <?php echo WC()->cart->get_cart_total(); ?>
        </a>
    </li>
<?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
});


// code for debugging template pathways

// go to wp-admin/config.php and add:
// define('WP_DEBUG', true);
// define('WP_DEBUG_LOG', true);
// define('WP_DEBUG_DISPLAY', false);


// add_action('template_include', function($template) {
//     error_log('WordPress is using template: ' . $template);
//     return $template;
// });

// add_action('woocommerce_before_main_content', function() {
//     error_log('WooCommerce template path: ' . wc_locate_template(''));
// }, 1);


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


    <!-- footer container -->
    <footer>
        <div class="footer-container">
            <div class="policy">
                <!-- <h5>Policy</h5> -->
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
            </div>
            <?php
            // Check if the shop page exists and is published
            $shop_page_id = wc_get_page_id('shop');
            $show_woocommerce_nav = ($shop_page_id > 0 && get_post_status($shop_page_id) === 'publish');
            // Only display WooCommerce navigation elements if shop is published
            if ($show_woocommerce_nav) {
            ?>
                <div class="quick-links">
                    <h5>Quick Links</h5>
                    <ul class="footer-nav-list">
                        <?php
                        $current_shop = is_shop() ? 'active' : '';
                        $current_account = is_account_page() ? 'active' : '';
                        $current_cart = is_cart() ? 'active' : '';
                        ?>
                        <li class="nav-item">
                            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="<?php echo $current_shop; ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                                <?php esc_html_e('Shop', 'your-theme-domain'); ?>
                            </a>
                        </li>
                        <?php if (get_page_by_path('visit')) : ?>
                            <li class="nav-item">
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('visit'))); ?>" class="<?php echo is_page('visit') ? 'active' : ''; ?>">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                                    <?php esc_html_e('Visit', 'your-theme-domain'); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="<?php echo $current_account; ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                                <?php esc_html_e('Account', 'your-theme-domain'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="<?php echo $current_cart; ?>  cart-contents fragment_refresh">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cheese_favicon_1.png" class="active-icon" alt="">
                                <?php esc_html_e('Cart', 'your-theme-domain'); ?>
                                <?php echo WC()->cart->get_cart_total(); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php
            }
            ?>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>

</html>