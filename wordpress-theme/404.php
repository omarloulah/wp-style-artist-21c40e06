<?php
/**
 * 404 Page Template
 *
 * @package TechPolse
 */

get_header();
?>

<main class="site-main">
    <div class="container">
        <div class="error-404">
            <div style="text-align: center;">
                <h1 class="error-404-title"><?php esc_html_e('Article Not Found', 'techpolse'); ?></h1>
                <p style="color: var(--muted-foreground); margin-bottom: 2rem;">
                    <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'techpolse'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;">
                        <path d="m12 19-7-7 7-7"></path>
                        <path d="M19 12H5"></path>
                    </svg>
                    <?php esc_html_e('Back to Home', 'techpolse'); ?>
                </a>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
