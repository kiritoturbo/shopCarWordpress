<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Lấy thông tin từ biểu mẫu
    $fullname = sanitize_text_field($_POST['fullname']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $receive_fullname = sanitize_text_field($_POST['receive_fullname']);
    $receive_phone = sanitize_text_field($_POST['receive_phone']);
    $receive_address = sanitize_text_field($_POST['receive_address']);
    $to_district = sanitize_text_field($_POST['to_district']);
    $note_customer = sanitize_text_field($_POST['note_customer']);

    // Tạo một đơn hàng mới
    $order = wc_create_order();

    // Thêm thông tin người mua hàng vào đơn hàng
    $order->set_customer_id(get_current_user_id());
    $order->set_billing_first_name($fullname);
    $order->set_billing_email($email);
    $order->set_billing_phone($phone);

    // Thêm thông tin người nhận hàng và địa chỉ nhận hàng
    $order->set_shipping_first_name($receive_fullname);
    $order->set_shipping_phone($receive_phone);
    $order->set_shipping_address_1($receive_address);
    $order->set_shipping_city($to_district);

    // Thêm sản phẩm vào đơn hàng từ giỏ hàng
    if (WC()->cart->get_cart_contents_count() > 0) {
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $product_id = $cart_item['product_id'];
            $product_qty = $cart_item['quantity'];
            $product_variation_id = $cart_item['variation_id'];
            
            $order->add_product(wc_get_product($product_id), $product_qty, array(), $product_variation_id);
        }
    }

    // Lưu đơn hàng
    $order->calculate_totals();
    $order->save();

    // Xóa giỏ hàng
    WC()->cart->empty_cart();

    // Chuyển hướng đến trang cảm ơn
    // wp_redirect(woocommerce_get_page_permalink('thanks'));
    exit();
}

// Hiển thị form đặt hàng
?>
<section class="mainCheckout">
        <section class="container">
            <div class="wrapperContentCheckout">
                <h3 class="titleContentCheckout">Thanh Toán</h3>
                <div class="wrapperBottom flex">
                    <div class="paymentContentLeft">
                        <div class="wrapperTitleCheckout flex items-center">
                            <i class="fas fa-map-marker-alt"></i>
                            <h3 class="payment-title--local uppercase"> Thông tin khách hàng</h3>
                        </div>
                        <div class="paymentCustomerInfo">
                            <div class="registerInfoCustomer flex">
                                <div class="registerInfoCustomerLeft">
                                    <h3 class="payment-customer-title">Người mua hàng</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group required">
												<input name="fullname" id="fullname" placeholder="Họ và tên" value="" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group ">
												<input name="email" id="email" placeholder="Email" class="form-control"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group required">
												<input name="phone" id="phone" placeholder="Điện thoại" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="registerInfoCustomerRight">
                                    <h3 class="payment-customer-title">Người nhận hàng</h3>
                                    <div class="form-group required"><input name="receive_fullname" id="receive_fullname"
                                            placeholder="Họ và tên" 
                                             class="form-control"></div>
                                    <div class="form-group required"><input name="receive_phone" id="receive_phone"
                                            placeholder="Điện thoại" 
                                            class="form-control w30s-verify-phone-value"></div>
                                    <div class="form-group"><a href="#" class="w30s-copy-receive"><i
                                                class="fa fa-copy"></i> Sử dụng thông tin người mua hàng </a></div>
                                </div>
                            </div>
                            <div class="bottomRegisterInfo">
                                <div class="box-inline-title-checkbox">
                                    <div class="form-group w30s-choose-transport"><label>* Bạn có muốn nhận hàng trực
                                            tiếp tại shop ?</label><label
                                            class="w30s-checkbox-switch w30s-checkbox-switch-blue"><input
                                                name="noshipping" type="hidden" value="1"><span
                                                class="w30s-checkbox-slider w30s-checkbox-round"></span></label></div>
                                </div>
                                <h3 class="payment-customer-title">Địa chỉ nhận hàng</h3>
                                <div class="box-transport flex">
                                    <div class="boxTransportLeft">
                                        <div class="form-group">
                                            <input name="receive_address" placeholder="Địa chỉ" id="receive_address"
                                                onfocus="this.placeholder=''" onblur="this.placeholder='Địa chỉ'"
                                                value="" class="form-control w30s-transport-address">
                                        </div>
                                        <div class="selectTinhThanh">
                                            <select name="to_district" id="">
                                                <option value="">--- Chọn tỉnh/thành ---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="boxTransportRight">
                                        <div class="selectQuanHuyen">
                                            <select name="to_district" id="">
                                                <option value="">--- Chọn quận/huyện ---</option>
                                            </select>
                                        </div>
                                        <div class="selectPhuongXa">
                                            <select name="to_district" id="">
                                                <option value="">--- Chọn phường/xã ---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrapperTitleCheckout flex items-center">
                            <i class="fas fa-money-bill-wave"></i>
                            <h3 class="payment-title--local uppercase"> Hình thức thanh toán</h3>
                        </div>
                        <div class="box-payment-method flex items-center">
                            <h4 class="w30s-payment-method payment-method-cod"> Thanh toán khi nhận hàng </h4>
                        </div>
                    </div>
                    <div class="paymentContentRight">
                        <div class="wrapperPaymentRightTitle flex items-center justify-between">
                            <div class="wrapperTitleCheckout flex items-center">
                                <i class="fas fa-cart-plus"></i>
                                <h3 class="payment-title--local uppercase"> Thông tin đơn hàng</h3>
                            </div>
                            <div class="updateProductCart">
                                <a href="#" class="updateCart">Sửa</a>
                            </div>
                        </div>
                        <div class="payment-box-Right">
                            <div class="payment-list-product">
								<?php 
								if (WC()->cart->get_cart_contents_count() > 0) {
									foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
										$product_id = $cart_item['product_id'];
										$product = wc_get_product($product_id);
										$product_name = $product->get_name();
										$product_image_url = get_the_post_thumbnail_url($product_id);
										$product_quantity = $cart_item['quantity'];
										$product_price = $product->get_price();
										?>
										<div class="list-items flex ">
											<div class="list-items-image">
												<a href="<?php echo esc_url($product_image_url); ?>" target="_blank">
													<img src="<?php echo esc_url($product_image_url); ?>" alt="<?php echo esc_attr($product_name) ?>">
												</a>
											</div>
											<div class="list-item-info">
												<div class="item-info-name"><a
														href="<?php echo esc_url($product_image_url); ?>"
														class="w30s-limit-2-lines" target="_blank"><?php echo esc_attr($product_name) ?></a></div>
												<div class="item-info-quantity px-1"><span><?php echo esc_html($product_quantity) ?></span>x </div>
												<div class="item-info-price"> <?php echo wc_price($product_price) ?> </div>
											</div>
										</div>
										<?php
									}
								}

								?>
                                
                            </div>
                            <div class="box-price">
                                <div class="box-price-item box-coupon-label box-price-product">
                                <?php $total_price = WC()->cart->get_cart_total();?>
                                    <span>Tạm tính</span>
                                    <span class="price">
                                        <span class="price-product" data-price=""><?php echo $total_price?></span>
                                    </span>
                                </div>
                                <div class="box-price-item">
                                    <span class="bold">Thành tiền</span>
                                    <span class="price">
                                        <span class="price-total" data-total="615000000"><?php echo $total_price?></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group-textarea">
                                <textarea class="form-control" rows="3" name="note_customer" placeholder="Ghi chú">
                                </textarea>
                            </div>
                            <?php 
                            
                            ?>
                            <button type="submit" class="btn-save-payment" name="woocommerce_checkout_place_order" id="place_order">Thanh Toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>



