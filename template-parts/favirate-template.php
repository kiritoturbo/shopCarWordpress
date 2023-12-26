<?php /* Template Name: Favirate Template */ ?>    <!-- lấy danh sách sản phẩm yêu thích của người dùng -->

<?php get_header();?>
<section class="favirateContent ">
    <section class="wrapperFavirate">
            <section class="container">
                <section class="productNewCol">
                    <div class="repeatProduct">
                        <div class="boxRepeatProduct">
                                <?php
                                // Kiểm tra xem người dùng đã đăng nhập hay chưa
                                if (is_user_logged_in()) {
                                    // Lấy ID của người dùng hiện tại
                                    $user_id = get_current_user_id();

                                    // Lấy danh sách sản phẩm yêu thích của người dùng
                                    $favorite_products = get_user_meta($user_id, 'favorite_products', true);

                                    // Kiểm tra xem danh sách yêu thích có sản phẩm hay không
                                    if ($favorite_products && is_array($favorite_products)) {
                                        foreach ($favorite_products as $product_id) {
                                            // Sử dụng $product_id để lấy thông tin sản phẩm và hiển thị chúng
                                            $product = wc_get_product($product_id);
                                            if ($product) {
                                                $product_images = get_post_meta($product_id, 'product_images', true);
                                                $regular_price = $product->get_regular_price();
                                                $sale_price = $product->get_sale_price();
                                                $product_name = $product->get_name();
                                                ?>
                                                    <div class="itemProduct relative">
                                                        <a href="<?php echo get_permalink($product_id); ?>">
                                                            <div class="imgProduct">
                                                                <?php echo $product->get_image('thumbnail', array('class' => 'thumbnail')); ?>
                                                            </div>
                                                            <h3 class="titleProduct uppercase"><?php echo $product->get_title(); ?></h3>
                                                            <div class="priceProduct flex items-center flex-col">
                                                                <span class="lastPriceProduct"><?php echo ($sale_price == 0) ? '' : wc_price($sale_price); ?></span>
                                                                <span class="afterPriceProduct"><?php echo ($sale_price == 0) ? wc_price($regular_price) : ''; ?></span>
                                                            </div>
                                                        </a>
                                                        <?php if ($product->is_on_sale()) { ?>
                                                            <div class="couponTotal absolute">
                                                                <span class="couponNumber">-<?php echo percenSale($regular_price, $sale_price); ?>%</span>
                                                            </div>
                                                        <?php } ?>
                                    
                                                        <div class="groupWidget absolute">
                                                            <div class="itemGroupWidget">
                                                                <a href="#" class="add-to-cart-button" data-product-id="<?php echo esc_attr($product_id); ?>" data-ajax-done="false">
                                                                    <i class="fas fa-shopping-basket"></i>
                                                                </a>
                                                            </div>
                                                            <div class="itemGroupWidget">
                                                                <a href="#" class="favorite-button" data-product-id="<?php echo esc_attr($product_id); ?>">
                                                                    <i class="far fa-heart"></i>
                                                                </a>
                                                            </div>
                                                            <div class="itemGroupWidget">
                                                                <a href="#" class="add-to-compare-button" data-product-id="<?php echo esc_attr($product_id); ?>" data-product-name="<?php echo esc_attr($product_name); ?>">
                                                                    <i class="fas fa-retweet"></i>
                                                                </a>
                                                            </div>
                                                            <div class="itemGroupWidget">
                                                                <a href="#" class="open-quick-view" data-product-id="<?php echo esc_attr($product_id); ?>">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="quick-view relative" id="quick-view-<?php echo esc_attr($product_id); ?>">
                                                        <section class="container flex ">
                                                            <section class="thumnailSlider">
                                                                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                                                    class="swiper mySwiper2">
                                                                    <div class="swiper-wrapper">
                                                                        <?php foreach ($product_images as $image_id) { ?>
                                                                            <div class="swiper-slide">
                                                                                <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="swiper-button-next"></div>
                                                                    <div class="swiper-button-prev"></div>
                                                                </div>
                                                                <div thumbsSlider="" class="swiper mySwiper">
                                                                    <div class="swiper-wrapper">
                                                                        <?php foreach ($product_images as $image_id) { ?>
                                                                            <div class="swiper-slide">
                                                                                <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            <section class="descriptPriceProduct">
                                                                <section class="wrapperSingleProduct">
                                                                    <h1 class="titleSingleProduct"><?php echo $product->get_title(); ?></h1>
                                                                    <div class="contentDesSingle">
                                                                        <div class="contentDescript">
                                                                            <div class="contentDescriptBox">
                                                                                <?php echo $product->get_short_description(); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="contentSKU">
                                                                            <div class="contentSKUBox">
                                                                                <span class="labelSKU">
                                                                                    Mã SP:
                                                                                </span>
                                                                                <span class="descriptLabelSKU">
                                                                                    <?php echo $product->get_sku() ?: 'không có sku'; ?>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="contentBrand">
                                                                            <div class="contentBrandBox">
                                                                                <span class="labelSKU">
                                                                                    Thương hiệu:
                                                                                </span>
                                                                                <span class="descriptLabelSKU">
                                                                                    <?php echo $product->get_categories(); ?>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="contentPrice">
                                                                            <?php
                                                                            if ($product->is_on_sale()) {
                                                                                echo '<span class="priceAfterCoupon">' . wc_price($sale_price) . '</span>';
                                                                                echo '<span class="priceBeforeCoupon">' . wc_price($regular_price) . '</span>';
                                                                            } else {
                                                                                echo '<span class="priceAfterCoupon">' . wc_price($regular_price) . '</span>';
                                                                            }
                                                                            ?>
                                                                        </div>
                                    
                                                                        <div class="contentAddCart">
                                                                            <div class="contentAddCartBox flex items-center">
                                                                                <div class="addAcount flex items-center">
                                                                                    <div class="numberProduct">
                                                                                        <div class="soluongProduct">
                                                                                            <input value="1" name="" type="number" placeholder=""
                                                                                                inputmode="numeric" autocomplete="off">
                                                                                        </div>
                                                                                        <span class="increaseNumber">
                                                                                            <i class="fas fa-plus"></i>
                                                                                        </span>
                                                                                        <span class="descreaseNumber">
                                                                                            <i class="fas fa-minus"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="addCartAcount">
                                                                                        <span class="iconAddCart">
                                                                                            <i class="fas fa-cart-arrow-down"></i>
                                                                                        </span>
                                                                                        <a href="<?php echo esc_url($product->add_to_cart_url()) ?>"
                                                                                        class="addCart">Thêm vào giỏ hàng</a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="compareHeart">
                                                                                    <div class="compareProductAdd">
                                                                                        <a href="" class="compareItem">
                                                                                            <i class="fas fa-retweet"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="heartProductAdd">
                                                                                        <a href="" class="heartItem">
                                                                                            <i class="far fa-heart"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shareSocials">
                                    
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </section>
                                                        </section>
                                                        <a href="#" class="close-quick-view absolute"
                                                        data-product-id="<?php echo esc_attr($product_id); ?>"><i class="fas fa-times"></i></a>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    } else {
                                        echo 'Danh sách yêu thích trống.';
                                    }
                                } else {
                                    echo 'Vui lòng đăng nhập để xem danh sách yêu thích.';
                                }
                                ?>
                        </div>
                    </div>
                </section>
            </section>      
    </section>
</section>


<?php get_footer();?>
