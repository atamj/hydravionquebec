<?php

namespace App;



add_action('wp_enqueue_scripts', function (): void {
//    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');


}, 100);

add_action('after_setup_theme', function (): void {
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls'
    ]);

    remove_theme_support('block-templates');

    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'mobile_navigation' => __('Mobile Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage'),
    ]);

    remove_theme_support('core-block-patterns');

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support('responsive-embeds');

    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style'
    ]);

    add_theme_support('customize-selective-refresh-widgets');

    set_image_sizes();
}, 20);

add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ];

    register_sidebar([
            'name' => __('Primary', 'sage'),
            'id' => 'sidebar-primary'
        ] + $config);

    register_sidebar([
            'name' => __('Footer', 'sage'),
            'id' => 'sidebar-footer'
        ] + $config);
});

add_action('init', function () {
//    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
//    remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

    reset_image_sizes();
});


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('magnetic', RESOURCE_URL . '/scripts/magnetic.js', array('jquery'), time(), true);
    wp_enqueue_script('alpine', RESOURCE_URL . '/scripts/lib/alpine.min.js', array(), time(), true);
    wp_enqueue_script('gsap', RESOURCE_URL . '/scripts/lib/gsap.min.js', array(), time(), true);
    wp_enqueue_script('scripts', RESOURCE_URL . '/scripts/scripts.js', array('jquery', 'underscore', 'swiper'), time(), true);
    wp_enqueue_script('isotope', RESOURCE_URL . '/scripts/lib/isotope.pkgd.min.js', array(), time(), true);
    wp_enqueue_script('isotope-packery', RESOURCE_URL . '/scripts/lib/isotope-packery.js', array('isotope'), time(), true);
    wp_enqueue_script('masonry-grid', RESOURCE_URL . '/scripts/masonry.js', array('isotope-packery'), time(), true);
    wp_enqueue_script('swiper', RESOURCE_URL . '/scripts/lib/swiper-bundle.js', array(), null, true);
    wp_enqueue_script('masonry-grid-init', RESOURCE_URL . '/scripts/masonry-grid.js', array(), null, true);
    wp_enqueue_style('swiper', RESOURCE_URL . '/styles/lib/swiper-bundle.css', array(), null);
});

add_action('init', function () {
    global $wp_rewrite;
    $region_terms = get_terms(array(
        'taxonomy' => 'package_region',
        'hide_empty' => false,
    ));

    if ($region_terms && !is_wp_error($region_terms)) {
        foreach ($region_terms as $term) {
            $slug = $term->slug;
            add_rewrite_rule("^$slug/([^/]+)/([^/]+)/?$", 'index.php?package_type=$matches[1]&package_group=$matches[2]&package_region_term=' . $slug, 'top');
            add_rewrite_rule("^$slug/([^/]+)/?$", 'index.php?package_type=$matches[1]&package_region_term=' . $slug, 'top');
            add_rewrite_rule("^$slug/?$", 'index.php?package_region=' . $slug, 'top');
        }
    }
}, 11);



//// Hook my above function to the pre_get_posts action
//add_action( 'pre_get_posts', function ( $query ) {
//
//    if ($query->is_main_query() ) { // Run only on the homepage
//        dd( $query);
//        $query->query_vars['cat'] = -2; // Exclude my featured category because I display that elsewhere
//        $query->query_vars['posts_per_page'] = 5; // Show only 5 posts on the homepage only
//    }
//});
//
