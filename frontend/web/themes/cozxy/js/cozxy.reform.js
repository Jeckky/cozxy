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
                changeMap(JSONObject.latitude, JSONObject.longitude); //Get Map : latitude and longitude

                $('.name-lockers').html(JSONObject.title);
                $('.description-lockers-cool').html('address :' + JSONObject.description);
                if (JSONObject.mapImages == null) {
                    $('.view-map-images-lockers-cool').html('<div class="col-sm-12" style="padding: 5px;">\n\
                       <img class="img-responsive" src="' + $baseUrl + 'images/picking-point/No_map.png' + '" alt="" style="width:100%;">\n\
                </div>');
                } else {
                    //alert('xx');
                    $('.view-map-images-lockers-cool').html('<div class="col-sm-12" style="padding: 5px;">\n\
                        <img class="img-responsive" src="' + $baseUrl + JSONObject.mapImages + '" alt="" style="width:100%;">\n\
                </div>');
                }

            } else {
                $('.name-lockers-cool').html('');
                $('.view-map-images-lockers-cool').html('');
                //$('.history-lockers-null').html('');
            }
        }
    });
});

function changeMap(lats, lng) {

    var map;
    //var myLatLng = {lat: lats, lng: lng}; //13.8713948,100.6151315
    var myLatLng = {lat: 13.7880589, lng: 100.5329692};
    console.log(myLatLng);

    map = new google.maps.Map($('.cart-detail').find("#map"), {
        center: myLatLng,
        zoom: 16
    });

    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: 'Hello World!'
    });
}

function CozxyChangeAddress() {
    alert('test change address!!');
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


