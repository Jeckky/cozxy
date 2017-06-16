/**
 * Created by npr on 5/17/2017 AD.
 */
$(function () {
    var ww = $(window).width();
    if (ww > 992) {
        descSet();
    }
});
function descSet() {
    var ww = $(window).width();
    if (ww > 992) {
        var pg = $('.cart-body').height() - 92;
        $('.total-price').css('min-height', pg + 'px');
    }
}
$(window).resize(function () {
    descSet();
});

/*
 * use after add to cart
 * @param {type} y
 * @param {type} x
 * @param {type} productSuppId
 * @param {type} orderId
 * @param {type} sendDate
 * @param {type} orderItemId
 * @returns {undefined}
 */
function qSet(y, x, productSuppId, orderId, sendDate, orderItemId) {
    var temp = parseInt($('.quantity-' + y).val());

    //alert(temp);

    if (isNaN(temp)) {
        temp = 1;
    }
    temp += x;
    if (temp < 1) {
        temp = 1;
    }
    $('.quantity-' + y).val(temp);
    if (temp > 1) {
        $('.multi-' + y).html(temp + ' x ');
    } else {
        $('.multi-' + y).html('');
    }
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "cart/change-quantity-item-and-save",
        data: {productSuppId: productSuppId, quantity: temp, sendDate: sendDate},
        success: function (data)
        {
            if (data.status) {
                $('.price-detail').find('.summaryFormatText').html(data.cart.summaryFormatText + ' THB');
                $('.price-detail').find('.totalFormatText').html(data.cart.totalWithoutDiscountText + ' THB');
                $('.price-detail').find('.discountFormatText').html(data.cart.discountFormatText + ' THB');
                $('.qty-cart').find('#qty-cart-show-' + orderItemId).html(temp);

                $.ajax({
                    type: "POST",
                    url: $baseUrl + "cart/get-product-quantity",
                    data: {},
                    success: function (data, status)
                    {
                        if (status == "success") {
                            $('#notify-cart-top-menu').html(data);
                        } else {

                        }
                    }
                });

                /*$button.parent().parent().find(".price").html(data.priceText);

                 $button.parent().parent().find(".total").html(data.subTotalText + " ฿");
                 $button.parent().find("input").val(temp.toFixed(2));
                 $('.cart-dropdown table').find('tbody').find("#item" + data.orderItemId).find(".qty").find("#qty").val(temp.toFixed(2));
                 $('.cart-dropdown table').find('tbody').find("#item" + data.orderItemId).find(".price").html(data.priceText);
                 $('.cart-btn a span').text(data.cart.qty);
                 $('.cart-btn a').find("#cartTotal").html(data.cart.summaryFormatText);
                 $('.cart-dropdown').find(".footer").find('.total').html(data.cart.summaryFormatText);
                 $('.shopping-cart').find(".cart-sidebar").find(".subtotal").html(data.cart.totalWithoutDiscountText + " ฿");
                 $('.shopping-cart').find(".cart-sidebar").find(".total").html(data.cart.totalFormatText + " ฿");
                 $('.shopping-cart').find(".cart-sidebar").find(".savings").html("-" + data.cart.totalItemDiscountText + " ฿");
                 $('.shopping-cart').find(".cart-sidebar").find(".shipSavings").html("-" + data.cart.shippingDiscountValueText + " ฿");
                 $('.shopping-cart').find(".cart-sidebar").find(".discount").html(data.cart.discountFormatText + " ฿");
                 $('.shopping-cart').find(".cart-sidebar").find(".summary").html(data.cart.summaryFormatText + " ฿");
                 if (parseInt(data.saving) > 0)
                 {
                 $('.shopping-cart').find(".items-list").find("#item" + data.orderItemId).find(".savings").html("You Saved " + data.savingText + " ฿");
                 $('.shopping-cart').find(".items-list").find("#item" + data.orderItemId).find(".savings").removeClass("hide");
                 } else
                 {
                 $('.shopping-cart').find(".items-list").find("#item" + data.orderItemId).find(".savings").addClass("hide");
                 }
                 if (parseInt(data.shippingDiscountValue) > 0)
                 {
                 $('.shopping-cart').find(".items-list").find("#item" + data.orderItemId).find(".shipSavings").html("Shipping Saved " + data.shippingDiscountValueText + " ฿");
                 $('.shopping-cart').find(".items-list").find("#item" + data.orderItemId).find(".shipSavings").removeClass("hide");
                 } else
                 {
                 $('.shopping-cart').find(".items-list").find("#item" + data.orderItemId).find(".shipSavings").addClass("hide");
                 }*/
            } else
            {
                if (data.errorCode === 1)
                {
                    temp = temp - 1;
                    alert("Cannot order more than the specified number.");
//                    $('.incr-btn').popover('show');
                    //$('.quantity-sel').find('#quantity').val(temp);
                    $('.quantity-' + y).val(temp);
                    $('.multi-' + y).html(temp + ' x ');
                    $('.qty-cart').find('#qty-cart-show').html(temp);
                }
                //$button.parent().find("input").val(temp.toFixed(2));
            }
        }
    });
}


function proceed(data) {
    var shop_data = data;
    if (shop_data == 'apply_coupon') {
        couponCode = $("#coupon-code").val();

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "cart/add-coupon",
            data: {couponCode: couponCode},
            success: function (data)
            {
                if (data.status)
                {
                    //alert($('.shopping-cart .cart-sidebar .cart-totals .cartTotalRight').html(''));
                    /* $('.shopping-cart .cart-sidebar .cart-totals .cartTotalRight').append(
                     '<tr class="alert alert-warning" ><td style="font-size:12px"><b>Coupon</b> ' + data.cart.couponCode + '</td>' +
                     '<td class="discount align-r">' + data.cart.discountFormatText + '</td>' +
                     '</tr>'
                     );
                     $('.shopping-cart .cart-sidebar .cart-totals .summary').text(data.cart.summaryFormatText + " ฿");*/
                    $('.price-detail').find('.promo-coupon-codes-code').html('<span class=\'label label-primary\'>' + data.cart.couponCode + '</span>');
                    $('.price-detail').find('.promo-coupon-codes').html(data.cart.discountFormatText + ' THB');
                    $('.open-coupon-trash').removeClass('hidden');
                    $('.open-coupon-trash').addClass('display');
                    $('.price-detail').find('.summaryFormatText').html(data.cart.summaryFormatText + ' THB');
                    $("#coupon-code").val('');
                    $('.price-detail').find('.coupon').removeClass("hidden");
                } else
                {
                    alert(data.message);
                }
            }
        });
    } else if (shop_data == 'update_cart') {
        window.location = $baseUrl + 'history';
    } else if (shop_data == 'to_checkout') {
        window.location = $baseUrl + 'checkout';
    } else if (shop_data == 'to_guest') {
        window.location = $baseUrl + 'register/login';
    } else if (shop_data == '') {
        //window.location = '' ;
    } else {
        window.location = '';
    }
}

/*
 * ise delete items to cart
 * @param {type} ItemOrderId
 * @returns {undefined}
 */

function deleteItemCart(ItemOrderId) {
    //alert(ItemOrderId);

    if (confirm('Sure to delete item') == true) {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + 'cart/delete-cart-item',
            //data: {maxQnty: $maxQnty},
            data: {id: ItemOrderId},
            success: function (data)
            {
                if (data.status)
                {
                    $('.price-detail').find('.summaryFormatText').html(data.cart.summaryFormatText + ' THB');
                    $('#item' + ItemOrderId).remove();
                    $.ajax({
                        type: "POST",
                        url: $baseUrl + "cart/get-product-quantity",
                        data: {},
                        success: function (data, status)
                        {
                            if (status == "success") {
                                $('#notify-cart-top-menu').html(data);
                                $('.price-detail').find('.summaryFormatText').html(data.cart.summaryFormatText + ' THB');
                                $('.price-detail').find('.totalFormatText').html(data.cart.totalWithoutDiscountText + ' THB');
                                $('.price-detail').find('.discountFormatText').html(data.cart.discountFormatText + ' THB');
                            } else {

                            }
                        }
                    });
                }
            }
        });
    } else {
        //window.confirm("Sure to delete item");
    }

}


/*
 * Before Add To Cart
 * @param {type} y
 * @param {type} x
 * @param {type} productSuppId
 * @param {type} orderId
 * @param {type} sendDate
 * @param {type} orderItemId
 * @returns {undefined}
 */
function qSets(y, x, productSuppId, orderId, sendDate, orderItemId) {
    var temp = parseInt($('.quantity-' + y).val());

    //alert(temp);

    /* if (isNaN(temp)) {
     temp = 1;
     }
     temp += x;
     if (temp < 1) {
     temp = 1;
     }*/
    $('.quantity-' + y).val(temp);
    if (temp > 1) {
        $('.multi-' + y).html(temp + ' x ');
    } else {
        $('.multi-' + y).html('');
    }

}

/*
 *
 */

$('.cancelCouponCode').click(function () {
    if (confirm("Do you want to remove discount coupon.")) {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "cart/delete-coupon",
            data: {'id': id},
            success: function (data, status)
            {
                if (status == "success") {
                    $('.price-detail').find('.coupon').addClass("hidden");
//                alert(JSON.stringify(data.cart));
                    $('.price-detail').find('.discountFormatText').html("<span style='color:black'>0 THB<span>");
                    $('.price-detail').find('.summaryFormatText').html(data.cart.summaryFormatText + ' THB');
//                $('.price-detail').find('.summaryFormatText').html("xxx");
                    $('.price-detail').find('.totalFormatText').html(data.cart.totalWithoutDiscountText + ' THB');
                } else {

                }
            }
        });
    }
});

//