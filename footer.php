	<section class="footerContainer text-white">
	    <section class="container flex justify-center">
	        <div class="footerContact">
	            <h4>Liên hệ</h4>
	            <div class="footerContactContent">
	                <div class="contentAddress flex">
	                    <span class="footerContactTitle">Địa chỉ:</span>
	                    <p><?php the_field('dia_chi', 'option');?></p>
	                </div>
	                <div class="contentEmail flex">
	                    <span class="footerContactTitle">Email:</span>
	                    <span class="footerContactEmail"><?php the_field('email_contact_option', 'option'); ?></span>
	                </div>
	                <div class="contentPhone flex">
	                    <span class="footerContactTitle">Phone:</span>
	                    <span class="footerContactPhone"><?php the_field('so_dien_thoai', 'option'); ?></span>
	                </div>
	            </div>
	        </div>
	        <div class="footerService">
	            <h4>Dịch vụ</h4>
	            <div class="contentServices">
	                <ul>
	                    <li>
	                        <a href="">Vệ Sinh – Bảo Dưỡng Nội Thất Xe Ô Tô</a>
	                    </li>
	                    <li>
	                        <a href="">Vệ Sinh – Bảo Dưỡng Nội Thất Xe Ô Tô</a>
	                    </li>
	                    <li>
	                        <a href="">Vệ Sinh – Bảo Dưỡng Nội Thất Xe Ô Tô</a>
	                    </li>
	                    <li>
	                        <a href="">Vệ Sinh – Bảo Dưỡng Nội Thất Xe Ô Tô</a>
	                    </li>
	                </ul>
	            </div>
	        </div>
	        <div class="footerTableClick">
	            <h4>Thống kê truy cập</h4>
	            <div class="contentTableClick">
	                <ul class="">
	                    <li class="statistic-item">
	                        <span>Tổng lượt truy cập: </span>
	                        <span> 41453 </span>
	                    </li>
	                    <li class="statistic-item">
	                        <span>Trong ngày: </span>
	                        <span> 41453 </span>
	                    </li>
	                    <li class="statistic-item">
	                        <span>Đang trực tuyến: </span>
	                        <span> 41453 </span>
	                    </li>
	                    <li class="statistic-item">
	                        <span>Trong tuần: </span>
	                        <span> 41453 </span>
	                    </li>
	                    <li class="statistic-item">
	                        <span>Trong tháng: </span>
	                        <span> 41453 </span>
	                    </li>
	                </ul>
	            </div>
	        </div>
	        <div class="footerFanpage">
	            <h4>Fanpage</h4>
	            <div class="contentFanpage">
				<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fpavietnam.com.vn%3Fref%3Dembed_page&tabs=timeline&width=334&height=330&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="100%" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
	            </div>
	        </div>
	    </section>
	</section>
	<section class="footerEnd">
	    <section class="container">
	        <div class="contentFooterEnd flex items-center justify-center">
	            <h4>Thiết Kế Website bởi P.A Việt Nam</h4>
	            <a href="#" class="footerEndLink">
	                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logofooter.webp" alt="">
	            </a>
	        </div>
	    </section>
	</section>
	<section class="scollTop">
	    <a href="#" class="scrollTopLink" id="scrollTopLink">
			<i class="fas fa-chevron-up"></i>
	    </a>
	</section>
	<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="teRs8CgB"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
></script>
<script src="https://cdnjs.cloudflare.com/a	jax/libs/ion-rangeslider/2.2.0/js/ion.rangeSlider.min.js"></script>
	<?php wp_footer(); ?>

	</body>

	</html>