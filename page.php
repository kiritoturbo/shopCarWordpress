<?php
get_header();
?>
	
	<?php get_template_part('template-parts/item-breadcumb') ?>
	<section class="px-15">
		<main id="primary" class="container py-25">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; 
			?>
		</main>
	</section>
<?php
get_footer();?>
