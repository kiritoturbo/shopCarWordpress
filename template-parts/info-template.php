<?php /* Template Name: Info Template */ ?>
<?php get_header();?>

<section class="infoContent px-15 py-25">
    <section class="container">
        <section class="wrapperInfo flex">
            <section class="wrapperInfoLeft">
                <div class="userInforContent flex">
                    <div class="imgUserInfo">
                        <?php 
                            $user_id = get_current_user_id(); // Lấy ID của người dùng hiện tại
                            $avatar = get_avatar($user_id); // Lấy avatar của người dùng
                            if($user_id) {echo $avatar;}else{ echo '<i class="fas fa-user"></i>';}; // Hiển thị avatar
                        ?>
                    </div>
                    <div class="nameUserContent">
                        <span class="nameUserInfo">
                            <?php 
                                $current_user = wp_get_current_user(); // Lấy thông tin người dùng hiện tại
                                // echo '<pre>';
                                // print_r($current_user);
                                // echo '</pre>';
                                $username = $current_user->display_name; // Lấy tên đăng nhập của người dùng
                                if($username){echo '<span>'.$username.'</span>';}else{echo '<span>Tài khoản<br/> đăng nhập</span>';};
                            ?>
                        </span>
                        <span class="desUserInfo">Chỉnh sửa tài khoản</span>
                    </div>
                </div>
                <div class="navTabInfos">
                    <a href="#" class="navTabInfoItem firstTab" data-tab="tab1" data-title="Quản lý giao dịch">
                        <span>Quản lý giao dịch</span>
                    </a>
                    <a href="#" class="navTabInfoItem" data-tab="tab2" data-title="Đơn hàng của bạn">
                        <i class="fas fa-file"></i>
                        <span>Đơn hàng của bạn</span>
                    </a>
                    <a href="#" class="navTabInfoItem" data-tab="tab3" data-title="Sản phẩm đã xem">
                        <i class="far fa-eye"></i>
                        <span>Sản phẩm đã xem</span>
                    </a>
                    <a href="#" class="navTabInfoItem" data-tab="tab4" data-title="Danh sách yêu thích">
                        <i class="fas fa-heart"></i>
                        <span>Danh sách yêu thích</span>
                    </a>

                    <a href="#" class="navTabInfoItem firstTab" data-tab="tab5" data-title="Quản lý tài khoản">
                        <span>Quản lý tài khoản</span>
                    </a>
                    <a href="#" class="navTabInfoItem" data-tab="tab6" data-title="Thông tin tài khoản">
                        <i class="fas fa-edit"></i>
                        <span>Thông tin tài khoản</span>
                    </a>
                    <a href="#" class="navTabInfoItem" data-tab="tab7" data-title="Đổi mật khẩu">
                        <i class="fas fa-key"></i>
                        <span>Đổi mật khẩu</span>
                    </a>
                    <a href="<?php echo wp_logout_url('/autoCarWordpress/dang-nhap'); ?>" class="button-logout" >
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Đăng xuất</span>
                    </a>
                </div>
            </section>
            <section class="wrapperInfoRight">
                <h4 class="titleWrapperInfo">
                    Quản lý giao dịch 
                </h4>
                <div class="tab-show">
                    <div id="tab1" class="tab-content">Không có thông tin dữ liệu này </div>
                    <div id="tab2" class="tab-content">Không có thông tin dữ liệu đơn hàng</div>
                    <div id="tab3" class="tab-content">Không có thông tin dữ liệu đã xem</div>
                    <div id="tab4" class="tab-content">
                        <section class="favirateContent ">
                            <section class="wrapperFavirate">
                                    <section class="">
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
                                                                    // $product_images = get_post_meta($product_id, 'product_images', true);
                                                                    $product_images = $product->get_gallery_image_ids();
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
                                                                                    <span class="afterPriceProduct"><?php echo ($sale_price == 0) ? '<span class="lastPriceProduct">'. wc_price($regular_price) .'</span>' : ''; ?></span>
                                                                                </div>
                                                                            </a>
                                                                            <?php if ($product->is_on_sale()) { ?>
                                                                                <div class="couponTotal absolute">
                                                                                    <span class="couponNumber">-<?php echo percenSale($regular_price, $sale_price); ?>%</span>
                                                                                </div>
                                                                            <?php } ?>
                                                                            <div class="deleteFavitr absolute">
                                                                                <a href="#" class="remove-from-favorites" data-product-id="<?php echo esc_attr($product_id); ?>">
                                                                                    <i class="fas fa-times"></i>
                                                                                </a>
                                                                            </div>
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
                                                                                            <?php if($product_images){?>
                                                                                                <?php foreach ($product_images as $image_id) { ?>
                                                                                                    <div class="swiper-slide">
                                                                                                        <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                                                                                                    </div>
                                                                                                <?php } ?>
                                                                                            <?php } else{?>
                                                                                                    <div class="swiper-slide">
                                                                                                        <?php echo $product->get_image();?>
                                                                                                    </div>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                        <div class="swiper-button-next"></div>
                                                                                        <div class="swiper-button-prev"></div>
                                                                                    </div>
                                                                                    <div thumbsSlider="" class="swiper mySwiper">
                                                                                        <div class="swiper-wrapper">
                                                                                                <?php if($product_images){?>
                                                                                                    <?php foreach ($product_images as $image_id) { ?>
                                                                                                        <div class="swiper-slide">
                                                                                                            <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                                                                                                        </div>
                                                                                                    <?php } ?>
                                                                                                <?php } else{?>
                                                                                                        <div class="swiper-slide">
                                                                                                            <?php echo $product->get_image();?>
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
                    </div>
                    <div id="tab5" class="tab-content">Nội dung tab 5</div>
                    <div id="tab6" class="tab-content">Nội dung tab 6</div>
                    <div id="tab7" class="tab-content">Nội dung tab 7</div>
                </div>
            </section>
        </section>
    </section>
</section>
<?php get_footer();?>