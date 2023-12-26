<?php /* Template Name: Dịch vụ Template */ ?>
<?php get_header();?>
<section class="breadcrumbs px-15">
		<section class="container ">
			<section class="breadCrumbsContent flex justify-between items-center">
				<div class="breadCrumbsLeft">
					<h4><?php single_term_title(); ?></h4>
				</div>
				<?php custom_breadcrumb(); ?>
			</section>
		</section>
	</section>
	<section class="mainArcharProduct">
        <section class="container flex">
            <section class="widgetLeft">
                <div class="wrapperWidgetLeft">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-category-new') ) : ?><?php endif; ?>
                    <div class="bannerLeftArchar">
                        <div class="wrapperBanner">
                            <div class="bannerBox">
                                <div class="banerItemBox">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bannerLEfft.webp" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="productNewWidget">
                        <section class="productsNew">
                            <section class="w-full">
                                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-post-new') ) : ?><?php endif; ?>
                            </section>
                        </section>
                    </div>
                </div>
            </section>
            <section class="productRight">
                <div class="categoryPostBox">
                    <div class="postNewProduct">
                        <div class="swiper mySwiperArchar">
                            <div class="swiper-wrapper swiper-wrapper-dichvu">
								<?php 
                                $args = array(
                                    'post_type' => 'dich-vu-post', 
                                    'posts_per_page' => -1, 
                                );

                                $query = new WP_Query($args);

                                if ($query->have_posts()) :
                                    while ($query->have_posts()) : $query->the_post();
                                        ?>
                                            <div class="itemProduct relative">
                                                <a href="<?php the_permalink(); ?>">
                                                    <div class="imgProduct">
                                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
                                                    </div>
                                                    <h3 class="titleProduct uppercase"><?php the_title(); ?></h3>
                                                    <div class="priceProduct flex items-center flex-col">
                                                            <span class="lastPriceProduct"><?php the_content(); ?></span>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata(); 
                                else :
                                    echo 'Không có bài viết nào.';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>

<?php get_footer();?>
