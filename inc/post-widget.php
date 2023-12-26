<?php 
class LatestNewsWidget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'latest_news_widget',
            __('Tin Tức Mới Nhất Custom', 'fimetech'),
            array('description' => __('Hiển thị tin tức mới nhất', 'fimetech'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $title = apply_filters('widget_title', $instance['title']);
        // if (!empty($title)) {
        //     echo $args['before_title'] . $title . $args['after_title'];
        // }
        ?>

        <section class="productNewCol">
            <div class="titleArcharProduct uppercase relative">
                <h2 class=""><?php echo $title; ?></h2>
                <div class="lineGrey">
                    <span class="itemLineGrey"></span>
                </div>
            </div>
            <div class="postWidget">
                <div class="postWrapperBox">
                    <?php
                    $args = array(
                        'post_type' => 'post', 
                        'posts_per_page' => 4,
                        'orderby' => 'date', 
                        'order' => 'DESC',
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            ?>
                            <div class="postItemBox">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                                <div class="decriptPostWidget">
                                    <h3 class="titlePostWidget"><?php the_title(); ?></h3>
                                    <div class="dateTimePostWidget">
                                        <span class="datePostWidget">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <span class="timePostWidget">
                                            <p><?php echo get_the_date('d/m/Y'); ?></p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Tiêu đề:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

function register_latest_news_widget() {
    register_widget('LatestNewsWidget');
}

add_action('widgets_init', 'register_latest_news_widget');
