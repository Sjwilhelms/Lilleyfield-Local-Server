<!-- footer container -->
<footer>
    <div class="footer-container">
        <div class="policy">
            <h5>Policy</h5>
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div>
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

    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>