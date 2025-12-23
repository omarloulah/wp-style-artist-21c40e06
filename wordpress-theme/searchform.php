<?php
/**
 * Search Form Template
 *
 * @package TechPolse
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="sr-only" for="search-field"><?php esc_html_e('Search', 'techpolse'); ?></label>
    <input 
        type="search" 
        id="search-field"
        class="search-field" 
        placeholder="<?php esc_attr_e('Search articles...', 'techpolse'); ?>" 
        value="<?php echo get_search_query(); ?>" 
        name="s"
    >
    <button type="submit" class="search-submit">
        <?php esc_html_e('Search', 'techpolse'); ?>
    </button>
</form>
