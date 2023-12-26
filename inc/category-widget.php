<?php 
class CategoryListWidget extends WP_Widget {

function __construct() {
    parent::__construct(
        'category_list_widget',
        __('Danh mục tin tức Custom', 'text_domain'),
        array('description' => __('Hiển thị danh mục tin tức', 'text_domain'))
    );
}

public function widget($args, $instance) {
    echo $args['before_widget'];

    $title = apply_filters('widget_title', $instance['title']);
    ?>

    <div class="widgetListArchar">
        <div class="titleArcharProduct uppercase relative">
            <h2 class=""><?php echo $title; ?></h2>
            <div class="lineGrey">
                <span class="itemLineGrey"></span>
            </div>
        </div>
        <div>
            <ul>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    $category_link = get_category_link($category->term_id);
                    ?>
                    <li>
                        <a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category->name); ?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>

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

function register_category_list_widget() {
register_widget('CategoryListWidget');
}

add_action('widgets_init', 'register_category_list_widget');
