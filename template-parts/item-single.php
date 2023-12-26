<div class="swiper-slide">
    <a href="<?php the_permalink(); ?>">
        <div class="sliderImage">
            <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'thumbnail d-block w-100')); ?>
        </div>
        <h3 class="titleSlider">
            <?php the_title(); ?>
        </h3>
        <div class="timeDateSlider flex items-center">
            <span class="iconCalenderSlider">
                <i class="fas fa-calendar-alt"></i>
            </span>
            <div class="timeDateItem">
                <span class="timeItem"><?php echo get_the_date('d/M/y'); ?></span>
                <span class="dateItem"><?php echo get_the_time('H:i:s'); ?></span>
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
        <div class="descriptSlider">
            <?php the_excerpt(); ?>
        </div>
    </a>
</div>