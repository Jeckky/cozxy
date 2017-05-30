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
    //console.log(value);
    //console.log(prev_val);
    //alert(b_pickingid);
    //alert('test');
    $.ajax({
        type: "POST",
        //dataType: "JSON",
        //dataType: "html",
        url: $baseUrl + "checkout/map-images-google",
        data: {'pickingIds': prev_val},
        success: function (data, status)
        {
            //console.log(data);
            //console.log(status);
            if (status == "success") {
                var JSONObject = JSON.parse(data);
                initialize();
                //console.log(JSONObject.mapImages);
                $('.name-lockers').html(JSONObject.title);
                //if (JSONObject.title != '') {
                //$('.history-lockers-null').html('');
                //}
                //alert(JSONObject.mapImages);
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

function initialize(Lat, Lng) {
    /*
     var mapOptions = {
     zoom: 8,
     center: new google.maps.LatLng(-34.397, 150.644)
     };

     var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
     */
    alert('Lat, Lng');
}

function CozxyChangeAddress() {
    alert('test change address!!');
}