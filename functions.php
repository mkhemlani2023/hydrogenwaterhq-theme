<?php
/**
 * HydrogenWaterHQ Theme Functions
 *
 * @package HydrogenWaterHQ
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function hydrogenwaterhq_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 630, true);

    // Add custom image sizes for affiliate content
    add_image_size('product-thumbnail', 400, 400, true);
    add_image_size('hero-image', 1920, 600, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'hydrogenwaterhq'),
        'footer'  => __('Footer Menu', 'hydrogenwaterhq'),
    ));

    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Responsive embeds
    add_theme_support('responsive-embeds');

    // Wide alignment support for Gutenberg
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'hydrogenwaterhq_setup');

/**
 * Enqueue scripts and styles
 */
function hydrogenwaterhq_scripts() {
    // Main stylesheet
    wp_enqueue_style(
        'hydrogenwaterhq-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );

    // Additional styles
    wp_enqueue_style(
        'hydrogenwaterhq-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array('hydrogenwaterhq-style'),
        wp_get_theme()->get('Version')
    );

    // Main JavaScript
    wp_enqueue_script(
        'hydrogenwaterhq-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'hydrogenwaterhq_scripts');

/**
 * Register widget areas
 */
function hydrogenwaterhq_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'hydrogenwaterhq'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'hydrogenwaterhq'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 1', 'hydrogenwaterhq'),
        'id'            => 'footer-1',
        'description'   => __('First footer widget area.', 'hydrogenwaterhq'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 2', 'hydrogenwaterhq'),
        'id'            => 'footer-2',
        'description'   => __('Second footer widget area.', 'hydrogenwaterhq'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 3', 'hydrogenwaterhq'),
        'id'            => 'footer-3',
        'description'   => __('Third footer widget area.', 'hydrogenwaterhq'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'hydrogenwaterhq_widgets_init');

/**
 * Custom excerpt length
 */
function hydrogenwaterhq_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'hydrogenwaterhq_excerpt_length');

/**
 * Custom excerpt more text
 */
function hydrogenwaterhq_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'hydrogenwaterhq_excerpt_more');

/**
 * Add affiliate disclosure to single posts
 */
function hydrogenwaterhq_affiliate_disclosure() {
    if (is_single()) {
        $disclosure = get_option('hydrogenwaterhq_affiliate_disclosure',
            'This post may contain affiliate links. If you make a purchase through these links, we may earn a commission at no additional cost to you.'
        );
        if ($disclosure) {
            echo '<div class="affiliate-disclosure-post"><em>' . esc_html($disclosure) . '</em></div>';
        }
    }
}
add_action('hydrogenwaterhq_after_entry_header', 'hydrogenwaterhq_affiliate_disclosure');

/**
 * Add Schema.org markup for articles
 */
function hydrogenwaterhq_schema_markup() {
    if (is_single()) {
        global $post;
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author()
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => get_site_icon_url()
                )
            )
        );

        if (has_post_thumbnail()) {
            $schema['image'] = get_the_post_thumbnail_url($post->ID, 'full');
        }

        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'hydrogenwaterhq_schema_markup');

/**
 * Optimize performance - remove unnecessary items from head
 */
function hydrogenwaterhq_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
}
add_action('init', 'hydrogenwaterhq_cleanup_head');

/**
 * Add loading="lazy" to images (for older WP versions)
 */
function hydrogenwaterhq_lazy_load_images($content) {
    if (is_admin()) {
        return $content;
    }
    return preg_replace('/<img(.*?)>/i', '<img$1 loading="lazy">', $content);
}
add_filter('the_content', 'hydrogenwaterhq_lazy_load_images');

/**
 * Shortcode: Product Box
 * Usage: [product_box title="Product Name" price="$99" rating="4.5" button_text="Check Price" button_url="#"]Content here[/product_box]
 */
function hydrogenwaterhq_product_box_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'title' => 'Product Name',
        'price' => '',
        'rating' => '',
        'button_text' => 'Check Price on Amazon',
        'button_url' => '#',
        'image' => '',
    ), $atts);

    $output = '<div class="product-box">';

    if ($atts['image']) {
        $output .= '<img src="' . esc_url($atts['image']) . '" alt="' . esc_attr($atts['title']) . '">';
    }

    $output .= '<h3>' . esc_html($atts['title']) . '</h3>';

    if ($atts['rating']) {
        $stars = str_repeat('&#9733;', floor($atts['rating']));
        $output .= '<div class="product-rating">' . $stars . ' ' . esc_html($atts['rating']) . '/5</div>';
    }

    if ($content) {
        $output .= '<div class="product-description">' . wp_kses_post($content) . '</div>';
    }

    if ($atts['price']) {
        $output .= '<div class="product-price">' . esc_html($atts['price']) . '</div>';
    }

    $output .= '<a href="' . esc_url($atts['button_url']) . '" class="affiliate-button" target="_blank" rel="nofollow noopener">' . esc_html($atts['button_text']) . '</a>';
    $output .= '</div>';

    return $output;
}
add_shortcode('product_box', 'hydrogenwaterhq_product_box_shortcode');

/**
 * Shortcode: Pros and Cons
 * Usage: [pros_cons pros="Pro 1|Pro 2|Pro 3" cons="Con 1|Con 2"]
 */
function hydrogenwaterhq_pros_cons_shortcode($atts) {
    $atts = shortcode_atts(array(
        'pros' => '',
        'cons' => '',
    ), $atts);

    $pros = array_filter(explode('|', $atts['pros']));
    $cons = array_filter(explode('|', $atts['cons']));

    $output = '<div class="pros-cons">';

    if (!empty($pros)) {
        $output .= '<div class="pros"><h4>&#10004; Pros</h4><ul>';
        foreach ($pros as $pro) {
            $output .= '<li>' . esc_html(trim($pro)) . '</li>';
        }
        $output .= '</ul></div>';
    }

    if (!empty($cons)) {
        $output .= '<div class="cons"><h4>&#10006; Cons</h4><ul>';
        foreach ($cons as $con) {
            $output .= '<li>' . esc_html(trim($con)) . '</li>';
        }
        $output .= '</ul></div>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('pros_cons', 'hydrogenwaterhq_pros_cons_shortcode');

/**
 * Shortcode: Info Box
 * Usage: [info_box type="info|warning|success"]Content[/info_box]
 */
function hydrogenwaterhq_info_box_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'type' => 'info',
    ), $atts);

    $class = 'info-box';
    if (in_array($atts['type'], array('warning', 'success'))) {
        $class .= ' ' . $atts['type'];
    }

    return '<div class="' . esc_attr($class) . '">' . wp_kses_post($content) . '</div>';
}
add_shortcode('info_box', 'hydrogenwaterhq_info_box_shortcode');

/**
 * Add nofollow to external links in content
 */
function hydrogenwaterhq_nofollow_external_links($content) {
    $home_url = home_url();

    return preg_replace_callback('/<a[^>]+href=["\']([^"\']+)["\'][^>]*>/i', function($matches) use ($home_url) {
        $link = $matches[0];
        $url = $matches[1];

        // Skip internal links
        if (strpos($url, $home_url) === 0 || strpos($url, '/') === 0 || strpos($url, '#') === 0) {
            return $link;
        }

        // Add nofollow if external
        if (strpos($link, 'rel=') === false) {
            $link = str_replace('<a ', '<a rel="nofollow noopener" ', $link);
        } elseif (strpos($link, 'nofollow') === false) {
            $link = preg_replace('/rel=["\']([^"\']*)["\']/', 'rel="$1 nofollow"', $link);
        }

        // Add target="_blank" if not present
        if (strpos($link, 'target=') === false) {
            $link = str_replace('<a ', '<a target="_blank" ', $link);
        }

        return $link;
    }, $content);
}
add_filter('the_content', 'hydrogenwaterhq_nofollow_external_links');

/**
 * Custom template tags
 */
require get_template_directory() . '/inc/template-tags.php';
