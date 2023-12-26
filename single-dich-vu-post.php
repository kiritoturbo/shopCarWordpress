<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

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
    ?>
    <section class="mainSingleProduct">
        <section class="container flex ">
            <section class="thumnailSlider">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper3">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'thumbnail d-block w-100')); ?>
                      </div>
                    </div>
                  </div>
                  <div thumbsSlider="" class="swiper mySwiper">
                  </div>
            </section>
            <section class="descriptPriceProduct">
                <section class="wrapperSingleProduct">
                    <h1 class="titleSingleProduct"><?php the_title(); ?></h1>
                    <div class="contentDesSingle">
                        <div class="contentDescript">
                            <div class="contentDescriptBox">
                                <?php 
                                the_excerpt();
                                ?>
                            </div>
                        </div>
                        <div class="lastPriceProduct">
                            <?php
                                echo '<span class="">' . the_content() . '</span>';
                            ?>
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
