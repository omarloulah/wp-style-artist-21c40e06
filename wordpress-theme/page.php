<?php
/**
 * Page Template
 *
 * @package TechPolse
 */

get_header();
?>

<main class="site-main">
    <div class="container py-8">
        <div class="content-grid">
            <article class="article-main">
                <?php while (have_posts()) : the_post(); ?>
                    <header style="margin-bottom: 2rem;">
                        <h1 style="font-size: 2.25rem; font-weight: 700; color: var(--foreground); margin-bottom: 1rem;">
                            <?php the_title(); ?>
                        </h1>
                    </header>
                    
                    <div class="article-body">
                        <?php the_content(); ?>
                    </div>
                    
                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                <?php endwhile; ?>
            </article>

            <aside class="sidebar sidebar-sticky">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>
