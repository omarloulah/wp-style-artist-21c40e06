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
                        <?php echo esc_html(get_theme_mod('footer_description', 'Your go-to destination for the latest tech insights, tutorials, and industry news. Stay ahead of the curve with expert analysis and practical guides.')); ?>
                    </p>
                    
                    <!-- Social Links -->
                    <div class="social-links" style="margin-top: 1.5rem;">
                        <a href="#" class="social-link" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-link" aria-label="GitHub">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
                                <path d="M9 18c-4.51 2-5-2-7-2"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect width="4" height="12" x="2" y="9"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" class="social-link" aria-label="RSS Feed">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 11a9 9 0 0 1 9 9"></path>
                                <path d="M4 4a16 16 0 0 1 16 16"></path>
                                <circle cx="5" cy="19" r="1"></circle>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Categories -->
                <div class="footer-column">
                    <h4 class="footer-column-title"><?php esc_html_e('Categories', 'techpolse'); ?></h4>
                    <ul class="footer-links">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'count',
                            'order'   => 'DESC',
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
                    <h4 class="footer-column-title"><?php esc_html_e('Quick Links', 'techpolse'); ?></h4>
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
                            <li><a href="<?php echo esc_url(home_url('/about')); ?>" class="footer-link"><?php esc_html_e('About Us', 'techpolse'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact')); ?>" class="footer-link"><?php esc_html_e('Contact', 'techpolse'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="footer-link"><?php esc_html_e('Privacy Policy', 'techpolse'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/terms')); ?>" class="footer-link"><?php esc_html_e('Terms of Service', 'techpolse'); ?></a></li>
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
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
                <?php esc_html_e('Crafted with', 'techpolse'); ?> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display: inline-block; vertical-align: middle; color: #ef4444;">
                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                </svg>
                <?php esc_html_e('for tech enthusiasts.', 'techpolse'); ?>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
