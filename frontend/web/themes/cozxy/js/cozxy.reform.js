/*  By  Taninut.B , 7/5/2016 */
var $addToWishlistBtn = $('#addItemToWishlist');
var $addedToCartMessage = $('.cart-message');
var map;

var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost' || window.location.host == 'dev') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cozxy/frontend/web/';
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

function organization(selectObject, value) {
    var value = selectObject.value;
    //alert(value);//default-shipping-address
    if (value == 'company') {
        document.getElementById('address-company').disabled = false;
        document.getElementById('address-tax').disabled = false;
        //$("#address-company").disabled = false;
        //$('.field-address-company').show();
        $('#address-tax').disabled = false; //.setAttribute("disabled", false);
    } else if (value == 'personal') {
        //$(".default-shipping-address").find('.field-address-company').hide();
        //$(".default-shipping-address").find('.field-address-tax').hide();
        document.getElementById('address-company').disabled = true;
        document.getElementById('address-tax').disabled = true;
    } else {
        alert(value);
    }

}




$('#addressId').change(function (event, id, value) {
    prev_val = $(this).val();
    $.ajax({
        type: "POST",
        //dataType: "JSON",
        //dataType: "html",
        url: $baseUrl + "checkout/address",
        data: {'addressId': prev_val},
        success: function (data, status)
        {
            //alert(data);
            if (status == "success") {
                var JSONObject = JSON.parse(data);
                //alert(JSONObject.address.firstname);
                $('.address-checkouts').find(".name-show").html(JSONObject.address.firstname + ' ,' + JSONObject.address.lastname);
                $('.address-checkouts').find(".address-show").html(JSONObject.address.address + ' ,'
                        + JSONObject.address.amphur + ' ,' + JSONObject.address.district + ' ,' + JSONObject.address.province
                        + ' ,' + JSONObject.address.zipcode);
            } else {
                $('.name-lockers-cool').html('');
                $('.view-map-images-lockers-cool').html('');

            }
        }
    });
});

$(document).on('click', '#checkBot', function () {//test
    var inputPass = $(this).parent().parent().parent().parent().find("#inputPass").val();
    var passPic = $(this).parent().parent().parent().parent().find("#passwordPic").val();
    var creditVal = $(this).parent().parent().parent().parent().find("#paymentMethod").val();
    var billVal = $(this).parent().parent().parent().parent().find("#paymentMethod2").val();
    if (creditVal == 'credit') {
        var creditCard = document.getElementById("paymentMethod").checked;
    } else {
        var creditCard = false;
    }
    if (billVal == 'bill') {
        var billPayment = document.getElementById("paymentMethod2").checked;
    } else {
        var billPayment = false;
    }
    if ((inputPass == '') || (inputPass != passPic)) {
        alert('Incorrect verify, please recheck.');
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: $baseUrl + '/top-up/random-pass',
            data: {data: '1'},
            success: function (data) {
                if (data.pass) {
                    $("#passwordPic").val(data.pass);
                }
            }
        });
    } else if (creditCard == false && billPayment == false) {
        alert("Please select payment method.");
    } else {
        $("#top-up").submit();
    }
});

$(document).on('keypress', '#amount', function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code > 57) {
        return false;
    } else if (code < 48 && code != 8) {
        return false;
    }
});

$(document).on('click', '#confirm-topup', function (e) {
    var amount = $(this).parent().parent().parent().parent().find('#amount').val();
    var currentAmount = $(this).parent().parent().parent().parent().parent().find('#currentAmount').val();
    if (amount == '') {
        if (currentAmount == '') {
            alert('empty amount');
            return false;
        } else {
            if (parseInt(currentAmount) < 100) {
                alert("Amount must not less than 100 THB.");
                return false;
            } else {
                if (confirm(':: Confirm Amount ' + currentAmount + ' THB ?')) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    } else {
        if (parseInt(amount) < 100) {
            alert("Amount must not less than 100 THB.");
            return false;
        } else {
            if (confirm(':: Confirm Amount ' + amount + ' THB ?')) {
                return true;
            } else {
                return false;
            }
        }
    }
});


$("#place-order").on('click', function () {
//alert('test');
    var _shipping = $('input[id=checkout_select_address_shipping]:checked').val();
    var _billing = $('input[id=checkout_select_address_billing]:checked').val();
    var _payment01 = $('input[id=payment01]:checked').val();
    var _placeUserId = $('input[id=placeUserId]').val();
    var _placeOrderId = $('input[id=placeOrderId]').val();
    var _countItems = $('input[id=countItems]').val();
    var _notes = $("#order-notes").val();
    //alert(_billing);
    if (_billing === undefined) {
        //alert('Click for Billing to a different adress?');
        //window.location = $baseUrl + 'profile/billings-address/add';
        $("#billing-different-adress").modal('show');
    }
    if (_placeUserId == '') {
        $("#modal-cart-not-item").modal('show');
    }

    /*
     * Increate 26/9/2016 By Taninut.BM
     */
//var provinceid = $('input[id=pickingpoint-provinceid]').val();
//var amphurid = $('input[id=pickingpoint-amphurid]').val();
//var pickingid = $('input[id=pickingpoint-pickingid]').val();
    /*
     * Lockers ร้อน
     */
//var eProvinceid = $('input[id=pickingpoint-provinceid]').val();
    var eProvinceid = $('select#pickingpoint-provinceid option:selected').val();
    if (eProvinceid != null) {
        var eProvinceid = $('#pickingpoint-provinceid').val();
        var eAmphurid = $('#pickingpoint-amphurid').val();
        var ePickingid = $('#pickingpoint-pickingid').val();
        var receiveTypeLockers = $('input[id=receiveTypeLockers]').val();
    } else {
        var receiveTypeLockers = false;
        var eAmphurid = false;
        var eProvinceid = false;
        var ePickingid = false;
    }
//console.log('Lockers ร้อน LcProvinceid : ' + eProvinceid);
//console.log('Lockers ร้อน LcAmphurid :' + eAmphurid);
//console.log('Lockers ร้อน LcPickingids :' + ePickingid);
//console.log('Lockers ร้อน receiveTypeLockers :' + receiveTypeLockers);
    /*
     *   Lockers เย็น
     */
//var LcProvinceid = document.getElementById("LcprovinceId");
    var LcProvinceid = $('select#LcprovinceId option:selected').val();
    if (LcProvinceid != null) {
//var LcAmphurid = $('select#LcamphurId option:selected').val();
        var LcProvinceid = $('#LcprovinceId').val();
        var LcAmphurid = $('#LcamphurId').val();
        var LcPickingids = $('#LcpickingId').val();
        var receiveTypeLockersCool = $('input[id=receiveTypeLockersCool]').val();
    } else {
        var receiveTypeLockersCool = false;
        var LcAmphurid = false;
        var LcProvinceid = false;
        var LcPickingids = false;
    }
//console.log('Lockers เย็น LcProvinceid : ' + LcProvinceid);
//console.log('Lockers เย็น LcAmphurid :' + LcAmphurid);
//console.log('Lockers เย็น LcPickingids :' + LcPickingids);
//console.log('Lockers เย็น receiveTypeLockersCool :' + receiveTypeLockersCool);

// pickingpoint amphurid //
    /*
     * Booth
     */
//var bAmphurid = document.getElementById("BamphurId");
    var b_provinceid = $('select#BprovinceId option:selected').val();
    if (b_provinceid != null) {
        var b_provinceid = $('#BprovinceId').val();
        var b_amphurid = $('#BprovinceId').val();
        var b_pickingid = $('#BpickingId').val();
        var receiveTypeBooth = $('input[id=receiveTypeBooth]').val();
    } else {
        var b_amphurid = false;
        var b_provinceid = false;
        var b_pickingid = false;
        var receiveTypeBooth = false;
    }
//console.log('Booth LcProvinceid : ' + b_provinceid);
//console.log('Booth LcAmphurid :' + b_amphurid);
//console.log('Booth LcPickingids :' + b_pickingid);
//console.log('Booth receiveTypeBooth :' + receiveTypeBooth);

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
                LcPickingids: LcPickingids,
                pickingId: ePickingid,
                b_pickingid: b_pickingid,
                receiveTypeLockers: receiveTypeLockers,
                receiveTypeBooth: receiveTypeBooth,
                receiveTypeLockersCool: receiveTypeLockersCool
            }, function (data) {
//console.log(data.name); // John
//console.log(data.time); // 2pm
            }, "json");
        } else if (_billing != undefined) {

            $.post("checkout/burn-checkouts", {
                shipping: _shipping,
                billing: _billing,
                payment01: _payment01,
                placeUserId: _placeUserId,
                notes: _notes,
                placeOrderId: _placeOrderId,
                LcPickingids: LcPickingids,
                pickingId: ePickingid,
                b_pickingid: b_pickingid,
                receiveTypeLockers: receiveTypeLockers,
                receiveTypeBooth: receiveTypeBooth,
                receiveTypeLockersCool: receiveTypeLockersCool
            }, function (data) {
//console.log(data.name); // John
//console.log(data.time); // 2pm
            }, "json");
        }
//}
    }

// $this->redirect(['order-thank']);
});