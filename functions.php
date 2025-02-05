<?php 
define("CHI_THEME_DIR_URI", get_template_directory_uri());
define("CHI_THEME_BASE_DIR", get_template_directory());

class Storefront_Child_Theme {
    
    private static $instance = null;

    private function __construct(){
        add_action("wp_enqueue_scripts", [ $this,"enqueue_styles"] );
    }

    public function enqueue_styles(){
        wp_enqueue_style("storefront-child", get_stylesheet_uri() ."", [],);
    }

    public static function get_instance(){
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

function mytheme_add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

// remove woocommerce default css

// add_filter('woocommerce_enqueue_styles', 'jk_dequeue_styles');
// function jk_dequeue_styles($enqueue_styles) {
//     unset($enqueue_styles['woocommerce-general']);
//     unset($enqueue_styles['woocommerce-layout']);
//     unset($enqueue_styles['woocommerce-smallscreen']);
//     return $enqueue_styles;
// }

// remove wordpress default css

// Disable WordPress default style.css
// function remove_default_styles() {
//     wp_dequeue_style('wp-block-library');
//     wp_dequeue_style('wp-block-library-theme');
//     wp_dequeue_style('classic-theme-styles');
//     wp_dequeue_style('global-styles');
// }
// add_action('wp_enqueue_scripts', 'remove_default_styles', 100);

// remove storefront built in header

// In your child theme's functions.php
add_action('init', 'remove_storefront_header');
function remove_storefront_header() {
    remove_action('storefront_header', 'storefront_header_container', 0);
    remove_action('storefront_header', 'storefront_skip_links', 5);
    remove_action('storefront_header', 'storefront_site_branding', 20);
    remove_action('storefront_header', 'storefront_secondary_navigation', 30);
    remove_action('storefront_header', 'storefront_primary_navigation', 50);
}


// remove storefront built in footer

add_action('init', 'remove_storefront_footer');
function remove_storefront_footer() {
    remove_action('storefront_footer', 'storefront_footer_widgets', 10);
    remove_action('storefront_footer', 'storefront_credit', 20);
}

add_filter('template_include', function($template) {
    if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
        $new_template = locate_template(['woocommerce.php']);
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}, 99);

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


// single-product.php reorder title

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 20);
