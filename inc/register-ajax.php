<?php
//ajax
function enqueue_my_scripts() {
    wp_enqueue_script('my-script', get_template_directory_uri() . '/js/your-script.js', array('jquery'), '1.0.0', true);
    wp_localize_script('my-script', 'my_ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');
function enqueue_ajax_script() {
    // Đăng ký script jQuery và truyền URL của endpoint AJAX vào script
    wp_enqueue_script('your-custom-ajax-script', get_template_directory_uri() . '/js/your-script.js', array('jquery'), '1.0', true);

    // Sử dụng hàm wp_localize_script để truyền URL
    wp_localize_script('your-custom-ajax-script', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_ajax_script');


// Hàm lấy sản phẩm dựa trên các tham số lọc
function get_filtered_products($limit = -1, $orderby = 'date') {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $limit,
        'orderby' => $orderby,
    );

    $products = new WP_Query($args);

    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();

            get_template_part('template-parts/item-product');
        }
        wp_reset_postdata();
    } else {
        echo 'Không có sản phẩm nào.';
    }

    die(); 
}
// Đăng ký hàm AJAX
add_action('wp_ajax_filter_products', 'get_filtered_products');
add_action('wp_ajax_nopriv_filter_products', 'get_filtered_products');


//add cart
add_action('wp_ajax_add_product_to_cart', 'add_product_to_cart');
add_action('wp_ajax_nopriv_add_product_to_cart', 'add_product_to_cart');

// function add_product_to_cart() {
//     $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

//     if ($product_id > 0) {
//         WC()->cart->add_to_cart($product_id);
//         die();
//     }
// }
function add_product_to_cart() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    if ($product_id > 0) {
        // Lấy số sản phẩm hiện tại trong giỏ hàng
        $cart_item_count = WC()->cart->get_cart_contents_count();

        // Thêm sản phẩm vào giỏ hàng
        WC()->cart->add_to_cart($product_id);

        // Lấy số sản phẩm sau khi thêm vào giỏ hàng
        $new_cart_item_count = WC()->cart->get_cart_contents_count();

        // Trả về số sản phẩm trong giỏ hàng sau khi thêm
        echo $new_cart_item_count;
        die();
    }
}
