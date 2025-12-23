<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span>Tech<span class="accent">Polse</span></span>
                <?php endif; ?>
            </a>

            <!-- Desktop Navigation -->
            <nav class="main-nav">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'walker'         => new TechPolse_Nav_Walker(),
                    ));
                } else {
                    // Default categories if no menu is set
                    $categories = get_categories(array(
                        'orderby' => 'name',
                        'order'   => 'ASC',
                        'number'  => 5,
                    ));
                    
                    foreach ($categories as $category) {
                        $active_class = (is_category($category->term_id)) ? 'active' : '';
                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="nav-link ' . $active_class . '">' . esc_html($category->name) . '</a>';
                    }
                }
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- Search Button -->
                <button type="button" class="btn-icon search-toggle" aria-label="<?php esc_attr_e('Search', 'techpolse'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                </button>

                <!-- Theme Toggle -->
                <button type="button" class="btn-icon theme-toggle" aria-label="<?php esc_attr_e('Toggle Theme', 'techpolse'); ?>">
                    <svg class="sun-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2"></path>
                        <path d="M12 20v2"></path>
                        <path d="m4.93 4.93 1.41 1.41"></path>
                        <path d="m17.66 17.66 1.41 1.41"></path>
                        <path d="M2 12h2"></path>
                        <path d="M20 12h2"></path>
                        <path d="m6.34 17.66-1.41 1.41"></path>
                        <path d="m19.07 4.93-1.41 1.41"></path>
                    </svg>
                    <svg class="moon-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                    </svg>
                </button>

                <!-- Mobile Menu Toggle -->
                <button type="button" class="btn-icon mobile-menu-toggle" aria-label="<?php esc_attr_e('Menu', 'techpolse'); ?>" aria-expanded="false">
                    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" x2="20" y1="12" y2="12"></line>
                        <line x1="4" x2="20" y1="6" y2="6"></line>
                        <line x1="4" x2="20" y1="18" y2="18"></line>
                    </svg>
                    <svg class="close-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <div class="container">
            <nav class="mobile-nav">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'walker'         => new TechPolse_Nav_Walker(),
                    ));
                } else {
                    $categories = get_categories(array(
                        'orderby' => 'name',
                        'order'   => 'ASC',
                        'number'  => 5,
                    ));
                    
                    foreach ($categories as $category) {
                        $active_class = (is_category($category->term_id)) ? 'active' : '';
                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="nav-link ' . $active_class . '">' . esc_html($category->name) . '</a>';
                    }
                }
                ?>
            </nav>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="search-modal" style="display: none;">
        <div class="container">
            <?php get_search_form(); ?>
        </div>
    </div>
</header>
