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

add_filter('woocommerce_enqueue_styles', 'jk_dequeue_styles');
function jk_dequeue_styles($enqueue_styles)
{
    // unset($enqueue_styles['woocommerce-general']);
    // unset($enqueue_styles['woocommerce-layout']);
    // unset($enqueue_styles['woocommerce-smallscreen']);
    return $enqueue_styles;
}

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

add_action('init', 'remove_storefront_header');
function remove_storefront_header()
{
    remove_action('storefront_header', 'storefront_header_container', 0);
    remove_action('storefront_header', 'storefront_skip_links', 5);
    remove_action('storefront_header', 'storefront_site_branding', 20);
    remove_action('storefront_header', 'storefront_secondary_navigation', 30);
    remove_action('storefront_header', 'storefront_primary_navigation', 50);
}


// remove storefront built in footer

add_action('init', 'remove_storefront_footer');
function remove_storefront_footer()
{
    remove_action('storefront_footer', 'storefront_footer_widgets', 10);
    remove_action('storefront_footer', 'storefront_credit', 20);
}

add_filter('template_include', function ($template) {
    if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
        $new_template = locate_template(['woocommerce.php']);
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}, 99);

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
