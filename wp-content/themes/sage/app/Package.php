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
            'saison' => [
                'label' => __('Saison'),
                'slug' => 'saison',
            ],
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
        $package_saison = get_query_var('saison');
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

        if ($package_saison) {
            $selected_saison = array_filter($this->taxonomies_terms['saison']['terms'], function ($item) use ($package_saison) {
                return $item['permalink'] === $package_saison;
            });
            $values['saison'] = array_values($selected_saison)[0]['id'];
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
        global $wp_query;

        /** Récupérer les ids des champs qui devraient être sélectionné sur la page */
        $selectedSaisonId = $this->get_default_selected()['saison'] ?? null;
        $selectedRegionId = $this->get_default_selected()['package_region'] ?? null;
        $selectedTypeId = $this->get_default_selected()['package_type'] ?? null;
        $selectedGroupId = $this->get_default_selected()['package_group'] ?? null;
        foreach ($form['fields'] as &$field) {
            /** On récupère tous les choix (options) pour les taxonomies ou les destinations */
            if (array_key_exists($field->inputName, $this->taxonomies)) {
                $field->choices = $this->get_taxonomy_choices($field->inputName);
            } elseif ($field->inputName === 'destination') {
                $field->choices = $this->get_posts_choices();
            }

            switch ($field->inputName) {
                case 'saison':
                    foreach ($field->choices as &$choice) {
                        $choice['isSelected'] = $choice['value'] == $selectedSaisonId;
                    }
                    break;
                case 'package_region':
                    foreach ($field->choices as $key => &$choice) {
                        /** On filtre les destinations en fonction des filtres choisis pour afficher que les choix valides */
                        $destination = array_filter($this->posts, function ($item) use ($choice, $selectedSaisonId) {
                            return in_array($choice['value'], $item['taxonomies']['package_region']) && in_array($selectedSaisonId, $item['taxonomies']['saison']);
                        });
                        /**
                         * Si on ne trouve rien dans les destinations, c'est que ce choix n'est pas valide donc on le supprime.
                         * Si on a un choix de région sélectionné, on le met en isSelected
                         */
                        if (empty($destination)) {
                            unset($field->choices[$key]);
                        } elseif ($selectedRegionId) {
                            $choice['isSelected'] = $selectedRegionId == $choice['value'];
                        } elseif (isset($wp_query->query_vars['package_region'])) {
                            $term = get_term_by('slug', $wp_query->query_vars['package_region'], 'package_region');
                            if ($term->term_id == $choice['value']) {
                                $choice['isSelected'] = true;
                            }
                        }
                    }
                    break;
                case 'package_type':
                    foreach ($field->choices as &$choice) {
                        $choice['isSelected'] = $selectedTypeId == $choice['value'];
                    }
                    break;

                case 'package_group':
                    foreach ($field->choices as $key => &$choice) {
//                        dump($selectedGroupId);
                        if (!$selectedGroupId) {
                            $packages = $this->getFilteredPackages(group_id: $choice['value']);
                        } else {
                            $packages = $this->getFilteredPackages();
                        }
//                        dump($packages->tax_query);
                        if (!$packages->have_posts()) {
                            unset($field->choices[$key]);
                        } elseif ($selectedGroupId) {
                            $choice['isSelected'] = $selectedGroupId == $choice['value'];
                        } elseif (isset($wp_query->query_vars['package_group'])) {
                            $term = get_term_by('slug', $wp_query->query_vars['package_group'], 'package_group');
                            if ($term->term_id == $choice['value']) {
                                $choice['isSelected'] = true;
                            }
                        }
                    }
                    break;
                case 'destination':
                    foreach ($field->choices as $key => &$choice) {

                        $packages = $this->getFilteredPackages([$choice['value']]);
                        if (!$packages->have_posts()) {
                            unset($field->choices[$key]);
                        } else {
                            $choice['isSelected'] = is_single() && get_the_ID() == $choice['value'];
                        }
                    }
                    break;
            }
        }

        return $form;
    }

    public function getFilteredPackages(array|bool $post__in = false, $group_id = false)
    {
        /** Récupérer les ids des champs qui devraient être sélectionné sur la page */
        $selectedSaisonId = $this->get_default_selected()['saison'] ?? null;
        $selectedRegionId = $this->get_default_selected()['package_region'] ?? null;
        $selectedTypeId = $this->get_default_selected()['package_type'] ?? null;
        $selectedGroupId = $this->get_default_selected()['package_group'] ?? null;

        $tax_query = [];
        $tax_query['relation'] = 'AND';

//        if ($selectedSaisonId) {
            $tax_query[] = [
                'taxonomy' => 'saison',
                'field' => 'term_id',
                'terms' => $selectedSaisonId
            ];
//        }
//        if ($selectedSaisonId && $selectedRegionId) {
            $tax_query[] = [
                'taxonomy' => 'package_region',
                'field' => 'term_id',
                'terms' => $selectedRegionId
            ];
//        }
//        if ($selectedSaisonId && $selectedRegionId && $selectedTypeId) {
            $tax_query[] = [
                'taxonomy' => 'package_type',
                'field' => 'term_id',
                'terms' => $selectedTypeId
            ];
//        }
        if ($group_id) {
            $tax_query[] = [
                'taxonomy' => 'package_group',
                'field' => 'term_id',
                'terms' => $group_id
            ];
        }
        /*if ($group_id) {
            $tax_query[] = [
                'taxonomy' => 'package_group',
                'field' => 'term_id',
                'terms' => $group_id
            ];
        }*/

        $query_args = [
            'post_type' => 'package',
            'tax_query' => $tax_query,
            'posts_per_page' => -1,
        ];

        if ($post__in) {
            $query_args['post__in'] = $post__in;
        }
        return new WP_Query($query_args);
    }


    public function render()
    {

        $view = view('components.package', $_POST["item"])->render();
        echo stripslashes($view);
        die();
    }
}

new Package();

