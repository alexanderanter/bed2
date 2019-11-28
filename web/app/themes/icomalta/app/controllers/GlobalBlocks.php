<?php

namespace App;

use Sober\Controller\Controller;

class GlobalBlocks extends Controller
{
    public static function get()
    {
        $global_blocks = get_field('global_blocks_relationship', false, false);

        if (!$global_blocks) {
            return false;
        }

        $args = [
            'post_type' => 'ga_global_blocks',
            'posts_per_page' => 3,
            'post__in' => $global_blocks,
            'orderby' => 'post__in',
        ];

        return new \WP_Query($args);
    }
}
