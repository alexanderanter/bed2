<?php

namespace App;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public static function get_site_logo()
    {
        $alt = get_bloginfo('name');

        if (get_bloginfo('description')) {
            $alt .= ' - ' . get_bloginfo('description');
        }

        // Check custom logo
        $customLogoId = get_theme_mod('custom_logo');

        return '<img src="' . wp_get_attachment_image_src($customLogoId, 'full')[0] . '" alt="' . $alt . '">';
    }

    public static function pagination()
    {
        if (is_singular()) {
            return;
        }

        global $wp_query;

        /** Stop execution if there's only 1 page */
        if ($wp_query->max_num_pages <= 1) {
            return;
        }

        $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
        $max = intval($wp_query->max_num_pages);

        /** Add current page to the array */
        if ($paged >= 1) {
            $links[] = $paged;
        }

        /** Add the pages around the current page to the array */
        if ($paged >= 3) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if (($paged + 2) <= $max) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }

        echo '<div class="ico-pagination"><ul>' . "\n";

        /** Previous Post Link */
        if (get_previous_posts_link()) {
            printf('<li>%s</li>' . "\n", get_previous_posts_link(__('&laquo; Prev', 'icomalta')));
        }

        /** Link to first page, plus ellipses if necessary */
        if (!in_array(1, $links)) {
            $class = 1 == $paged ? ' class="active"' : '';

            printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

            if (!in_array(2, $links)) {
                echo '<li><a>…</a></li>';
            }
        }

        /** Link to current page, plus 2 pages in either direction if necessary */
        sort($links);
        foreach ((array)$links as $link) {
            $class = $paged == $link ? ' class="active"' : '';
            printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
        }

        /** Link to last page, plus ellipses if necessary */
        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links)) {
                echo '<li>…</li>' . "\n";
            }

            $class = $paged == $max ? ' class="active"' : '';
            printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
        }

        /** Next Post Link */
        if (get_next_posts_link()) {
            printf('<li>%s</li>' . "\n", get_next_posts_link(__('Next &raquo;', 'icomalta')));
        }

        echo '</ul></div>' . "\n";
    }

	public static function pageHeaderContent()
	{
		$post_id = null;

		if(is_home()) {
			$page_for_posts_id = get_option( 'page_for_posts' );
			$page_for_posts_obj = get_post( $page_for_posts_id );
			$post_id = $page_for_posts_obj->ID;
		}

		return get_field('page_header_content', $post_id) ?? get_the_excerpt();
	}
}
