<?php
/**
 * The main template file
 *
 * @package TechPolse
 */

get_header();
?>

<main class="site-main">
    <div class="container py-8">
        
        <?php if (is_home() && !is_paged()) : ?>
            <?php
            // Featured Post Section
            $featured = techpolse_get_featured_post();
            if ($featured->have_posts()) :
                while ($featured->have_posts()) : $featured->the_post();
            ?>
            <section class="featured-section animate-fade-in">
                <div class="featured-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('techpolse-featured'); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php endif; ?>
                </div>
                <div class="featured-overlay"></div>
                <div class="featured-content">
                    <div class="featured-inner">
                        <span class="badge badge-featured" style="margin-bottom: 1rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <?php esc_html_e('Featured', 'techpolse'); ?>
                        </span>
                        
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="badge badge-category" style="margin-left: 0.5rem;">
                                <?php echo esc_html($categories[0]->name); ?>
                            </a>
                        <?php endif; ?>
                        
                        <h2 class="featured-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        
                        <p class="featured-excerpt"><?php echo get_the_excerpt(); ?></p>
                        
                        <div class="featured-meta">
                            <span class="meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                    <line x1="16" x2="16" y1="2" y2="6"></line>
                                    <line x1="8" x2="8" y1="2" y2="6"></line>
                                    <line x1="3" x2="21" y1="10" y2="10"></line>
                                </svg>
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <?php echo techpolse_reading_time(); ?>
                            </span>
                            <span class="meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <?php the_author(); ?>
                            </span>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="btn btn-featured btn-lg">
                            <?php esc_html_e('Read Article', 'techpolse'); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        <?php endif; ?>

        <!-- Category Tabs -->
        <div class="category-tabs">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="category-tab <?php echo is_home() ? 'active' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px; vertical-align: -2px;">
                    <rect width="7" height="7" x="3" y="3" rx="1"></rect>
                    <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                    <rect width="7" height="7" x="14" y="14" rx="1"></rect>
                    <rect width="7" height="7" x="3" y="14" rx="1"></rect>
                </svg>
                <?php esc_html_e('All', 'techpolse'); ?>
            </a>
            <?php
            $categories = get_categories(array(
                'orderby' => 'count',
                'order'   => 'DESC',
                'number'  => 5,
            ));
            
            foreach ($categories as $category) {
                $active_class = is_category($category->term_id) ? 'active' : '';
                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-tab ' . $active_class . '">' . esc_html($category->name) . '</a>';
            }
            ?>
        </div>

        <!-- Main Content Grid -->
        <div class="content-grid">
            <!-- Articles Grid -->
            <div class="articles-column">
                <?php if (have_posts()) : ?>
                    <div class="articles-grid">
                        <?php
                        // Skip the featured post on the first page
                        $featured_id = 0;
                        if (is_home() && !is_paged()) {
                            $featured_query = techpolse_get_featured_post();
                            if ($featured_query->have_posts()) {
                                $featured_query->the_post();
                                $featured_id = get_the_ID();
                                wp_reset_postdata();
                            }
                        }
                        
                        while (have_posts()) : the_post();
                            // Skip featured post
                            if (get_the_ID() === $featured_id) {
                                continue;
                            }
                        ?>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                                    <line x1="16" x2="16" y1="2" y2="6"></line>
                                                    <line x1="8" x2="8" y1="2" y2="6"></line>
                                                    <line x1="3" x2="21" y1="10" y2="10"></line>
                                                </svg>
                                                <?php echo get_the_date(); ?>
                                            </span>
                                            <span class="meta-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    <div class="no-posts">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 1.5rem; opacity: 0.5;">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="9" x2="15" y1="15" y2="15"></line>
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;"><?php esc_html_e('No articles found', 'techpolse'); ?></h3>
                        <p><?php esc_html_e('Check back later for new content.', 'techpolse'); ?></p>
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
