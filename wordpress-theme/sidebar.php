<?php
/**
 * Sidebar Template
 *
 * @package TechPolse
 */
?>

<!-- Popular Articles Widget -->
<div class="sidebar-widget">
    <div class="widget-header">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 20V10"></path>
            <path d="M18 20V4"></path>
            <path d="M6 20v-4"></path>
        </svg>
        <h3 class="widget-title"><?php esc_html_e('Trending Now', 'techpolse'); ?></h3>
    </div>
    
    <div class="popular-articles">
        <?php
        $popular = techpolse_get_popular_posts(4);
        $count = 1;
        
        if ($popular->have_posts()) :
            while ($popular->have_posts()) : $popular->the_post();
        ?>
            <a href="<?php the_permalink(); ?>" class="popular-article">
                <span class="popular-article-number"><?php echo $count; ?></span>
                <div class="popular-article-content">
                    <h4 class="popular-article-title"><?php the_title(); ?></h4>
                    <span class="popular-article-views">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 4px;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <?php echo techpolse_reading_time(); ?>
                    </span>
                </div>
            </a>
        <?php
            $count++;
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<!-- Tags Widget -->
<div class="sidebar-widget">
    <div class="widget-header">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m15 5 6.3 6.3a2.4 2.4 0 0 1 0 3.4L17 19"></path>
            <path d="M9.586 5.586A2 2 0 0 0 8.172 5H3a1 1 0 0 0-1 1v5.172a2 2 0 0 0 .586 1.414L8 18"></path>
            <circle cx="6.5" cy="9.5" r=".5" fill="currentColor"></circle>
        </svg>
        <h3 class="widget-title"><?php esc_html_e('Popular Tags', 'techpolse'); ?></h3>
    </div>
    
    <div class="tags-cloud">
        <?php
        $tags = get_tags(array(
            'orderby' => 'count',
            'order'   => 'DESC',
            'number'  => 12,
        ));
        
        foreach ($tags as $tag) {
            echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-link">' . esc_html($tag->name) . '</a>';
        }
        ?>
    </div>
</div>

<!-- Newsletter Widget -->
<div class="sidebar-widget newsletter-widget">
    <div class="widget-header" style="margin-bottom: 0.5rem;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
        </svg>
        <h3 class="newsletter-title">
            <?php echo esc_html(get_theme_mod('newsletter_title', 'Stay Updated')); ?>
        </h3>
    </div>
    <p class="newsletter-description">
        <?php echo esc_html(get_theme_mod('newsletter_description', 'Get the latest articles, tutorials, and tech insights delivered straight to your inbox. No spam, unsubscribe anytime.')); ?>
    </p>
    
    <form class="newsletter-form" action="#" method="post">
        <input 
            type="email" 
            name="email" 
            class="newsletter-input" 
            placeholder="<?php esc_attr_e('Enter your email', 'techpolse'); ?>" 
            required
        >
        <button type="submit" class="btn btn-primary" style="width: 100%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                <path d="m22 2-7 20-4-9-9-4Z"></path>
                <path d="M22 2 11 13"></path>
            </svg>
            <?php esc_html_e('Subscribe', 'techpolse'); ?>
        </button>
    </form>
</div>

<!-- About Widget (Optional) -->
<div class="sidebar-widget">
    <div class="widget-header">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M12 16v-4"></path>
            <path d="M12 8h.01"></path>
        </svg>
        <h3 class="widget-title"><?php esc_html_e('About', 'techpolse'); ?></h3>
    </div>
    <p style="font-size: 0.9rem; color: var(--muted-foreground); line-height: 1.7;">
        <?php echo esc_html(get_theme_mod('about_text', 'TechPolse is your trusted source for cutting-edge technology news, in-depth tutorials, and expert insights. Join our community of tech enthusiasts.')); ?>
    </p>
</div>

<?php
// WordPress dynamic sidebar
if (is_active_sidebar('sidebar-1')) {
    dynamic_sidebar('sidebar-1');
}
?>
