<?php
/**
 * TechPolse Theme Functions
 *
 * @package TechPolse
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function techpolse_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');

    // Set thumbnail sizes
    set_post_thumbnail_size(800, 500, true);
    add_image_size('techpolse-featured', 1200, 600, true);
    add_image_size('techpolse-card', 400, 250, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary'   => __('Primary Menu', 'techpolse'),
        'footer'    => __('Footer Menu', 'techpolse'),
        'resources' => __('Resources Menu', 'techpolse'),
    ));
}
add_action('after_setup_theme', 'techpolse_setup');

/**
 * Enqueue Styles and Scripts
 */
function techpolse_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'techpolse-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'techpolse-style',
        get_stylesheet_uri(),
        array('techpolse-fonts'),
        wp_get_theme()->get('Version')
    );

    // Theme JavaScript
    wp_enqueue_script(
        'techpolse-scripts',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'techpolse_scripts');

/**
 * Register Sidebars/Widget Areas
 */
function techpolse_widgets_init() {
    register_sidebar(array(
        'name'          => __('Blog Sidebar', 'techpolse'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in blog sidebar.', 'techpolse'),
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'techpolse'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in footer.', 'techpolse'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'techpolse_widgets_init');

/**
 * Custom Excerpt Length
 */
function techpolse_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'techpolse_excerpt_length');

/**
 * Custom Excerpt More
 */
function techpolse_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'techpolse_excerpt_more');

/**
 * Estimated Reading Time
 */
function techpolse_reading_time($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    return $reading_time . ' min read';
}

/**
 * Get Featured Article
 */
function techpolse_get_featured_post() {
    $args = array(
        'posts_per_page' => 1,
        'meta_key'       => '_is_featured',
        'meta_value'     => '1',
        'post_status'    => 'publish',
    );
    
    $featured = new WP_Query($args);
    
    if (!$featured->have_posts()) {
        // If no featured post, get the latest post
        $args = array(
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        );
        $featured = new WP_Query($args);
    }
    
    return $featured;
}

/**
 * Get Popular Posts (by comment count)
 */
function techpolse_get_popular_posts($count = 3) {
    $args = array(
        'posts_per_page' => $count,
        'orderby'        => 'comment_count',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    );
    
    return new WP_Query($args);
}

/**
 * Get Related Posts
 */
function techpolse_get_related_posts($post_id = null, $count = 3) {
    $post_id = $post_id ?: get_the_ID();
    $categories = wp_get_post_categories($post_id);
    
    if (empty($categories)) {
        return new WP_Query();
    }
    
    $args = array(
        'posts_per_page' => $count,
        'category__in'   => $categories,
        'post__not_in'   => array($post_id),
        'post_status'    => 'publish',
    );
    
    return new WP_Query($args);
}

/**
 * Add Featured Post Meta Box
 */
function techpolse_add_featured_meta_box() {
    add_meta_box(
        'techpolse_featured',
        __('Featured Post', 'techpolse'),
        'techpolse_featured_meta_box_callback',
        'post',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'techpolse_add_featured_meta_box');

function techpolse_featured_meta_box_callback($post) {
    wp_nonce_field('techpolse_featured_nonce', 'techpolse_featured_nonce');
    $value = get_post_meta($post->ID, '_is_featured', true);
    ?>
    <label>
        <input type="checkbox" name="is_featured" value="1" <?php checked($value, '1'); ?> />
        <?php _e('Mark as Featured Post', 'techpolse'); ?>
    </label>
    <?php
}

function techpolse_save_featured_meta($post_id) {
    if (!isset($_POST['techpolse_featured_nonce']) || 
        !wp_verify_nonce($_POST['techpolse_featured_nonce'], 'techpolse_featured_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $is_featured = isset($_POST['is_featured']) ? '1' : '0';
    update_post_meta($post_id, '_is_featured', $is_featured);
}
add_action('save_post', 'techpolse_save_featured_meta');

/**
 * Custom Walker for Primary Menu
 */
class TechPolse_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';
        
        if (in_array('current-menu-item', $classes) || in_array('current_page_item', $classes)) {
            $classes[] = 'active';
        }
        
        $class_names = implode(' ', array_filter($classes));
        
        $output .= '<a href="' . esc_url($item->url) . '" class="nav-link ' . ($this->has_active_class($classes) ? 'active' : '') . '">';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }
    
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        // No wrapper needed
    }
    
    private function has_active_class($classes) {
        return in_array('current-menu-item', $classes) || in_array('current_page_item', $classes);
    }
}

/**
 * Pagination
 */
function techpolse_pagination() {
    global $wp_query;
    
    $big = 999999999;
    
    $pages = paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'type'      => 'array',
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
    ));
    
    if (is_array($pages)) {
        echo '<nav class="pagination">';
        foreach ($pages as $page) {
            echo $page;
        }
        echo '</nav>';
    }
}

/**
 * Comments Template Modifications
 */
function techpolse_comment_form_defaults($defaults) {
    $defaults['comment_notes_before'] = '';
    $defaults['title_reply'] = __('Leave a Comment', 'techpolse');
    $defaults['class_submit'] = 'btn btn-primary';
    return $defaults;
}
add_filter('comment_form_defaults', 'techpolse_comment_form_defaults');

/**
 * Body Classes
 */
function techpolse_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'singular';
    }
    
    if (is_front_page() && !is_home()) {
        $classes[] = 'front-page';
    }
    
    return $classes;
}
add_filter('body_class', 'techpolse_body_classes');

/**
 * Customizer Settings
 */
function techpolse_customize_register($wp_customize) {
    // Theme Options Section
    $wp_customize->add_section('techpolse_options', array(
        'title'    => __('TechPolse Options', 'techpolse'),
        'priority' => 30,
    ));
    
    // Newsletter Section Title
    $wp_customize->add_setting('newsletter_title', array(
        'default'           => 'Subscribe to Newsletter',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('newsletter_title', array(
        'label'   => __('Newsletter Title', 'techpolse'),
        'section' => 'techpolse_options',
        'type'    => 'text',
    ));
    
    // Newsletter Description
    $wp_customize->add_setting('newsletter_description', array(
        'default'           => 'Get the latest articles and tech tips delivered directly to your inbox',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('newsletter_description', array(
        'label'   => __('Newsletter Description', 'techpolse'),
        'section' => 'techpolse_options',
        'type'    => 'textarea',
    ));
    
    // Footer Description
    $wp_customize->add_setting('footer_description', array(
        'default'           => 'A tech blog specializing in SEO, site performance, web security, and AI workflows. Quality content for developers and website owners.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('footer_description', array(
        'label'   => __('Footer Description', 'techpolse'),
        'section' => 'techpolse_options',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'techpolse_customize_register');

/**
 * Remove WordPress Version from Head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Defer JavaScript Loading
 */
function techpolse_defer_scripts($tag, $handle, $src) {
    if (is_admin()) {
        return $tag;
    }
    
    if (strpos($handle, 'techpolse') !== false) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'techpolse_defer_scripts', 10, 3);
