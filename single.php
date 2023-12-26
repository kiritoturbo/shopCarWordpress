<?php
get_header();
?>
<section class="breadcrumbs px-15">
	<section class="container ">
		<section class="breadCrumbsContent flex justify-between items-center">
			<div class="breadCrumbsLeft">
				<h4><?php
				$categories = get_the_category();
				if ($categories) {
					$category = $categories[0]; // Lấy danh mục đầu tiên (có thể điều chỉnh nếu cần)
					$parent_category = get_term($category->parent, 'category'); // Lấy danh mục cha

					if ($parent_category && !is_wp_error($parent_category)) {
						echo $parent_category->name; // Hiển thị tên danh mục cha
					}
				}
				?></h4>
			</div>
			<?php custom_breadcrumb(); ?>
		</section>
	</section>
</section>

<section class="mainSingle px-15">
	<section class="container">
		<section class="wrapperSingle">
			<div class="headerSingle">
				<h1 class="titleSingle"><?php the_title(); ?></h1>
				<div class="timeDateSlider flex items-center">
					<span class="iconCalenderSlider">
						<i class="fas fa-calendar-alt"></i>
					</span>
					<div class="timeDateItem">
						<span class="timeItem"><?php echo get_the_date('d/m/Y'); ?></span>
						<span class="dateItem"><?php echo get_the_time(); ?></span>
					</div>
					<div class="eyeSlider">
						<span>
							<i class="fas fa-eye"></i>
						</span>
						<span class="totalEye">
							<?php echo getPostViews(get_the_ID()); ?>
						</span>
					</div>
				</div>
			</div>
			<div class="contentSingle">
				<?php the_content(); ?>
			</div>
			<div class="shareSocials">
				<div class="wrapperShare">
					<ul class="wrapper-list-share-socials flex items-center justify-center">
						<li>
							<div class="fb-share-button fb_iframe_widget" data-layout="button" data-href="https://demo037023.web30s.vn/volkswagen-jetta" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=164566120964750&amp;container_width=0&amp;href=https%3A%2F%2Fdemo037023.web30s.vn%2Fvolkswagen-jetta&amp;layout=button&amp;locale=vi_VN&amp;sdk=joey">
								<span style="vertical-align: bottom; width: 76px; height: 20px;"><iframe name="f2e45df3e68d624" width="1000px" height="1000px" data-testid="fb:share_button Facebook Social Plugin" title="fb:share_button Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v4.0/plugins/share_button.php?app_id=164566120964750&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df37934cf49c38c%26domain%3Ddemo037023.web30s.vn%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fdemo037023.web30s.vn%252Ffb3fb61720a1c8%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2Fdemo037023.web30s.vn%2Fvolkswagen-jetta&amp;layout=button&amp;locale=vi_VN&amp;sdk=joey" style="border: none; visibility: visible; width: 76px; height: 20px;" class="">
									</iframe>
								</span>
							</div>
						</li>
						<li>
							<div class="zalo-share-button" data-href="https://demo037023.web30s.vn/volkswagen-jetta" data-oaid="123456" data-layout="2" data-color="blue" data-customize="false" style="position: relative; display: inline-block; width: 20px; height: 20px;"><iframe id="248c6f87-9ad6-4230-9e03-b252a85182ec" name="248c6f87-9ad6-4230-9e03-b252a85182ec" frameborder="0" allowfullscreen="" scrolling="no" width="20px" height="20px" src="https://button-share.zalo.me/share_inline?id=248c6f87-9ad6-4230-9e03-b252a85182ec&amp;layout=2&amp;color=blue&amp;customize=false&amp;width=20&amp;height=20&amp;isDesktop=true&amp;url=https%3A%2F%2Fdemo037023.web30s.vn%2Fvolkswagen-jetta&amp;d=eyJ1cmwiOiJodHRwczovL2RlbW8wMzcwMjMud2ViMzBzLnZuL3ZvbGtzd2FnZW4tamV0dGEifQ%253D%253D&amp;shareType=0" style="position: absolute; z-index: 99; top: 0px; left: 0px;">
								</iframe>
							</div>
						</li>
						<li>
							<script>
								window.twttr = (function(d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0],
										t = window.twttr || {};
									if (d.getElementById(id)) return t;
									js = d.createElement(s);
									js.id = id;
									js.src = "//platform.twitter.com/widgets.js";
									fjs.parentNode.insertBefore(js, fjs);
									t._e = [];
									t.ready = function(f) {
										t._e.push(f);
									};
									return t;
								}(document, "script", "twitter-wjs"));
							</script><iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" class="twitter-share-button twitter-share-button-rendered twitter-tweet-button" style="position: static; visibility: visible; width: 73px; height: 20px;" title="Twitter Tweet Button" src="https://platform.twitter.com/widgets/tweet_button.2b2d73daf636805223fb11d48f3e94f7.en.html#dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=https%3A%2F%2Fdemo037023.web30s.vn%2Fvolkswagen-jetta&amp;size=m&amp;text=Volkswagen%20Jetta&amp;time=1695115036984&amp;type=share&amp;url=https%3A%2F%2Fdemo037023.web30s.vn%2Fvolkswagen-jetta" data-url="https://demo037023.web30s.vn/volkswagen-jetta">
							</iframe>
						</li>
					</ul>
				</div>
			</div>
			<section class="tagsWrapper">
				<section class="container">
					<div class="tagSingle">
						<h4 class="titleTagSingle">Tags</h4>
					</div>
					<div class="contentTags">
						<?php
						$tags = get_the_tags();

						if ($tags) {
							foreach ($tags as $tag) {
								echo '<span><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></span>';
							}
						}
						?>
					</div>
				</section>
				<section class="commentFbForWeb ">
					<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="100%" data-numposts="5"></div>
				</section>
				
			</section>
		</section>
	</section>
</section>
<section class="productsNew">
	<section class="container">
		<section class="productNewCol">
			<div class="titleArcharProduct uppercase relative">
				<h2 class="">Tin tức liên quan</h2>
				<div class="lineGrey">
					<span class="itemLineGrey"></span>
				</div>
			</div>
			<div class="postNewProduct">
				<div class="swiper mySwiper1 mySwiperMobile ">
					<div class="swiper-wrapper">
					<?php
						$categories = get_the_category($post->ID);
						if ($categories) 
						{
							$category_ids = array();
							foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
					
							$args=array(
							'category__in' => $category_ids,
							'post__not_in' => array($post->ID),
							'caller_get_posts'=>1
							);
							$my_query = new wp_query($args);
							if( $my_query->have_posts() ) 
							{
								while ($my_query->have_posts())
								{
									$my_query->the_post();
									?>
										<?php get_template_part('template-parts/item-single'); ?>
									<?php
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		</section>
	</section>
</section>


<?php
get_footer();
