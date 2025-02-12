<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */
defined('ABSPATH') || exit;

?>
<div class="myaccount-container">
    <nav class="woocommerce-MyAccount-navigation">
        <ul>
            <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                    <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
                        
                        <?php echo esc_html($label); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="woocommerce-MyAccount-content">
        <?php
        /**
         * My Account content.
         *
         * @since 2.6.0
         */
        do_action('woocommerce_account_content');
        ?>
    </div>
</div>