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
            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
            <polyline points="16 7 22 7 22 13"></polyline>
        </svg>
        <h3 class="widget-title"><?php esc_html_e('Most Read', 'techpolse'); ?></h3>
    </div>
    
    <div class="popular-articles">
        <?php
        $popular = techpolse_get_popular_posts(3);
        $count = 1;
        
        if ($popular->have_posts()) :
            while ($popular->have_posts()) : $popular->the_post();
        ?>
            <a href="<?php the_permalink(); ?>" class="popular-article">
                <span class="popular-article-number"><?php echo $count; ?></span>
                <div class="popular-article-content">
                    <h4 class="popular-article-title"><?php the_title(); ?></h4>
                    <span class="popular-article-views">
                        <?php echo get_comments_number(); ?> <?php esc_html_e('comments', 'techpolse'); ?>
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
            <path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"></path>
            <path d="M7 7h.01"></path>
        </svg>
        <h3 class="widget-title"><?php esc_html_e('Tags', 'techpolse'); ?></h3>
    </div>
    
    <div class="tags-cloud">
        <?php
        $tags = get_tags(array(
            'orderby' => 'count',
            'order'   => 'DESC',
            'number'  => 10,
        ));
        
        foreach ($tags as $tag) {
            echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-link">' . esc_html($tag->name) . '</a>';
        }
        ?>
    </div>
</div>

<!-- Newsletter Widget -->
<div class="sidebar-widget newsletter-widget">
    <h3 class="newsletter-title">
        <?php echo esc_html(get_theme_mod('newsletter_title', 'Subscribe to Newsletter')); ?>
    </h3>
    <p class="newsletter-description">
        <?php echo esc_html(get_theme_mod('newsletter_description', 'Get the latest articles and tech tips delivered directly to your inbox')); ?>
    </p>
    
    <form class="newsletter-form" action="#" method="post">
        <input 
            type="email" 
            name="email" 
            class="newsletter-input" 
            placeholder="<?php esc_attr_e('Your email address', 'techpolse'); ?>" 
            required
        >
        <button type="submit" class="btn btn-primary" style="width: 100%;">
            <?php esc_html_e('Subscribe', 'techpolse'); ?>
        </button>
    </form>
</div>

<?php
// WordPress dynamic sidebar
if (is_active_sidebar('sidebar-1')) {
    dynamic_sidebar('sidebar-1');
}
?>
