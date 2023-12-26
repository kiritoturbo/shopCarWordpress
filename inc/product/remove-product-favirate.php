<?php 
add_action('wp_ajax_remove_favorite_product', 'remove_favorite_product');
add_action('wp_ajax_nopriv_remove_favorite_product', 'remove_favorite_product');

function remove_favorite_product() {
    if (isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        $user_id = get_current_user_id();

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if ($user_id > 0) {
            $favorite_products = get_user_meta($user_id, 'favorite_products', true);

            if (!empty($favorite_products) && is_array($favorite_products)) {
                // Tìm và xóa sản phẩm khỏi danh sách yêu thích
                $key = array_search($product_id, $favorite_products);
                if ($key !== false) {
                    unset($favorite_products[$key]);
                    update_user_meta($user_id, 'favorite_products', $favorite_products);
                }
            }

            // Phản hồi Ajax thành công
            echo 'success';
        } else {
            // Người dùng chưa đăng nhập, bạn có thể xử lý theo cách khác nếu cần thiết
            echo 'not_logged_in';
        }
    }

    die();
}
