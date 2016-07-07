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

// Create date 6/7/2016 By Pew , ReFrom By :

$('#see-more-search-cost-fit').on('click', function () {
    var $btn = $(this);
    $btn.button('loading');
    // simulating a timeout
    setTimeout(function () {
        $btn.button('reset');
    }, 1000);
})

// Create date 7/7/2016 By Pew , ReFrom By :

$('.checkout_select').on('click', function () {
    alert('Id Name : ' + $(this).find('input').attr('id'));
    alert('Value : ' + $(this).find('input').val());

    // var url = "path/to/your/file"; // the script where you handle the form input.

    /*$.ajax({
     type: "POST",
     url: url,
     data: $("#idForm").serialize(), // serializes the form's elements.
     success: function (data)
     {
     alert(data); // show response from the php script.
     //$('.form-group').find('#co-country').val('Australia');
     //$('.form-group').find('#co-first-name').val('นายกมล');
     //$('.form-group').find('#co-last-name').val('พวงเกษม');
     //$('.form-group').find('#co-str-adress').val('เลขที่ 1 ชั้น 7 ซอยลาดพร้าว 19 จอมพล จตุจักร กรุงเทพ 10900');
     //$('.form-group').find('#co-appartment').val('test');
     //$('.form-group').find('#co-company-name').val('test');
     //$('.form-group').find('#co-city').val('test');
     //$('.form-group').find('#co-state').val('test');
     //$('.form-group').find('#co_postcode').val('10900');
     //$('.form-group').find('#co-email').val('นายกมล');
     //$('.form-group').find('#co_phone').val('0616539889');
     $('.form-group').find('#order-notes').val('test');
     }
     });

     e.preventDefault(); // avoid to execute the actual submit of the form.
     */

    // Test
    $('.form-group').find('#co-country').val('Australia');
    $('.form-group').find('#co-first-name').val('นายกมล');
    $('.form-group').find('#co-last-name').val('พวงเกษม');
    $('.form-group').find('#co-str-adress').val('เลขที่ 1 ชั้น 7 ซอยลาดพร้าว 19 จอมพล จตุจักร กรุงเทพ 10900');
    $('.form-group').find('#co-appartment').val('test');
    $('.form-group').find('#co-company-name').val('test');
    $('.form-group').find('#co-city').val('test');
    $('.form-group').find('#co-state').val('test');
    $('.form-group').find('#co_postcode').val('10900');
    $('.form-group').find('#co-email').val('นายกมล');
    $('.form-group').find('#co_phone').val('0616539889');
    $('.form-group').find('#order-notes').val('test');
});
