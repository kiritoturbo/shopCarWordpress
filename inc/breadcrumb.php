<?php
//breadcumbs
function custom_breadcrumb() {
    echo '<div class="breadcrumb breadCrumbsRight">';
    if (!is_home()) {
        echo '<a href="' . get_home_url() . '" class="breadscrumb-item">Trang chủ</a>';
        if (is_category() || is_single()) {
            $categories = get_the_category();
            if ($categories) {
                $category = $categories[0]; // Lấy danh mục đầu tiên (có thể điều chỉnh nếu cần)
                $cat_ancestors = get_ancestors($category->term_id, 'category');
                if ($cat_ancestors) {
                    $cat_ancestors = array_reverse($cat_ancestors);
                    foreach ($cat_ancestors as $cat_ancestor_id) {
                        $cat_ancestor = get_category($cat_ancestor_id);
                        echo '<a class="breadscrumb-item"> / ' . esc_html($cat_ancestor->name) . '</a>';
                    }
                }
                echo '<a class="breadscrumb-item"> / ';
                single_term_title();
                echo '</a>';
                if (is_single()) {
                    echo '<a class="breadscrumb-item"> / ';
                    the_title();
                    echo '</a>';
                }
            }
        } elseif (is_page()) {
            echo '<a class="breadscrumb-item active"> / ';
            the_title();
            echo '</a>';
        }
    }
    echo '</div>';
}

