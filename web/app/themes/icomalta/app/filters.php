<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "…" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip;';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index',
    '404',
    'archive',
    'author',
    'category',
    'tag',
    'taxonomy',
    'date',
    'home',
    'frontpage',
    'page',
    'paged',
    'search',
    'single',
    'singular',
    'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__ . '\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory() . '/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );
    return template_path(locate_template(["views/{$comments_template}", $comments_template]) ?: $comments_template);
}, 100);

// 404 archive pages
add_filter('template_redirect', function () {
    global $wp_query;

    if (is_attachment()) {
        status_header(404); # Sets 404 header
        $wp_query->set_404(); # Shows 404 template
    }
});

// Give pages excerpts
add_action('init', function () {
    add_post_type_support('page', 'excerpt');
});

# Nicer Flexible Content Titles (https://www.advancedcustomfields.com/resources/acf-fields-flexible_content-layout_title/)
add_filter('acf/fields/flexible_content/layout_title', function ($title, $field, $layout, $i) {
    # Figure out the field name
    $nameBits = explode('_', $layout['name']);
    $fieldName = end($nameBits);
    $fieldName = str_replace('-', '_', $fieldName);
    $newTitle = '<strong>' . $title . '</strong>';

    # See if it has a "title" field
    if ($t = get_sub_field($fieldName . '_title')) {
        $newTitle .= ": \"$t\"";
    }

    # Or template
    if ($t = get_sub_field($layout['key'] . '_template')) {
        $newTitle .= ' <small>(' . ucfirst(str_replace(['-', '_'], ' ', basename($t, '.php'))) . ' layout)</small>';
    }

    return $newTitle;
}, 10, 4);

add_filter('sage/display_sidebar', function ($display) {
    static $display;

    isset($display) || $display = in_array(true, [
        // The sidebar will be displayed if any of the following return true
        is_page_template('views/template-page-sidebar.blade.php')
    ]);

    return $display;
});

add_filter('get_search_form', function () {
    $form = '';
    echo template('partials.site-search-form');
    return $form;
});

// Exclude pages from WordPress Search
if (!is_admin()) {
    add_filter('pre_get_posts', function ($query) {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }

        return $query;
    });
}

add_filter('excerpt_length', function () {
    return 15;
});

/**
 * Comment template
 */
function format_comment($comment, $args, $depth)
{

$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class('offset'); ?> id="comment-<?php comment_ID() ?>">

    <div class="d-flex">

        <div class="comment-avatar">
            <?= get_avatar(get_comment_author_email(), 80) ?>
        </div>

        <div class="comment-intro flex-fill">
            <div class="comment-author">
                <h4 class="comment-title mb-0 d-flex">
                    <?= get_comment_author_link() ?>

                    <span class="reply tracking ml-auto text-uppercase">
                        <?php comment_reply_link(array_merge($args,
                            ['depth' => $depth, 'max_depth' => $args['max_depth']])) ?>
                    </span>
                </h4>
                <time class="updated" datetime="<?= get_post_time('c', true) ?>"><?= get_comment_date(); ?>, <?= get_comment_time() ?></time>
            </div>

            <div class="comment-content">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em>
                        <php _e(
                        'Your comment is awaiting moderation.') ?></em><br/>
                <?php endif; ?>

                <?php comment_text(); ?>
            </div>
        </div>
    </div>

    <?php }

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
}