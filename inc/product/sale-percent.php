<?php 
//sale off
function percenSale($price,$price_sale){
    if($price_sale <= 0 || $price <= 0){
        return 0;
    }
	$sale = (floatval($price_sale)*100)/floatval($price);
	$percent = 100 - $sale;
	return number_format($percent);
}
//số lượt xem 
function getPostViews($postID){ // hàm này dùng để lấy số người đã xem qua bài viết
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){ // Nếu như lượt xem không có
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0"; // giá trị trả về bằng 0
    }
    return $count; // Trả về giá trị lượt xem
}

