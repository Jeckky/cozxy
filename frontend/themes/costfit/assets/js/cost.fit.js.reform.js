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
    } else if (shop_data == 'to_guest') {
        window.location = 'register/login';
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


$('.checkout_select_address_billing').on('click', function () {
//alert('Id Name : ' + $(this).find('input').attr('id'));
// alert('Value : ' + $(this).find('input').val());
    var addressId = $(this).find('input').attr('id');
    var addressIdValue = $(this).find('input').val();
    // var url = "path/to/your/file"; // the script where you handle the form input.

});
$('.updateBillingCancel').on('click', function () {
    $("#billingUpdate").addClass("hide");
});
$('.checkout_update_address_shipping').on('click', function () {
//alert('Id Name : ' + $(this).find('input').attr('id'));
//alert('Value : ' + $(this).find('input').val());
    var edit_shipping = $(this).find('input').val();
    $('.actionFormEditShipping').show();
    $('.actionFormBillingNew').hide();
    $('.actionFormEditBilling').hide();
    $.post("checkout/get-address", {
        address: edit_shipping
    }, function (data, status) {

        if (status == "success") {
            var JSONObject = JSON.parse(data);
            $('.form-group').find('#' + $('.form-group').find('#countryDDId').val()).val(JSONObject.countryId).trigger('change');
            $.post("checkout/child-states", {// child-states //
                'depdrop_parents[]': JSONObject.countryId,
                'depdrop_all_params[]': JSONObject.countryId
            }, function (data, status) {
                if (status == "success") {
                    var JSONObject2 = JSON.parse(data);
                    $('.form-group').find('#' + $('.form-group').find('#statesDDId').val()).removeAttr('disabled');
                    for (i in JSONObject2.output)
                    {
                        if (JSONObject2.output[i].id === JSONObject.provinceId) {
                            //alert(JSONObject2.output[i].id);
                            $('.form-group').find('#' + $('.form-group').find('#statesDDId').val()).append('<option selected value=' + JSONObject2.output[i].id + '>' + JSONObject2.output[i].name + '</option>');
                        } else {
                            $('.form-group').find('#' + $('.form-group').find('#statesDDId').val()).append('<option value=' + JSONObject2.output[i].id + '>' + JSONObject2.output[i].name + '</option>');
                        }
                    }
//                    $('.form-group').find('#' + $('.form-group').find('#statesDDId').val()).depdrop('init');
                    $('.form-group').find('#' + $('.form-group').find('#statesDDId').val()).val(JSONObject.provinceId).trigger('change');
                } else {
                    //alert(status);
                }
                // window.location = 'checkout/order-thank';
            }); // child-states //

            $.post("checkout/child-amphur", {// child-amphur //
                'depdrop_parents[]': JSONObject.provinceId,
                'depdrop_all_params[]': JSONObject.provinceId
            }, function (data, status) {
                if (status == "success") {
                    var JSONObject2 = JSON.parse(data);
                    $('.form-group').find('#' + $('.form-group').find('#amphurDDId').val()).removeAttr('disabled');
                    for (i in JSONObject2.output)
                    {
                        if (JSONObject2.output[i].id === JSONObject.amphurId) {
                            //alert(JSONObject2.output[i].id);
                            $('.form-group').find('#' + $('.form-group').find('#amphurDDId').val()).append('<option selected value=' + JSONObject2.output[i].id + '>' + JSONObject2.output[i].name + '</option>');
                        } else
                        {
                            $('.form-group').find('#' + $('.form-group').find('#amphurDDId').val()).append('<option value=' + JSONObject2.output[i].id + '>' + JSONObject2.output[i].name + '</option>');
                        }
                    }
                    $('.form-group').find('#' + $('.form-group').find('#amphurDDId').val()).val(JSONObject.amphurId).trigger('change');
                } else {
                    //alert(status);
                }
            }); // child-amphur //

            $.post("checkout/child-district", {// child-district //
                'depdrop_parents[]': JSONObject.amphurId,
                'depdrop_all_params[]': JSONObject.amphurId
            }, function (data, status) {
                if (status == "success") {
                    var JSONObject3 = JSON.parse(data);
                    $('.form-group').find('#' + $('.form-group').find('#districtDDId').val()).removeAttr('disabled');
                    for (i in JSONObject3.output)
                    {
                        if (JSONObject3.output[i].id === JSONObject.amphurId) {
                            //alert(JSONObject2.output[i].id);
                            $('.form-group').find('#' + $('.form-group').find('#districtDDId').val()).append('<option selected value=' + JSONObject3.output[i].id + '>' + JSONObject3.output[i].name + '</option>');
                        } else
                        {
                            $('.form-group').find('#' + $('.form-group').find('#districtDDId').val()).append('<option value=' + JSONObject3.output[i].id + '>' + JSONObject3.output[i].name + '</option>');
                        }
                    }
                    $('.form-group').find('#' + $('.form-group').find('#districtDDId').val()).val(JSONObject.districtId).trigger('change');
                } else {
                    //alert(status);
                }
            }); // child-district //
            $('.form-group').find('#firstname').val(JSONObject.firstname);
            $('.form-group').find('#lastname').val(JSONObject.lastname);
            $('.form-group').find('#company').val(JSONObject.company);
            $('.form-group').find('#address').val(JSONObject.address);
            $('.form-group').find('#zipcode').val(JSONObject.zipcode);
            $('.form-group').find('#email').val(JSONObject.email);
            $('.form-group').find('#tel').val(JSONObject.tel);
            $('.form-group').find('#address-hidden').html('<input type="hidden" name="addressId" id="addressId" value="' + JSONObject.addressId + '">'); //val(JSONObject.tel);
            //$('.form-group').find('#order-notes').val('test');
            //$('.form-group').find('#address-hidden').html('<input type="hidden" name="addressId" id="addressId" value="' + JSONObject.addressId + '"> <input type="hidden" name="model_id3" id="model_id3" value="' + JSONObject.provinceId + '"> <input type="hidden" name="model_id2" id="model_id2" value="' + JSONObject.amphurId + '"> <input type="hidden" name="model_id1" id="model_id1" value="' + JSONObject.districtId + '"> <input type="hidden" name="model_id" id="model_id" value="' + JSONObject.countryId + '">');
        }

    });
});
$('.new-address-form ').on('click', function () {
    $('.form-group').find('#address-hidden').html('');
    $('.actionFormEditShipping').hide();
    $('.actionFormBillingNew').show();
    $('.actionFormEditBilling').hide();
    $('.form-group').find('#firstname').val('');
    $('.form-group').find('#lastname').val('');
    $('.form-group').find('#company').val('');
    $('.form-group').find('#address').val('');
    $('.form-group').find('#districtId').val('');
    $('.form-group').find('#amphurId').val('');
    $('.form-group').find('#provinceId').val('');
    $('.form-group').find('#zipcode').val('');
    $('.form-group').find('#email').val('');
    $('.form-group').find('#tel').val('');
    $('#formShipping').show();
    $('#formBilling').show();
});
$('.checkout_update_address_billing').on('click', function () {
//alert('Id Name : ' + $(this).find('input').attr('id'));
//alert('Value : ' + $(this).find('input').val());
    var edit_shipping = $(this).find('input').val();
    //$('.actionFormEditShipping').show();
    $('.actionFormBillingNew').hide();
    //$('.actionFormEditBilling').hide();
    $('.actionFormEditShipping').hide();
    $('.actionFormEditBilling').show();
    $.post("checkout/get-address", {
        address: edit_shipping
    }, function (data, status) {

        if (status == "success") {

            var JSONObject = JSON.parse(data);
            $('.form-group').find('#' + $('.form-group-billing').find('#countryDDId').val()).val(JSONObject.countryId).trigger('change');
            $.post("checkout/child-states", {// child-states //
                'depdrop_parents[]': JSONObject.countryId,
                'depdrop_all_params[]': JSONObject.countryId
            }, function (data, status) {
                if (status == "success") {
                    var JSONObjectB1 = JSON.parse(data);
                    $('.form-group').find('#' + $('.form-group-billing').find('#statesDDId').val()).removeAttr('disabled');
                    for (i in JSONObjectB1.output)
                    {
                        if (JSONObjectB1.output[i].id === JSONObject.provinceId) {
                            //alert(JSONObject2.output[i].id);
                            $('.form-group').find('#' + $('.form-group-billing').find('#statesDDId').val()).append('<option selected value=' + JSONObjectB1.output[i].id + '>' + JSONObjectB1.output[i].name + '</option>');
                        } else {
                            $('.form-group').find('#' + $('.form-group-billing').find('#statesDDId').val()).append('<option value=' + JSONObjectB1.output[i].id + '>' + JSONObjectB1.output[i].name + '</option>');
                        }
                    }
//                    $('.form-group').find('#' + $('.form-group').find('#statesDDId').val()).depdrop('init');
                    $('.form-group').find('#' + $('.form-group-billing').find('#statesDDId').val()).val(JSONObject.provinceId).trigger('change');
                } else {
                    //alert(status);
                }
                // window.location = 'checkout/order-thank';
            }); // child-states //

            $.post("checkout/child-amphur", {// child-amphur //
                'depdrop_parents[]': JSONObject.provinceId,
                'depdrop_all_params[]': JSONObject.provinceId
            }, function (data, status) {
                if (status == "success") {
                    var JSONObject2 = JSON.parse(data);
                    $('.form-group').find('#' + $('.form-group-billing').find('#amphurDDId').val()).removeAttr('disabled');
                    for (i in JSONObject2.output)
                    {
                        if (JSONObject2.output[i].id === JSONObject.amphurId) {
                            //alert(JSONObject2.output[i].id);
                            $('.form-group').find('#' + $('.form-group-billing').find('#amphurDDId').val()).append('<option selected value=' + JSONObject2.output[i].id + '>' + JSONObject2.output[i].name + '</option>');
                        } else
                        {
                            $('.form-group').find('#' + $('.form-group-billing').find('#amphurDDId').val()).append('<option value=' + JSONObject2.output[i].id + '>' + JSONObject2.output[i].name + '</option>');
                        }
                    }
                    $('.form-group').find('#' + $('.form-group-billing').find('#amphurDDId').val()).val(JSONObject.amphurId).trigger('change');
                } else {
                    //alert(status);
                }
            }); // child-amphur //

            $.post("checkout/child-district", {// child-district //
                'depdrop_parents[]': JSONObject.amphurId,
                'depdrop_all_params[]': JSONObject.amphurId
            }, function (data, status) {
                if (status == "success") {
                    var JSONObject3 = JSON.parse(data);
                    $('.form-group').find('#' + $('.form-group-billing').find('#districtDDId').val()).removeAttr('disabled');
                    for (i in JSONObject3.output)
                    {
                        if (JSONObject3.output[i].id === JSONObject.amphurId) {
                            //alert(JSONObject2.output[i].id);
                            $('.form-group').find('#' + $('.form-group-billing').find('#districtDDId').val()).append('<option selected value=' + JSONObject3.output[i].id + '>' + JSONObject3.output[i].name + '</option>');
                        } else
                        {
                            $('.form-group').find('#' + $('.form-group-billing').find('#districtDDId').val()).append('<option value=' + JSONObject3.output[i].id + '>' + JSONObject3.output[i].name + '</option>');
                        }
                    }
                    $('.form-group').find('#' + $('.form-group-billing').find('#districtDDId').val()).val(JSONObject.districtId).trigger('change');
                } else {
                    //alert(status);
                }
            }); // child-district //
            $('.form-group').find('#firstname').val(JSONObject.firstname);
            $('.form-group').find('#lastname').val(JSONObject.lastname);
            $('.form-group').find('#company').val(JSONObject.company);
            $('.form-group').find('#address').val(JSONObject.address);
            //$('.form-group').find('#districtId').val(JSONObject.districtId);
            //alert(JSONObject.provinceId);
            //$('.form-group').find('#' + $('.form-group').find('#statesDDId').val()).depdrop('init');
            // $('.form-group').find('#' + $('.form-group').find('#statesDDId').val()).val(JSONObject.provinceId).change();
            //$('.form-group').find('#amphurId').val(JSONObject.amphurId);
            //$('.form-group').find('#province').val(JSONObject.provinceId);
            $('.form-group').find('#zipcode').val(JSONObject.zipcode);
            $('.form-group').find('#email').val(JSONObject.email);
            $('.form-group').find('#tel').val(JSONObject.tel);
            $('.form-group').find('#address-hidden').html('<input type="hidden" name="addressId" id="addressId" value="' + JSONObject.addressId + '">'); //val(JSONObject.tel);
            //$('.form-group').find('#order-notes').val('test');
            //$('.form-group').find('#address-hidden').html('<input type="hidden" name="addressId" id="addressId" value="' + JSONObject.addressId + '"> <input type="hidden" name="model_id3" id="model_id3" value="' + JSONObject.provinceId + '"> <input type="hidden" name="model_id2" id="model_id2" value="' + JSONObject.amphurId + '"> <input type="hidden" name="model_id1" id="model_id1" value="' + JSONObject.districtId + '"> <input type="hidden" name="model_id" id="model_id" value="' + JSONObject.countryId + '">');
        }

        // window.location = 'checkout/order-thank';
    });
});
$('.checkout_select_address_shipping').on('click', function () {
    $('#formShippingUpdate').hide();
    $('#formShipping').hide();
});
$('.checkout_select_address_billing').on('click', function () {
    $('#formBillingUpdate').hide();
    $('#formBilling').hide();
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
    $('#formShipping').hide();
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
    if (_placeUserId == '') {
        $("#modal-cart-not-item").modal('show');
    }

    if (_placeOrderId == '') {
        $("#modal-cart-not-item").modal('show');
    }

    if (_placeOrderId == '') {
        //alert('สินค้าในตะกร้า 0 รายการ');
        $("#modal-cart-not-item").modal('show');
        //window.location = 'site';

    } else {
        if (_shipping === undefined) {
            //alert('Please Select Shipping Address');
            $("#modal-cart-not-shipping").modal('show');
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
/// Delete Default shipping address , Default billings address ///
$('.get-shipping-address').click(function () {
    var address_id = $(this).parent().attr('data-id');
    $("span#spanTest").attr('data-id', address_id);
});
$('.shipping-address').click(function () {

    var address_id = $(this).parent().data('id');
    $.ajax
            ({
                url: '/profile/shipping-address-delete',
                data: {"address_id": address_id},
                type: 'post',
                success: function (result)
                {
                    //alert(result);
                    if (result = 'complete') {
                        window.location = 'profile';
                    } else if (result = 'wrong') {
                        window.location = 'profile';
                    } else {
                        window.location = 'profile';
                    }
                }
            });
});

var x = "Total Height: " + screen.height;
//alert(x);
//document.getElementById('test-menu');
//$('#test-menu').setAttribute("style", "width:" + x + "px;float:left;");
//c$("#test-menu").css({"width": "" + x + "px"}).show();


/*
 $('.ship-to-dif-adress').click(function () {
 //alert('Test');
 $("#NewBilling").addClass("hidden-panel");
 //panel-toggle active
 });*/

//Add(+/-) Button Number Incrementers
$(".incr-btn-cart").on("click", function (e) {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    var newVal = 1
    if ($button.text() == "+") {
        newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below 1
        if (oldValue > 1) {
            newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
        }
        $('.incr-btn').popover('hide');
    }
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "cart/change-quantity-item",
        data: {productId: $("#productId").val(), quantity: newVal},
        success: function (data)
        {
            if (data.status)
            {
                $('.price').html(data.price);
                if (data.discountValue != "null")
                {
                    $('.discountPrice').html(data.discountValue + " ฿ extra offyour order");
                } else
                {
                    $('.discountPrice').html("&nbsp;Add more than 1 item to your order");
                }
                $('#pp' + oldValue).removeClass("priceActive");
                $('#pp' + newVal).addClass("priceActive");

                $button.parent().find("input").val(newVal);
            } else
            {
                if (data.errorCode === 1)
                {
                    newVal = newVal - 1;
                    $('.incr-btn').popover('show');
                }
                $button.parent().find("input").val(newVal);
            }
        }
    });
});

function itemzero(items, title) {

    var item_cart = $('.total').html()

    if (title == 'cart') {
        if (item_cart == '0.00') {
            $("#modal-cart-not-item").modal('show');
        } else {
            window.location = 'cart';
        }
    } else if (title == 'checkout') {
        if (item_cart == '0.00') {
            $("#modal-cart-not-item").modal('show');
        } else {
            window.location = 'checkout';
        }
    }
}

