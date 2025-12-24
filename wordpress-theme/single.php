<?php
/**
 * Single Post Template
 *
 * @package TechPolse
 */

get_header();
?>

<!-- Reading Progress Bar -->
<div id="reading-progress" class="reading-progress-bar" style="width: 0%;"></div>

<main class="site-main">
    <?php while (have_posts()) : the_post(); ?>

    <!-- Featured Image Full Width -->
    <?php if (has_post_thumbnail()) : ?>
    <div class="article-hero-image">
        <?php the_post_thumbnail('full', array('class' => 'article-hero-img')); ?>
    </div>
    <?php endif; ?>

    <!-- Article Content -->
    <div class="container article-content-wrapper" style="padding-top: 2rem;">
        <div class="content-grid">
            <article class="article-main">
                <!-- Article Title and Meta -->
                <div class="article-title-section" style="margin-bottom: 2rem;">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                    ?>
                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="badge badge-category" style="margin-bottom: 1rem; display: inline-block;">
                            <?php echo esc_html($categories[0]->name); ?>
                        </a>
                    <?php endif; ?>
                    
                    <h1 style="font-size: 2rem; font-weight: 700; color: var(--foreground); margin-bottom: 1rem; line-height: 1.2;">
                        <?php the_title(); ?>
                    </h1>
                    
                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; font-size: 0.875rem; color: var(--muted-foreground);">
                        <span style="display: flex; align-items: center; gap: 0.5rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                <line x1="16" x2="16" y1="2" y2="6"></line>
                                <line x1="8" x2="8" y1="2" y2="6"></line>
                                <line x1="3" x2="21" y1="10" y2="10"></line>
                            </svg>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span style="display: flex; align-items: center; gap: 0.5rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <?php echo techpolse_reading_time(); ?>
                        </span>
                    </div>
                </div>

                <!-- Article Body -->
                <div class="article-body">
                    <?php the_content(); ?>
                </div>

                <!-- Share Buttons -->
                <div class="share-buttons" style="margin-top: 2rem;">
                    <span class="share-label"><?php esc_html_e('Share:', 'techpolse'); ?></span>
                    
                    <button type="button" class="btn-icon btn-twitter" onclick="window.open('https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>', '_blank')" aria-label="<?php esc_attr_e('Share on Twitter', 'techpolse'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                        </svg>
                    </button>
                    
                    <button type="button" class="btn-icon btn-facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>', '_blank')" aria-label="<?php esc_attr_e('Share on Facebook', 'techpolse'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </button>
                    
                    <button type="button" class="btn-icon btn-linkedin" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>', '_blank')" aria-label="<?php esc_attr_e('Share on LinkedIn', 'techpolse'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                            <rect width="4" height="12" x="2" y="9"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg>
                    </button>
                    
                    <button type="button" class="btn-icon btn-copy" onclick="copyToClipboard('<?php the_permalink(); ?>')" aria-label="<?php esc_attr_e('Copy Link', 'techpolse'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                    </button>
                    
                    <button type="button" class="btn-icon btn-whatsapp" onclick="window.open('https://wa.me/?text=<?php the_title(); ?> <?php the_permalink(); ?>', '_blank')" aria-label="<?php esc_attr_e('Share on WhatsApp', 'techpolse'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ($tags) :
                ?>
                <div class="article-tags" style="margin-top: 2rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary);">
                            <path d="m15 5 6.3 6.3a2.4 2.4 0 0 1 0 3.4L17 19"></path>
                            <path d="M9.586 5.586A2 2 0 0 0 8.172 5H3a1 1 0 0 0-1 1v5.172a2 2 0 0 0 .586 1.414L8 18"></path>
                            <circle cx="6.5" cy="9.5" r=".5" fill="currentColor"></circle>
                        </svg>
                        <span style="font-weight: 600; color: var(--foreground);"><?php esc_html_e('Tags', 'techpolse'); ?></span>
                    </div>
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
                    <h3 class="related-articles-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: -5px; margin-right: 0.5rem; color: var(--primary);">
                            <path d="M16 3h5v5"></path>
                            <path d="M8 3H3v5"></path>
                            <path d="M12 22v-8.3a4 4 0 0 0-1.172-2.872L3 3"></path>
                            <path d="m15 9 6-6"></path>
                        </svg>
                        <?php esc_html_e('Related Articles', 'techpolse'); ?>
                    </h3>
                    <div class="related-articles-grid">
                        <?php while ($related->have_posts()) : $related->the_post(); ?>
                            <a href="<?php the_permalink(); ?>" class="related-article-card">
                                <h4 class="related-article-card-title"><?php the_title(); ?></h4>
                                <span class="related-article-card-meta">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: -1px; margin-right: 4px;">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <?php echo techpolse_reading_time(); ?>
                                </span>
                            </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Post Navigation -->
                <div style="margin-top: 3rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    
                    <?php if ($prev_post) : ?>
                        <a href="<?php echo get_permalink($prev_post); ?>" class="related-article-card" style="text-align: left;">
                            <span style="font-size: 0.75rem; color: var(--muted-foreground); display: flex; align-items: center; gap: 0.25rem; margin-bottom: 0.5rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                                <?php esc_html_e('Previous', 'techpolse'); ?>
                            </span>
                            <h4 class="related-article-card-title"><?php echo get_the_title($prev_post); ?></h4>
                        </a>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                        <a href="<?php echo get_permalink($next_post); ?>" class="related-article-card" style="text-align: right;">
                            <span style="font-size: 0.75rem; color: var(--muted-foreground); display: flex; align-items: center; gap: 0.25rem; margin-bottom: 0.5rem; justify-content: flex-end;">
                                <?php esc_html_e('Next', 'techpolse'); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </span>
                            <h4 class="related-article-card-title"><?php echo get_the_title($next_post); ?></h4>
                        </a>
                    <?php endif; ?>
                </div>

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
