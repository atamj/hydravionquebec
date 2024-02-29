<?php


/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function (): string {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Load scripts asset as module
 *
 * @return string
 */
add_filter('script_loader_tag', function ($tag, $handle, $src): string {
    $namespace = strtolower(wp_get_theme()->get('Name'));

    if ($namespace !== $handle) {
        return $tag;
    }

    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';

    return $tag;
}, 10, 3);


add_filter('upload_mimes', function ($mimes) {
    $mimes['kml'] = 'text/xml';
    $mimes['kmz'] = 'application/zip';
    return $mimes;
});


add_filter('query_vars', function ($vars) {
    $vars[] = 'package_region_term';
    $vars[] = 'package_type_term';
    $vars[] = 'package_group_term';
    return $vars;
});

add_filter('term_link', function ($link, $term, $taxonomy) {
    $custom_taxonomies = array('package_region', 'package_type', 'package_group');
    if (in_array($taxonomy, $custom_taxonomies)) {
        return home_url('/') . $term->slug;
    }
    return $link;
}, 10, 3);


add_filter('gform_field_value_package_group', function ($value) {


    if (is_single() && get_post_type() == 'package') {
        return get_the_terms(get_the_ID(), 'package_group')[0]->term_id;
    }

    $term_slug = get_query_var('package_group') ? sanitize_text_field(get_query_var('package_group')) : '';


    if (!empty($term_slug)) {
        $term = get_term_by('slug', $term_slug, 'package_group');
        if ($term && !is_wp_error($term)) {
            return $term->term_id;
        }
    }
    return $value;
});


add_filter('gform_field_value_package_region', function ($value) {

    if (is_single() && get_post_type() == 'package') {
        return get_the_terms(get_the_ID(), 'package_region')[0]->term_id;
    }


    $term_slug = get_query_var('package_region_term') ? sanitize_text_field(get_query_var('package_region_term')) : '';
//


    if (!empty($term_slug)) {
        $term = get_term_by('slug', $term_slug, 'package_region');
        if ($term && !is_wp_error($term)) {
            return $term->term_id;
        }
    }
    return $value;
});


add_filter('gform_field_value_package_type', function ($value) {

    if (is_single() && get_post_type() == 'package') {
        return get_the_terms(get_the_ID(), 'package_type')[0]->term_id;
    }


    $term_slug = get_query_var('package_type') ? sanitize_text_field(get_query_var('package_type')) : '';


    if (!empty($term_slug)) {


        $term = get_term_by('slug', $term_slug, 'package_type');


        if ($term && !is_wp_error($term)) {
            return $term->term_id;
        }
    }
    return $value;
});

add_filter('gform_field_value_package', function ($value) {
    if (is_single() && get_post_type() == 'package') {
        return get_the_ID();
    }
});


add_filter('mce_external_plugins', function ($plugins) {
    $plugins['table'] = get_template_directory_uri() . '/resources/scripts/lib/tinymce-table-plugin.min.js';
    return $plugins;
});

add_filter('mce_buttons', function ($buttons) {
    array_push($buttons, 'table');
    return $buttons;
});



