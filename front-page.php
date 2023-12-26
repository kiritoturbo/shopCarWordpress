<?php session_start();
$compare_products = isset($_SESSION['compare_products']) ? $_SESSION['compare_products'] : array();?>   
<?php get_header() ?>   

    <section class="sliderContainer">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
            <?php 
                $args = array(
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'post_type' => 'slider'
                );
                $the_query = new WP_Query($args);
                $i = 1;
            ?>
            <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <div class="swiper-slide">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' =>'thumbnail'));?>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/anh-banner-xe-hyundai-elantra.webp" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner-hyundai-accent.webp" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner-khuyen-mai_new.webp" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner-toyota-corolla-altis-2017.webp" alt="">
                    </div>
                    <?php endif; ?>
            <?php wp_reset_query(); ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
    </section>
    <section class="bannerContainer">
        <section class="container flex">
            <?php 
                $imgTopLeft = get_field('banner_tren_cung_ben_trai'); 
                $imgBottomLeft = get_field('banner_duoi_cung_ben_trai'); 
                $imgCenter = get_field('banner_giua'); 
                $imgTopRight = get_field('banner_tren_cung_ben_phai'); 
                $imgBottomRight = get_field('banner_duoi_cung_ben_phai'); 
                ?>
            <section class="itemBanner">
                <div class="bannerLeft ">
                    <div class="itemBannerLeftTop">
                        <div class="wrapperImageBanner">
                            <?php if($imgTopLeft){
                                echo '<img src="' . esc_url($imgTopLeft["url"]) . '" alt="'. esc_url($imgTopLeft["alt"]) .'">';
                            }else{
                                echo '<img src="'. get_template_directory_uri().'/assets/img/get-image-v3.webp" alt="">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="itemBannerLeftBottom">
                        <div class="wrapperImageBanner">
                            <?php if($imgBottomLeft){
                                echo '<img src="' . esc_url($imgBottomLeft["url"]) . '" alt="'. esc_url($imgBottomLeft["alt"]) .'">';
                            }else{
                                echo '<img src="'. get_template_directory_uri().'/assets/img/get-image-v3 (1).webp" alt="">';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="itemBanner">
                <div class="bannerCenter">
                    <div class="wrapperImageBanner">
                        <?php if($imgCenter){
                                    echo '<img src="' . esc_url($imgCenter["url"]) . '" alt="'. esc_url($imgCenter["alt"]) .'">';
                                }else{
                                    echo '<img src="'. get_template_directory_uri().'/assets/img/centerbanner.webp" alt="">';
                                }
                        ?>
                    </div>
                </div>
            </section>
            <section class="itemBanner">
                <div class="bannerRight">
                    <div class="bannerRightTop">
                        <div class="wrapperImageBanner">
                            <?php if($imgTopRight){
                                echo '<img src="' . esc_url($imgTopRight["url"]) . '" alt="'. esc_url($imgTopRight["alt"]) .'">';
                            }else{
                                echo '<img src="'. get_template_directory_uri().'/assets/img/rightbannertop.webp" alt="">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="bannerRightBottom">
                        <div class="wrapperImageBanner">
                            <?php if($imgBottomRight){
                                echo '<img src="' . esc_url($imgBottomRight["url"]) . '" alt="'. esc_url($imgBottomRight["alt"]) .'">';
                            }else{
                                echo '<img src="'. get_template_directory_uri().'/assets/img/rightbannerBottom.webp" alt="">';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <section class="productsNew">
        <section class="container">
            <section class="productNewCol">
                <div class="titleArcharProduct uppercase relative">
                    <h2 class="">Sản phẩm mới</h2>
                    <div class="lineGrey">
                        <span class="itemLineGrey"></span>
                    </div>
                </div>
                <div class="repeatProduct">
                    <div class="boxRepeatProduct">
                        <?php 
                            $category_slug = 'san-pham-moi';
                            $category = get_term_by('slug', $category_slug, 'product_cat');
                            if ($category) {
                                $args = array(
                                    'post_type' => 'product',
                                    'posts_per_page' => -1, 
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'id',
                                            'terms' => $category->term_id, 
                                        ),
                                    ),
                                );
                                $products = new WP_query( $args);
                                if ($products) {
                                     while ($products->have_posts()) : $products->the_post(); 
                                        ?>
                                            <?php get_template_part('template-parts/item-product') ?>
                                        <?php endwhile; wp_reset_postdata(); ?>
                                        
                                        <?php
                                } else {
                                    echo 'Không có sản phẩm trong danh mục này.';
                                }
                            } else {
                                echo 'Danh mục không tồn tại.';
                            }
                        ?>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <section class="bannerCenterContainer">
        <section class="container bannerCenterContent">
            <div class="wrapperBannerCenter">
                <div class="wrapperImgBanner">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bannerCenter.webp" alt="">
                </div>
            </div>
        </section>
    </section>
    <section class="productsNew">
        <section class="container">
            <section class="productNewCol">
                <div class="titleArcharProduct uppercase relative">
                    <h2 class="">Sản phẩm bán chạy</h2>
                    <div class="lineGrey">
                        <span class="itemLineGrey"></span>
                    </div>
                </div>
                <div class="repeatProduct">
                    <div class="boxRepeatProduct">
                    <?php
                        $args = array(
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'posts_per_page' => 10,
                            'meta_key' => 'total_sales',
                            'orderby' => 'meta_value_num'
                        );
                    ?>
                    <?php $getposts = new WP_query( $args);?>
                    <?php global $wp_query; $wp_query->in_the_loop = true; ?>
                    <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                        <?php get_template_part('template-parts/item-product') ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <section class="bannerCenterContainer">
        <section class="container bannerCenterContent">
            <div class="wrapperBannerCenter">
                <div class="wrapperImgBanner">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/connector_1.webp" alt="">
                </div>
            </div>
        </section>
    </section>
    <section class="productsNew">
        <section class="container">
            <section class="productNewCol">
                <div class="titleArcharProduct uppercase relative">
                    <h2 class="">Tin tức mới nhất</h2>
                    <div class="lineGrey">
                        <span class="itemLineGrey"></span>
                    </div>
                </div>
                <div class="postNewProduct">
                    <div class="swiper mySwiper1 mySwiperMobile">
                        <div class="swiper-wrapper">
                            <?php 
                                $args = array(
                                    'post_type' => 'post',
                                    'orderby' => 'date',
                                    'order' => 'DESC'
                                );
                                
                                $query = new WP_Query($args);
                                
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        setPostViews(get_the_ID());
                                        ?>
                                            <?php get_template_part('template-parts/item-single'); ?>
                                        <?php
                                    }
                                    wp_reset_postdata();
                                } else {
                                    echo 'Không tìm thấy bài viết mới nhất.';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <section class="brandProduct px-15">
        <section class="container">
            <section class="brandContent">
                <div class="swiper mySwiper2 mySwiperBrand">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <div class="wrapperBrand">
                            <a href="#">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bmw_logo_new.webp" alt="logo brand">
                            </a>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="wrapperBrand">
                            <a href="#">
                                <img src="https://demo037023.web30s.vn/datafiles/32574/upload/images/logo/Kia-logo-new.png?t=1604304724" alt="logo brand">
                            </a>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="wrapperBrand">
                            <a href="#">
                                <img src="https://demo037023.web30s.vn/datafiles/32574/upload/images/logo/ferrari_logo.png?t=1604304724" alt="logo brand">
                            </a>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="wrapperBrand">
                            <a href="#">
                                <img src="https://demo037023.web30s.vn/datafiles/32574/upload/images/logo/Hyundai_logo_new.jpg?t=1604304724" alt="logo brand">
                            </a>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="wrapperBrand">
                            <a href="#">
                                <img src="https://demo037023.web30s.vn/datafiles/32574/upload/images/logo/logo-toyota-1.png?t=1604304724" alt="logo brand">
                            </a>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="wrapperBrand">
                            <a href="#">
                                <img src="https://demo037023.web30s.vn/datafiles/32574/upload/images/logo/mazda_logo_new.png?t=1604304724" alt="logo brand">
                            </a>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="wrapperBrand">
                            <a href="#">
                                <img src="https://demo037023.web30s.vn/datafiles/32574/upload/images/logo/logo_mercedes.png?t=1604304724" alt="logo brand">
                            </a>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="wrapperBrand">
                            <a href="#">
                                <img src="https://demo037023.web30s.vn/datafiles/32574/upload/images/logo/logo_honda_new.jpg?t=1604304724" alt="logo brand">
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
            </section>
        </section>
    </section>
    <section class="contactRegister">
        <section class="container">
            <section class="contactContent">
                <h2 class="titleContact">ĐĂNG KÝ NHẬN TIN KHUYẾN MÃI</h2>
                <div class="sloganContact">
                    <p>Bạn sẽ nhận được thông tin khuyến mãi mới nhất của chúng tôi !</p>
                </div>
                <?php 
                 // echo do_shortcode('[ninja_form id=2]');
                ?> 

                <form action="" >
                    <div class="subcriptContact relative">
                        <input value="" name="email" type="text" placeholder="Địa chỉ email....." autocomplete="off">
                        <a href="#" type="submit">
                            <span class=" ">Đăng ký nhận tin</span>
                        </a>
                    </div>
                </form>
            </section>
        </section>
    </section>

<?php get_footer(); ?>