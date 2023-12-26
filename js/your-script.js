//slider
var swiperSlider = new Swiper(".mySwiper", {
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
  },
  autoplay: {
    delay: 3000,
  },
});

var swiper = new Swiper(".mySwiper1", {
  spaceBetween: 30,
  freeMode: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    // Khi kích thước màn hình lớn hơn hoặc bằng 768px (PC)
    768: {
      slidesPerView: 3, 
    },
    // Khi kích thước màn hình nhỏ hơn 768px (Mobile)
    0: {
      slidesPerView: 2,
    },
  },
});
window.addEventListener('load', function() {
  var swiperCompare = new Swiper(".compareContent .mySwiper", {
    slidesPerView: getSlidesPerView(), // Số lượng cột ban đầu
    spaceBetween: 1,
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    autoplay: {
      delay: 0, // Vô hiệu hóa autoplay
    },
    breakpoints: {
      // Điều chỉnh số lượng cột cho các kích thước màn hình khác nhau
      768: {
        slidesPerView: getSlidesPerView(3), // 3 cột ở kích thước 768px
      },
      1024: {
        slidesPerView: getSlidesPerView(4), // 4 cột ở kích thước 1024px
      }
    }
  });

  // Hàm để xác định số lượng cột dựa trên kích thước màn hình
  function getSlidesPerView(defaultValue = 2) {
    if (window.innerWidth >= 1024) {
      return 4; // 4 cột cho màn hình lớn hơn hoặc bằng 1024px
    } else if (window.innerWidth >= 768) {
      return 3; // 3 cột cho màn hình lớn hơn hoặc bằng 768px
    }
    return defaultValue; // Giá trị mặc định cho các kích thước màn hình nhỏ hơn
  }
  
  // Lắng nghe sự kiện resize để cập nhật số lượng cột khi thay đổi kích thước màn hình
  window.addEventListener('resize', function() {
    swiperCompare.params.slidesPerView = getSlidesPerView();
    swiperCompare.update();
  });
});


var swiperBrand = new Swiper(".mySwiperBrand", {
  slidesPerView: 6,
  spaceBetween: 30,
  freeMode: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  loop: true,
  autoplay: {
    delay: 1000,
  },
});
// var swiper3 = new Swiper(".mySwiper3", {
//   loop: true,
//   spaceBetween: 10,
//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },
//   thumbs: {
//     swiper: swiper,
//   },
// });
var swiperSingle = new Swiper(".mainSingleProduct .mySwiper", {
  spaceBetween: 10,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2Single = new Swiper(".mainSingleProduct .mySwiper2", {
  spaceBetween: 10,
  navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
  },
  thumbs: {
      swiper: swiperSingle,
  },
});


// JavaScript cho nút kéo lên đầu trang
var scrollToTopButton = document.getElementById("scrollTopLink");
window.addEventListener("scroll", function () {
  if (document.documentElement.scrollTop > 300) {
    scrollToTopButton.style.display = "flex";
  } else {
    scrollToTopButton.style.display = "none";
  }
});

scrollToTopButton.addEventListener("click", function (e) {
  e.preventDefault();
  window.scrollTo({
    top: 0,
    behavior: "smooth", // Hiệu ứng kéo mượt
  });
});


//lọc sản phẩm ở archar product
jQuery(document).ready(function ($) {
  $("select").on("change", function () {
    var limit = $(".filterLimit select").val();
    var orderby = $(".filterSort select").val();

    // Hiển thị overlay và biểu tượng xoay tròn
    $(".loading-overlay, .loading-spinner").show();

    $.ajax({
      url: my_ajax_object.ajaxurl,
      type: "POST",
      data: {
        action: "filter_products_select",
        limit: limit,
        orderby: orderby,
      },
      success: function (response) {
        // Ẩn overlay và biểu tượng xoay tròn khi nhận được kết quả
        $(".loading-overlay, .loading-spinner").hide();

        if (response.length > 0) {
          $(".resultFilter .boxRepeatProduct").html(response);
        } else {
          $(".resultFilter .boxRepeatProduct").html(
            "<p>Không có sản phẩm.</p>"
          );
        }
      },
    });
  });
});

//add cart
jQuery(document).ready(function ($) {
  $(".add-to-cart-button").on("click", function (e) {
    e.preventDefault();
    var $button = $(this);
    var product_id = $button.data("product-id");
    var ajaxDone = $button.data("ajax-done");

    if (ajaxDone !== "true") {
      $.ajax({
        type: "POST",
        url: my_ajax_object.ajaxurl,
        data: {
          action: "add_product_to_cart",
          product_id: product_id,
        },
        success: function (response) {
          $(".bottomTitleCartPc .totalProduct").html(response);
          // Sử dụng SweetAlert2 để hiển thị thông báo overlay
          Swal.fire({
            title: "Thêm thành công!",
            text: "Sản phẩm đã được thêm vào giỏ hàng.",
            icon: "success",
            confirmButtonText: "OK",
            showCancelButton: true,
            cancelButtonText: "Chuyển đến giỏ hàng",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Người dùng đã bấm nút OK
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Người dùng đã bấm nút hủy bỏ (Chuyển đến giỏ hàng)
                window.location.href = "/autoCarWordpress/gio-hang/";
            }
        });

          // Đánh dấu cờ là đã thực hiện AJAX
          $button.data("ajax-done", "true");
        },
      });
    }
  });
});

///yêu thích sản phẩm
jQuery(document).ready(function ($) {
  $(".itemGroupWidget a.favorite-button").click(function (event) {
    event.preventDefault();

    var product_id = $(this).data("product-id");

    $.ajax({
      type: "POST",
      url: my_ajax_object.ajaxurl,
      data: {
        action: "add_to_favorite",
        product_id: product_id,
      },
      success: function (response) {
        if (response == "added") {
          Swal.fire({
            title: "Thành công!",
            text: "Sản phẩm đã được thêm vào danh sách yêu thích.",
            icon: "success",
            confirmButtonText: "OK",
          });
        } else {
          Swal.fire({
            title: "Sản phẩm đã có trong danh sách!",
            text: "Bạn đã thêm sản phẩm này vào danh sách yêu thích trước đó.",
            icon: "error",
            confirmButtonText: "OK",
        });
        }
      },
    });
  });
});

//nút cộng trừ ở giỏ hàng
// Không cần thêm sự kiện click vào các phần tử .cartItem ở đây

$("body").on("click", ".cart-quantity-button", function (e) {
  e.preventDefault();

  var $button = $(this);
  var cart_item_key = $button.data("cart-item-key");
  var $quantityInput = $button.siblings(".cart-quantity-input");
  var quantity = parseInt($quantityInput.val());

  if ($button.hasClass("plus")) {
    quantity += 1;
  } else if ($button.hasClass("minus")) {
    quantity -= 1;
    if (quantity < 1) {
      quantity = 1; // Đảm bảo số lượng không nhỏ hơn 1
    }
  }

  $.ajax({
    type: "POST",
    url: ajax_object.ajaxurl,
    data: {
      action: "update_cart_item_quantity",
      cart_item_key: cart_item_key,
      quantity: quantity,
    },
    success: function (response) {
      if (response && response.data.new_quantity) {
        $quantityInput.val(response.data.new_quantity);
      }

      if (response && response.data.new_total_price) {
        var productId = $button.closest(".cartItem").data("product-id");
        $(
          ".cartItem[data-product-id='" +
            productId +
            "'] .totalProductCart .lastPriceProductCart"
        ).html(response.data.new_total_price);
        $(".bottomTitleCartPc .totalProduct").html(response.data.new_number_cart);
        $(".cartTotalCart .woocommerce-Price-amount").html(response.data.tongchung);
      }
      Swal.fire({
        title: "Thêm/bớt thành công!",
        text: "Sản phẩm đã được thêm/bớt một lần.",
        icon: "success",
        confirmButtonText: "OK",
      });

      if (response && response.data.fragments) {
        $.each(response.data.fragments, function (key, value) {
          $(key).replaceWith(value);
        });
        $(document.body).trigger("wc_fragment_refresh");
      }
    },
  });
});
//menu mobile
$(document).ready(function () {
  // Bắt sự kiện khi click vào biểu tượng mở menu
  $(".iconMenuRight").click(function () {
      $(".contentMenuMobile").css("left", "0");
      $(".overlay").css("display", "block");
  });

  // Bắt sự kiện khi click vào biểu tượng đóng menu
  $(".nav-close").click(function () {
      $(".contentMenuMobile").css("left", "-100%");
      $(".overlay").css("display", "none");
  });

  // Bắt sự kiện khi click vào overlay để đóng menu
  $(".overlay").click(function () {
      $(".contentMenuMobile").css("left", "-100%");
      $(".overlay").css("display", "none");
  });
});
//lọc theo danh mục sản phẩm
jQuery(document).ready(function ($) {
  // Bắt sự kiện click vào danh mục sản phẩm
  $(document).on("click", ".filter-category", function (e) {
      e.preventDefault();

      // Lấy danh mục sản phẩm từ thuộc tính data-category
      var category = $(this).data("category");
      $(".loading-overlay, .loading-spinner").show();
      // Gửi yêu cầu AJAX để lấy sản phẩm theo danh mục
      $.ajax({
          type: "POST",
          url: ajax_object.ajaxurl, // Địa chỉ URL của file xử lý AJAX (cần được cung cấp)
          data: {
              action: "filter_products_by_category", // Action xử lý AJAX (cần được xác định ở phía máy chủ)
              category: category, // Danh mục sản phẩm để lọc
          },
          success: function (response) {
            $(".loading-overlay, .loading-spinner").hide();
              if (response) {
                  // Hiển thị sản phẩm sau khi lọc
                  $(".productNewCol .boxRepeatProduct").html(response);
              } else {
                  console.log("Không có sản phẩm nào.");
              }
          },
      });
  });
});
// 
jQuery(function ($) {
  // Bắt sự kiện khi người dùng bấm nút "Thanh Toán" (tùy chỉnh lại ID và class cho phù hợp)
  $('#place_order').on('click', function (e) {
      e.preventDefault();
      if (typeof wp !== 'undefined' && typeof wp.user !== 'undefined' && wp.user.isLoggedIn) {
        // Người dùng chưa đăng nhập
        Swal.fire({
          title: "Lỗi",
          text: "Bạn cần đăng nhập để thanh toán",
          icon: "error",
          confirmButtonText: "OK",
        });
        return;
        } 
      // Lấy thông tin từ biểu mẫu
      var fullname = $('#fullname').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var receive_fullname = $('#receive_fullname').val();
      var receive_phone = $('#receive_phone').val();
      var receive_address = $('#receive_address').val();
      var to_district = $('#to_district').val();
      var note_customer = $('#note_customer').val();

      // Kiểm tra không để trống
      if (fullname === '') {
        alert('Vui lòng nhập họ và tên.');
        return;
      } else if (email === '') {
        alert('Vui lòng nhập địa chỉ email.');
        return;
      } else if (phone === '') {
        alert('Vui lòng nhập số điện thoại.');
        return;
      } else if (receive_fullname === '') {
        alert('Vui lòng nhập họ và tên người nhận.');
        return;
      } else if (receive_phone === '') {
        alert('Vui lòng nhập số điện thoại người nhận.');
        return;
      } else if (receive_address === '') {
        alert('Vui lòng nhập địa chỉ người nhận.');
        return;
      } else if (to_district === '') {
        alert('Vui lòng chọn quận/huyện.');
        return;
      }

      // Tạo đối tượng đơn hàng
      var orderData = {
          billing_first_name: fullname,
          billing_email: email,
          billing_phone: phone,
          shipping_first_name: receive_fullname,
          shipping_phone: receive_phone,
          shipping_address_1: receive_address,
          shipping_city: to_district,
          customer_note: note_customer,
          payment_method: 'bacs', 
          payment_method_title: 'Chuyển khoản ngân hàng', 
      };

      // Tạo đơn hàng
      $.ajax({
          type: 'POST',
          url: ajax_object.ajaxurl, 
          data: {
              action: 'create_order', 
              order_data: orderData
          },
          success: function (response) {
              Swal.fire({
                title: 'Đặt hàng thành công',
                text:   'Cảm ơn bạn đã mua hàng',
                icon: "success",
                confirmButtonText: "OK",
                showCancelButton: true,
                cancelButtonText: "Chuyển đến giỏ hàng",
                reverseButtons: true,
            })
              window.location.href = '/autoCarWordpress/';
          },
          error: function (error) {
              console.log('Lỗi khi tạo đơn hàng: ' + error);
              Swal.fire({
                title: "Lỗi!!!",
                text:error,
                icon: "error",
                confirmButtonText: "OK",
              });
          }
      });
  });
});
//compare product

jQuery(document).ready(function($) {
    $('.add-to-compare-button').on('click', function(event) {
        event.preventDefault();
        $(".loading-overlay, .loading-spinner").show();

        var productId = $(this).data('product-id');
        var productName = $(this).data('product-name');

        $.ajax({
            type: 'POST',
            url: ajax_object.ajaxurl,
            data: {
                action: 'add_product_to_compare', 
                product_id: productId,
                product_name: productName
            },
            success: function(response) {
              $(".loading-overlay, .loading-spinner").hide();
              console.log(response);
          
              if (response === 'added') {
                  // Sản phẩm đã được thêm thành công
                  Swal.fire({
                      title: "Thêm thành công!",
                      text: "Sản phẩm đã được thêm vào so sánh.",
                      icon: "success",
                      confirmButtonText: "OK",
                      showCancelButton: true,
                      cancelButtonText: "Chuyển đến so sánh",
                      reverseButtons: true,
                  }).then((result) => {
                      if (result.isConfirmed) {
                      } else if (result.dismiss === Swal.DismissReason.cancel) {
                          window.location.href = "/autoCarWordpress/compare/";
                      }
                  });
              } else if (response === 'already_added') {
                  Swal.fire({
                      title: "Sản phẩm đã có trong danh sách!",
                      text: "Bạn đã thêm sản phẩm này vào danh sách so sánh trước đó.",
                      icon: "info",
                      confirmButtonText: "OK",
                  });
              } else {
              }
          }
          
        });
    });
});

//quick view 
// Sử dụng jQuery để bắt sự kiện khi nhấp vào biểu tượng mắt
$('.open-quick-view').on('click', function(e) {
  e.preventDefault();
  
  // Lấy product_id từ thuộc tính data-product-id
  var product_id = $(this).data('product-id');
  
  // Hiển thị Quick View tương ứng
  $('#quick-view-' + product_id).show();
  // Hiển thị overlay
  $('.overlay').fadeIn();
  // Khởi tạo Swiper cho slider trong Quick View
  var swiperSingleQuick = new Swiper("#quick-view-" + product_id + " .mySwiper", {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
  });

  var swiper2SingleQuick = new Swiper("#quick-view-" + product_id + " .mySwiper2", {
      spaceBetween: 10,
      navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
      },
      thumbs: {
          swiper: swiperSingleQuick,
      },
  });

  
});

// Sử dụng jQuery để bắt sự kiện khi nhấp vào nút đóng Quick View
$('.close-quick-view').on('click', function(e) {
  e.preventDefault();
  
  // Lấy product_id từ thuộc tính data-product-id
  var product_id = $(this).data('product-id');
  
  // Ẩn Quick View tương ứng
  $('#quick-view-' + product_id).hide();
  
  // Ẩn overlay nếu không còn Quick View nào đang hiển thị
  if ($('.quick-view:visible').length === 0) {
      $('.overlay').fadeOut();
  }
});
$('.overlay').on('click', function(e) {
  e.preventDefault();
  
  // Lấy product_id từ thuộc tính data-product-id
  var product_id = $(this).data('product-id');
  
  // Ẩn Quick View tương ứng
  $('#quick-view-' + product_id).hide();
  $('.quick-view').hide();
  
  // Ẩn overlay nếu không còn Quick View nào đang hiển thị
  if ($('.quick-view:visible').length === 0) {
      $('.overlay').fadeOut();
  }
});



//info tabs
// Lắng nghe sự kiện click trên các tab
const tabLinks = document.querySelectorAll(".navTabInfoItem");
const tabContents = document.querySelectorAll(".tab-content");
const titleWrapperInfo = document.querySelector(".titleWrapperInfo");

tabLinks.forEach(function(tabLink) {
    tabLink.addEventListener("click", function(event) {
        event.preventDefault();

        // Loại bỏ lớp 'active' khỏi tất cả các tab và tab content
        tabLinks.forEach(function(link) {
            link.classList.remove("active");
        });
        tabContents.forEach(function(content) {
            content.style.display = "none";
        });

        // Thêm lớp 'active' cho tab hiện tại
        this.classList.add("active");
        const tabId = this.getAttribute("data-tab");
        const tabTitle = this.getAttribute("data-title");

        // Cập nhật tiêu đề ở h4
        titleWrapperInfo.textContent = tabTitle;

        // Hiển thị nội dung của tab hiện tại
        const currentTabContent = document.getElementById(tabId);
        if (currentTabContent) {
            currentTabContent.style.display = "block";
        }
    });
});
//xóa yêu thích 
jQuery(document).ready(function($) {
  $('.remove-from-favorites').on('click', function(e) {
      e.preventDefault();
      var $button = $(this); // Lưu trữ tham chiếu đến nút xóa
      var productId = $button.data('product-id');
      var data = {
          action: 'remove_favorite_product',
          product_id: productId
      };

      $.ajax({
          type: 'POST',
          url: ajax_object.ajaxurl, // Đặt URL của hàm xử lý Ajax ở đây
          data: data,
          success: function(response) {
              if (response === 'success') {
                  // Xóa sản phẩm khỏi danh sách ngay lập tức
                  $button.closest('.itemProduct').remove();
                  Swal.fire({
                    title: "xóa sản phẩm thành công",
                    text: "sản phẩm đã được xóa từ danh sách yêu thích.",
                    icon: "success",
                    confirmButtonText: "OK",
                  });
              } else if (response === 'not_logged_in') {
                  // Người dùng chưa đăng nhập, bạn có thể xử lý theo cách khác nếu cần thiết
                  alert('Vui lòng đăng nhập để xóa sản phẩm khỏi yêu thích.');
              }
          }
      });
  });
});



    jQuery(document).ready(function ($) {
        $('input[name="product_category"]').change(function () {
            // Lấy giá trị của checkbox đã chọn
            var selectedCategories = $('input[name="product_category"]:checked').map(function () {
                return this.value;
            }).get();

            // Gửi yêu cầu Ajax để lọc sản phẩm
            $.ajax({
                url: ajax_object.ajaxurl, // ajaxurl được tự động xác định trong WordPress
                type: 'POST',
                data: {
                    action: 'filter_products',
                    categories: selectedCategories
                },
                success: function (response) {
                    // Hiển thị sản phẩm đã lọc bằng cách thay thế nội dung sản phẩm hiện tại
                    $('.resultFilter .boxRepeatProduct').html(response);
                }
            });
        });
    });

    $("#range_02").ionRangeSlider({
      type: "double",
        min: 0,
        max: 3780000000,
        from: 0,
        to: 3780000000,
        // grid: true
  });

  $("#range_02").on('change', function (){
        // Lấy đối tượng slider
    var slider = $("#range_02").data("ionRangeSlider");

    // Lấy giá trị hiện tại của slider
    var currentValueFrom = slider.result.from;
    var currentValueTo = slider.result.to;
    // console.log("Giá trị hiện tại từ: " + currentValueFrom);
    // console.log("Giá trị hiện tại đến: " + currentValueTo);
    filterProductsByPrice(currentValueFrom, currentValueTo);
    function filterProductsByPrice(minPrice, maxPrice) {
      // Gửi yêu cầu AJAX để lọc sản phẩm theo giá
      $(".loading-overlay, .loading-spinner").show();
      $.ajax({
          type: "POST",
          url: ajax_object.ajaxurl, // Địa chỉ URL của file xử lý AJAX (cần được cung cấp)
          data: {
              action: "filter_products_by_price", // Action xử lý AJAX (cần được xác định ở phía máy chủ)
              min_price: minPrice, // Giá tối thiểu
              max_price: maxPrice, // Giá tối đa
          },
          
          success: function (response) {
              if (response) {
                $(".loading-overlay, .loading-spinner").hide();
                  // Hiển thị sản phẩm sau khi lọc
                  $(".productNewCol .boxRepeatProduct").html(response);
              } else {
                  console.log("Không có sản phẩm nào.");
              }
          },
      });
  }

  })


  jQuery(document).ready(function ($) {
    // Lắng nghe sự kiện khi các checkbox thay đổi
    $('.formLabel input[type="checkbox"]').on('change', function () {
        // Tạo một mảng để lưu trữ các giá trị biến thể được chọn
        var selectedVariants = [];

        // Lặp qua tất cả các checkbox và kiểm tra xem chúng có được chọn không
        $('.formLabel input[type="checkbox"]').each(function () {
            if ($(this).is(":checked")) {
                // Nếu được chọn, thêm giá trị vào mảng selectedVariants
                selectedVariants.push($(this).val());
            }
        });

        // Gọi hàm để lọc sản phẩm dựa trên các biến thể được chọn
        filterProductsByVariants(selectedVariants);
    });

    function filterProductsByVariants(variants) {
        // Gửi yêu cầu AJAX để lọc sản phẩm dựa trên biến thể được chọn
        $(".loading-overlay, .loading-spinner").show();
        $.ajax({
            type: "POST",
            url: ajax_object.ajaxurl, // Địa chỉ URL của file xử lý AJAX (cần được cung cấp)
            data: {
                action: "filter_products_by_variants", // Action xử lý AJAX (cần được xác định ở phía máy chủ)
                selected_variants: variants, // Mảng chứa các biến thể được chọn
            },

            success: function (response) {
                if (response) {
                    $(".loading-overlay, .loading-spinner").hide();
                    // Hiển thị sản phẩm sau khi lọc
                    $(".productNewCol .boxRepeatProduct").html(response);
                } else {
                    console.log("Không có sản phẩm nào.");
                }
            },
        });
    }
});
