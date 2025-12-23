<?php
/**
 * Search Results Template
 *
 * @package TechPolse
 */

get_header();
?>

<main class="site-main">
    <div class="container py-8">
        
        <!-- Search Header -->
        <div class="archive-header">
            <h1 class="archive-title">
                <?php
                printf(
                    esc_html__('Search Results for: %s', 'techpolse'),
                    '<span style="color: var(--primary);">' . get_search_query() . '</span>'
                );
                ?>
            </h1>
            <p class="archive-description">
                <?php
                global $wp_query;
                $total = $wp_query->found_posts;
                printf(
                    _n('%s result found', '%s results found', $total, 'techpolse'),
                    number_format_i18n($total)
                );
                ?>
            </p>
        </div>

        <!-- Search Form -->
        <div style="margin-bottom: 2rem;">
            <?php get_search_form(); ?>
        </div>

        <!-- Main Content Grid -->
        <div class="content-grid">
            <!-- Articles Grid -->
            <div class="articles-column">
                <?php if (have_posts()) : ?>
                    <div class="articles-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <article class="article-card animate-slide-up">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="article-card-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('techpolse-card'); ?>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>" alt="<?php the_title_attribute(); ?>">
                                        <?php endif; ?>
                                        
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) :
                                        ?>
                                            <span class="article-card-badge badge badge-category">
                                                <?php echo esc_html($categories[0]->name); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="article-card-content">
                                        <h3 class="article-card-title"><?php the_title(); ?></h3>
                                        <p class="article-card-excerpt"><?php echo get_the_excerpt(); ?></p>
                                        
                                        <div class="article-card-meta">
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
                                        </div>
                                    </div>
                                </a>
                            </article>
                        <?php endwhile; ?>
                    </div>
                    
                    <?php techpolse_pagination(); ?>
                    
                <?php else : ?>
                    <div class="no-posts" style="text-align: center; padding: 4rem 0;">
                        <p style="color: var(--muted-foreground); margin-bottom: 1rem;">
                            <?php esc_html_e('No articles found matching your search.', 'techpolse'); ?>
                        </p>
                        <p style="color: var(--muted-foreground);">
                            <?php esc_html_e('Try different keywords or browse our categories.', 'techpolse'); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="sidebar sidebar-sticky">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>
