<?php //yêu thích sản phẩm 
function add_to_favorite() {
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (is_user_logged_in()) {
        // Lấy ID của người dùng hiện tại
        $user_id = get_current_user_id();

        if (isset($_POST['product_id'])) {
            $product_id = intval($_POST['product_id']);
            
            // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích của người dùng hay chưa
            $favorite_products = get_user_meta($user_id, 'favorite_products', true);

            if (!$favorite_products) {
                $favorite_products = array();
            }

            if (!in_array($product_id, $favorite_products)) {
                // Nếu sản phẩm chưa có trong danh sách, thêm nó vào
                $favorite_products[] = $product_id;

                // Cập nhật danh sách yêu thích của người dùng trong cơ sở dữ liệu
                update_user_meta($user_id, 'favorite_products', $favorite_products);

                // Trả về 'added' để thông báo rằng sản phẩm đã được thêm vào danh sách yêu thích
                echo 'added';
            } else {
                // Nếu sản phẩm đã có trong danh sách, trả về 'already_added'
                echo 'already_added';
            }
        } else {
            // Nếu không có product_id được gửi, trả về 'error'
            echo 'error';
        }
    } else {
        // Nếu người dùng chưa đăng nhập, trả về 'not_logged_in'
        echo 'not_logged_in';
    }

    // Dừng xử lý để ngăn mã HTML không cần thiết được đưa ra
    die();
}

add_action('wp_ajax_add_to_favorite', 'add_to_favorite');
add_action('wp_ajax_nopriv_add_to_favorite', 'add_to_favorite');
