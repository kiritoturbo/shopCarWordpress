<?php
get_header();
?>
    <section class="breadcrumbs px-15">
        <section class="container ">
            <section class="breadCrumbsContent flex justify-between items-center">
                <div class="breadCrumbsLeft">
                    <h4><?php woocommerce_page_title(); ?></h4>
                </div>
                <div class="breadCrumbsRight">
                    <?php custom_breadcrumb(); ?>
                </div>
            </section>
        </section>
    </section>
    <section class="mainArcharProduct">
        <section class="container flex">
            <section class="widgetLeft">
                <div class="wrapperWidgetLeft">
                    <div class="widgetListArchar">
                         <div class="titleArcharProduct uppercase relative">
                            <h2 class="">Danh mục sản phẩm</h2>
                            <div class="lineGrey">
                                <span class="itemLineGrey"></span>
                            </div>
                        </div>
                        <div>
                            <ul>
                                <?php 
                                $terms = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => 0));
                                foreach ($terms as $key => $value) {
                                    $term_name = $value->name;
                                    $term_link = get_term_link($value, 'product_cat');
                                    ?>
                                    <li>
                                        <a href="" class="filter-category"  data-category="<?php echo esc_attr($value->slug); ?>"><?php echo $term_name?></a>
                                        <i class="fas fa-chevron-down"></i>
                                        <i class="fas fa-chevron-up d-none"></i>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="filterBrand">
                        <div class="titleArcharProduct uppercase relative">
                            <h2 class="">Lọc thương hiệu</h2>
                            <div class="lineGrey">
                                <span class="itemLineGrey"></span>
                            </div>
                        </div>
                        <div class="listFilterBrand">
                            <div class="flex flex-col justify-center">
                                <?php
                                $terms = get_terms(array(
                                    'taxonomy' => 'product_cat', // Thay 'product_cat' bằng tên taxonomy của bạn
                                    'hide_empty' => false, // Hiển thị cả các danh mục không có sản phẩm
                                ));

                                if (!empty($terms)) {
                                    foreach ($terms as $term) {
                                        ?>
                                        <label for="">
                                            <input type="checkbox" value="<?php echo esc_attr($term->term_id); ?>" name="product_category">
                                            <span class="item-name"><?php echo esc_html($term->name); ?></span>
                                        </label>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>



                    </div>

                    <div class="filterPrice">
                        <div class="titleArcharProduct uppercase relative">
                            <h2 class="">Lọc theo giá</h2>
                            <div class="lineGrey">
                                <span class="itemLineGrey"></span>
                            </div>
                        </div>
                        <div class="rangeBox">
                            <input id="range_02" class="irs-hidden-input" tabindex="-1" readonly="">
                        </div>
                    </div>

                    <div class="filterOption">
                        <div class="form-group">
                            <label>Số chỗ</label>
                            <div class="flex flex-col">
                                <label for="" class="formLabel">
                                    <input type="checkbox" value="" id="" name="">
                                    <span class="item-checkbox"></span>
                                    <span class="item-name">4 chỗ </span>
                                </label>
                                <label for=" " class="formLabel">
                                    <input type="checkbox" value="" id="" name="">
                                    <span class="item-checkbox"></span>
                                    <span class="item-name">7 chỗ </span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Động cơ</label>
                            <div class="flex flex-col">
                                <label for="" class="formLabel">
                                    <input type="checkbox" value="2-0" id="" name="">
                                    <span class="item-checkbox"></span>
                                    <span class="item-name">2.0</span>
                                </label>
                                <label for="" class="formLabel">
                                    <input type="checkbox" value="1-0" id="" name="">
                                    <span class="item-checkbox"></span>
                                    <span class="item-name">1.0</span>
                                </label>
                                <label for="" class="formLabel">
                                    <input type="checkbox" value="" id="" name="">
                                    <span class="item-checkbox"></span>
                                    <span class="item-name">turbo 1.5+</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Màu sắc</label>
                            <div class="flex flex-col">
                                <label for="" class="formLabel">
                                    <input type="checkbox" value="xanh-la" id="" name="">
                                    <span class="item-checkbox"></span>
                                    <span class="item-name">
                                        <span class="item-checkbox"></span>
                                        <span class="item-name">Xanh lá</span>
                                    </span>
                                </label>
                                <label for="" class="formLabel">
                                    <input type="checkbox" value="" id="" name="">
                                    <span class="item-checkbox"></span>
                                    <span class="item-name">
                                        <span class="item-checkbox"></span>
                                        <span class="item-name">đỏ</span>
                                    </span>
                                </label>
                                <label for="" class="formLabel">
                                    <input type="checkbox" value="" id="" name="">
                                    <span class="item-checkbox"></span>
                                    <span class="item-name">
                                        <span class="item-checkbox"></span>
                                        <span class="item-name">Cam</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

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
                                <section class="productNewCol">
                                    <div class="titleArcharProduct uppercase relative">
                                        <h2 class="">Sản phẩm mới</h2>
                                        <div class="lineGrey">
                                            <span class="itemLineGrey"></span>
                                        </div>
                                    </div>
                                    <div class="repeatProduct">
                                        <div class="boxRepeatProduct">
                                            <?php if (have_posts()) : ?>
                                            <?php while (have_posts()) : the_post(); ?>
                                                <?php get_template_part('template-parts/item-product') ?>
                                            <?php endwhile; else : ?>
                                            <p>Không có</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </section>
                    </div>
                </div>
            </section>

            <section class="productRight relative">
                <div class="contentProductRight">
                    <div class="filterCowHeader">
                        <div class="filterLimit">
                            <label>Hiển thị</label>
                            <select>
                                <option>Mặc định</option>
                                <option value="9">9</option>
                                <option value="18">18</option>
                                <option value="27">27</option>
                                <option value="36">36</option>
                                <option value="45">45</option>
                            </select>
                        </div>
                        <div class="filterSort">
                            <label>Chọn sắp xếp</label>
                            <select>
                            <option value="default">Mặc định</option>
                                <option value="name-asc">Sắp xếp theo tên (A-Z)</option>
                                <option value="name-desc">Sắp xếp theo tên (Z-A)</option>
                                <option value="price-asc">Sắp xếp theo giá (Nhỏ -> Lớn)</option>
                                <option value="price-desc">Sắp xếp theo giá (Lớn -> Nhỏ)</option>
                                <option value="sale-asc">Sắp xếp theo khuyến mãi (Có -> không)</option>
                                <option value="sale-desc">Sắp xếp theo khuyến mãi (Không -> Có)</option>
                            </select>
                        </div>
                        <div class="filterView flex justify-center">
                            <div class="viewGrid">
                                <i class="fas fa-th-large"></i>
                            </div>
                            <div class="viewList">
                                <i class="fas fa-list-ul"></i>
                            </div>
                        </div>
                    </div>
                    <div class="resultFilter">
                        <section class="productsNew">
                            <section class="">
                                <section class="productNewCol">
                                    <div class="repeatProduct">
                                        <div class="boxRepeatProduct">
                                        <?php if (have_posts()) : ?>
                                                <?php while (have_posts()) : the_post(); ?>
                                                    <?php get_template_part('template-parts/item-product') ?>
                                                <?php endwhile; ?>
                                        <?php else : ?>
                                            <p>Không có sản phẩm trong danh mục này.</p>
                                        <?php endif; ?>
                                        <?php wp_reset_postdata(); ?>
                                </section>
                            </section>
                        </section>
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
                            'prev_next' => true,
                            'prev_text' => '<i class="fas fa-angle-double-left"></i>' ,
                            'next_text' => '<i class="fas fa-angle-double-right"></i>'
                        );
                        echo '<ul class="panigationCus">';
                        echo paginate_links($paginate_args);
                        echo '</ul>';
                    ?>
                    <div class="loading-spinner"></div>
                    <div class="loading-overlay"></div>
                </div>
            </section>
        </section>
    </section>


    
<?php
get_footer();
