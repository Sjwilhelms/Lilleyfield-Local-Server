<?php
get_header();
?>

<main>
    <?php 
    if (is_cart()) {
        // Cart page content
        echo '<h1>Cart</h1>';
        echo do_shortcode('[woocommerce_cart]');
    }
    elseif (is_checkout()) {
        // Checkout page content
        echo '<h1>Checkout</h1>';
        echo do_shortcode('[woocommerce_checkout]');
    }
    elseif (is_account_page()) {
        // Account page content
        echo '<h1>My Account</h1>';
        echo do_shortcode('[woocommerce_my_account]');
    }
    else {
        // Default WooCommerce content (shop, single product, etc)
        woocommerce_content();
    }
    ?>
</main>

<?php
get_footer();
?>