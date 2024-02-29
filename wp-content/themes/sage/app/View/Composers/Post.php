<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content',
        'partials.content-*',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'title' => get_the_title(),
        ];
    }
}
