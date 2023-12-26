<?php 
//register style.css
function enqueue_custom_styles() {
    wp_enqueue_style('custom-style-1', get_template_directory_uri() . '/assets/css/base.css', array(), '1.0.0', 'all');
    wp_enqueue_style('custom-style-2', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');
//register script.js
function enqueue_custom_scripts() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/your-script.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

