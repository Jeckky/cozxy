/*  By  Taninut.B , 7/5/2016 */
var $addToWishlistBtn = $('#addItemToWishlist');
var $addedToCartMessage = $('.cart-message');

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

$('#LcpickingId').change(function (event, id, value) {
    prev_val = $(this).val();

    $.ajax({
        type: "POST",
        url: $baseUrl + "checkout/map-images-google",
        data: {'pickingIds': prev_val},
        success: function (data, status)
        {
            if (status == "success") {
                var JSONObject = JSON.parse(data);

                /* Map Google in latitude and longitude for cozxy*/
                changeMap(JSONObject.latitude, JSONObject.longitude);

            } else {

            }
        }
    });
});

function changeMap(lats, lng) {

    var map;
    //var myLatLng = {lat: lats, lng: lng}; //13.8713948,100.6151315
    var myLatLng = {lat: 13.7880589, lng: 100.5329692};
    console.log(myLatLng);

    map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 16
    });

    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: 'Hello World!'
    });
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
            if (status == "success") {
                var JSONObject = JSON.parse(data);
                $('.address-checkouts').find(".name-show").html(JSONObject.firstname + ' ' + JSONObject.lastname);
                $('.address-checkouts').find(".address-show").html('');
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
