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
                } else
                {
                    alert(data.message);
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

$('.checkout_update_address_shipping').on('click', function () {
    //alert('Id Name : ' + $(this).find('input').attr('id'));
    //alert('Value : ' + $(this).find('input').val());

    var address = $(this).find('input').attr('id');
    var addressIdValue = $(this).find('input').val();

    $.ajax({
        type: "POST",
        url: '',
        data: $("#idForm").serialize(), // serializes the form's elements.
        success: function (data)
        {
            //alert(data); // show response from the php script.
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

});

$('.checkout_select_address_billing').on('click', function () {
    //alert('Id Name : ' + $(this).find('input').attr('id'));
    // alert('Value : ' + $(this).find('input').val());
    var addressId = $(this).find('input').attr('id');
    var addressIdValue = $(this).find('input').val();
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


     */

});

$('.updateBillingCancel').on('click', function () {
    $("#billingUpdate").addClass("hide");
});

$('.checkout_update_address_billing').on('click', function () {
//    alert('Id Name : ' + $(this).find('input').attr('id'));
//    alert('Value : ' + $(this).find('input').val());

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


     */

});

$('.checkout_select_address_shipping').on('click', function () {
});

/*
 $('#address-countryid').prop("disabled", false);
 $('#address-provinceid').prop("disabled", false);
 $('#address-amphurid').prop("disabled", false);
 $('#address-districtid').prop("disabled", false);
 */

$('.updateShippingCancel').on('click', function () {
    $("#shippingUpdate").addClass("hide");
});

var showBillingAddress = false;
$('.ship-to-dif-adress').on("click", function () {
    if (!showBillingAddress)
    {
        $(".shippingArea").removeClass("hide");
        showBillingAddress = true;
    } else
    {
        $(".shippingArea").addClass("hide");
        showBillingAddress = false;
    }
});

// 12/7/2016 Create By Taninut.B ,

$(".reveal_current").on('click', function () {
    var $pwd1 = $(".pwd1");
    var $btn_title_current = $('.reveal-title-current');
    $btn_title_current.html('Show');
    if ($pwd1.attr('type') === 'password') {
        $pwd1.attr('type', 'text');
        $btn_title_current.html('Show');
    } else {
        $pwd1.attr('type', 'password');
        $btn_title_current.html('Hidden');
    }
});

$(".reveal_new").on('click', function () {
    var $pwd2 = $(".pwd2");
    var $btn_title_new = $('.reveal-title-new');
    $btn_title_new.html('Show');
    if ($pwd2.attr('type') === 'password') {
        $pwd2.attr('type', 'text');
        $btn_title_new.html('Show');
    } else {
        $pwd2.attr('type', 'password');
        $btn_title_new.html('Hidden');
    }
});

$(".reveal_re").on('click', function () {
    var $pwd3 = $(".pwd3");
    var $btn_title_re = $('.reveal-title-re');
    $btn_title_re.html('Show');
    if ($pwd3.attr('type') === 'password') {
        $pwd3.attr('type', 'text');
        $btn_title_re.html('Show');
    } else {
        $pwd3.attr('type', 'password');
        $btn_title_re.html('Hidden');
    }
});

/* $('#reFormMember').modal({
 show: 'false'
 });
 */

// 25/7/2016 Create By Taninut.B

$("#place-order").on('click', function () {

    var _shipping = $('input[id=checkout_select_address_shipping]:checked').val();
    var _billing = $('input[id=checkout_select_address_billing]:checked').val();
    var _payment01 = $('input[id=payment01]:checked').val();
    var _placeUserId = $('input[id=placeUserId]').val();
    var _placeOrderId = $('input[id=placeOrderId]').val();
    var _notes = $("#order-notes").val();

    if (_shipping === undefined) {
        alert('Please Select Shipping Address');
    } else {
        if (_billing === undefined) {
            $.post("checkout/burn-checkouts", {
                shipping: _shipping,
                payment01: _payment01,
                placeUserId: _placeUserId,
                notes: _notes,
                placeOrderId: _placeOrderId
            }, function (data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                // window.location = 'checkout/order-thank';
            });
        } else if (_billing != undefined) {
            $.post("checkout/burn-checkouts", {
                shipping: _shipping,
                billing: _billing,
                payment01: _payment01,
                placeUserId: _placeUserId,
                notes: _notes,
                placeOrderId: _placeOrderId
            }, function (data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                // window.location = 'checkout/order-thank';
            });

        }
    }
    // $this->redirect(['order-thank']);
});

$("#btn-checkout-formShipping").on('click', function () {
    //alert('Id Name : ' + $(this).find('input').attr('id'));
    //alert('Value : ' + $(this).find('input').val()); Address[countryId]
    var x = document.getElementsByName("countryId");
    var inputs = $('#default-shipping-address').getElementsByTagName('input');
    //alert(inputs);
    //alert('test : formShipping');
    // $this->redirect(['order-thank']);
});

$("#btn-checkout-formBilling").on('click', function () {
    //alert('Id Name : ' + $(this).find('input').attr('id'));
    //alert('Value : ' + $(this).find('input').val());
    //alert('test : formBilling');
    // $this->redirect(['order-thank']);
});
