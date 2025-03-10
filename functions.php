<?php
function child_theme_enqueue_styles()
{
    $parent_style = 'parent-style';

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'child_theme_enqueue_styles');

// Redirect Storefront custom logo to shop page

function storefront_child_custom_logo_link($html)
{
    $shop_url = get_permalink(wc_get_page_id('shop'));

    $html = str_replace(home_url(), $shop_url, $html);

    return $html;
}
add_filter('get_custom_logo', 'storefront_child_custom_logo_link');

//   Remove WooCommerce breadcrumbs in Storefront theme

function remove_storefront_woocommerce_breadcrumbs()
{
    remove_action('storefront_before_content', 'woocommerce_breadcrumb', 10);
}
add_action('init', 'remove_storefront_woocommerce_breadcrumbs');

// remove menu account menu links

function custom_remove_account_menu_items($menu_links)
{

    unset($menu_links['dashboard']);
    // unset( $menu_links['orders'] );     
    unset($menu_links['downloads']);
    // unset( $menu_links['edit-address'] );  
    // unset( $menu_links['payment-methods'] ); 
    // unset( $menu_links['edit-account'] );  
    // unset( $menu_links['customer-logout'] );

    return $menu_links;
}
add_filter('woocommerce_account_menu_items', 'custom_remove_account_menu_items');

//  preload both variations of logo images

function custom_preload_logo_images()
{
    echo '<link rel="preload" href="' . esc_url(get_stylesheet_directory_uri() . '/wp-content/uploads/2025/02/logo_inline.png') . '" as="image">';
    echo '<link rel="preload" href="' . esc_url(get_stylesheet_directory_uri() . '/wp-content/uploads/2025/02/lilleyfield_text.png') . '" as="image">';
}
add_action('wp_head', 'custom_preload_logo_images', 1);
