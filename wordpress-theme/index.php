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

        <!-- Browse Categories Section -->
        <?php if (is_home() && !is_paged()) : ?>
        <section class="categories-section">
            <h2 class="section-title">
                <span class="section-title-bar"></span>
                <?php esc_html_e('Browse Categories', 'techpolse'); ?>
            </h2>
            
            <div class="categories-grid">
                <?php
                $cat_icons = array(
                    'ai-workflow' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><path d="M11 9h4V6H9v11h6v-3h-4"/></svg>',
                    'seo-basics' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>',
                    'performance' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m13 2-2 2.5h3L12 7"/><path d="M10 14v-3"/><path d="M14 14v-3"/><path d="M12 14v-3"/></svg>',
                    'security' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>',
                    'marketing' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>',
                    'design' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="13.5" cy="6.5" r=".5"/><circle cx="17.5" cy="10.5" r=".5"/><circle cx="8.5" cy="7.5" r=".5"/><circle cx="6.5" cy="12.5" r=".5"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.555C21.965 6.012 17.461 2 12 2z"/></svg>',
                );
                
                $cat_colors = array(
                    'ai-workflow' => 'from-purple-500 to-pink-500',
                    'seo-basics' => 'from-blue-500 to-cyan-500',
                    'performance' => 'from-yellow-500 to-orange-500',
                    'security' => 'from-green-500 to-emerald-500',
                    'marketing' => 'from-red-500 to-rose-500',
                    'design' => 'from-indigo-500 to-violet-500',
                );
                
                $cat_bg_colors = array(
                    'ai-workflow' => '#a855f7',
                    'seo-basics' => '#3b82f6',
                    'performance' => '#f59e0b',
                    'security' => '#10b981',
                    'marketing' => '#ef4444',
                    'design' => '#6366f1',
                );
                
                $all_categories = get_categories(array(
                    'orderby' => 'count',
                    'order'   => 'DESC',
                    'number'  => 6,
                    'hide_empty' => false,
                ));
                
                $index = 0;
                foreach ($all_categories as $category) :
                    $slug = $category->slug;
                    $icon = isset($cat_icons[$slug]) ? $cat_icons[$slug] : $cat_icons['design'];
                    $bg_color = isset($cat_bg_colors[$slug]) ? $cat_bg_colors[$slug] : '#6366f1';
                ?>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-card" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                        <div class="category-card-icon" style="background: <?php echo esc_attr($bg_color); ?>;">
                            <?php echo $icon; ?>
                        </div>
                        <h3 class="category-card-title"><?php echo esc_html($category->name); ?></h3>
                        <span class="category-card-count"><?php echo esc_html($category->count); ?> <?php esc_html_e('articles', 'techpolse'); ?></span>
                    </a>
                <?php 
                    $index++;
                endforeach; 
                ?>
            </div>
        </section>
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
