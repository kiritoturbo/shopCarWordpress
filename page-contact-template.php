<?php
/*
 Template Name: Contact
 */
get_header();
?>
<?php get_template_part('template-parts/item-breadcumb') ?>
<section class="mainContactLienHe  px-15">
        <section class="container flex">
            <section class="mainContactLeft">
                <div class="mainContactLeftContent">
                    <span class="sologanContactContent">Hãy đến với chúng tôi để bạn có những sản phẩm ưng ý nhất. Chi tiết:</span>
                    <div class="addressPhoneContact">
                        <div class="contentAddressContact">
                            <div class="titleContentAddContact">
                                Địa chỉ:
                            </div>
                            <p>
                                <?php the_field('dia_chi', 'option');?>
                            </p>
                        </div>
                        <div class="contentPhoneContact">
                            <div class="titleContentPhoneContact">
                                Phone:       
                            </div>
                            <p>
                                <?php the_field('so_dien_thoai', 'option'); ?>
                            </p>
                        </div>
                        <div class="contentEmailContact">
                            <div class="titleContentEmailContact">
                                Email:   
                            </div>
                            <p><?php the_field('email_contact_option', 'option'); ?></p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="mainContactRight">
                <div class="mainContactRightContent">
                    <form action="" class="formLink">
                        <div class="wrapperFormControl">
                            <div class="formControlName formControl">
                                <input value="" name="fullname" type="text" placeholder="Họ và tên" autocomplete="off">
                            </div>
                            <div class="formControlEmail formControl">
                                <input value="" name="email" type="text" placeholder="Email" autocomplete="off">
                            </div>
                            <div class="formControlPhone formControl">
                                <input value="" name="phone" type="text" placeholder="Số điện thoại" autocomplete="off">
                            </div>
                            <div class="formControlAddress formControl">
                                <input value="" name="address" type="text" placeholder="Địa chỉ" autocomplete="off">
                            </div>
                            <div class="formControlTextbox formControl">
                                <textarea value="" name="content" rows="3" placeholder="Nội dung" autocomplete="off"></textarea>
                            </div>
                            <div class="formControlCaptcha formControl  ">
                                <input value="" name="captcha" type="text" placeholder="Mã bảo mật" autocomplete="off">
                                <div class="keyCapchaControl">
                                    <img src="https://demo037023.web30s.vn/captcha/create?background=transparent&amp;type=all&amp;font_color=495057&amp;length_text=5&amp;font_family=&amp;key=contact-form"/>
                                    <a class="btn-refresh-captcha">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="btn-submit flex items-center">
                                <a href="" class="sendForm">
                                    <i class="fas fa-paper-plane "></i>
                                    <span class="">
                                        Gửi đi
                                    </span>
                                </a>
                                <a href="" class="resetTextBox">
                                    <i class="w30s-icon fas fa-sync-alt "></i>
                                    <span class="w30s-content "><span class="w30s-content">Làm lại</span></span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </section>
    </section>
    <section class="iframeMap px-15">
        <section class="container">
            <div class="wrapperMap">
                <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=100%25&amp;q=&amp;hl=en&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
        </section>
    </section>
<?php
get_footer();
?>