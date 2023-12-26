<?php
//search post & product
function custom_search_template($template) {
    if (is_search()) {
        global $wp_query;
        $post_type = get_query_var('post_type');
        
        if ($post_type === 'product') {
            return locate_template('search-product.php');
        } elseif ($post_type === 'post') {
            return locate_template('search-post.php');
        }
    }

    return $template;
}
add_filter('template_include', 'custom_search_template');
