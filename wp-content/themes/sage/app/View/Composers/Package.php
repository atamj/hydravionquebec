<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class Package extends Composer
{
    /**
     * List of views served by this composer.
     */
    protected static $views = [
        'components.package',
    ];


    /**
     * Returns the data for the view.
     *
     * @return array
     */
    public function with()
    {
        return [
            'featured_image' => $this->get_featured_image(),
            'title' => $this->get_title(),
            'description' => $this->get_description(),
            'duration' => $this->get_duration(),
            'length' => $this->get_length(),
            'price' => $this->get_price(),
            'price_base' => $this->get_price_base(),
            'address' => $this->get_address(),
            'content' => is_archive() ? false : get_the_content(),
            'video' => $this->get_video(),
            'slides' => is_single() ? [] : $this->get_slides(),
            'leaflet_map' => $this->leaflet_map()
        ];
    }


    public function leaflet_map()
    {
        $leafletMap = false;
        if (!empty($_POST)) {
            if ($_POST['item']['leaflet']) {
                $leafetDecoded = str_replace("\\", "", $_POST['item']['leaflet']);
                $leafetDecoded = json_decode($leafetDecoded);
                if ($leafetDecoded) {
                    if (!empty($leafetDecoded->layers) || $leafetDecoded->geojson != '') {
                        $leafletMap = json_encode($_POST['item']['leaflet']);
                    }
                }
            }
        } else {
            $leafletMapField = get_field('leaflet_map');
            $leafetDecoded = str_replace("\\", "", $leafletMapField);
            $leafetDecoded = json_decode($leafetDecoded);
            if ($leafetDecoded) {
                if (!empty($leafetDecoded->layers) || $leafetDecoded->geojson != '') {
                    $leafletMap = $leafletMapField;
                }
            }
        }

        return $leafletMap;
    }

    public function get_video()
    {
        $obj = is_archive() ? get_queried_object() : null;

        if (!empty(get_field('featured_video', $obj))) {
            return get_field('featured_video', $obj);
        }
        return false;
    }

    public function get_duration()
    {
        $obj = is_archive() ? get_queried_object() : null;

        return get_field('duree', $obj);
    }

    public function get_length()
    {
        $obj = is_archive() ? get_queried_object() : null;

        return get_field('temps_de_vol', $obj);
    }

    public function get_address()
    {
        $obj = is_archive() ? get_queried_object() : null;

        return get_field('address', $obj);
    }

    public function get_price()
    {
        $obj = is_archive() ? get_queried_object() : null;

        return get_field('prix', $obj);
    }

    public function get_price_base()
    {
        $obj = is_archive() ? get_queried_object() : null;

        return get_field('prix_base', $obj);
    }

    public function get_title()
    {
        $obj = is_archive() ? get_queried_object() : null;

        return $obj ? $obj->name : get_the_title();
    }

    public function get_description()
    {
        $obj = is_archive() ? get_queried_object() : null;

        $description = get_field('featured_text', $obj);

        if ($description) {
            return $description;
        }

        return $obj ? $obj->description : get_the_excerpt();
    }

    public function get_featured_image()
    {
        $obj = is_archive() ? get_queried_object() : null;

        $image = get_field('featured_image', $obj);

        if (!$image) {
            if (is_single()) {
                $image = get_the_post_thumbnail_url();
            }


            if (!$image) {
                $image = get_default_image_placeholder();
            }
        }

        return $image;
    }

    public function get_slides()
    {
        global $wp_query;
        $slides = [];

        $obj = get_queried_object();


        switch ($obj->taxonomy) {
            case 'package_region':
                if ($obj->term_id != 21) {
                    $taxonomies = get_terms([
                        'taxonomy' => 'package_type',
                        'hide_empty' => false,
                        'parent' => 0
                    ]);

                    foreach ($taxonomies as $key => $term) {
                        $slides[$key]['title'] = $term->name;
                        $slides[$key]['permalink'] = $term->slug;

                        $featured_image = get_field('featured_image', $term);

                        if (!$featured_image || $featured_image == '') {
                            $slides[$key]['featured_image'] = get_default_image_placeholder();
                        } else {
                            $slides[$key]['featured_image'] = $featured_image;
                        }
                    }
                }
                break;
            case 'package_type':
                if ($obj->term_id != 35) {
                    if ($obj->term_id == 24) {

                        $wp_query = new WP_Query([
                            'post_type' => 'package',
                            'posts_per_page' => -1,
                            'tax_query' => [
                                [
                                    'taxonomy' => 'package_type',
                                    'field' => 'term_id',
                                    'terms' => $obj->term_id
                                ],
                                [
                                    'taxonomy' => 'package_region',
                                    'field' => 'term_id',
                                    'terms' => get_term_by('slug', get_query_var('package_region_term'), 'package_region')->term_id
                                ]
                            ]
                        ]);


                        foreach ($wp_query->get_posts() as $post) {
                            $slides[] = [
                                'title' => $post->post_title,
                                'content' => $post->post_content,
                                'featured_image' => get_the_post_thumbnail_url($post->ID),
                                'permalink' => get_permalink($post->ID),
                            ];
                        }
                    } else {
                        $taxonomies = get_terms([
                            'taxonomy' => 'package_group',
                            'hide_empty' => false,
                            'parent' => 0
                        ]);

                        foreach ($taxonomies as $key => $term) {
                            $slides[$key]['title'] = $term->name;
                            $slides[$key]['permalink'] = $term->slug;

                            $featured_image = get_field('featured_image', $term);

                            if (!$featured_image || $featured_image == '') {
                                $slides[$key]['featured_image'] = get_default_image_placeholder();
                            } else {
                                $slides[$key]['featured_image'] = $featured_image;
                            }
                        }
                    }
                }

                break;
            case 'package_group':
                foreach ($wp_query->get_posts() as $post) {
                    $slides[] = [
                        'title' => $post->post_title,
                        'content' => $post->post_content,
                        'featured_image' => get_the_post_thumbnail_url($post->ID),
                        'permalink' => get_permalink($post->ID),
                    ];
                }
                break;
        }
        return $slides;
    }
}
