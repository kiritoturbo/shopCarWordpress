<?php 
//lọc theo giá
// Trong file functions.php hoặc một file plugin tương ứng
add_action('wp_ajax_filter_products_by_price', 'filter_products_by_price_callback');
add_action('wp_ajax_nopriv_filter_products_by_price', 'filter_products_by_price_callback');

function filter_products_by_price_callback() {
    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];

    // Tạo truy vấn WP_Query để lấy sản phẩm theo giá
    $args = array(
        'post_type' => 'product',
        'meta_query' => array(
            array(
                'key' => '_price',
                'value' => array($min_price, $max_price),
                'type' => 'NUMERIC',
                'compare' => 'BETWEEN',
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
        echo "Không có sản phẩm nào trong khoảng giá này.";
    endif;

    wp_die();
}

