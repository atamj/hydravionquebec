<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class PackageSlider extends Composer
{
    /**
     * List of views served by this composer.
     */
    protected static $views = [
        'components.packages-slider',
    ];

    /**
     * Returns the data for the view.
     *
     * @return array
     */
    public function with()
    {
        return [
            'packages' => $this->getAllPackages(),
        ];
    }

    /**
     * Get all packages from the database.
     *
     * @return array
     */
    protected function getAllPackages()
    {
        $query = new WP_Query([
            'post_type' => 'package',
            'posts_per_page' => -1,
        ]);

        $packages = [];
        if ($query->have_posts()) {
            foreach ($query->get_posts() as $post) {
                $packages[] = [
                    'title' => stripslashes($post->post_title),
                    'featured_image' => get_the_post_thumbnail_url($post),
                    'permalink' => get_the_permalink($post),
                ];
            }
            wp_reset_postdata();
        }

        return $packages;
    }
}
