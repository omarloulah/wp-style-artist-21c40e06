<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-grid">
                <!-- Brand -->
                <div class="footer-brand">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <span>Tech<span class="accent">Polse</span></span>
                        <?php endif; ?>
                    </a>
                    <p class="footer-brand-description">
                        <?php echo esc_html(get_theme_mod('footer_description', 'A tech blog specializing in SEO, site performance, web security, and AI workflows. Quality content for developers and website owners.')); ?>
                    </p>
                </div>

                <!-- Categories -->
                <div class="footer-column">
                    <h4 class="footer-column-title"><?php esc_html_e('Categories', 'techpolse'); ?></h4>
                    <ul class="footer-links">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order'   => 'ASC',
                            'number'  => 5,
                        ));
                        
                        foreach ($categories as $category) {
                            echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '" class="footer-link">' . esc_html($category->name) . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <!-- Links -->
                <div class="footer-column">
                    <h4 class="footer-column-title"><?php esc_html_e('Links', 'techpolse'); ?></h4>
                    <?php
                    if (has_nav_menu('resources')) {
                        wp_nav_menu(array(
                            'theme_location' => 'resources',
                            'container'      => false,
                            'menu_class'     => 'footer-links',
                            'depth'          => 1,
                        ));
                    } else {
                        ?>
                        <ul class="footer-links">
                            <li><a href="<?php echo esc_url(home_url('/about')); ?>" class="footer-link"><?php esc_html_e('About', 'techpolse'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact')); ?>" class="footer-link"><?php esc_html_e('Contact', 'techpolse'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="footer-link"><?php esc_html_e('Privacy Policy', 'techpolse'); ?></a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <p class="footer-copyright">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'techpolse'); ?>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
