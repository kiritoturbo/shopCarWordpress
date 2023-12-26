<!doctype html>
<html <?php language_attributes(); ?>>
<!-- trả về đúng ngôn ngữ của nó  -->

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.2.0/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.2.0/css/ion.rangeSlider.skinFlat.min.css">

    <?php wp_head(); ?>
    <!-- rất quan trọng ,dựa vào hook để viết code ,ở phần footer cx có  -->
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="overlay"></div>
    <div class="contentMenuMobile ">
        <div class="nav-bar-top flex">
            <a href="#" class="title-web">
                <span>Automotive</span>
            </a>
            <a href="#" class="nav-close">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <div class="menu-title-mobile">
            <?php wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'container' => 'false',
                    'menu_id' => 'header-menu',
                    'menu_class' => 'flex items-center flex-wrap w-full'
                )
            ); ?>
        </div>
    </div>
    <section class="headerContainer">
        <section class="headerTop px-15">
            <section class="headerTopContent container flex justify-between">
                <section class="headerTopContentLeft ">
                    <div class="headerTopChild flex items-center text-primary">
                        <svg class="iconHeadPhone" fill="black" preserveAspectRatio="none" viewBox="0 0 512 512" width="50px" height="50px">
                            <path d="M256 32C114.52 32 0 146.496 0 288v48a32 32 0 0 0 17.689 28.622l14.383 7.191C34.083 431.903 83.421 480 144 480h24c13.255 0 24-10.745 24-24V280c0-13.255-10.745-24-24-24h-24c-31.342 0-59.671 12.879-80 33.627V288c0-105.869 86.131-192 192-192s192 86.131 192 192v1.627C427.671 268.879 399.342 256 368 256h-24c-13.255 0-24 10.745-24 24v176c0 13.255 10.745 24 24 24h24c60.579 0 109.917-48.098 111.928-108.187l14.382-7.191A32 32 0 0 0 512 336v-48c0-141.479-114.496-256-256-256z"></path>
                        </svg>
                        <h4 class="headerTopCall">
                            <span class="headerCallContent">Gọi ngay!</span>
                        </h4>
                        <h4 class="headerTopPhoneNumber">
                            <span class="headerPhoneNumber"><?php the_field('so_dien_thoai', 'option'); ?></span>
                        </h4>
                    </div>
                </section>

                <section class="headerTopContentRight">
                    <div class="headerTopChild flex items-center">
                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'menu-top',
                                'container' => 'false',
                                'menu_id' => 'header-menu',
                                'menu_class' => 'widgetTopRight flex items-center'
                            )
                        ); ?>
                        <ul class="languageTop flex items-center">
                            <li>
                                <a href="#" title="Tiếng Việt">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vn.svg" alt="Tiếng Việt">
                                </a>
                            </li>
                            <li>
                                <a href="#" title="American">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/us.svg" alt="American">
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
            </section>
        </section>
        <section class="headerBottom px-15 bg-black">
            <section class="container">
                <section class="headerBottomSearch py-25">
                    <div class="searchChild flex items-center ">
                        <div class="wrapperSearch">
                            <form role="search" method="get" class="searchHeader relative">
                                <input class="w-full h-full outline-none" value="<?php echo get_search_query(); ?>" name="s" type="text" placeholder="Nhập từ khóa....." autocomplete="off">
                                <!-- Chú ý ở đây phải check điều kiện -->
                                <?php if (!is_category()  && !is_single()) {  ?>
                                    <input type="hidden" value="product" name="post_type">
                                <?php } ?>
                                <span class="absolute right-0">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </span>
                            </form>
                        </div>
                        <div class="logoHeader">
                            <a href="<?php bloginfo('url') ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.webp" alt="">
                            </a>
                        </div>
                        <div class="CartPC flex items-center flex-end text-white">
                            <div class="iconCartPC">
                                <a href="<?php echo wc_get_cart_url(); ?>">
                                    <i class="fas fa-cart-arrow-down"></i>
                                </a>
                            </div>
                            <div class="titleCartPC">
                                <h4>
                                    <a href="<?php echo wc_get_cart_url(); ?>" class="uppercase">Giỏ hàng</a>
                                </h4>
                                <div class="bottomTitleCartPc">
                                    <span class="titleTotalCart uppercase">Sản phẩm</span>
                                    <?php
                                    $cart_item_count = WC()->cart->get_cart_contents_count();
                                    ?>
                                    <span class="totalProduct"><?php echo $cart_item_count === 0 ? "0" : $cart_item_count; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="headerBottomMenu bg-primary">
                    <nav class="menuPC w-full uppercase">
                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'menu-1',
                                'container' => 'nav',
                                'container_class' => 'menu-container',
                                'menu_class' => 'menu flex items-center flex-wrap w-full',
                                'depth' => 5,
                                'menu_id' => 'header-menu',
                                'walker' => new Custom_Walker_Nav_Menu(), // Sử dụng custom walker
                            )
                        ); ?>
                    </nav>
                    <nav class="menuMobile flex justify-between">
                        <div class="iconHomeLeft">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="iconMenuRight">
                            <i class="fas fa-bars"></i>
                        </div>
                    </nav>
                </section>

            </section>
        </section>
    </section>