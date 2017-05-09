/*
 * http://www.codeigniter.in.th/jsmin
 * ลดขนาดไฟล์ Javascript ด้วย JS Minifier
 * By Taninut.Bm
 * Create Date : 2/02/2017
 */

$(document).ready(function (e) {
    /*Global Variables
     *******************************************/
    var $addToCartBtn = $('#addItemToCartUnity');
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
//console.log($baseUrl);
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
        var $maxQnty = parseInt($('#maxQnty').val());
        var $productSuppId = $(this).parent().parent().find("#productSuppId").val();
        var $wmaxQnty = parseInt($('#maxQnty' + $productSuppId).val());
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + 'cart/delete-cart-item' + "?id=" + orderItemId,
            data: {maxQnty: $maxQnty},
            success: function (data)
            {

                if (data.status)
                {
                    $target.hide(300, function () {
                        $.when($target.remove()).then(function () {
                            $positionQty = $positionQty - itemQty;
                            $('.cart-btn a span').text($positionQty);
                            $('#maxQnty').val($maxQnty + data.deleteQnty);
                            $('#maxQnty' + $productSuppId).val($wmaxQnty + data.deleteQnty);
                            if (($maxQnty + data.deleteQnty) > 0) {
                                $('#quantity').val(1);
                                $addToCartBtn.removeAttr('disabled');
                                $('#addWishlistItemToCart' + data.productSuppId).removeAttr('disabled');
                            } else {
                                $('#quantity').val(0);
                                $addToCartBtn.attr('disabled', 'disabled');
                            }
                            if (($wmaxQnty + data.deleteQnty) > 0) {
                                $('#addWishlistItemToCart' + data.productSuppId).removeAttr('disabled');
                            }
                            if ($positions.length === 1) {
                                $('.cart-dropdown .body').html('<h3>Cart is empty!</h3>');
                                $('.shopping-cart .items-list').remove();
                                $('.shopping-cart .title').html('<h3>Cart is empty!</h3>');
                                $('.shopping-cart #showSlow').remove();
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
                            //$('.cart-dropdown ').append($target);
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
        if (navigator.userAgent.indexOf("Firefox") != -1) {
//alert('Firefox');
        } else {
            event.preventDefault();
        }

        var $target = $(this).parent().parent();
        var pId = $(this).parent().parent().find("#productSuppId").val();
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

                            if (data.length == 0) {
                                $('.wishlist .title').text('Wishlist is empty!');
                                $('.wishlist .items-list').remove();
                            }
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
        if (navigator.userAgent.indexOf("Firefox") != -1) {
            alert('Firefox');
        } else {
            event.preventDefault();
        }

        //alert('test add to cart new ');

        //$addedToCartMessage.removeClass('visible');
        var $itemName = $(this).parent().parent().find('h1').text();
        if (typeof $itemName == 'undefined' || $itemName == '')
        {
            var $itemName = $(this).parent().parent().find('.title').html();
        }

        var $itemId = $(this).parent().parent().find('#productId').val();
        var $productSuppId = $(this).parent().parent().find('#productSuppId').val();
        var $fastId = $(this).parent().parent().find('#fastId').val();
        var $supplierId = $(this).parent().parent().find('#supplierId').val();
        var $itemPrice = $(this).parent().parent().find('.price').text();
        var $itemQnty = $(this).parent().find('#quantity').val();
        var $cartTotalItems = parseInt($('.cart-btn a span').text()) + parseInt($itemQnty);
        var $maxQnty = $(this).parent().find('#maxQnty').val();
        /*
         *เพิ่ม Type จุดรับสินค้า
         * 1.Lockers
         * 2.Booth
         */
        var $receiveType = $(this).parent().parent().find("#receiveType").val();
        //alert($receiveType);
        //$addedToCartMessage.find('p').text('"' + $itemName + '"' + '  ' + 'was successfully added to your cart.');
        //var getUrl = window.location;
        //var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
        // alert($itemQnty + " max=> " + $maxQnty);
        if (parseInt($itemQnty) <= parseInt($maxQnty) && parseInt($itemQnty) > 0) {
            // alert("aaaaaa");
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: $baseUrl + '/cart/add-to-cart' + "?id=" + $itemId,
                data: {quantity: $itemQnty, fastId: $fastId, supplierId: $supplierId, productSuppId: $productSuppId, receiveType: $receiveType},
                success: function (data)
                {
                    if (data.status)
                    {
                        $('#maxQnty').val($maxQnty - $itemQnty);
                        if (($maxQnty - $itemQnty) == 0) {
                            $('#quantity').val(0);
                            $addToCartBtn.attr('disabled', 'disabled');
                        } else {
                            $('#quantity').val(1);
                        }
                        $('.cart-dropdown table').remove();
                        $('.cart-dropdown .body').append(
                                data.shoppingCart
                                );
                        $('.cart-btn a span').text($cartTotalItems);
                        $('.cart-btn a').find("#cartTotal").html(data.cart.totalFormatText);
                        $('.cart-dropdown .footer .total').html(data.cart.totalFormatText);
                    }
                    //alert(data.shoppingCart);
                    $addedToCartMessage.addClass('visible');
                }
            });
        } else {
            $(this).parent().find('#quantity').val($maxQnty);
            $(this).parent().find('#maxQnty').val($maxQnty);
            if ($itemQnty == 0) {
                $(this).parent().find('#quantity').val(1);
                alert("Can not be '0'");
            } else {
                //alert($(this).parent().find('#quantity').val() + ' max ' + $(this).parent().find('#maxQnty').val());
                alert("Max quantity for this product");
            }
        }

        //
    });
    //Add(+/-) Button Number Incrementers
    $(".incr-btn").on("click", function (e) {
        if (navigator.userAgent.indexOf("Firefox") != -1) {
//alert('Firefox');
        } else {
            event.preventDefault();
        }

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
        $button.parent().find("input").val(newVal);
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + '/cart/change-quantity-item',
            data: {productSuppId: $("#productSuppId").val(), quantity: newVal},
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
    $("#resetOtp").on("click", function (e) {
        var orderId = $(this).parent().parent().parent().find("#orderId").val();
        var tel = $(this).parent().parent().parent().find("#tel").val();
        var userId = $(this).parent().parent().parent().find("#userId").val();
        $.ajax({
            type: "POST",
            url: $baseUrl + '/receive/gen-new-otp',
            data: {orderId: orderId, tel: tel, userId: userId},
            success: function (data) {
                $('.refNo').html('<h4 class="text-center refNo"> Ref No : ' + data + '</h4>');
            }
        });
    });
    //////////////////////////////    RETURN  ///////////////////////////////////////
    $(document).on('click', '#sendTicket', function () {
        var invoice = $(this).parent().parent().find("#invoiceNo").val();
        var tickeTitle = $(this).parent().parent().find("#tickeTitle").val();
        var description = $(this).parent().parent().find("#description").val();
        if (invoice == '' || tickeTitle == '' || description == '') {
            alert('กรุณากรอกข้อมูลให้ครบทุกช่อง');
        } else {
            $("#ticket-form").submit();
        }
    });
    $(document).on('click', '#sendMessege', function () {
        var messege = $(this).parent().parent().find("#messege").val();
        var orderId = $(this).parent().parent().find("#orderId").val();
        var userId = $(this).parent().parent().find("#userId").val();
        var ticketId = $(this).parent().parent().find("#ticketId").val();
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: $baseUrl + '/profile/save-messege',
            data: {messege: messege, orderId: orderId, userId: userId, ticketId: ticketId},
            success: function (data) {
                if (data.status) {
                    $("#messege").val('');
                }
            }
        });
    });
    $(document).on('keyup', '#messege', function (e) {
        var messege = $(this).parent().parent().find("#messege").val();
        var orderId = $(this).parent().parent().find("#orderId").val();
        var userId = $(this).parent().parent().find("#userId").val();
        var ticketId = $(this).parent().parent().find("#ticketId").val();
        if (e.keyCode == 13) {
            alert("assss");
            $("#messege").val('');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: $baseUrl + '/profile/save-messege',
                data: {messege: messege, orderId: orderId, userId: userId, ticketId: ticketId},
                success: function (data) {
                    if (data.status) {
                        $("#messege").val('');
                    }
                }
            });
        }
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
    $(document).on('click', '#confirm-topup', function (e) {
        var amount = $(this).parent().parent().parent().parent().find('#amount').val();
        var currentAmount = $(this).parent().parent().parent().parent().parent().find('#currentAmount').val();
        if (amount == '') {
            if (currentAmount == '') {
                alert('empty amount');
                return false;
            } else {
                if (!confirm(':: Confirm Amount ' + currentAmount + ' THB ?')) {
                    return false;
                }
            }
        } else {
            if (!confirm(':: Confirm Amount ' + amount + ' THB ?')) {
                return false;
            }
        }
    });
    $(document).on('click', '#regis-button', function () {
        var password = $(this).parent().parent().find('#user-password').val();
        var agree = $(this).parent().parent().find('#agreePolicy');
        if ($("#agreePolicy").is(':checked') == false) {
            alert('Please check, you have read and agree with the term.');
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: $baseUrl + '/register/check-password',
                data: {password: password},
                success: function (data) {
                    if (data.status == true) {
                        alert(data.ms);
                    } else {
                        $('#register-form').submit();
                        //alert(data.ms);
                    }
                }
            });
        }
    });

});/*Document Ready End*//////////////////////////////////////////////////////////////////////////////////////////////////////////////


/************************************************************************/


