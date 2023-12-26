<?php 
// path-to-your-ajax-handler.php

add_action('wp_ajax_add_product_to_compare', 'add_product_to_compare');
add_action('wp_ajax_nopriv_add_product_to_compare', 'add_product_to_compare');
function add_product_to_compare() {
    if (isset($_POST['product_id']) && isset($_POST['product_name'])) {
        $product_id = intval($_POST['product_id']);
        $product_name = sanitize_text_field($_POST['product_name']);

        // Kiểm tra xem có tồn tại session compare_products không
        session_start();
        if (!isset($_SESSION['compare_products'])) {
            $_SESSION['compare_products'] = array();
        }

        // Kiểm tra xem sản phẩm đã có trong danh sách so sánh chưa
        if (isset($_SESSION['compare_products'][$product_id])) {
            // Nếu đã thêm rồi, trả về thông báo 'already_added'
            echo 'already_added';
        } else {
            // Nếu chưa thêm, thêm sản phẩm vào danh sách so sánh
            $_SESSION['compare_products'][$product_id] = $product_name;
            // Trả về thông báo 'added'
            echo 'added';
        }
    } else {
        echo 'error'; // Trả về 'error' nếu có lỗi
    }

    die();
}


