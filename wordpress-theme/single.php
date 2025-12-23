<?php
/**
 * Single Post Template
 *
 * @package TechPolse
 */

get_header();
?>

<main class="site-main">
    <?php while (have_posts()) : the_post(); ?>
    
    <!-- Article Header -->
    <div class="article-header">
        <div class="article-header-bg">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('techpolse-featured'); ?>
            <?php endif; ?>
            <div class="article-header-overlay"></div>
        </div>
        
        <div class="container">
            <div class="article-header-content">
                <div class="article-header-inner">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                    ?>
                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="badge badge-category">
                            <?php echo esc_html($categories[0]->name); ?>
                        </a>
                    <?php endif; ?>
                    
                    <h1 class="article-header-title"><?php the_title(); ?></h1>
                    
                    <div class="article-header-meta">
                        <span class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                <line x1="16" x2="16" y1="2" y2="6"></line>
                                <line x1="8" x2="8" y1="2" y2="6"></line>
                                <line x1="3" x2="21" y1="10" y2="10"></line>
                            </svg>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <?php echo techpolse_reading_time(); ?>
                        </span>
                        <span class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <?php the_author(); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="container article-content-wrapper">
        <div class="content-grid">
            <article class="article-main">
                <!-- Share Buttons -->
                <div class="share-buttons">
                    <span class="share-label"><?php esc_html_e('Share:', 'techpolse'); ?></span>
                    <button type="button" class="btn btn-outline btn-icon" onclick="navigator.share ? navigator.share({title: '<?php the_title(); ?>', url: '<?php the_permalink(); ?>'}) : window.open('https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>', '_blank')" aria-label="<?php esc_attr_e('Share', 'techpolse'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                            <polyline points="16 6 12 2 8 6"></polyline>
                            <line x1="12" x2="12" y1="2" y2="15"></line>
                        </svg>
                    </button>
                    <button type="button" class="btn btn-outline btn-icon" onclick="if(navigator.clipboard) navigator.clipboard.writeText('<?php the_permalink(); ?>')" aria-label="<?php esc_attr_e('Copy Link', 'techpolse'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Article Body -->
                <div class="article-body">
                    <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ($tags) :
                ?>
                <div class="article-tags" style="margin-top: 2rem;">
                    <div class="tags-cloud">
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-link">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Related Articles -->
                <?php
                $related = techpolse_get_related_posts(get_the_ID(), 3);
                if ($related->have_posts()) :
                ?>
                <div class="related-articles">
                    <h3 class="related-articles-title"><?php esc_html_e('Related Articles', 'techpolse'); ?></h3>
                    <div class="related-articles-grid">
                        <?php while ($related->have_posts()) : $related->the_post(); ?>
                            <a href="<?php the_permalink(); ?>" class="related-article-card">
                                <h4 class="related-article-card-title"><?php the_title(); ?></h4>
                                <span class="related-article-card-meta"><?php echo techpolse_reading_time(); ?></span>
                            </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Comments -->
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </article>

            <!-- Sidebar -->
            <aside class="sidebar sidebar-sticky">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
    
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
