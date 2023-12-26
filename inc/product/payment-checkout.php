<?php 
//thanh toán 
// Đăng ký hàm AJAX để tạo đơn hàng
add_action('wp_ajax_create_order', 'create_order');
add_action('wp_ajax_nopriv_create_order', 'create_order'); // Đối với người dùng không đăng nhập

function create_order() {
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (!is_user_logged_in()) {
        die('Bạn cần đăng nhập để tạo đơn hàng.');
    }

    // Lấy dữ liệu đơn hàng từ AJAX
    $order_data = $_POST['order_data'];

    // Tạo đối tượng đơn hàng
    $order = wc_create_order();

    // Thêm thông tin từ dữ liệu AJAX vào đơn hàng
    $fullname = sanitize_text_field($_POST['fullname']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $receive_fullname = sanitize_text_field($_POST['receive_fullname']);
    $receive_phone = sanitize_text_field($_POST['receive_phone']);
    $receive_address = sanitize_text_field($_POST['receive_address']);
    $to_district = sanitize_text_field($_POST['to_district']);
    $note_customer = sanitize_text_field($_POST['note_customer']);

    // Tạo một đơn hàng mới
    $order = wc_create_order();

    // Thêm thông tin người mua hàng vào đơn hàng
    $order->set_customer_id(get_current_user_id());
    $order->set_billing_first_name($fullname);
    $order->set_billing_email($email);
    $order->set_billing_phone($phone);

    // Thêm thông tin người nhận hàng và địa chỉ nhận hàng
    $order->set_shipping_first_name($receive_fullname);
    $order->set_shipping_phone($receive_phone);
    $order->set_shipping_address_1($receive_address);
    $order->set_shipping_city($to_district);


    // Thêm sản phẩm vào đơn hàng (dựa vào thông tin giỏ hàng hiện tại, bạn cần tuỳ chỉnh phần này)

    if (WC()->cart->get_cart_contents_count() > 0) {
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $product_id = $cart_item['product_id'];
            $product_qty = $cart_item['quantity'];
            $product_variation_id = $cart_item['variation_id'];
            // Đặt thông tin khách hàng
           
            $order->add_product(wc_get_product($product_id), $product_qty, array(), $product_variation_id);
        }
    }

    // Lưu đơn hàng
    $order->calculate_totals();
    $order->save();

    // Xóa giỏ hàng
    WC()->cart->empty_cart();

    // Trả về thông tin đơn hàng và URL cảm ơn
    $order_data = array(
        'order_id' => $order->get_id(),
        'order_total' => wc_price($order->get_total()),
        'redirect' => wc_get_endpoint_url('order-received', $order->get_id(), wc_get_page_permalink('checkout'))
    );

    echo json_encode($order_data);

    // Dừng xử lý
    wp_die();
}
