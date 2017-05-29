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

 