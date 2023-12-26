<?php 
// lọc theo sản phẩm
add_action('wp_ajax_filter_products_by_category', 'filter_products_by_category_callback');
add_action('wp_ajax_nopriv_filter_products_by_category', 'filter_products_by_category_callback');

function filter_products_by_category_callback() {
    $category = $_POST['category'];

    $args = array(
        'post_type' => 'product',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category,
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
           get_template_part('template-parts/item-product');
        endwhile;
        wp_reset_postdata();
    else :
        echo "Không có sản phẩm nào trong danh mục này.";
    endif;
    wp_die();
}

