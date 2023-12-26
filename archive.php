<?php
get_header();
?>
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
                            <div class="swiper-wrapper">
								<?php if (have_posts()) : ?>
								<?php while (have_posts()) : the_post(); ?>
									<?php get_template_part('template-parts/item-single'); ?>
								<?php endwhile; else : ?>
								<p>Không có</p>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php 
                    global $wp_query;
                    $current_page = max(1, get_query_var('paged'));
                    $total_pages =$wp_query->max_num_pages; 
                    $paginate_args = array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => '?paged=%#%', 
                        'total' => $total_pages,
                        'current' => $current_page,
                        // 'show_all' => false,
                        // 'end_size' => 1,
                        // 'mid_size' => 2,
                        'prev_next' => true,
                        'prev_text' => '<i class="fas fa-angle-double-left"></i>' ,
                        'next_text' => '<i class="fas fa-angle-double-right"></i>'
                    );
                    echo '<ul class="panigationCus">';
                    echo paginate_links($paginate_args);
                    echo '</ul>';
                ?>
                </div>
            </section>
        </section>
    </section>
<?php
get_footer();
