/*  By  Taninut.B , 7/5/2016 */

function proceed(data) {
    var shop_data = data;
    if (shop_data == 'apply_coupon') {
        //window.location = '';
        couponCode = $(".coupon").find("#coupon-code").val();
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "cart/add-coupon",
            data: {couponCode: couponCode},
            success: function (data)
            {
                if (data.status)
                {
//                    alert($('.shopping-cart .cart-sidebar .cart-totals .cartTotalRight').html());
                    $('.shopping-cart .cart-sidebar .cart-totals .cartTotalRight').append(
                            '<tr class="alert alert-info"><td>Discount Coupon :' + data.cart.couponCode + '</td>' +
                            '<td class="">' + data.cart.discount + '</td>' +
                            '</tr>'
                            );
                }
            }
        });
    } else if (shop_data == 'update_cart') {
        window.location = 'history';
    } else if (shop_data == 'to_checkout') {
        window.location = 'checkout';
    } else if (shop_data == '') {
        //window.location = '' ;
    } else {
        window.location = '';
    }
}