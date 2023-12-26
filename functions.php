<?php

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
 
remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20);
add_filter('woocommerce_product_tabs', 'remove_additional_information_tab', 98);

function remove_additional_information_tab($tabs) {
    unset($tabs['additional_information']);
    return $tabs;
}


function filter_products() {
    $selected_categories = $_POST['categories'];

    $args = array(
        'post_type' => 'product',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat', // Thay 'product_cat' bằng tên taxonomy của bạn
                'field' => 'id',
                'terms' => $selected_categories,
                'operator' => 'IN',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
				get_template_part('template-parts/item-product');
            ?>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Không có sản phẩm phù hợp.';
    endif;

    die();
}

// Đăng ký hàm xử lý yêu cầu Ajax
add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');


class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Điều chỉnh cấu trúc HTML cho menu con ở mức độ $depth
        if ($depth >= 2) {
            $output .= '<ul class="sub-menu">';
        } else {
            $output .= '<ul>';
        }
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Điều chỉnh cấu trúc HTML cho mỗi mục menu
        if ($depth >= 2) {
            $output .= '<li class="menu-item menu-item-depth-' . $depth . '">';
        } else {
            $output .= '<li class="menu-item">';
        }
        
        $output .= '<a href="' . $item->url . '">' . $item->title;
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</a></li>';
    }
}



function filter_products_by_variants() {
    // Nhận danh sách các biến thể được chọn từ yêu cầu POST
    $selected_variants = $_POST['selected_variants'];

    // Thực hiện lọc sản phẩm dựa trên các biến thể được chọn
    // Phần này phải là tax_query
    $args = array(
        'post_type' => 'product', 
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'pa_so-cho', 
                'value' => $selected_variants,
                // 'compare' => 'IN',
            ),
        ),
    );

    $products_query = new WP_Query($args);

    if ($products_query->have_posts()) {
        while ($products_query->have_posts()) {
            get_template_part('template-parts/item-product');

        }
        wp_reset_postdata();
    } else {
        echo "Không có sản phẩm nào phù hợp.";
    }

    die();
}

add_action('wp_ajax_filter_products_by_variants', 'filter_products_by_variants');
add_action('wp_ajax_nopriv_filter_products_by_variants', 'filter_products_by_variants');



// Đăng ký hàm xử lý AJAX
add_action('wp_ajax_filter_products_select', 'filter_products_select');
add_action('wp_ajax_nopriv_filter_products_select', 'filter_products_select');

function filter_products_select() {
    $limit = $_POST['limit'] ? $_POST['limit'] : 9;
    $orderby = $_POST['orderby'];

    // Tạo truy vấn để lấy sản phẩm theo các tham số đã chọn
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $limit,
        'orderby' => $orderby,
    );

    // Thêm đoạn mã sau để xử lý sắp xếp
    if ($orderby == 'name-asc') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'title';
    } elseif ($orderby == 'name-desc') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'title';
    } elseif ($orderby == 'price-asc') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'meta_value_num'; // Sắp xếp theo giá
        $args['meta_key'] = '_price';
    } elseif ($orderby == 'price-desc') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value_num'; // Sắp xếp theo giá
        $args['meta_key'] = '_price';
    } elseif ($orderby == 'sale-asc') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'meta_value_num'; // Sắp xếp theo trường khuyến mãi (nếu có)
        $args['meta_key'] = '_sale_price';
    } elseif ($orderby == 'sale-desc') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value_num'; // Sắp xếp theo trường khuyến mãi (nếu có)
        $args['meta_key'] = '_sale_price';
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/item-product');
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Không có sản phẩm.</p>';
    endif;
    wp_die();
}



require get_template_directory().'/inc/filter/filter-category-product.php';
require get_template_directory().'/inc/filter/filter-price.php';

require get_template_directory().'/inc/search-top.php';
require get_template_directory().'/inc/register-ajax.php';
require get_template_directory().'/inc/register-css-js.php';
require get_template_directory().'/inc/posttype-slider.php';
require get_template_directory().'/inc/view-post.php';
require get_template_directory().'/inc/post-widget.php';
require get_template_directory().'/inc/category-widget.php';
require get_template_directory().'/inc/custom-menu.php';
require get_template_directory().'/inc/createTemplate/create-template.php';

require get_template_directory().'/inc/product/remove-product-favirate.php';
require get_template_directory().'/inc/product/custom-money.php';
require get_template_directory().'/inc/product/payment-checkout.php';
require get_template_directory().'/inc/product/update-cart.php';
require get_template_directory().'/inc/product/sale-percent.php';
require get_template_directory().'/inc/product/favorite-product.php';
require get_template_directory().'/inc/product/compare-product.php';

require get_template_directory().'/inc/breadcrumb.php';
require get_template_directory().'/inc/pagination.php';





function fimetech_setup() {
	
	require get_template_directory().'/inc/themeSupport/register-support.php';

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'fimetech' ),
			'menu-top' => esc_html__( 'Menutop', 'fimetech' ),
		)
	);
	if (function_exists('register_sidebar')){
		register_sidebar(
			array(
				'name'=> 'Cột bên',
				'id' => 'sidebar-post-new',
		));
		register_sidebar(
			array(
				'name'=> 'Cột category',
				'id' => 'sidebar-category-new',
		));
	}
}
add_action( 'after_setup_theme', 'fimetech_setup' );

require get_template_directory().'/inc/themeSupport/register-sidebar.php';

