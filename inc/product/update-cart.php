<?php
// Xử lý yêu cầu AJAX để cập nhật số lượng sản phẩm trong giỏ hàng WooCommerce
add_action('wp_ajax_update_cart_item_quantity', 'update_cart_item_quantity');
add_action('wp_ajax_nopriv_update_cart_item_quantity', 'update_cart_item_quantity');

function update_cart_item_quantity() {
    $cart_item_key = $_POST['cart_item_key'];
    $quantity = intval($_POST['quantity']);
    // $cart_total_before_update = wc_price(WC()->cart->get_cart_contents_total());


    // Kiểm tra nếu có sản phẩm trong giỏ hàng với cart_item_key này
    foreach (WC()->cart->get_cart() as $key => $cart_item) {
        if ($key === $cart_item_key) {
            // Cập nhật số lượng
            WC()->cart->set_quantity($key, $quantity);
            WC()->cart->calculate_totals(); // Tính lại tổng tiền

            // Trả về dữ liệu mới sau khi cập nhật
            $new_quantity = WC()->cart->get_cart_item($key)['quantity'];
            $new_total_price = wc_price(WC()->cart->get_cart_item($key)['line_total']);
            // Lấy giá trị tổng của tất cả sản phẩm trong giỏ hàng sau khi cập nhật
            $cart_total_after_update = wc_price(WC()->cart->get_cart_contents_total()); 
            $new_cart_item_count = WC()->cart->get_cart_contents_count();

            $response = array(
                'new_quantity' => $new_quantity,
                'new_total_price' => $new_total_price,
                'tongchung'=> $cart_total_after_update,
                'new_number_cart'=>$new_cart_item_count
            );

            wp_send_json_success($response); // Trả về dữ liệu mới thành công
        }
    }

    // Trả về lỗi nếu không tìm thấy sản phẩm
    wp_send_json_error();
}



function update_item_quantities() {
    // Kiểm tra tính hợp lệ của yêu cầu AJAX và Nonce
    check_ajax_referer('update-item-quantities-nonce', 'security');

    // Lấy dữ liệu từ yêu cầu AJAX
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    WC()->cart->set_quantity($cart_item_key, $quantity);

    // Lấy thông tin về giỏ hàng sau khi cập nhật
    $cart = WC()->cart->get_cart();

    // Tạo mảng chứa thông tin cập nhật
    $update_data = array();

    foreach ($cart as $key => $cart_item) {
        $product_id = $cart_item['product_id'];
        $update_data["div.cart-item[data-product-id='$product_id'] .cart-quantity-input"] = $cart_item['quantity'];
    }

    // Trả về thông tin cập nhật dưới dạng JSON
    wp_send_json($update_data);

    // Dừng xử lý
    wp_die();
}

// Đăng ký action cho user đã đăng nhập và user không đăng nhập
add_action('wp_ajax_update_item_quantities', 'update_item_quantities');
add_action('wp_ajax_nopriv_update_item_quantities', 'update_item_quantities');