    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="affiliate-disclosure">
                <strong>Affiliate Disclosure:</strong> As an Amazon Associate and affiliate partner of various brands, we earn from qualifying purchases. This helps support our site at no extra cost to you.
            </div>

            <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
            <div class="footer-widgets">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-column">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-2')) : ?>
                    <div class="footer-column">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-3')) : ?>
                    <div class="footer-column">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <nav class="footer-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ));
                ?>
            </nav>

            <div class="site-info">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                <p>
                    <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a> |
                    <a href="<?php echo esc_url(home_url('/terms-of-service/')); ?>">Terms of Service</a> |
                    <a href="<?php echo esc_url(home_url('/affiliate-disclosure/')); ?>">Affiliate Disclosure</a>
                </p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
