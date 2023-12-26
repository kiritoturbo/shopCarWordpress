<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
    <section class="breadcrumbs px-15">
        <section class="container ">
            <section class="breadCrumbsContent flex justify-between items-center">
                <div class="breadCrumbsLeft">
                    <h4>Sản phẩm</h4>
                </div>
                <div class="breadCrumbsRight">
                    <?php
                        /**
                         * woocommerce_before_main_content hook.
                         *
                         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                         * @hooked woocommerce_breadcrumb - 20
                         */
                        do_action( 'woocommerce_before_main_content' );
                    ?>
                </div>
            </section>
        </section>
    </section>
	<?php 
        $product_id = get_the_ID();
        $product = wc_get_product($product_id);
        $product_images = get_post_meta($product_id, 'product_images', true);
    ?>
    <section class="mainSingleProduct">
        <section class="container flex ">
            <section class="thumnailSlider">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <?php echo $product->get_image();?>
                        </div>
                        <div class="swiper-slide">
                            <?php echo $product->get_image();?>
                        </div>
                        <div class="swiper-slide">
                            <?php echo $product->get_image();?>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div thumbsSlider="" class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php 
                        if (!empty($product_images)) {
                            foreach ($product_images as $image_url) {
                                echo '<img src="' . esc_url($image_url) . '" alt="Product Image" />';
                                ?>
                                    <div class="swiper-slide">
                                        <?php echo esc_url($image_url);?>
                                    </div>
                                <?php 
                            }
                        } else {
                            ?>
                                <div class="swiper-slide">
                                    <?php echo $product->get_image();?>
                                </div>
                                <div class="swiper-slide">
                                    <?php echo $product->get_image();?>
                                </div>
                                <div class="swiper-slide">
                                    <?php echo $product->get_image();?>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <section class="descriptPriceProduct">
                <section class="wrapperSingleProduct">
                    <h1 class="titleSingleProduct"><?php the_title(); ?></h1>
                    <div class="contentDesSingle">
                        <div class="contentDescript">
                            <div class="contentDescriptBox">
                                <?php 
                                if(empty($product->get_short_description())){
                                    echo 'Mô tả sản phẩm';
                                }else{
                                    the_excerpt();
                                }
                                ?>
                            </div>
                        </div>
                        <div class="contentSKU">
                            <div class="contentSKUBox">
                                <span class="labelSKU">
                                    Mã SP:
                                </span>
                                <span class="descriptLabelSKU">
                                <?php 
                                if($product->get_sku()){
                                    echo $product->get_sku(); 
                                }else{echo 'HTDT32-23';}
                                ?>
                                </span>
                            </div>
                        </div>
                        <div class="contentBrand">
                            <div class="contentBrandBox">
                                <span class="labelSKU">
                                    Thương hiệu:
                                </span>
                                <span class="descriptLabelSKU">
                                    <?php
                                        echo $product->get_categories();
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="contentPrice">
                            <?php
                                // Lấy giá sản phẩm
                                $regular_price = $product->get_regular_price();
                                $sale_price = $product->get_sale_price();
                                
                                if ($product->is_on_sale()) {
                                    // Hiển thị giá khuyến mãi nếu có
                                    echo '<span class="priceAfterCoupon">' . wc_price($sale_price) . '</span>';
                                    echo '<span class="priceBeforeCoupon">' . wc_price($regular_price) . '</span>';
                                } else {
                                    // Hiển thị giá thông thường nếu không có khuyến mãi
                                    echo '<span class="priceAfterCoupon">' . wc_price($regular_price) . '</span>';
                                }
                            ?>
                        </div>
                        <?php 
                            // Kiểm tra nếu sản phẩm có biến thể
                            if (function_exists('wc_get_product')) {
                                ?>
                                <div class="contentOptionColor">
                                    <div class="contentOptionColorBox">
                                        <div class="sitdown-Item">
                                            <label for="" class="title-Option">Số chỗ:</label>
                                            <div class="list-Option">
                                                <select name="" id="" class="list-Item">
                                                    <option selected="selected">4 chỗ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="machine-Item">
                                            <label for="" class="title-Option">Động cơ:</label>
                                            <div class="list-Option">
                                                <select name="" id="" class="list-Item">
                                                    <option selected="selected">1.0</option>
                                                    <option selected="selected">2.0</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="color-Item">
                                            <label for="" class="title-Option">Màu sắc:</label>
                                            <span class="descript-colorItem">Xanh lá</span>
                                            <div class="list-Option">
                                                <div class="all-color"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        }
                        ?>
                        <div class="contentAddCart">
                            <div class="contentAddCartBox flex items-center">
                                <div class="addAcount flex items-center">
                                    <div class="numberProduct">
                                        <div class="soluongProduct">
                                            <input value="1" name="" type="number" placeholder="" inputmode="numeric" autocomplete="off">
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
                                        
                                        <a href="<?php echo esc_url($product->add_to_cart_url())?>" class="addCart">Thêm vào giỏ hàng</a>
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
        <section class="commentProductTabs">
            <section class="container">
                <section class="commentProductTabsContent">
                    <nav class="nav-tabs">
                        <?php
                        /**
                         * Hook: woocommerce_after_single_product_summary.
                         *
                         * @hooked woocommerce_output_product_data_tabs - 10
                         * @hooked woocommerce_upsell_display - 15
                         * @hooked woocommerce_output_related_products - 20
                         */
                        do_action( 'woocommerce_after_single_product_summary' );
                        ?>
                    </nav>
                    <div class="tab-contents">
                        <div class="contentDescript">
                                
                        </div>
                    </div>
                </section>
            </section>
        </section>
        <section class="tagsWrapper">
            <section class="container">
                <div class="tagSingle">
                    <h4 class="titleTagSingle">Tags</h4>
                </div>
                <div class="contentTags">
                    <?php
                        global $product;

                        if ($product) {
                            $product_tags = wc_get_product_tag_list($product->get_id());

                            if ($product_tags) {
                                $tags_list = explode(', ', $product_tags);
                                foreach ($tags_list as $tag) {
                                    // Lấy thông tin về tag
                                    $term = get_term_by('name', $tag, 'product_tag');
                                    
                                    if ($term) {
                                        $tag_link = get_term_link($term);
                                        if (!is_wp_error($tag_link)) {
                                            echo '<span><a href="' . esc_url($tag_link) . '">' . esc_html($term->name) . '</a></span>';
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                </div>
            </section>
        </section>
    </section>

		



<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
