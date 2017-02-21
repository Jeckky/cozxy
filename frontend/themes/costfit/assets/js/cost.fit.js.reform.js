/*  By  Taninut.B , 7/5/2016 */
var $addToWishlistBtn = $('#addItemToWishlist');
var $addedToCartMessage = $('.cart-message');
//var userLang = navigator.language || navigator.userLanguage;
//alert("The language is: " + userLang);
//alert(window.location.pathname);

var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost' || window.location.host == 'dev') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cost.fit-frontend/';
} else if (window.location.host == '192.168.100.8' || window.location.host == '192.168.100.20') {
    //console.log($baseUrl);
    var str = window.location.pathname;
    var res = str.split("/");
    //console.log(window.location.pathname);
    //console.log(res);
    // console.log(res[1])
    $baseUrl = window.location.protocol + "//" + window.location.host + '/' + res[1] + '/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}

//alert($baseUrl);

function proceed(data) {
    var shop_data = data;
    if (shop_data == 'apply_coupon') {
        //window.location = '';
        couponCode = $(".coupon").find("#coupon-code").val();
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "cart/add-coupon",
            data: {couponCode: couponCode},
            success: function (data)
            {
                if (data.status)
                {
//                    alert($('.shopping-cart .cart-sidebar .cart-totals .cartTotalRight').html());
                    $('.shopping-cart .cart-sidebar .cart-totals .cartTotalRight').append(
                            '<tr class="alert alert-warning" ><td style="font-size:12px"><b>Coupon</b> ' + data.cart.couponCode + '</td>' +
                            '<td class="discount align-r">' + data.cart.discountFormatText + '</td>' +
                            '</tr>'
                            );
                    $('.shopping-cart .cart-sidebar .cart-totals .summary').text(data.cart.summaryFormatText + " ฿");
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
    //alert(edit_shipping);
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
    //alert('test');
    var _shipping = $('input[id=checkout_select_address_shipping]:checked').val();
    var _billing = $('input[id=checkout_select_address_billing]:checked').val();
    var _payment01 = $('input[id=payment01]:checked').val();
    var _placeUserId = $('input[id=placeUserId]').val();
    var _placeOrderId = $('input[id=placeOrderId]').val();
    var _countItems = $('input[id=countItems]').val();
    var _notes = $("#order-notes").val();
    if (_placeUserId == '') {
        $("#modal-cart-not-item").modal('show');
    }

    /*
     * Increate 26/9/2016 By Taninut.BM
     */
    //var provinceid = $('input[id=pickingpoint-provinceid]').val();
    //var amphurid = $('input[id=pickingpoint-amphurid]').val();
    //var pickingid = $('input[id=pickingpoint-pickingid]').val();
    var eProvinceid = document.getElementById("pickingpoint-provinceid");
    if (eProvinceid != null) {
        var provinceid = eProvinceid.options[eProvinceid.selectedIndex].value;

        var eAmphurid = document.getElementById("pickingpoint-amphurid");
        var amphurid = eAmphurid.options[eAmphurid.selectedIndex].value;

        var ePickingid = document.getElementById("pickingpoint-pickingid");
        var pickingid = ePickingid.options[ePickingid.selectedIndex].value;

        // pickingpoint amphurid //
        var eAmphurid = document.getElementById("pickingpoint-amphurid");
        var amphurid = eAmphurid.options[eAmphurid.selectedIndex].value;
        if (amphurid > 0) {
            var amphurid = ePickingid.options[ePickingid.selectedIndex].value;
            //console.log(amphurid);
        } else {
            //console.log('Please select a pickingpoint amphurid list');
            $('.field-pickingpoint-amphurid').find('.select2-container--krajee').attr('style', 'width: 100%; border: 1px #ec3747 solid; ');
        }
        // pickingpoint provinceid //
        var eProvinceid = document.getElementById("pickingpoint-provinceid");
        var provinceid = eProvinceid.options[eProvinceid.selectedIndex].value;
        if (provinceid > 0) {
            var provinceid = ePickingid.options[ePickingid.selectedIndex].value;
            //console.log(provinceid);
        } else {
            //console.log('Please select a pickingpoint provinceid list');
            $('.field-pickingpoint-provinceid').find('.select2-container--krajee').attr('style', 'width: 100%; border: 1px #ec3747 solid; ');
        }
        // pickingpoint pickingid //
        var ePickingid = document.getElementById("pickingpoint-pickingid");
        var pickingid = ePickingid.options[ePickingid.selectedIndex].value;
        if (pickingid > 0) {
            var pickingid = ePickingid.options[ePickingid.selectedIndex].value;
            //console.log(pickingid);
        } else {
            //console.log('Please select a pickingpoint pickingid list');
            $('.field-pickingpoint-pickingid').find('.select2-container--krajee').attr('style', 'width: 100%; border: 1px #ec3747 solid; ');
            // exit();
        }
        var receiveTypeLockers = $('input[id=receiveTypeLockers]').val();
    } else {
        var receiveTypeLockers = false;
        var eAmphurid = false;
        var eProvinceid = false;
        var ePickingid = false;

    }


    //alert(pickingid);
    /*
     * Checkouts : Booth
     * Update : 15/02/2017
     * Create By : Taninut.Bm
     */

    //var bProvinceid = document.getElementById("BprovinceId");
    //if (bProvinceid != null) {

    // }
    //var b_provinceid = bProvinceid.options[bProvinceid.selectedIndex].value;

    //var bAmphurid = document.getElementById("BamphurId");
    //var b_amphurid = bAmphurid.options[bAmphurid.selectedIndex].value;

    //var bPickingid = document.getElementById("BpickingId");
    //var b_pickingid = bPickingid.options[bPickingid.selectedIndex].value;

    // pickingpoint amphurid //
    var bAmphurid = document.getElementById("BamphurId");
    if (bAmphurid != null) {

        var bPickingid = document.getElementById("BpickingId");
        var b_pickingid = bPickingid.options[bPickingid.selectedIndex].value;

        var b_amphurid = bAmphurid.options[bAmphurid.selectedIndex].value;
        if (b_amphurid > 0) {
            var b_pickingid = bPickingid.options[bPickingid.selectedIndex].value;
            //console.log(amphurid);
        } else {
            //console.log('Please select a pickingpoint amphurid list');
            $('.field-BamphurId').find('.select2-container--krajee').attr('style', 'width: 100%; border: 1px #ec3747 solid; ');
        }
        // pickingpoint provinceid //
        var bProvinceid = document.getElementById("BprovinceId");
        var b_provinceid = bProvinceid.options[bProvinceid.selectedIndex].value;
        if (b_provinceid > 0) {
            var b_pickingid = bPickingid.options[bPickingid.selectedIndex].value;
            //console.log(provinceid);
        } else {
            //console.log('Please select a pickingpoint provinceid list');
            $('.field-Bprovinceid').find('.select2-container--krajee').attr('style', 'width: 100%; border: 1px #ec3747 solid; ');
        }

        // pickingpoint pickingid //
        var bPickingid = document.getElementById("BpickingId");
        var b_pickingid = bPickingid.options[bPickingid.selectedIndex].value;
        if (b_pickingid > 0) {
            var b_pickingid = bPickingid.options[bPickingid.selectedIndex].value;
            //console.log(pickingid);
        } else {
            //console.log('Please select a pickingpoint pickingid list');
            $('.field-BpickingId').find('.select2-container--krajee').attr('style', 'width: 100%; border: 1px #ec3747 solid; ');
            exit();
        }
        var receiveTypeBooth = $('input[id=receiveTypeBooth]').val();
    } else {
        var b_amphurid = false;
        var b_provinceid = false;
        var b_pickingid = false;
        var receiveTypeBooth = false;
    }


    //alert(b_pickingid);
    /*
     * hiddenType : receiveTypeLockers and receiveTypeBooth
     * create date : 15/02/2017
     * create by : taninut.bm
     */
    //var receiveTypeLockers = document.getElementById("receiveTypeLockers");
    //var receiveTypeBooth = document.getElementById("receiveTypeBooth");
    //document.getElementById("receiveTypeLockers");//$('input[id=receiveTypeLockers]').val();

    //alert(receiveTypeLockers);
    //alert(receiveTypeBooth);
    /* End */

    if (_countItems == '') {
        //alert('สินค้าในตะกร้า 0 รายการ');
        $("#modal-cart-not-item").modal('show');
        //window.location = 'site';
    } else {
        //if (_shipping === undefined) {
        //alert('Please Select Shipping Address');
        //$("#modal-cart-not-shipping").modal('show');
        //} else {
        if (_billing === undefined) {
            $.post("checkout/burn-checkouts", {
                shipping: _shipping,
                payment01: _payment01,
                placeUserId: _placeUserId,
                notes: _notes,
                placeOrderId: _placeOrderId,
                pickingId: pickingid,
                b_pickingid: b_pickingid,
                receiveTypeLockers: receiveTypeLockers,
                receiveTypeBooth: receiveTypeBooth
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
                placeOrderId: _placeOrderId,
                pickingId: pickingid,
                b_pickingid: b_pickingid,
                receiveTypeLockers: receiveTypeLockers,
                receiveTypeBooth: receiveTypeBooth
            }, function (data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                // window.location = 'checkout/order-thank';
            });
        }
        //}
    }

// $this->redirect(['order-thank']);
});
$("#btn-checkout-formShipping").on('click', function () {

    var x = document.getElementsByName("countryId");
    var inputs = $('#default-shipping-address').getElementsByTagName('input');
});
$("#btn-checkout-formBilling").on('click', function () {

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
                url: $baseUrl + 'profile/shipping-address-delete',
                data: {"address_id": address_id},
                type: 'post',
                success: function (result)
                {
                    //alert(result);
                    if (result = 'complete') {
                        window.location = $baseUrl + 'profile';
                    } else if (result = 'wrong') {
                        window.location = $baseUrl + 'profile';
                    } else {
                        window.location = $baseUrl + 'profile';
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

    event.preventDefault();
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    //var pId = $button.parent().parent().find("#productId").val();
    var pSuppId = $button.parent().parent().find("#productSuppId").val();
    var sendDate = $button.parent().parent().find("#sendDate").val();
//    var pId = $("#productId").val();
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
    }
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "cart/change-quantity-item-and-save",
        data: {productSuppId: pSuppId, quantity: newVal, sendDate: sendDate},
        success: function (data)
        {
            if (data.status)
            {
                $button.parent().parent().find(".price").html(data.priceText);
//                if (data.discountValue != "null")
//                {
//                    $('.discountPrice').html(data.discountValue + " ฿ extra offyour order");
//                } else
//                {
//                    $('.discountPrice').html("&nbsp;Add more than 1 item to your order");
//                }
//                $('#pp' + oldValue).removeClass("priceActive");
//                $('#pp' + newVal).addClass("priceActive");
                $button.parent().parent().find(".total").html(data.subTotalText + " ฿");
                $button.parent().find("input").val(newVal.toFixed(2));
                $('.cart-dropdown table').find('tbody').find("#item" + data.orderItemId).find(".qty").find("#qty").val(newVal.toFixed(2));
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
                }
            } else
            {
                if (data.errorCode === 1)
                {
                    newVal = newVal - 1;
                    alert("ไม่สามารถสั่งซื้อเกินจำนวนที่กำหนดได้");
//                    $('.incr-btn').popover('show');
                }
                $button.parent().find("input").val(newVal.toFixed(2));
            }
        }
    });
});

function itemzero(items, title) {

    var item_cart = $('.total').html();
    var pathArray = window.location.pathname;
    var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
    if (title == 'cart') {
        if (item_cart == '0.00') {
            $("#modal-cart-not-item").modal('show');
        } else {

            /*if (window.location.host == 'localhost') {
             window.location = window.location.protocol + "//" + window.location.host + '/cost.fit-frontend/cart';
             } else if (window.location.host == '192.168.100.8') {
             window.location = window.location.protocol + "//" + window.location.host + '/cost.fit/frontend/web/cart';
             } else {
             window.location = window.location.protocol + "//" + window.location.host + '/cart';
             }*/
            window.location = $baseUrl + 'cart';
        }
    } else if (title == 'checkout') {
        if (item_cart == '0.00') {
            $("#modal-cart-not-item").modal('show');
        } else {
            window.location = $baseUrl + 'checkout';
            /*
             if (window.location.host == 'localhost') {
             window.location = window.location.protocol + "//" + window.location.host + '/cost.fit-frontend/checkout';
             } else if (window.location.host == '192.168.100.8') {
             window.location = window.location.protocol + "//" + window.location.host + '/cost.fit/frontend/web/checkout';
             } else {
             window.location = window.location.protocol + "//" + window.location.host + '/checkout';
             }
             */
        }
    }
}

$addToWishlistBtn.click(function () {
    event.preventDefault();
    var $pId = $(this).parent().parent().find('#productSuppId').val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "cart/add-wishlist",
        data: {productId: $pId},
        success: function (data)
        {
            if (data.status)
            {
                $('#addItemToWishlist').attr('disabled', true);
                alert("Sucees to add wishlist");
            } else
            {
                alert(data.message);
            }
        }
    });
});
$(".addWishlistItemToCart").click(function () {
    event.preventDefault();
    $addedToCartMessage.removeClass('visible');
    var $itemName = $(this).parent().parent().find('.title').html();
    var $itemId = $(this).parent().parent().find('#productId').val();
    var $productSuppId = $(this).parent().parent().find('#productSuppId').val();
    var $supplierId = $(this).parent().parent().find('#supplierId').val();
    var $fastId = $(this).parent().parent().find('#fastId').val();
    var $maxQnty = $(this).parent().parent().find('#maxQnty' + $productSuppId).val();
    //var $itemPrice = $(this).parent().parent().find('.price').text();
    var $itemQnty = $(this).parent().find('#quantity').val();
    var $cartTotalItems = parseInt($('.cart-btn a span').text()) + parseInt($itemQnty);
    var $button = $('#addWishlistItemToCart' + $productSuppId);
    $addedToCartMessage.find('p').text('"' + $itemName + '"' + '  ' + 'was successfully added to your cart.');
//        var getUrl = window.location;
//        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
//        alert(baseUrl);
    //alert($itemId);
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "cart/add-to-cart?id=" + $itemId,
        data: {quantity: $itemQnty, fastId: $fastId, supplierId: $supplierId, productSuppId: $productSuppId},
        success: function (data)
        {
            if (data.status)
            {
                $('#maxQnty' + $productSuppId).val($maxQnty - $itemQnty);
                if (($maxQnty - $itemQnty) == 0) {
                    $button.attr('disabled', 'disabled');
                }
                $('.cart-dropdown table').remove();
                $('.cart-dropdown .body').append(
                        data.shoppingCart
                        );
                $('.cart-btn a span').text($cartTotalItems);
                $('.cart-btn a').find("#cartTotal").html(data.cart.totalFormatText);
                $('.cart-dropdown .footer .total').html(data.cart.totalFormatText);
            }
        }
    });
    $addedToCartMessage.addClass('visible');
});
$("#GuestaddItemToWishlist").on('click', function () {
//alert('test');
    $("#modal-guest-add-item-to-wishlist").modal('show');
});
//$("#lateShippingCheck").on('click', function () {
//    var sendDate = $(this).parent().parent().parent().parent().parent().find("sendDate");
//    alert(sendDate.val());
//
//});
$('#lateShippingCheck').on('ifChecked', function (event) {
//var sendDate = $(this).parent().parent().parent().parent().parent().parent().find("#sendDate");
//alert('xxx');
    var productId = $('input[id=productId]').val();
    var fastId = $('input[id=fastId]').val();
    //alert(productId);
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "products/get-product-shipping-price/",
        data: {'productId': productId, 'fastId': fastId},
        success: function (data)
        {
            // alert(productId);
            $("#fastId").val(data);
            $("#choose").hide();
            $("#unchoose").show();
        }

    });
});
$('#lateShippingCheck').on('ifUnchecked', function (event) {
    var productId = $('input[id=productId]').val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "products/get-defult-product-shipping-price/",
        data: {'productId': productId},
        success: function (data)
        {
            //  alert(data);
            $("#fastId").val(data);
            $("#choose").show();
            $("#unchoose").hide();
        }
    });
});
$(".sorting").on('click', function () {

    var sorted_id = $(this).parent().attr('id');
    //alert(address_id);
    if (sorted_id == 'sortingAccount') {
        $("#sortingAccount").attr('id', 'sortedAccount');
        $("#submenu-sorting-account").hide();
    } else if (sorted_id == 'sortedAccount') {
        $("#sortedAccount").attr('id', 'sortingAccount');
        $("#submenu-sorting-account").show();
    }
});
$(".see-more").on('click', function () {
    $('#save-main-new').append('<div id="save-append">xxxx</div>');
});
//  Check seeMoreSave //
$(".see-more-x").on('click', function () {

    var ids = [];
    $(this).parent().find("#save-main-limit").find(".list-view").find(".category").each(function () {
        ids.push($(this).find('#seeMoreId').val());
    });
    //alert(ids);
    $.ajax({
        type: "POST",
        //dataType: "JSON",
        url: $baseUrl + "site/save-append",
        data: {'ids': ids},
        success: function (data)
        {
            if (data != '') {
                $('.list-view').append('<div id="save-append">' + data + '</div>');
            } else {
                $('#btn-see-more').attr('disabled', 'disabled');
            }
        }
    });
});
function changeoption(value)
{
    /*if (window.location.host == 'localhost') {
     urls = window.location.protocol + "//" + window.location.host + '/cost.fit-frontend/products/change-option/';
     } else if (window.location.host == '192.168.100.8') {
     urls = window.location.protocol + "//" + window.location.host + '/cost.fit/frontend/web/products/change-option/';
     } else {
     urls = window.location.protocol + "//" + window.location.host + '/products/change-option/';
     }
     */
    $.post($baseUrl + 'products/change-option/', {
        productId: value
    }, function (data, status) {
        var JSONObject = JSON.parse(data);
        //alert(JSONObject.productImagexx);
        $('#productItem').html(JSONObject.productItem);
        $('#productTabs').html(JSONObject.productTabs);
        $('#productImage').html(JSONObject.productImage);
        $('#image-thumbmail2').html(JSONObject.image);
        $('#image-thumbmail222').html(JSONObject.imageThumbnail2);
        $('.price').html(JSONObject.price);
        $('.old-price').html(JSONObject.oldPrice);
    });
}

$('#slowest').on('ifChecked', function (event) {
    //var sendDate = $(this).parent().parent().parent().parent().parent().parent().find("#sendDate");
    var orderId = $('input[id=orderId]').val();
    //alert(orderId);
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "cart/save-slowest/",
        data: {'orderId': orderId, 'type': 1},
        success: function (data)
        {
            location.reload();
        }
    });
});

$('#slowest').on('ifUnchecked', function (event) {
    //var sendDate = $(this).parent().parent().parent().parent().parent().parent().find("#sendDate");
    var orderId = $('input[id=orderId]').val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "cart/save-slowest/",
        data: {'orderId': orderId, 'type': 2},
        success: function (data)
        {
            location.reload();
        }
    });
});
/*
 $("input[name='brands']:checkbox").each(function () {
 $(this).on('ifChecked', function () {
 $.ajax({
 url: "/ajax/something/"
 })
 .done(function (data) {
 currentChecked = $(this);
 })
 .fail(function (data) {
 $(this).removeAttr('checked');
 currentChecked.prop('checked', true);
 });
 });
 });


 $('#brands').on('ifChecked', function (event) {
 alert('test');

 // alert(productId);
 //alert(fastId);
 $.ajax({
 type: "POST",
 dataType: "JSON",
 url: "",
 data: {'productId': productId, 'fastId': fastId},
 success: function (data)
 {
 // alert(productId);
 $("#fastId").val(data);
 $("#choose").hide();
 $("#unchoose").show();
 }

 });
 });
 */


$('.search-brands').on('ifChecked', function (event) {
    //var sendDate = $(this).parent().parent().parent().parent().parent().parent().find("#sendDate");
//    alert($(".subscr-form").find(".checkbox").find('.icheckbox').find('.search-brands').val());
    var categoryId = $('input[id=search-brands-categoryId]').val();

    var ids = [];
    $(".subscr-form").find(".checkbox").find('.icheckbox').each(function () {
        if ($(this).find('.search-brands').prop('checked'))
        {
            ids.push($(this).find('.search-brands').val());
        }
    });
    //alert(categoryId);
    $.ajax({
        type: "POST",
        //dataType: "JSON",
        url: $baseUrl + 'search/search-brands',
        data: {'brandId': ids, 'categoryId': categoryId},
        success: function (data)
        {
            $(".products-searchs-brands").html(data);
        }

    });
});

$('.search-brands').on('ifUnchecked', function (event) {
    //var sendDate = $(this).parent().parent().parent().parent().parent().parent().find("#sendDate");
//    alert($(".subscr-form").find(".checkbox").find('.icheckbox').find('.search-brands').val());
    var categoryId = $('input[id=search-brands-categoryId]').val();

    var ids = [];
    $(".subscr-form").find(".checkbox").find('.icheckbox').each(function () {
        if ($(this).find('.search-brands').prop('checked'))
        {
            ids.push($(this).find('.search-brands').val());
        }
    });
    //alert(categoryId);
    $.ajax({
        type: "POST",
        //dataType: "JSON",
        url: $baseUrl + 'search/search-brands',
        data: {'brandId': ids, 'categoryId': categoryId},
        success: function (data)
        {
            $(".products-searchs-brands").html(data);
        }

    });
});

// the last child
//$('#BpickingId').on('change', function (event) {
//var id = $(this).attr('id');
//alert(id);

//});

function organization(selectObject, value) {
    var value = selectObject.value;
    //alert(value);//default-shipping-address
    if (value == 'company') {
        document.getElementById('address-company').disabled = false;
        document.getElementById('address-tax').disabled = false;
        //$("#address-company").disabled = false;
        //$('.field-address-company').show();
        $('#address-tax').disabled = false;//.setAttribute("disabled", false);
    } else if (value == 'personal') {
        //$(".default-shipping-address").find('.field-address-company').hide();
        //$(".default-shipping-address").find('.field-address-tax').hide();
        document.getElementById('address-company').disabled = true;
        document.getElementById('address-tax').disabled = true;
    } else {
        alert(value);
    }

}

$('#BpickingId').change(function (event, id, value) {
    prev_val = $(this).val();
    //console.log(value);
    console.log(prev_val);
    //alert(b_pickingid);
    //alert('test');
    $.ajax({
        type: "POST",
        //dataType: "JSON",
        url: $baseUrl + "checkout/map-images",
        data: {'pickingIds': prev_val},
        success: function (data, status)
        {
            //console.log(data);
            //console.log(status);
            if (status == "success") {
                var JSONObject = JSON.parse(data);
                //console.log(JSONObject.mapImages);
                $('.name-booth').html(JSONObject.title);
                $('.description-booth').html('ที่อยู่:' + JSONObject.description);
                $('.view-map-images-booth').html('<div class="col-sm-12" style="padding: 5px;">\n\
                        <img class="img-responsive" src="' + $baseUrl + JSONObject.mapImages + '" alt="" style="width:100%;">\n\
                </div>');
            } else {
                $('.name-booth').html('');
                $('.view-map-images-booth').html('');
            }
        }
    });
});

$('#pickingpoint-pickingid').change(function (event, id, value) {
    prev_val = $(this).val();
    //console.log(value);
    console.log(prev_val);
    //alert(b_pickingid);
    //alert('test');
    $.ajax({
        type: "POST",
        //dataType: "JSON",
        url: $baseUrl + "checkout/map-images",
        data: {'pickingIds': prev_val},
        success: function (data, status)
        {
            //console.log(data);
            //console.log(status);
            if (status == "success") {
                var JSONObject = JSON.parse(data);
                //console.log(JSONObject.mapImages);
                $('.name-lockers').html(JSONObject.title);
                $('.description-lockers').html('ที่อยู่:' + JSONObject.description);
                $('.view-map-images-lockers').html('<div class="col-sm-12" style="padding: 5px;">\n\
                        <img class="img-responsive" src="' + $baseUrl + JSONObject.mapImages + '" alt="" style="width:100%;">\n\
                </div>');
            } else {
                $('.name-lockers').html('');
                $('.view-map-images-lockers').html('');
            }
        }
    });
});
