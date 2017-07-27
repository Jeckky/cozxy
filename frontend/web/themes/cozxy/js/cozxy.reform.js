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
            if (parseInt(amount) < parseInt(currentAmount)) {
                alert("Amount must more than or equal " + currentAmount + " THB.");
                return false;
            } else {
                if (confirm(':: Confirm Amount ' + amount + ' THB ?')) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
});
/*
 * Use : Wishlist
 * @param {type} id
 * @returns {undefined}
 */
function addItemToWishlist(id, shelfId) {
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
        data: {productId: $pId, shelfId: shelfId},
        success: function (data)
        {
            if (data.status) {
                //$('.wishlist-message').addClass('visible');
                var $this = $('#addItemToWishlist-' + $pId);
                /*if (res[1] != 'search') {
                 alert('133334');
                 $this.button('loading');
                 setTimeout(function () {
                 $this.button('reset');
                 }, 8000);
                 } else {*/
                // alert('13333');
                $('.heart-' + $pId + ' i').removeClass('fa fa-heart-o');
                $('.heart-' + $pId + ' i').addClass('fa fa-heartbeat');
                $('#heart-o' + $pId + shelfId).hide();
                $('#heartbeat' + $pId + shelfId).show();
                //}
                //$(".fa fa-heart-o").html("<div class='col-xs-4'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>");
            } else {//ลบ
                if (data.heartbeat == 0) {
                    $('.heart-' + $pId + ' i').removeClass('fa fa-heartbeat');
                    $('.heart-' + $pId + ' i').addClass('fa fa-heart-o');
                }
                $('#heart-o' + $pId + shelfId).show();
                $('#heartbeat' + $pId + shelfId).hide();
            }
        }
    });
}
function addItemToDefaultWishlist(id) {
    var pId = id;
    var str = window.location.pathname;
    var res = str.split("/");
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "cart/add-default-wishlist",
        data: {productId: pId},
        success: function (data)
        {
            if (data.status) {
                window.location = $baseUrl + "my-account?act=2&&p=" + data.title;
                //$('#showSuccessAdd').html(data.showText);
            } else {
                alert(data.message);
                return false;
            }
        }
    });
}
/*
 *  modal add Wish List Group
 * By sak
 */
function showWishlistGroup(shelfId, type) {
    if (type == 1) {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "my-account/show-wishlist-group",
            data: {shelfId: shelfId},
            success: function (data)
            {
                $('#showGroup-' + shelfId).hide();
                $('#hideGroup-' + shelfId).show();
                $('#wishListShelf-' + shelfId).html(data.text);
                $('#wishListShelf-' + shelfId).hide();
                $('#wishListShelf-' + shelfId).show('fade-in');
                if (data.idHide) {
                    var i;
                    for (i = 0; i < data.idHide.length; i++) {
                        $('#showGroup-' + data.idHide[i]).show();
                        $('#hideGroup-' + data.idHide[i]).hide();
                        $('#wishListShelf-' + data.idHide[i]).hide('slow');
                    }
                }
            }
        });
    } else {

        $('#hideGroup-' + shelfId).hide();
        $('#wishListShelf-' + shelfId).hide('slow');
        $('#showGroup-' + shelfId).show();
    }

}
function showFavorite(type) {
    if (type == 1) {
        $("#showFavoriteItem").show('fade-in');
        $("#hidefav").show();
        $("#showfav").hide();
    } else {

        $("#showFavoriteItem").hide('fade-in');
        $("#hidefav").hide();
        $("#showfav").show();
    }

}
function deleteShelf(shelfId) {

    if (confirm('Are you sure to delete?')) {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "my-account/delete-shelf",
            data: {shelfId: shelfId},
            success: function (data)
            {
                $('#allShelf2').html(data.text);
            }
        });
    } else {
        return false;
    }
}
function editShelf(shelfId, flag) {
    if (flag == 1) {
        $('#editShelf' + shelfId).show('fade-in');
        $('#hideEditShelf' + shelfId).show();
        $('#showEditShelf' + shelfId).hide();
    } else {
        $('#editShelf' + shelfId).hide('fade-in');
        $('#hideEditShelf' + shelfId).hide();
        $('#showEditShelf' + shelfId).show();
    }
}
function cancelEditShelf(shelfId) {
    $('#editShelf' + shelfId).hide('fade-in');
    $('#hideEditShelf' + shelfId).hide();
    $('#showEditShelf' + shelfId).show();
}
function updateShelf(shelfId) {
    var name = $('#shelfName' + shelfId).val();
    if (name == '') {
        alert('Shelf name can not empty');
        return false;
    } else {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "my-account/update-shelf",
            data: {shelfId: shelfId, name: name},
            success: function (data)
            {
                if (data.status) {
                    $('#allShelf2').html(data.text);
                    showWishlistGroup(shelfId, 1);
                } else {
                    alert(data.error);
                }
            }
        });
    }
}
function addToFavoriteStory(productPostId) {
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "story/add-to-favorite",
        data: {productPostId: productPostId},
        success: function (data)
        {
            if (data.status) {
                $("#favorite").hide();
                $("#unfavorite").show();
            } else {
                alert(data.error);
            }
        }
    });
}
function addToFavoriteStory(productPostId) {
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "story/add-to-favorite",
        data: {productPostId: productPostId},
        success: function (data)
        {
            if (data.status) {
                $("#favorite").hide();
                $("#unfavorite").show();
                $("#showAddSuccess").show();
                $("#showDelSuccess").hide();
            } else {
                alert(data.error);
            }
        }
    });
}
function unFavoriteStory(productPostId) {
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + "story/un-favorite",
        data: {productPostId: productPostId},
        success: function (data)
        {
            if (data.status) {
                $("#favorite").show();
                $("#unfavorite").hide();
                $("#showAddSuccess").hide();
                $("#showDelSuccess").show();
            } else {
                alert(data.error);
            }
        }
    });
}
function deleteItemFromFav(productPostId) {
    if (confirm('Are you sure to delete this favorite story')) {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "story/un-favorite",
            data: {productPostId: productPostId},
            success: function (data)
            {
                //alert(data);
                if (data.status) {
                    //alert('aaaaa');
                    $('#itemStory-' + productPostId).remove();
                } else {
                    /*
                     $('.name-lockers-cool').html('');
                     $('.view-map-images-lockers-cool').html('');
                     */
                }
            }
        });
    } else {
        return false;
    }
}
$(document).on('click', '#showCreateWishList', function (e) {
    var newWishList = $(this).parent().find('#newWishList');
    var hideCreateWishList = $(this).parent().find('#hideCreateWishList');
    hideCreateWishList.show();
    $(this).hide();
    newWishList.show('fade-in');
});
$(document).on('click', '#cancel-newWishList', function (e) {
    var newWishList = $(this).parent().parent().parent().find('#newWishList');
    var showCreateWishList = $(this).parent().parent().parent().find('#showCreateWishList');
    var hideCreateWishList = $(this).parent().parent().parent().find('#hideCreateWishList');
    showCreateWishList.show();
    hideCreateWishList.hide();
    newWishList.hide('fade-in');
});
$(document).on('click', '#hideCreateWishList', function (e) {
    var newWishList = $(this).parent().find('#newWishList');
    var showCreateWishList = $(this).parent().find('#showCreateWishList');
    showCreateWishList.show();
    $(this).hide();
    newWishList.hide('fade-in');
});
$(document).on('keyup', '#wishListName', function (e) {
    var createNew = $(this).parent().find('#create-newWishList');
    if ($(this).val() != '') {
        createNew.removeAttr('disabled');
    } else {
        createNew.attr('disabled', 'disabled');
    }
});
$(document).on('click', '#create-newWishList', function (e) {
    var title = $(this).parent().parent().find('#wishListName').val();
    var allGroup = $(this).parent().parent().parent().find('#allGroup');
    var newWishList = $(this).parent().parent().parent().find('#newWishList');
    var showCreateWishList = $(this).parent().parent().parent().find('#showCreateWishList');
    var hideCreateWishList = $(this).parent().parent().parent().find('#hideCreateWishList');
    var productSuppId = $(this).parent().find('#productSuppId').val();
    var allShelf2 = $(this).parent().parent().parent().parent().parent().find('#allShelf2');
    //alert(allShelf2.text);
    if (title != '') {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "shelf/create/",
            data: {'title': title, 'productSuppId': productSuppId},
            success: function (data)
            {
                if (data.status) {
                    $('#wishListName').val('');
                    showCreateWishList.show();
                    hideCreateWishList.hide();
                    newWishList.hide('fade-in');
                    allGroup.html(data.text);
                    allShelf2.html(data.text);
                } else {
                    alert(data.error);
                }
            }
        });
    }
});
$(document).on('click', '#closeWishlistModal', function (e) {
    // window.location = $baseUrl;
});
/*
 * Use : product show all
 * @param {type} id
 * @returns {undefined}
 */
$notify = $('#notify-cart-top-menu').html();
if ($notify == '') {
    $('#notify-cart-top-menu').css('background-color', '#000');
} else {
    $('#notify-cart-top-menu').removeAttr('style');
}
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
                        }, 8000)
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
                                $('#notify-cart-top-menu').removeAttr('style');
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
                $('#showSuccessRateStar').html('Successful, you give ' + rate + ' stars to this post.');
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
                $('.images-big').html('<img src="' + data + '" class="fullwidth" alt=" ">');
            } else {

            }
        }
    });
}

$(document).on('click', '#default-coin', function (e) {
    var systemCoin = $(this).parent().parent().find("#systemCoin");
    var choose = $(this).parent().find("#firstCoin");
    var systemCoin2 = $(this).parent().find("#systemCoin2");
    var system = $(this).parent().find("#system");
    var textPay = $(this).parent().find("#text-pay");
    systemCoin.val(choose.val());
    system.val(choose.val());
    systemCoin2.val(choose.val());
    textPay.html(choose.val());
});
$(document).on('click', '#chooseCoin', function () {
    var choose = $(this).parent().find("#inputSystemCoin");
    choose.removeAttr("disabled");
    //$("#inputSystemCoin").hide();
});
$(document).on('click', '#allCoin', function () {
    var choose = $(this).parent().parent().parent().find("#inputSystemCoin");
    choose.attr("disabled", "disabled");
    choose.val('');
    var systemCoin = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#systemCoin");
    var textPay = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#text-pay");
    var systemCoin2 = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#systemCoin2");
    var system = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#system");
    var allCoin = $(this).parent().find("#allCoinHidden");
    systemCoin.val(allCoin.val());
    system.val(allCoin.val());
    systemCoin2.val(allCoin.val());
    textPay.html(allCoin.val());
});
$(document).on('keypress', '#inputSystemCoin', function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code > 57) {
        return false;
    } else if (code < 48 && code != 8) {
        return false;
    }
});
$(document).on('click', '#confirm-payCoin', function (e) {
    var choose = $(this).parent().parent().parent().find("#inputSystemCoin");
    var systemCoin = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#systemCoin");
    var textPay = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#text-pay");
    var system = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#system");
    var systemCoin2 = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#systemCoin2");
    var addressId = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#addressId").val();
    var orderId = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#orderId").val();
    if (parseInt(choose.val()) > parseInt(systemCoin2.val())) {
        alert('Incorrect Input');
    } else {
        if (choose.val() != '') {
            systemCoin.val(choose.val());
            systemCoin2.val(choose.val());
            system.val(choose.val());
            textPay.html(choose.val());
        } else {
            systemCoin.val(systemCoin.val());
            system.val(systemCoin2.val());
            textPay.html(systemCoin.val());
        }
        $.ajax({
            type: "POST",
            url: $baseUrl + "checkout/save-address-id/",
            data: {'orderId': orderId, 'addressId': addressId, 'systemCoin': systemCoin2.val()},
            success: function (data, status)
            {
            }
        });
    }


});
$(document).on('click', '#cancel-payCoin', function (e) {
    var systemCoin = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#systemCoin");
    var textPay = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#text-pay");
    var systemCoin2 = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#systemCoin2");
    var system = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#system");
    var orderId = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#orderId").val();
    var addressId = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#addressId").val();
    textPay.html('');
    systemCoin.val(0);
    system.val(0);
    systemCoin2.val(0);
    $.ajax({
        type: "POST",
        url: $baseUrl + "checkout/save-address-id/",
        data: {'orderId': orderId, 'addressId': addressId, 'systemCoin': systemCoin2.val()},
        success: function (data, status)
        {
        }
    });
});
$('#isPay').change(function () {
    var orderId = $(this).parent().find("#orderId").val();
    if ($(this).is(':checked')) {
        $.ajax({
            type: "POST",
            url: $baseUrl + "checkout/is-pay-now/",
            data: {'orderId': orderId, 'isPay': 1},
        });
    } else {
        $.ajax({
            type: "POST",
            url: $baseUrl + "checkout/is-pay-now/",
            data: {'orderId': orderId, 'isPay': 0},
        });
    }
});


//////////////////////////////    RETURN  ///////////////////////////////////////
$(document).on('click', '#sendTicket', function () {
    var invoice = $(this).parent().parent().find("#invoiceNo").val();
    var tickeTitle = $(this).parent().parent().find("#tickeTitle").val();
    var description = $(this).parent().parent().find("#description").val();
    if (invoice == '' || tickeTitle == '' || description == '') {
        alert('Please fill in the form below.');
    } else {
        $("#ticket-form").submit();
    }
});
$(document).on('click', '#sendMessage', function () {
    var message = $(this).parent().parent().find("#message").val();
    var orderId = $(this).parent().parent().find("#orderId").val();
    var userId = $(this).parent().parent().find("#userId").val();
    var ticketId = $(this).parent().parent().find("#ticketId").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $baseUrl + 'return/save-message',
        data: {message: message, orderId: orderId, userId: userId, ticketId: ticketId},
        success: function (data) {
            if (data.status) {
                $("#message").val('');
            }
        }
    });
});
$(document).on('keyup', '#message', function (e) {
    var message = $(this).parent().parent().find("#message").val();
    var orderId = $(this).parent().parent().find("#orderId").val();
    var userId = $(this).parent().parent().find("#userId").val();
    var ticketId = $(this).parent().parent().find("#ticketId").val();
    // $("#message").val('');
    if (e.keyCode == 13) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: $baseUrl + 'return/save-message',
            data: {message: message, orderId: orderId, userId: userId, ticketId: ticketId},
            success: function (data) {
                if (data.status) {
                    $("#message").val('');
                }
            }
        });
    }
});
function checkReturnQuantity(orderItemId) {
    $(document).on('keypress', '#quantity-' + orderItemId, function (e) {
        var code = e.keyCode ? e.keyCode : e.which;
        if (code > 57) {
            return false;
        } else if (code < 48 && code != 8) {
            return false;
        }
    });
    var returnQuantity = $('#quantity-' + orderItemId).val();
    if (returnQuantity > 0) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: $baseUrl + 'return/check-quantity-return',
            data: {orderItemId: orderItemId},
            success: function (data) {
                if (data.status) {
                    if (data.canReturn < returnQuantity) {
                        alert('No more than ' + data.canReturn);
                        $('#quantity-' + orderItemId).val(data.canReturn);
                    }
                }
            }
        });
    } else if (returnQuantity != '') {
        alert('Can not be 0');
        $('#quantity-' + orderItemId).val(1);
    }

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
function filterPriceCozxy() {
    var brandName = [];
    $("input:checked").each(function () {
        brandName.push($(this).val());
    });
    //$min = $('input:hidden:eq(0)', '#amount-min').val();
    //$max = $('input:hidden:eq(1)', '#amount-min').val();
    //$categoryId = $('input:hidden:eq(2)', '#amount-min').val();
    $brandName = brandName;
    $min = $('input:hidden:eq(0)', '#amount-min').val();
    $max = $('input:hidden:eq(1)', '#amount-min').val();
//    alert($min + " " + $max);
    $categoryId = $('input:hidden:eq(2)', '#amount-min').val();
    $('.btn-black-s').html('APPLY ...');
    $('.brand-price-filter').html("<div class='text-center' style='zoom: 5;'><br><i class='fa fa-spinner fa-spin' aria-hidden='true'></i></div>");
    var path = $baseUrl + "search/filter-price?categoryId=" + $categoryId;
    $.ajax({
        url: path,
        type: "POST",
        //dataType: "JSON",
        data: {mins: $min, maxs: $max, brand: $brandName, },
        success: function (data, status) {
            if (data == '') {
                $('.brand-price-filter').html('<center><br><br><br><br><br><br>No results found.</center>');
            } else {
                if (status == "success") {

                    $('.brand-price-filter').html(data);
                } else {
                    alert('error');
                }
            }

        }
    });
}

function filterPriceCozxyClear() {
    location.reload();
}

function filterBrandCozxy($categoryId) {
    var brandName = [];
    $("input:checked").each(function () {
        brandName.push($(this).val());
    });
    $brandName = brandName;
    $min = $('input:hidden:eq(0)', '#amount-min').val();
    $max = $('input:hidden:eq(1)', '#amount-min').val();
    $('.btn-black-s').html('APPLY ...');
    $('.brand-price-filter').html("<div class='text-center' style='zoom: 5;'><br><i class='fa fa-spinner fa-spin' aria-hidden='true'></i></div>");
    var path = $baseUrl + "search/filter-brand?categoryId=" + $categoryId;
    $.ajax({
        url: path,
        type: "POST",
        data: {brand: $brandName, mins: $min, maxs: $max},
        success: function (data, status) {

            if (data == '') {
                $('.brand-price-filter').html('<center><br><br><br><br><br><br>No results found.</center>');
            } else {
                if (status == "success") {
                    $('.brand-price-filter').html(data);
                } else {
                    $('.brand-price-filter').html('<center><br><br><br><br><br><br>No results found.</center>');
                }
            }

        }
    });
}

function sortCozxy($categoryId, status) {
    var brandName = [];
    $("input:checked").each(function () {
        brandName.push($(this).val());
    });
    $brandName = brandName;
    $min = $('input:hidden:eq(0)', '#amount-min').val();
    $max = $('input:hidden:eq(1)', '#amount-min').val();
    if (status == "price")
    {
        $sort = $('#Sortprice').val();
    } else if (status == "brand")
    {
        $sort = $('#Sortbrand').val();
    } else
        (status == "new")
    {
        $sort = $('#Sortnew').val();
    }


    $('.btn-black-s').html('APPLY ...');
    $('.brand-price-filter').html("<div class='text-center' style='zoom: 5;'><br><i class='fa fa-spinner fa-spin' aria-hidden='true'></i></div>");
    var path = $baseUrl + "search/sort-cozxy?categoryId=" + $categoryId;
    $.ajax({
        url: path,
        type: "POST",
        data: {'status': status, brand: $brandName, mins: $min, maxs: $max, 'sort': $sort},
        success: function (data, status) {

            if (data == '') {
                $('.brand-price-filter').html('<center><br><br><br><br><br><br>No results found.</center>');
            } else {
                if (status == "success") {
                    //$('#Sortprice').val('SORT_ASC');
                    //$('#Sortbrand').val('SORT_ASC');

                    $('.brand-price-filter').html(data);
                } else {
                    $('.brand-price-filter').html('<center><br><br><br><br><br><br>No results found.</center>');
                }
            }

        }
    });
}

function SortOrder1(selectObject) {
    var value = selectObject.value;
    if (OrderHistory != '') {
        $.ajax({
            type: "POST",
            url: $baseUrl + "my-account/order-sort/",
            data: {'status': value},
            success: function (data, status) {

                if (data == '') {
                    $('.order-list').html('<center><br><br><br><br><br><br>No results found.</center>');
                } else {
                    if (status == "success") {
                        $('.order-list').html(data);
                    } else {
                        $('.order-list').html('<center><br><br><br><br><br><br>No results found.</center>');
                    }
                }

            }
        });
    }
}

function SortOrder() {
    var selectObject = $('#OrderHistory').val();
    var selectSearch = $('#searchOrderNo').val();
    //var value = selectObject.value;

    //console.log(selectObject + ' : ' + selectSearch);

    if (OrderHistory != '') {
        $.ajax({
            type: "POST",
            url: $baseUrl + "my-account/order-sort/",
            data: {'status': selectObject, 'selectSearch': selectSearch},
            success: function (data, status) {

                if (data == '') {
                    $('.order-list').html('<center><br><br><br><br><br><br>No results found.</center>');
                } else {
                    if (status == "success") {
                        $('.order-list').html(data);
                    } else {
                        $('.order-list').html('<center><br><br><br><br><br><br>No results found.</center>');
                    }
                }

            }
        });
    }
}

function sortStoriesCozxy($userId, status, type) {

    if (status == 'price') {
        $sortStories = $('input:hidden:eq(0)', '.sort-stories-cozxy').val();
    } else if (status == 'view') {
        $sortStories = $('input:hidden:eq(1)', '.sort-stories-cozxy').val();
    } else if (status == 'stars') {
        $sortStories = $('input:hidden:eq(2)', '.sort-stories-cozxy').val();
    } else if (status == 'new') {
        $sortStories = $('input:hidden:eq(3)', '.sort-stories-cozxy').val();
    }

    $.ajax({
        type: "POST",
        url: $baseUrl + "my-account/sort-stories?userId=" + $userId,
        data: {'status': status, 'sort': $sortStories, 'type': type},
        success: function (data, status) {

            if (data == '') {
                $('.sort-stories-cozxy').html('<center><br><br><br><br><br><br>No results found.</center>');
            } else {
                if (status == "success") {
                    $('.sort-stories-cozxy').html(data);
                } else {
                    $('.sort-stories-cozxy').html('<center><br><br><br><br><br><br>No results found.</center>');
                }
            }

        }
    });
}


function sortStoriesCompare(type, status, productPostId, productId) {
    var $currencyType = type.value;
    var $status = status;
    var $postId = productPostId;
    if ($status === 'price') {
        var $sortStories = $("#sortStoriesPrice").val();
        //var $sortStories = $('input:hidden:eq(1)', '.sort-stories-compare').val();
    } else {
        var $sortStories = '';
        $('input:hidden:eq(0)', '.sort-stories-currency').val($currencyType);
    }
    var CurrencyId = $('input:hidden:eq(0)', '.sort-stories-currency').val();
    $.ajax({
        type: "POST",
        url: $baseUrl + "story/sort-compare-stories/",
        //dataType: "JSON",
        data: {'currency': CurrencyId, 'status': $status, 'postId': $postId, 'sort': $sortStories, 'productId': productId},
        success: function (data, status) {

            if (data == '') {
                $('.compare-price-ajax').html('<center><br><br><br><br><br><br>No results found.</center>');
            } else {
                if (status == "success") {
                    $('.compare-price-ajax').html(data);
                } else {
                    $('.compare-price-ajax').html('<center><br><br><br><br><br><br>No results found.</center>');
                }
            }
        }
    });
}

function sortStoriesRecent($userId, status, type) {

    if (status == 'view') {
        $sortStories = $("#sortStoriesView").val();
    } else if (status == 'stars') {
        $sortStories = $("#sortStoriesStars").val();
    }

    var productId = $("#productId").val();
    var productSupplierId = $("#productSupplierId").val();
    $.ajax({
        type: "POST",
        url: $baseUrl + "my-account/sort-stories-recent?userId=" + $userId,
        data: {'status': status, 'sort': $sortStories, 'type': type, 'productId': productId, 'productSupplierId': productSupplierId},
        success: function (data, status) {

            if (data == '') {
                $('.sort-stories-cozxy').html('<center><br><br><br><br><br><br>No results found.</center>');
            } else {
                if (status == "success") {
                    $('.sort-stories-cozxy').html(data);
                } else {
                    $('.sort-stories-cozxy').html('<center><br><br><br><br><br><br>No results found.</center>');
                }
            }

        }
    });
}

$(".bs-example-modal-lg-x").click(function () {
    var postId = $(this).attr("data-id")
    var path = $baseUrl + "story/compare-price-story-modified/";
    $.ajax({
        url: path,
        type: "POST",
        //dataType: "JSON",
        data: {'postId': postId, },
        success: function (data, status) {
            if (status == "success") {
                var JSONObject = JSON.parse(data);
                $('#productpost-shopname').val(JSONObject.shopName);
                $('#productpost-price').val(JSONObject.price);
                $('#productpost-country').val(JSONObject.country).trigger('change');
                $('#productpost-currency').val(JSONObject.currency).trigger('change');
                $('#productpost-productPostId').html('<input type="hidden" name="productPostId" id="productPostId" value="' + JSONObject.productPostId + '">');
                console.log(JSONObject.country);
                console.log(JSONObject.currency);
                $(".bs-example-modal-lg").modal("show");
            } else {
                alert('error');
            }
        }
    });
});

function CozxyComparePriceModernBest(id, type, dataIndex) {

    var postId = id;
    if (postId == 0) {
        $('#productpost-shopname').val('');
        $('#productpost-price').val('');
        $('#productpost-country').val('');
        $('#productpost-currency').val('');
        $('#latitude').val('');
        $('#longitude').val('');
        $('#productpost-productPostId').html('<input type="hidden" name="statusPrice" id="statusPrice" value="' + type + '"> ');
        $(".bs-example-modal-lg").modal("show");
    } else {
        var path = $baseUrl + "story/compare-price-story-modified/";
        $.ajax({
            url: path,
            type: "POST",
            //dataType: "JSON",
            data: {'postId': postId, 'type': type},
            success: function (data, status) {
                if (status == "success") {
                    var JSONObject = JSON.parse(data);
                    $('#productpost-shopname').val(JSONObject.shopName);
                    $('#productpost-price').val(JSONObject.price);
                    $('#productpost-country').val(JSONObject.country);
                    $('#productpost-currency').val(JSONObject.currency);
                    $('#latitude').val(JSONObject.latitude);
                    $('#longitude').val(JSONObject.longitude);
                    $('#productpost-productPostId').html('<input type="hidden" name="dataIndex" id="dataIndex" value="' + dataIndex + '"><input type="hidden" name="statusPrice" id="statusPrice" value="' + type + '">  <input type="hidden" name="comparePriceId" id="comparePriceId" value="' + JSONObject.comparePriceId + '">');
                    //console.log(JSONObject.country);
                    //console.log(JSONObject.currency);
                    $(".bs-example-modal-lg").modal("show");
                } else {
                    alert('error');
                }
            }
        });
    }
}

function ComparePriceStory() {
    var $form = $("#default-add-new-compare-price-story"),
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
    var productPostId = $('#productPostId').val();
    var shopName = $('#productpost-shopname').val();
    var price = $('#productpost-price').val();
    var country = $('#productpost-country').val();
    var currency = $('#productpost-currency').val();
    var statusPrice = $('#statusPrice').val();
    var productId = $('#productId').val();
    var comparePriceId = $('#comparePriceId').val();

    var latitude = $('#latitude').val();
    var longitude = $('#longitude').val();

    var dataIndex = $('#dataIndex').val();
    //var tRow = document.getElementById("compare-price-").getElementsByTagName("tr");
    //alert(productPostId);
    //alert(idTds);


    var path = $baseUrl + "story/compare-price-story/";
    $data = '';
    if (statusPrice == 'add') {
        // alert('status : add new price');
        $.ajax({
            url: path,
            type: "POST",
            //dataType: "JSON",
            data: {'productPostId': productPostId, 'shopName': shopName, 'price': price,
                'country': country, 'currency': currency,
                'statusPrice': statusPrice, 'productId': productId,
                'latitude': latitude, 'longitude': longitude
            },
            success: function (data, status) {
                // console.log(data.price);
                var JSONObject = JSON.parse(data);
                if (status == "success") {
                    var table = document.getElementById("table-compare-price-cozxy");
                    var row = table.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    var rowCount = table.rows.length;

                    cell1.innerHTML = rowCount - 1;
                    cell2.innerHTML = JSONObject.country;
                    cell3.innerHTML = JSONObject.shopName
                    cell4.innerHTML = JSONObject.price;
                    cell5.innerHTML = JSONObject.LocalPrice + '<code><a class="text-danger" onclick="CozxyComparePriceModernBest(' + JSONObject.comparePriceId + ',' + '\'edit\'' + ',' + dataIndex + ')"><i class=\'fa fa-pencil-square-o\'></i>Edit Price</a></code>';
                    $('#compare-price-' + productPostId).append($data);
                    $(".bs-example-modal-lg").modal("hide");

                } else {
                    alert('error');
                }
            }
        });
    } else {
        $.ajax({
            url: path,
            type: "POST",
            //dataType: "JSON",
            data: {'productPostId': productPostId, 'shopName': shopName, 'price': price,
                'country': country, 'currency': currency, 'statusPrice': statusPrice,
                'comparePriceId': comparePriceId, 'latitude': latitude, 'longitude': longitude
            },
            success: function (data, status) {
                // console.log(data.price);
                var JSONObject = JSON.parse(data);
                if (status == "success") {
                    //$data += "<tr id='compare-price-" + JSONObject.comparePriceId + "'>";
                    $data += "<td>" + dataIndex + "</td>";
                    $data += "<td>" + JSONObject.country + "</td>";
                    $data += " <td>" + JSONObject.shopName + "</td>";
                    $data += "<td>" + JSONObject.price + "</td>";
                    $data += "<td>";
                    $data += "" + JSONObject.LocalPrice + "<code>";
                    $data += '<a class="text-danger"  onclick="CozxyComparePriceModernBest(' + JSONObject.comparePriceId + ',' + '\'edit\'' + ',' + '\'edit\'' + ',' + dataIndex + ')"><i class=\'fa fa-pencil-square-o\'></i>';
                    $data += "&nbsp;Edit Price</a></code></td>";
                    //$data += "</tr>";
                    $('#compare-price-' + JSONObject.comparePriceId).html($data);
                    $(".bs-example-modal-lg").modal("hide");
                } else {
                    alert('error');
                }
            }
        });
    }

}



counter = function () {

    var $textarea = $('#productpost-shortdescription').val();

    if ($textarea.length == 0) {
        $('#wordCount').html(0);
        $('#totalChars').html(0);
        $('#charCount').html(0);
        $('#charCountNoSpace').html(0);
        return;
    }
    console.log($textarea.length);
    var regex = /\s+/gi;
    var wordCount = $textarea.trim().replace(regex, ' ').split(' ').length;
    var totalChars = $textarea.length;
    var charCount = $textarea.trim().length;
    var charCountNoSpace = $textarea.replace(regex, '').length;

    $('#wordCount').html(wordCount);
    $('#totalChars').html(totalChars);
    $('#charCount').html(charCount);
    $('#charCountNoSpace').html(charCountNoSpace);
    var max = 10;
    if (totalChars > max) {
        //var top = $textarea.scrollTop();
        //$textarea.val($textarea.val().substr(0, max));
        //$textarea.scrollTop(top);
        //alert(totalChars);
    }
};

$(document).ready(function () {
    //$('#count').click(counter);
    $('#productpost-shortdescription').change(counter);
    $('#productpost-shortdescription').keydown(counter);
    $('#productpost-shortdescription').keypress(counter);
    $('#productpost-shortdescription').keyup(counter);
    $('#productpost-shortdescription').blur(counter);
    $('#productpost-shortdescription').focus(counter);
});


//
$("#acceptTerms").click(function () {
    //alert('Accept Terms');
    $(".bs-example-modal-lg").modal("hide");
    //loginform-accept-term
    document.getElementById('loginform-accept-term').checked = true;
    $('#create-account').removeAttr('disabled');
    $('#create-account').val('CREATE ACCOUNT');
});

$('#loginform-accept-term').click(function () {
    document.getElementById('loginform-accept-term').checked = true;
    $('#create-account').removeAttr('disabled');
    $('#create-account').val('CREATE ACCOUNT');
});


function StoriesRemove(id) {
    var path = $baseUrl + "story/stories-remove/";
    var $this = $('#removeItemStory-' + id);
    $this.button('loading');
    setTimeout(function () {
        $this.button('reset');
    }, 8000);
    $.ajax({
        url: path,
        type: "POST",
        //dataType: "JSON",
        data: {'id': id},
        success: function (data, status) {
            if (status == "success") {
                //var JSONObject = JSON.parse(data);
                $('.item-to-stories-' + id).remove();

            } else {
                alert('error');
            }
        }
    });
}