<?php

namespace app;

use WP_Query;

use function Roots\view;

class Package
{
    const POST_TYPE = 'package';
    private array $posts = [];
    private array $taxonomies;
    private array $taxonomies_terms = [];
    private array $defaultSettings;

    public function __construct()
    {

        $this->taxonomies = [
            'package_region' => [
                'label' => __('Région'),
                'slug' => 'region',
            ],
            'package_type' => [
                'label' => __('Aventure'),
                'slug' => 'aventure',
            ],
            'package_group' => [
                'label' => __('Type'),
                'slug' => 'type',
            ],
        ];

        add_action('init', [$this, 'init'], 999);

        $this->add_actions();
        $this->add_filters();
        $this->add_shortcodes();
        $this->add_ajax_actions();
    }

    private function add_actions(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    private function add_ajax_actions(): void
    {
        add_action('wp_ajax_get_package', [$this, 'render']);
        add_action('wp_ajax_nopriv_get_package', [$this, 'render']);
    }

    private function add_filters(): void
    {
        add_filter('gform_pre_render', [$this, 'populate_choices']);
        add_filter('gform_pre_validation', [$this, 'populate_choices']);
        add_filter('gform_pre_submission_filter', [$this, 'populate_choices']);
        add_filter('gform_admin_pre_render', [$this, 'populate_choices']);
    }

    private function add_shortcodes(): void
    {

    }

    public function init(): void
    {
        $this->defaultSettings = $this->setDefaultSettings();
        $this->posts = $this->set_posts();
        $this->taxonomies_terms = $this->set_taxonomies_terms();
    }

    public function setDefaultSettings(): array
    {
        $img_placeholder = get_option('theme_utilities_img_placeholder');
        $img_placeholder = $img_placeholder ? wp_get_attachment_image_url($img_placeholder, 'large') : false;

        return [
            'default_video' => get_option('theme_utilities_package_video_placeholder'),
            'default_image' => $img_placeholder,
        ];
    }

    public function getPosts(): array
    {
        return $this->posts;
    }

    public function getTaxonomiesTerms(): array
    {
        return $this->taxonomies_terms;
    }

    public function enqueue_scripts(): void
    {
        wp_enqueue_script('package-front-script', get_template_directory_uri() . '/resources/scripts/package-front.js', ['jquery'], time(), true);


        wp_localize_script('package-front-script', 'postData', [
            'packages' => json_encode($this->posts),
            'taxonomies' => json_encode($this->taxonomies_terms),
            'defaultSettings' => json_encode($this->defaultSettings),
            'admin_url' => admin_url('admin-ajax.php'),
            'isFront' => is_front_page(),
            'home_url' => home_url(),
            'selected' => $this->get_default_selected()
        ]);
    }

    public function set_posts(): array
    {
        $args = [
            'post_type' => self::POST_TYPE,
            'post_status' => 'publish',
            'suppress_filters' => false,
            'posts_per_page' => -1,
        ];

        $posts_query = new WP_Query($args);
        $posts = [];

        if ($posts_query->have_posts()) {
            while ($posts_query->have_posts()) {
                $posts_query->the_post();
                $post_id = get_the_ID();


                $image = get_field('featured_image');

                if (!$image) {
                    $image = get_the_post_thumbnail_url($post_id, 'large');

                    if (!$image) {
                        $image = $this->defaultSettings['default_image'];
                    }
                }

                $posts[$post_id] = [
                    'title' => get_the_title(),
                    'content' => get_the_content() ?: '',
                    'description' => get_the_excerpt() ?: '',
                    'permalink' => get_the_permalink(),
                    'featured_image' => $image,
                    'video' => !empty(get_field('featured_video')) ? get_field('featured_video') : '',
                    'id' => $post_id,
                    'price' => get_field('prix', $post_id) ?: '',
                    'price_base' => get_field('prix_base', $post_id) ?: '',
                    'address' => get_field('address', $post_id) ?: '',
                    'isSelected' => false,
                    'leaflet' => get_field('leaflet_map') ?: '',
                    'taxonomies' => $this->get_post_taxonomies_terms($post_id),
                    'duration' => get_field('duree', $post_id) ?: '',
                    'length' => get_field('temps_de_vol', $post_id) ?: '',
                    'slides' => []
                ];
            }

            wp_reset_postdata();
        }
        return $posts;
    }

    public function set_taxonomies_terms(): array
    {
        $taxonomies = get_object_taxonomies(self::POST_TYPE);

        $taxonomiesTerms = [];

        foreach ($taxonomies as $taxonomy) {
            $taxonomy_object = get_taxonomy($taxonomy);

            $taxonomiesTerms[$taxonomy] = [
                'name' => $taxonomy_object->labels->name,
                'terms' => [],
            ];

            foreach (get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
                'parent' => 0
            ]) as $term) {
                $image = get_field('featured_image', $term);
                if (!$image || $image == '') {


                    $image = $this->defaultSettings['default_image'];
                }

                $taxonomiesTerms[$taxonomy]['terms'][$term->term_id] = [
                    'id' => $term->term_id,
                    'title' => $term->name,
                    'permalink' => $term->slug,
                    'description' => $term->description ?: '',
                    'content' => '',
                    'featured_image' => $image,
                    'video' => get_field('featured_video', $term) ?? '',
                    'duration' => get_field('duree', $term) ?: '',
                    'length' => get_field('temps_de_vol', $term) ?: '',
                    'price' => get_field('prix', $term) ?: '',
                    'price_base' => get_field('prix_base', $term) ?: '',
                    'address' => get_field('address', $term) ?: '',
                    'slides' => []
                ];
            }
        }

        return $taxonomiesTerms;
    }

    public function get_post_taxonomies_terms($post_id): array
    {
        $taxonomies_terms = [];

        foreach ($this->taxonomies as $key => $taxonomy) {
            $taxonomies_terms[$key] = wp_get_post_terms($post_id, $key, ['fields' => 'ids']);
        }

        return $taxonomies_terms;
    }

    public function get_posts_choices(): array
    {
        $choices = [];

        foreach ($this->posts as $post) {
            $choices[] = ['text' => $post['title'], 'value' => $post['id'], 'price' => $post['price'], 'isSelected' => false];
        }

        return $choices;
    }

    private function get_taxonomy_choices($taxonomy): array
    {
        $terms = $this->taxonomies_terms[$taxonomy]['terms'];

        $choices = [];
        foreach ($terms as $term) {
            $choices[] = ['text' => $term['title'], 'value' => $term['id'], 'isSelected' => false];
        }

        return $choices;
    }

    public function get_default_selected()
    {
        $queriedObject = get_queried_object();
        $package_region_term = get_query_var('package_region_term');
        $package_group = get_query_var('package_group');
        $package_type = get_query_var('package_type');
        $values = [];

        if (is_tax()) {
            $key = $queriedObject->taxonomy;
            $values[$key] = $queriedObject->term_id;
        } elseif (is_single() && 'package' == get_post_type()) {
            $values['destination'] = $queriedObject->ID . "|" . $this->posts[$queriedObject->ID]['price'];
            foreach ($this->posts[$queriedObject->ID]['taxonomies'] as $key => $taxonomy) {
                if (!empty($taxonomy)) {
                    $values[$key] = $taxonomy[0];
                }
            }
        }

        if ($package_region_term) {
            $selected_region = array_filter($this->taxonomies_terms['package_region']['terms'], function ($item) use ($package_region_term) {
                return $item['permalink'] === $package_region_term;
            });

            $values['package_region'] = array_values($selected_region)[0]['id'];
        }

        if ($package_group) {
            $selected_group = array_filter($this->taxonomies_terms['package_group']['terms'], function ($item) use ($package_group) {
                return $item['permalink'] === $package_group;
            });
            $values['package_group'] = array_values($selected_group)[0]['id'];
        }

        if ($package_type) {
            $selected_type = array_filter($this->taxonomies_terms['package_type']['terms'], function ($item) use ($package_type) {
                return $item['permalink'] === $package_type;
            });
            $values['package_type'] = array_values($selected_type)[0]['id'];
        }

        return $values;
    }

    public function populate_choices($form)
    {
        foreach ($form['fields'] as &$field) {
            if ($field->cssClass == 'package_region') {
                $field->choices = $this->get_taxonomy_choices('package_region');
            }
            if ($field->cssClass == 'package_type') {
                $field->choices = $this->get_taxonomy_choices('package_type');
            }
            if ($field->cssClass == 'package_group') {
                $field->choices = $this->get_taxonomy_choices('package_group');
            }
            if ($field->cssClass == 'packages') {
                $field->choices = $this->get_posts_choices();

            }
        }

        return $form;
    }


    public function render()
    {

        $view = view('components.package', $_POST["item"])->render();
        echo stripslashes($view);
        die();
    }
}

new Package();

