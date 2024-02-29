<?php
/*
 * Copyright (c) 2023 яαvoroηα
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy of
 *  this software and associated documentation files (the "Software"), to deal in
 *  the Software without restriction, including without limitation the rights to
 *  use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 *  the Software, and to permit persons to whom the Software is furnished to do so,
 *  subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 *  FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 *  COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 *  IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 *  CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

use function Roots\bootloader;

if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (!function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['constants','setup', 'filters', 'helpers', 'medias', 'Package', 'inc.vite'])
    ->each(function ($file) {
        if (!locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
            /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });


function get_current_language_code()
{
    if (defined('ICL_LANGUAGE_CODE')) {
        $current_language = ICL_LANGUAGE_CODE;
    } else {
        $current_language = 'fr';
    }

    return $current_language;
}




function get_featured_video($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $video = get_field('featured_video', $post_id);

    if ($video) {

        return get_template_part('template-parts/parts/featured-video', null, [
            'video_id' => $video
        ]);
    }
    return false;
}


function get_default_image_placeholder()
{
    return wp_get_attachment_url(get_option('theme_utilities_img_placeholder')) ?? get_stylesheet_directory_uri() . '/assets/img/placeholder.jpg';
}


function get_featured_image()
{
    $obj = is_archive() ? get_queried_object() : null;

    $image = get_field('featured_image', $obj);

    if (!$image) {

        if (is_single() || is_page() || is_home()) {
            $image = get_the_post_thumbnail_url(get_queried_object_id());
        }


        if (!$image) {
            $image = get_default_image_placeholder();
        }
    }

    return $image;
}

add_filter('gform_entries_field_value', function ($value, $form_id, $field_id, $entry) {
    return showFieldChoiceLabel($value, $form_id, $field_id, $entry);
}, 10, 4);

add_filter( 'gform_entry_field_value', function ( $value, $field, $entry, $form ){
    return showFieldChoiceLabel($value, $form['id'], $field->id, $entry);
}, 10, 4 );


function showFieldChoiceLabel($value, $form_id, $field_id, $entry)
{
    $field = GFAPI::get_field($form_id, $field_id);
    $value_fields = array(
        'checkbox',
        'radio',
        'select'
    );

    if (is_numeric($field_id) && in_array($field->get_input_type(), $value_fields)) {
        $value = $field->get_value_entry_detail(RGFormsModel::get_lead_field_value($entry, $field), '', true, 'text');
    }

    return $value;
}


// Ajouter le code JavaScript à toutes les pages
function add_custom_css_js_to_all_pages() {
    // Vérifier que c'est une page où Gravity Forms est chargé
    if (class_exists('GFForms')) {
        // Enregistrer le script personnalisé
        wp_enqueue_script('do-custom-js', get_stylesheet_directory_uri() . '/resources/scripts/do-custom-js.js', array('jquery'), null, true);
    }
    wp_enqueue_style( 'dixonze', get_stylesheet_directory_uri() . '/resources/styles/dixonze.css', array('main'), time(), 'all' );
}
add_action('wp_enqueue_scripts', 'add_custom_css_js_to_all_pages');
