<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<section class="cartContainer">
    <section class="container">
        <section class="cartWrapper">
            <h4>Giỏ hàng của bạn</h4>
            <div class="cartContent">

                <?php
                // Lặp qua các sản phẩm trong giỏ hàng của WooCommerce
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    // Lấy thông tin sản phẩm
                    $product = $cart_item['data'];

                    // Lấy URL hình ảnh sản phẩm
                    $thumbnail_url = get_the_post_thumbnail_url($product->get_id(), 'thumbnail');
                    ?>

                    <div class="cartItem flex" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                        <div class="imgProductCart">
                            <?php if ($thumbnail_url) : ?>
                                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/placeholder.jpg" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="centerProductCart flex" >
                            <div class="titleProductCart"><h5><?php echo $product->get_name(); ?></h5></div>
                            <div class="descriptProductCart">
                                <div class="priceProductCart flex">
                                    <span class="titleDsProductCart">Đơn giá:</span>
                                    <span class="lastPriceProductCart"><?php echo wc_price($cart_item['data']->get_price()); ?></span>
                                </div>
                                <div class="amountProductCart flex">
                                    <span class="titleDsProductCart">Số lượng:</span>
                                    <div class="inputAmoutProductCart">
										<button class="cart-quantity-button minus" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                            <i class=" fas fa-minus "></i>
                                        </button>
										<input class="cart-quantity-input" name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]" value="<?php echo esc_attr($cart_item['quantity']); ?>" type="number" min="1">
										<button class="cart-quantity-button plus" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                            <i class=" fas fa-plus "></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="totalProductCart flex">
                                    <span class="titleDsProductCart">Tổng:</span>
                                    <span class="lastPriceProductCart"><?php echo wc_price($cart_item['line_total']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="deleteProcuctCart">
                            <a href="<?php echo esc_url(WC()->cart->get_remove_url($cart_item_key)); ?>">
                                <i class="cart-delete-icon fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>

                <?php } ?>

            </div>
            <div class="cartTotalCart">
                <div class="cartItemCart">
                    <div class="totalProductCart flex">
                        <span class="titleDsProductCart">Tổng tiền:</span>
                        <span class="lastPriceProductCarts"><?php wc_cart_totals_subtotal_html(); ?></span>
                    </div>
                    <div class="payProductCart">
                        <a class="" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="Xem thêm sản phẩm">
                            <span class="">Xem thêm sản phẩm</span>
                        </a>
                        <a class="" href="<?php echo esc_url(wc_get_checkout_url()); ?>" title="Thanh toán">
                            <span class="">Thanh toán</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>


	