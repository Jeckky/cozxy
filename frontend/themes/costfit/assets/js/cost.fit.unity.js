/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 *Limo HTML5 E-Commerce Template v1.4
 *Copyright 2015 8Guild.com
 *All scripts for Limo HTML5 E-Commerce Template
 */

/*Document Ready*////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function (e) {

    /*Global Variables
     *******************************************/

    var $addToCartBtn = $('#addItemToCartUnity');
    var $baseUrl = window.location.protocol + "//" + window.location.host;
    if (window.location.host == 'localhost') {
        $baseUrl = window.location.protocol + "//" + window.location.host + '/cost.fit-frontend/';
    } else if (window.location.host == '192.168.100.8') {
        $baseUrl = window.location.protocol + "//" + window.location.host + '/cost.fit/frontend/web/';
    } else {
        $baseUrl = window.location.protocol + "//" + window.location.host + '/';
    }

    /*Adding Placeholder Support in Older Browsers
     ************************************************/
    $('input, textarea').placeholder();

    /*Shopping Cart Dropdown
     *******************************************/
    //wishlist


    $(document).on('click', '.cart-dropdown .delete', function () {

        var $target = $(this).parent().parent();
        var $positions = $('.cart-dropdown .item');
        var $positionQty = parseInt($('.cart-btn a span').text());
        var orderItemId = $(this).find("#orderItemId").val();
        var itemQty = $(this).parent().parent().find(".qty").find("#qty").val();

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + 'cart/delete-cart-item' + "?id=" + orderItemId,
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
                                $('.cart-dropdown .body').html('<h3>Cart is empty!</h3>');
                            }
                            $('.cart-btn a').find("#cartTotal").html(data.cart.totalFormatText);
                            $('.cart-dropdown .footer .total').html(data.cart.totalFormatText);
                            if ($('.shopping-cart').find("#item" + orderItemId) !== undefined)
                            {
                                $('.shopping-cart').find("#item" + orderItemId).remove();
                            }
                            if ($('.shopping-cart .cart-sidebar .cart-totals .total').html() !== undefined)
                            {
                                $('.shopping-cart .cart-sidebar .cart-totals .total').html(data.cart.totalFormatText);
                                $('.shopping-cart .cart-sidebar .cart-totals .shipping').html(data.cart.shippingFormatText);
                                $('.shopping-cart .cart-sidebar .cart-totals .summary').html(data.cart.summaryFormatText);
                            }
                        });
                    });
                }
            }
        });
    });

    /*Shopping Cart Page
     *******************************************/
    //Deleting Items
    $(document).on('click', '.shopping-cart .delete i', function () {
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

    /*Wishlist Deleting Items
     *******************************************/
    $(document).on('click', '.wishlist .delete i', function () {
        event.preventDefault();
        var $target = $(this).parent().parent();
        var pId = $(this).parent().parent().find("#productId").val();

//        $target.hide(300, function () {
        $.when($target.remove()).then(function () {
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: $baseUrl + '/cart/delete-wishlist',
                data: {productId: pId},
                success: function (data)
                {
                    if (data.status)
                    {
                        $target.hide(300, function () {
                            $('.wishlist .items-list').remove();
                            $('.wishlist .title').text('Wishlist is empty!');
                            alert("Delete wishlist success");
//                                    $positionQty = $positionQty - itemQty;
//                                    $('.cart-btn a span').text($positionQty);
//                                    if ($positions.length === 1) {
//                                        $('.shopping-cart .items-list').remove();
//                                        $('.shopping-cart .title').text('Shopping cart is empty!');
//                                    }
//                                    $('.cart-btn a').find("#cartTotal").html(data.cart.totalFormatText);
//                                    $('.cart-dropdown .footer .total').html(data.cart.totalFormatText);
//                                    if ($('.cart-dropdown').find("#item" + orderItemId) !== undefined)
//                                    {
//                                        $('.cart-dropdown').find("#item" + orderItemId).remove();
//                                    }
//                                    if ($('.shopping-cart .cart-sidebar .cart-totals .total').html() !== undefined)
//                                    {
//                                        $('.shopping-cart .cart-sidebar .cart-totals .total').html(data.cart.totalFormatText);
//                                        $('.shopping-cart .cart-sidebar .cart-totals .shipping').html(data.cart.shippingFormatText);
//                                        $('.shopping-cart .cart-sidebar .cart-totals .summary').html(data.cart.summaryFormatText);
//                                    }
                        });
                    }
                }
            });

        });
//        });
    });


    /*Added To Cart Message + Action (For Demo Purpose)
     **************************************************/
    $addToCartBtn.click(function () {
        event.preventDefault();
        $addedToCartMessage.removeClass('visible');
        var $itemName = $(this).parent().parent().find('h1').text();

        if (typeof $itemName == 'undefined' || $itemName == '')
        {
            var $itemName = $(this).parent().parent().find('.title').html();
        }
        var $itemId = $(this).parent().parent().find('#productId').val();
        var $fastId = $(this).parent().parent().find('#fastId').val();
        var $itemPrice = $(this).parent().parent().find('.price').text();
        var $itemQnty = $(this).parent().find('#quantity').val();
        var $cartTotalItems = parseInt($('.cart-btn a span').text()) + parseInt($itemQnty);
        $addedToCartMessage.find('p').text('"' + $itemName + '"' + '  ' + 'was successfully added to your cart.');
//        var getUrl = window.location;
//        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
//        alert(baseUrl);

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + '/cart/add-to-cart' + "?id=" + $itemId,
            data: {quantity: $itemQnty, fastId: $fastId},
            success: function (data)
            {
                if (data.status)
                {
                    $('.cart-dropdown table').append(
                            '<tr class="item"><td><div class="delete"></div><a href="#">' + $itemName +
                            '<td><input type="text" value="' + $itemQnty +
                            '"></td><td class="price">' + $itemPrice + '</td>'
                            );
                    $('.cart-btn a span').text($cartTotalItems);
                    $('.cart-btn a').find("#cartTotal").html(data.cart.totalFormatText);
                    $('.cart-dropdown .footer .total').html(data.cart.totalFormatText);
                }
            }
        });

        $addedToCartMessage.addClass('visible');
    });

    //Add(+/-) Button Number Incrementers
    $(".incr-btn").on("click", function (e) {
        event.preventDefault();
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
            url: $baseUrl + '/cart/change-quantity-item',
            data: {productId: $("#productId").val(), quantity: newVal},
            success: function (data)
            {
                if (data.status)
                {
//                    $('.price').html(data.priceText);
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

});/*Document Ready End*//////////////////////////////////////////////////////////////////////////////////////////////////////////////


/************************************************************************/


