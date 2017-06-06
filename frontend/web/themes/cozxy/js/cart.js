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

function qSet(y, x, productSuppId, orderId, sendDate) {
    var temp = parseInt($('.quantity-' + y).val());

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
                    alert("ไม่สามารถสั่งซื้อเกินจำนวนที่กำหนดได้");
//                    $('.incr-btn').popover('show');
                }
                $button.parent().find("input").val(temp.toFixed(2));
            }
        }
    });
}


