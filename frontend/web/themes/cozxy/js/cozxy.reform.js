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
                //$('.checkout-total')
                $('input:hidden', '.checkout-total').val(JSONObject.address.addressId);
            } else {
                $('.name-lockers-cool').html('');
                $('.view-map-images-lockers-cool').html('');
            }
        }
    });
});
$(document).on('click', '#refreshPass', function () {

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
});
/*
 * Use : Wishlist
 * @param {type} id
 * @returns {undefined}
 */
function addItemToWishlist(id) {
    var $pId = id;
    var str = window.location.pathname;
    var res = str.split("/");
    //console.log(window.location.pathname);
    //console.log(res);
    //console.log(res[1]);
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "cart/add-wishlist",
        data: {productId: $pId},
        success: function (data)
        {
            if (data.status) {
                //$('.wishlist-message').addClass('visible');
                var $this = $('#addItemToWishlist-' + $pId);
                if (res[1] != 'search') {
                    $this.button('loading');
                    setTimeout(function () {
                        $this.button('reset');
                    }, 8000);
                } else {
                    $('.heart-' + $pId + ' i').removeClass('fa fa-heart-o');
                    $('.heart-' + $pId + ' i').addClass('fa fa-heartbeat');
                }
                //$(".fa fa-heart-o").html("<div class='col-xs-4'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>");
            } else {
                alert(data.message);
            }
        }
    });
}

/*
 * Use : Site index
 * @param {type} id
 * @returns {undefined}
 */
function addItemToCartUnitys(productSuppId, quantity, maxQnty, fastId, productId, supplierId, receiveType) {
    //javascript:addItemToCartUnitys(160, 1, "48", "false", "144", "", "")

    var $productSuppId = productSuppId;
    var $maxQnty = maxQnty;
    var $fastId = fastId;
    var $itemId = productId;
    var $supplierId = supplierId;
    var $receiveType = receiveType;
    var $itemQnty = quantity;
    var $this = $('#addItemsToCartMulti-' + $productSuppId);
    var $puls = $('#cart-plus-' + $productSuppId);
    var str = window.location.pathname;
    var res = str.split("/");
    if (res[1] != 'search') {
        $this.button('loading');
        setTimeout(function () {
            $this.button('reset');
        }, 8000);
    } else {
        $('.shopping-' + productSuppId + ' i').removeClass('fa fa-shopping-bag');
        $('.shopping-' + productSuppId + ' i').addClass('fa fa-cart-plus fa-spin');

    }

    // $(".fa-shopping-bag").addClass("fa-spin");

    if (parseInt($itemQnty) <= parseInt($maxQnty) && parseInt($itemQnty) > 0) {

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + 'cart/add-to-cart' + "?id=" + $itemId,
            data: {quantity: $itemQnty, fastId: $fastId, supplierId: $supplierId, productSuppId: $productSuppId, receiveType: $receiveType},
            success: function (data)
            {
                if (data.status) {
                    $('#maxQnty').val($maxQnty - $itemQnty);
                    if (($maxQnty - $itemQnty) == 0) {
                        $('#quantity').val(0);
                        //$addToCartBtn.attr('disabled', 'disabled');
                    } else {
                        $('#quantity').val(1);
                    }

                    if (res[1] != 'search') {
                        $('.shopping-' + productSuppId + ' i').removeClass('fa fa-cart-plus fa-spin');
                        $('.shopping-' + productSuppId + ' i').addClass('fa fa-check');
                    } else {
                        $('.shopping-' + productSuppId + ' i').removeClass('fa fa-cart-plus fa-spin');
                        $('.shopping-' + productSuppId + ' i').addClass('fa fa-check');
                        setTimeout(function () {
                            $('.shopping-' + productSuppId + ' i').removeClass('fa fa-checkn');
                            $('.shopping-' + productSuppId + ' i').addClass('fa fa-cart-plus');
                        }, 3000)
                    }

                    //$('.cart-dropdown table').remove();
                    //$('.cart-dropdown .body').append(
                    //data.shoppingCart
                    // );
                    // $('.cart-btn a span').text($cartTotalItems);
                    //$('.cart-btn a').find("#cartTotal").html(data.cart.totalFormatText);
                    //$('.cart-dropdown .footer .total').html(data.cart.totalFormatText);
                    //window.location = $baseUrl + 'cart';
                    //$.notify("Add to Cart Success ,", "success");

                    /* notify */
                    //alert(productSuppId);
                    //$('.shopping-' + productSuppId + ' i').removeClass('fa fa-cart-plus');
                    //$('.shopping-' + productSuppId + ' i').addClass('fa fa-check-circle fa-spin');
                    //alert($('.product-img').find('.v-hover').find('.shopping-' + productSuppId + ' i'));
                    //console.log(productSuppId);

                    // $('.shopping-' + productSuppId + ' i').removeClass('fa fa-cart-plus');
                    //$('#cart-plus-' + productSuppId + ' i').addClass('fa fa-check-circle fa-spin');

                    $.ajax({
                        type: "POST",
                        url: $baseUrl + "cart/get-product-quantity",
                        data: {},
                        success: function (data, status)
                        {
                            if (status == "success") {
                                $('#notify-cart-top-menu').html(data);
                            } else {

                            }
                        }
                    });
                }
                //alert(data.shoppingCart);
                //$addedToCartMessage.addClass('visible');
            }
        });
    } else {

        var $maxQnty = maxQnty;
        var $itemQnty = quantity;
        //$(this).parent().find('#quantity').val($maxQnty);
        //$(this).parent().find('#maxQnty').val($maxQnty);
        if ($itemQnty == 0) {
            $(this).parent().find('#quantity').val(1);
            alert("Can not be '0'");
        } else {
            //alert($(this).parent().find('#quantity').val() + ' max ' + $(this).parent().find('#maxQnty').val());
            alert("Max quantity for this product");
        }
    }
}


/*
 * Delete items to cart in deleteWishlist
 */

function deleteItemToWishlist(id) {
    //alert(id);
    var $this = $('#deletetemToWishlists-' + id);
    $this.button('loading');
    setTimeout(function () {
        $this.button('reset');
    }, 8000);
    $.ajax({
        type: "POST",
        url: $baseUrl + "cart/delete-wishlist",
        data: {'wishlistId': id},
        success: function (data, status)
        {
            //alert(data);
            if (status == "success") {
                var JSONObject = JSON.parse(data);
                $('.item-to-wishlist-' + id).remove();
            } else {
                /*
                 $('.name-lockers-cool').html('');
                 $('.view-map-images-lockers-cool').html('');
                 */
            }
        }
    });
}

/**
 * User Delete Billing Address
 */

function deleteItemToBillingAddressMe(id) {
    //alert(id);
    var $this = $('#deleteItemToBillingAddressz-' + id);
    $this.button('loading');
    setTimeout(function () {
        $this.button('reset');
    }, 8000);
    $.ajax({
        type: "POST",
        url: $baseUrl + "my-account/delete-item-to-billing-address",
        data: {'addressId': id},
        success: function (data, status)
        {
            //(status);
            if (status == "success") {
                $('.itemToBillingAddress-' + id).remove();
            } else {
                alert('Please try again.');
                window.location = $baseUrl + 'my-account';
                /*
                 $('.name-lockers-cool').html('');
                 $('.view-map-images-lockers-cool').html('');
                 */
            }
        }
    });
}

$(document).on('click', '.delete', function () {
    var $target = $(this).parent().parent();
    var $positions = $('.shopping-cart .item');
    var orderItemId = $(this).parent().find("#orderItemId").val();
    var $positionQty = parseInt($('.cart-btn a span').text());
    var itemQty = $('.cart-dropdown .item').find("#qty").val();
    //alert($baseUrl);
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + '/cart/delete-cart-item' + "?id=" + orderItemId,
        //data: {quantity: $itemQnty},
        success: function (data)
        {
            if (data.status)
            {
                $target.hide(300, function () {
                    $.when($target.remove()).then(function () {
                        $positionQty = $positionQty - itemQty;
                        $('.cart-btn a span').text($positionQty);
                        if ($positions.length === 1) {
                            $('.shopping-cart .items-list').remove();
                            $('.shopping-cart .title').text('Shopping cart is empty!');
                        }
                        $('.cart-btn a').find("#cartTotal").html(data.cart.totalFormatText);
                        $('.cart-dropdown .footer .total').html(data.cart.totalFormatText);
                        if ($('.cart-dropdown').find("#item" + orderItemId) !== undefined)
                        {
                            $('.cart-dropdown').find("#item" + orderItemId).remove();
                        }
                        if ($('.shopping-cart .cart-sidebar .cart-totals .total').html() !== undefined)
                        {
                            $('.shopping-cart .cart-sidebar .cart-totals .subtotal').html(data.cart.totalWithoutDiscountText + " ฿");
                            $('.shopping-cart .cart-sidebar .cart-totals .total').html(data.cart.totalFormatText);
                            $('.shopping-cart .cart-sidebar .cart-totals .shipping').html(data.cart.shippingFormatText);
                            $('.shopping-cart .cart-sidebar .cart-totals .summary').html(data.cart.summaryFormatText);
                            //alert(data.cart.items.length);
                            //alert($('.shopping-cart .item-list .showSlow').html());
                            if (data.cart.items.length == 0) {
                                $('.shopping-cart #showSlow').addClass("hide");
                            }

                        }
                    });
                });
            }
        }
    });
});

$(document).on('click', '#reviews-rate', function (e) {

    var rate = $('input:hidden', '#reviews-rate').val();
    var postId = $(this).parent().find("#postId").val();
    var userId = $(this).parent().find("#userId").val();
    $.ajax({
        type: "POST",
        url: $baseUrl + "story/rating-post",
        data: {'rate': rate, 'postId': postId, 'userId': userId},
        success: function (data)
        {
            //alert(data["status"]);
            //(status);
            if (data) {
                alert('Successful, you give ' + rate + ' stars to this post.');
            } else {
                alert('Somting wrong');
            }
        }
    });
});
$(document).on('click', '#viewPost', function (e) {
    var postId = $(this).parent().parent().find("#postId").val();
    var userId = $(this).parent().parent().find("#userId").val();
    $.ajax({
        type: "POST",
        url: $baseUrl + "story/view-post",
        data: {'postId': postId, 'userId': userId},
        success: function (data)
        {

        }
    });
});
/*
 * @returns {undefined}
 */
$('#currency-currencyid').change(function () {
    var value = $('#currency-currencyid').val();
    var productId = $(this).parent().parent().find("#productId").val();
    $('#currency-currencyid').submit();
    //alert(productId);
    /*$.ajax({
     type: 'POST',
     dataType: 'JSON',
     url: $baseUrl + '/story/compare-price',
     data: {productId: productId, currencyId: value},
     success: function (data) {
     alert(data["text"]);
     // $('#showData').html(data.text);
     }
     });*/

});
function checkoutNewBilling() {

    var $form = $("#default-add-new-billing-address"),
            data = $form.data("yiiActiveForm");
    $.each(data.attributes, function () {
        this.status = 3;
    });
    $form.yiiActiveForm("validate");
    var $this = $('#acheckoutNewBillingz');
    $this.button('loading');
    setTimeout(function () {
        $this.button('reset');
    }, 8000);
    var push_co_country = $('#co-country').val();
    var push_firstname = $('#address-firstname').val();
    var push_lastname = $('#address-lastname').val();
    var push_address = $('#address-address').val();
    var push_email = $('#address-email').val();
    var push_tel = $('#address-tel').val();
    var push_company = $('#address-company').val();
    var push_tax = $('#address-tax').val();
    var push_countryid = $('#address-countryid').val();
    var push_provinceid = $('#address-provinceid').val();
    var push_amphurid = $('#address-amphurid').val();
    var push_districtid = $('#address-districtid').val();
    var push_zipcode = $('#address-zipcode').val();
    var push_isDefault = $('#address-isDefault').val();
    $.ajax({
        type: "POST",
        url: $baseUrl + "checkout/checkout-new-billing",
        data: {'co_country': push_co_country, 'firstname': push_firstname, 'lastname': push_lastname, 'address': push_address, 'email': push_email, 'tel': push_tel
            , 'company': push_company, 'tax': push_tax, 'countryid': push_countryid, 'provinceid': push_provinceid, 'amphurid': push_amphurid
            , 'districtid': push_districtid, 'zipcode': push_zipcode, 'isDefault': push_isDefault
        },
        success: function (data, status)
        {

            if (status == "success") {
                //window.location = $baseUrl + 'checkout';
                $(".bs-example-modal-lg").modal("hide");
                $('#addressId').append(data);
            } else {
                alert('Please try again.');
            }
        }
    });
}

function filterPriceCozxy() {

    $min = $('input:hidden:eq(0)', '#amount-min').val();
    $max = $('input:hidden:eq(1)', '#amount-min').val();
    $categoryId = $('input:hidden:eq(2)', '#amount-min').val();
    $('.btn-black-s').html('APPLY ...');
    $('.filter-product-cozxy').html("<div class='text-center' style='zoom: 5;'><br><i class='fa fa-spinner fa-spin' aria-hidden='true'></i></div>");
    var path = $baseUrl + "search/filter-price";
    $.ajax({
        url: path,
        type: "POST",
        dataType: "JSON",
        data: {mins: $min, maxs: $max, categoryId: $categoryId},
        success: function (data, status) {

            if (status == "success") {
                //javascript:addItemToCartUnitys('161', 1, '44', '', '145', '', '')
                //javascript:addItemToCartUnitys(160, 1, "48", "", "144", "", "")
                var yourval = jQuery.parseJSON(JSON.stringify(data));
                //var obj = JSON.parse(data);
                //console.log(yourval['160']);
                var items = '';
                $.each(yourval, function (key, val) {
                    //console.log(key);//160,162
                    //console.log(val.productSuppId);
                    //console.log(items);
                    //alert(val.fastId);
                    if (val.fastId == false) {
                        $fastId = '';
                    } else {
                        $fastId = val.fastId;
                    }
                    items += "<div class=\"col-md-4 col-sm-6 col-xs-12\">";
                    items += "<div class=\"product-box\">";
                    items += "<div class=\"product-img text-center\">";
                    items += "<img alt=\"262x262\" class=\"media-object fullwidth\" data-src=\"holder.js / 262x262\" src='" + val.image + "' data-holder-rendered=\"true\" style=\"width: 260px; height: 260px;\">";
                    items += "<div class=\"v-hover\">";
                    items += "<a href='" + val.url + "'>";
                    items += "<div class=\"col-xs-4\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></div>";
                    items += "</a>";
                    items += " <a>";
                    if (val.wishList == 1) {
                        items += "<div class=\"col-xs-4 heartbeat\"><i class=\"fa fa-heartbeat\" aria-hidden=\"true\"></i></div>";
                        items += "</a>";
                    } else {
                        items += '<a href=\'javascript:addItemToWishlist(' + val.productSuppId + ');\' id=\'addItemToWishlist-' + val.productSuppId + '\' data-loading-text=\"<div class =\'col-xs-4\'><i class=\'fa fa-heartbeat\' aria-hidden =\'true\'></i></div>\">';
                        items += "<div class=\"col-xs-4 heart\"><i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i></div>";
                        items += "</a>";
                    }
                    items += '<a href=\'javascript:addItemToCartUnitys(' + val.productSuppId + ', 1, "' + val.maxQnty + '", "' + $fastId + '", "' + val.productId + '", "' + val.supplierId + '", "' + val.receiveType + '")\' id=\"addItemsToCartMulti-' + val.productSuppId + '\" data-loading-text=\" <div class =\'col-xs-4\'> <i class = \'fa fa-circle-o-notch fa-spin\' aria-hidden = \'true\'> </i></div> \">';
                    items += "<div class=\"col-xs-4 shopping\"><i class=\"fa fa-shopping-bag\" aria-hidden=\"true\"></i></div>";
                    items += " </a>";
                    items += " </div>";
                    items += "</div>";
                    items += "<div class=\"product-txt\">";
                    items += "<p class=\"size16 fc-g666\"></p>";
                    items += ' <p class=\"size14 b\" style=\"height:50px; \"><a href=' + val.url + ' class=\"fc-black\">' + val.title + '</a></p>';
                    items += " <p>";
                    items += '<span class=\"size18\">' + val.price + ' THB</span><br>';
                    items += '  <span class=\"size14 onsale\">' + val.price_s + ' THB</span>';
                    items += "   </p>";
                    items += " </div>";
                    items += " </div>";
                    items += "</div>";
                    $('.filter-product-cozxy').html(items);
                });
            } else {
                alert('error');
            }
        }
    });
}

function filterPriceCozxyClear() {
    location.reload();
}


function showMore(cat, clickNum, countAll, limit_start, limit_end) {
    //console.log(cat + ' , ' + countAll + ' , ' + limit_start + ',' + limit_end);
    var cats = cat;
    var countAlls = countAll;
    var limit_starts = limit_start;
    var limit_ends = 90;
    var clickNums = Math.floor(clickNum);

    $('.showStepMore').html(" SHOW MORE<span class=\'size16\'>&nbsp; ↓ </span></a>");
    $('.filter-product-cozxy').html("<div class='text-center loading-spin' style='zoom: 5;'><br><i class='fa fa-spinner fa-spin' aria-hidden='true'></i></div>");
    $.ajax({
        type: "POST",
        url: $baseUrl + "search/show-more-products",
        data: {'cat': cats, 'count': countAlls, 'starts': limit_starts, 'ends': limit_ends},
        success: function (data, status)
        {
            if (status == "success") {
                //$('.filter-product-cozxy').html("<div class='text-center' style='zoom: 5;'><br><br><i class='fa fa-spinner fa-spin' aria-hidden='true'></i></div>");
                //var yourval = jQuery.parseJSON(JSON.stringify(data));
                //$('.fa .fa-spinner .fa-spin').removeClass();
                yourval = JSON.parse(data);
                var items = '';
                $.each(yourval, function (key, val) {

                    if (val.fastId == false) {
                        $fastId = '';
                    } else {
                        $fastId = val.fastId;
                    }
                    items += "<div class=\"col-md-4 col-sm-6 col-xs-12\">";
                    items += "<div class=\"product-box\">";
                    items += "<div class=\"product-img text-center\">";
                    items += "<img alt=\"262x262\" class=\"media-object fullwidth\" data-src=\"holder.js/262x262\" src='" + val.image + "' data-holder-rendered=\"true\" style=\"width: 260px; height: 260px;\">";
                    items += "<div class=\"v-hover\">";
                    items += "<a href='" + val.url + "'>";
                    items += "<div class=\"col-xs-4\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></div>";
                    items += "</a>";
                    items += " <a>";
                    if (val.wishList == 1) {
                        items += "<div class=\"col-xs-4 heartbeat\"><i class=\"fa fa-heartbeat\" aria-hidden=\"true\"></i></div>";
                        items += "</a>";
                    } else {
                        items += '<a href=\'javascript:addItemToWishlist(' + val.productSuppId + ');\' id=\'addItemToWishlist-' + val.productSuppId + '\' data-loading-text=\"<div class =\'col-xs-4\'><i class=\'fa fa-heartbeat\' aria-hidden =\'true\'></i></div>\">';
                        items += "<div class=\"col-xs-4 heart\"><i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i></div>";
                        items += "</a>";
                    }
                    items += '<a href=\'javascript:addItemToCartUnitys(' + val.productSuppId + ', 1, "' + val.maxQnty + '", "' + $fastId + '", "' + val.productId + '", "' + val.supplierId + '", "' + val.receiveType + '")\' id=\"addItemsToCartMulti-' + val.productSuppId + '\" data-loading-text=\" <div class =\'col-xs-4\'> <i class = \'fa fa-circle-o-notch fa-spin\' aria-hidden = \'true\'> </i></div> \">';
                    items += "<div class=\"col-xs-4 shopping\"><i class=\"fa fa-shopping-bag\" aria-hidden=\"true\"></i></div>";
                    items += " </a>";
                    items += " </div>";
                    items += "</div>";
                    items += "<div class=\"product-txt\">";
                    items += "<p class=\"size16 fc-g666\"></p>";
                    items += ' <p class=\"size14 b\" style=\"height:50px; \"><a href=' + val.url + ' class=\"fc-black\">' + val.title + '</a></p>';
                    items += " <p>";
                    items += '<span class=\"size18\">' + val.price + ' THB</span><br>';
                    items += '  <span class=\"size14 onsale\">' + val.price_s + ' THB</span>';
                    items += "   </p>";
                    items += " </div>";
                    items += " </div>";
                    items += "</div>";
                    $('.filter-product-cozxy').append(items);
                    $('.loading-spin').hide();
                });
            } else {
                alert('Somting error');
            }
        }
    });


}


$(".upload-payment-slip").click(function () {
    //alert($(this).data('id'));

});

function ShowImages(img, productImageId) {
    var src = img.src;
    $('.images-big').html("<div class='text-center' style='zoom:2; height: 185px;'><br><br><br><i class='fa fa-spinner fa-spin' aria-hidden='true'></i></div>");
    $.ajax({
        type: "POST",
        url: $baseUrl + "product/images-item-big/",
        data: {'ImageId': productImageId},
        success: function (data, status)
        {
            if (status == "success") {
                $('.images-big').html('<img src="/' + data + '" class="fullwidth" alt=" ">');
            } else {

            }
        }
    });
}

/*
 $.growl({title: "Growl", message: "The kitten is awake!"});
 $.growl.error({message: "The kitten is attacking!"});
 $.growl.notice({message: "The kitten is cute!"});
 $.growl.warning({message: "The kitten is ugly!"});
 */
/*
 $.notify("Hello World");

 $(".pos-demo").notify(
 "Welcome Guest",
 {position: "right"}
 );
 $.notify("This notofication is working ", "success");*/