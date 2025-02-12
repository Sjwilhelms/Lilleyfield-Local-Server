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
                
                <?php if (get_page_by_path('visit')): ?>
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
        <div class="footer-map">
            <h5>Map</h5>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2032.5117667968798!2d-5.054693623453872!3d50.26199857155689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x486b17005facb545%3A0xf76f4923181b6a9a!2sLilleyfield%20Cheese%20Co.!5e1!3m2!1sen!2suk!4v1738686011136!5m2!1sen!2suk"
                width="350" 
                height="150" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>