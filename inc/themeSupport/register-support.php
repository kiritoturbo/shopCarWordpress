<?php
// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

add_theme_support('woocommerce');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');
add_theme_support('wc-product-gallery-zoom');
add_theme_support( 'title-tag' );

add_theme_support( 'post-thumbnails' );

add_theme_support(
    'html5',
    array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    )
);

// Set up the WordPress core custom background feature.
add_theme_support(
    'custom-background',
    apply_filters(
        'fimetech_custom_background_args',
        array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )
    )
);

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );

/**
 * Add support for core custom logo.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 */
add_theme_support(
    'custom-logo',
    array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    )
);