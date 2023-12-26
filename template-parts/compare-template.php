<?php session_start();?>
<?php 
// Template Name: Compare Template
?>

<?php get_header(); ?>

<?php
// Khởi động phiên làm việc với session

// Kiểm tra nếu biến session compare_products chưa được khởi tạo, thì khởi tạo nó là một mảng trống
if (!isset($_SESSION['compare_products'])) {
    $_SESSION['compare_products'] = array();
}

// Kiểm tra xóa sản phẩm khỏi danh sách so sánh
if (isset($_GET['remove_product']) && is_numeric($_GET['remove_product'])) {
    $remove_product_id = intval($_GET['remove_product']);
    if (isset($_SESSION['compare_products'][$remove_product_id])) {
        unset($_SESSION['compare_products'][$remove_product_id]);
    }
}

// Kiểm tra nếu có sản phẩm được thêm vào danh sách so sánh
if (isset($_POST['product_id']) && isset($_POST['product_name'])) {
    $product_id = intval($_POST['product_id']);
    $product_name = sanitize_text_field($_POST['product_name']);

    // Kiểm tra xem sản phẩm đã có trong danh sách so sánh chưa
    if (!isset($_SESSION['compare_products'][$product_id])) {
        $_SESSION['compare_products'][$product_id] = $product_name;
    }
}

$compare_products = $_SESSION['compare_products'];
?>

<section class="compareContent px-15 py-25">
    <section class="container">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php if (!empty($compare_products)) : ?>
                    <?php foreach ($compare_products as $product_id => $product_name) : ?>
                        <?php
                        // Truy vấn thông tin sản phẩm dựa trên ID sản phẩm
                        $product = wc_get_product($product_id);
                        if ($product) :
                            ?>
                            <div class="swiper-slide">
                                <div class="wrapperProductCompare flex">
                                    <div class="productCompare relative">
                                        <div class="imgCompare">
                                            <?php echo get_the_post_thumbnail($product_id, 'thumbnail', array('class' => 'thumbnail')); ?>
                                        </div>
                                        <div class="titleCompare"><?php echo esc_html($product->get_name()); ?></div>
                                        <div class="removeProductCompare absolute">
                                            <a href="?remove_product=<?php echo $product_id; ?>" class="remove-product"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    <div class="priceProductCompare">
                                        <?php
                                        $regular_price = $product->get_regular_price();
                                        $sale_price = $product->get_sale_price();
    
                                        if ($product->is_on_sale()) :
                                            ?>
                                            <span class="priceAfterCoupon"><?php echo wc_price($sale_price); ?></span>
                                            <span class="priceBeforeCoupon"><?php echo wc_price($regular_price); ?></span>
                                        <?php else : ?>
                                            <span class="priceAfterCoupon"><?php echo wc_price($regular_price); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="brandProductCompare">
                                        <?php echo $product->get_categories(); ?>   
                                    </div>
                                    <div class="desProductCompare">
                                        <?php echo $product->get_short_description(); ?>
                                    </div>
                                    <div class="addCartProductCompare">
                                        <div class="addCartAcount">
                                            <span class="iconAddCart">
                                                <i class="fas fa-cart-arrow-down"></i>
                                            </span>
                                            
                                            <a href="<?php echo esc_url($product->add_to_cart_url())?>" class="addCart">Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="swiper-slide">
                        <p>Không có sản phẩm nào trong danh sách so sánh.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
</section>


<?php get_footer(); ?>
