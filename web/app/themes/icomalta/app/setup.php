<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    add_theme_support('custom-logo');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];
    register_sidebar([
            'name' => __('Primary', 'sage'),
            'id' => 'sidebar-primary',
        ] + $config);
    register_sidebar([
            'before_widget' => '<section class="widget col-lg %1$s %2$s">',
            'name' => __('Footer', 'sage'),
            'id' => 'sidebar-footer',
        ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();

        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

/**
 * Custom image sizes.
 * switch_theme is used for performance reasons.
 *
 * @link https://10up.com/blog/2012/enforcing-wordpress-image-sizes-within-your-theme/
 */
add_action('switch_theme', function () {
    update_option('thumbnail_size_w', 180);
    update_option('thumbnail_size_h', 180);
    update_option('thumbnail_crop', 1);
    update_option('medium_size_w', 724);
    update_option('medium_size_h', 724);
    update_option('large_size_w', 1140);
    update_option('large_size_h', 1140);

    add_image_size('extra_large', 1600, 1600);
});

add_action('after_setup_theme', function () {
    // Set default values for the upload media box
    update_option('image_default_align', 'center');
    update_option('image_default_size', 'medium');
});

add_action( 'wpcf7_before_send_mail', function( $cf7 )
{
    $email = $cf7->posted_data["your-email"];
    $first_name  = $cf7->posted_data["your-firstname"];
    $last_name  = $cf7->posted_data["your-lastname"];
    // $phone = $cf7->posted_data["your-phone"];
    // $best_time = $cf7->posted_data["best-time-to-call"];

    $post_items[] = 'oid=00D0Y000001jFly';
    $post_items[] = 'first_name=' . $first_name;
    $post_items[] = 'last_name=' . $last_name;
    $post_items[] = 'email=' . $email;
    // $post_items[] = 'phone=' . $phone;
    // $post_items[] = '00NU00000031VX4=' . $best_time;

    if(!empty($first_name) && !empty($last_name) && !empty($email) )
    {
        $post_string = implode ('&', $post_items);
        // Create a new cURL resource
        $ch = curl_init();

        if (curl_error($ch) != "")
        {
            // error handling
        }

        $con_url = 'https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
        curl_setopt($ch, CURLOPT_URL, $con_url);
        // Set the method to POST
        curl_setopt($ch, CURLOPT_POST, 1);
        // Pass POST data
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_string);
        curl_exec($ch); // Post to Salesforce
        curl_close($ch); // close cURL resource
    }
} );

add_action('init', function() {
    $email = "im@robinnilsson.me";
    $first_name  = "Robin";
    $last_name  = "Nilsson";
    // $phone = $cf7->posted_data["your-phone"];
    // $best_time = $cf7->posted_data["best-time-to-call"];

    $post_items[] = 'oid=00D0Y000001jFly';
    $post_items[] = 'first_name=' . $first_name;
    $post_items[] = 'last_name=' . $last_name;
    $post_items[] = 'email=' . $email;
    // $post_items[] = 'phone=' . $phone;
    // $post_items[] = '00NU00000031VX4=' . $best_time;

    if(!empty($first_name) && !empty($last_name) && !empty($email) )
    {
        $post_string = implode ('&', $post_items);
        // Create a new cURL resource
        $ch = curl_init();

        if (curl_error($ch) != "")
        {
            // error handling
        }

        $con_url = 'https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
        curl_setopt($ch, CURLOPT_URL, $con_url);
        // Set the method to POST
        curl_setopt($ch, CURLOPT_POST, 1);
        // Pass POST data
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_string);
        curl_exec($ch); // Post to Salesforce
        curl_close($ch); // close cURL resource
    }
});
