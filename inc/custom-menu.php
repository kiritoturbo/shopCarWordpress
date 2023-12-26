<?php 
// // Hàm kiểm tra xem mục menu có menu con hay không
function has_submenu($item_id, $menu_items) {
    foreach ($menu_items as $item) {
        if ($item->menu_item_parent && $item->menu_item_parent == $item_id) {
            return true;
        }
    }
    return false;
}

// // Hàm thêm biểu tượng vào menu chứa menu con
// function add_icon_to_submenu($items, $args) {
//     if ($args->theme_location == 'menu-1') { 
//         foreach ($items as $item) {
//             if (has_submenu($item->ID, $items)) {
//                 $item->title .= ' <i class="fas fa-chevron-down"></i>';
//             }
//         }
//     }
//     return $items;
// }
// add_filter('wp_nav_menu_objects', 'add_icon_to_submenu', 10, 2);
function add_icon_to_submenu($items, $args) {
    if ($args->theme_location == 'menu-1') {
        foreach ($items as $item) {
            if (has_submenu($item->ID, $items)) {
                $item->title .= ' <i class="fas fa-chevron-down"></i>';
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'add_icon_to_submenu', 10, 2);

