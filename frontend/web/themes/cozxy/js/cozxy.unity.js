$(document).ready(function (e) {
    /*Global Variables Use : Product Views
     * add to cart use product view
     *******************************************/
    var $addToCartBtn = $('#addItemToCartUnity');

    $addToCartBtn.click(function () {
        if (navigator.userAgent.indexOf("Firefox") != -1) {
            alert('Firefox');
        } else {
            event.preventDefault();
        }

        //alert('test add to cart new ');
        $('#notify-cart-top-menu').removeAttr('style');
        //$addedToCartMessage.removeClass('visible');
        var $itemName = $(this).parent().parent().find('h1').text();
        if (typeof $itemName == 'undefined' || $itemName == '')
        {
            var $itemName = $(this).parent().parent().find('.title').html();
        }

        /* var $itemId = $(this).parent().parent().find('#productId').val();
         var $productSuppId = $(this).parent().parent().find('#productSuppId').val();
         var $fastId = $(this).parent().parent().find('#fastId').val();
         var $supplierId = $(this).parent().parent().find('#supplierId').val();
         var $itemPrice = $(this).parent().parent().find('.price').text();
         var $itemQnty = $(this).parent().find('#quantity').val();
         var $cartTotalItems = parseInt($('.cart-btn a span').text()) + parseInt($itemQnty);
         var $maxQnty = $(this).parent().find('#maxQnty').val();
         */
        var $itemId = $('#productId').val();
        var $productSuppId = $('#productSuppId').val();
        var $fastId = $('#fastId').val();
        var $supplierId = $('#supplierId').val();
        //var $itemPrice = $('#price').val();
        var $itemQnty = $('#quantity').val();
        var $cartTotalItems = '';
        var $maxQnty = $('#maxQnty').val();

        /*
         *เพิ่ม Type จุดรับสินค้า
         * 1.Lockers
         * 2.Booth
         */
        var $receiveType = $('#receiveType').val();
        //$('#addItemToCartUnity').html('test add to cart');
        var $this = $('#addItemToCartUnity');
        $this.button('loading');
        setTimeout(function () {
            $this.button('reset');
        }, 8000);
        if (parseInt($itemQnty) <= parseInt($maxQnty) && parseInt($itemQnty) > 0) {

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: $baseUrl + 'cart/add-to-cart' + "?id=" + $itemId,
                data: {quantity: $itemQnty, fastId: $fastId, supplierId: $supplierId, productSuppId: $productSuppId, receiveType: $receiveType},
                success: function (data)
                {

                    if (data.status) {
                        if (data.isMaxQuantitys == 'YES') {
                            $('#maxQnty').val($maxQnty - $itemQnty);
                            if (($maxQnty - $itemQnty) == 0) {
                                $('#quantity').val(0);
                                //$addToCartBtn.attr('disabled', 'disabled');
                            } else {
                                $('#quantity').val(1);
                            }
                            //$('.cart-dropdown table').remove();
                            //$('.cart-dropdown .body').append(
                            //data.shoppingCart
                            // );
                            // $('.cart-btn a span').text($cartTotalItems);
                            //$('.cart-btn a').find("#cartTotal").html(data.cart.totalFormatText);
                            //$('.cart-dropdown .footer .total').html(data.cart.totalFormatText);
                            //window.location = $baseUrl + 'cart';

                            // $.notify("Add to Cart Success ,", "success");
                            $('#cart-plus-' + $productSuppId).removeClass('fa fa-cart-plus fa-spin');
                            $('#cart-plus-' + $productSuppId).addClass('fa fa-check');
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
                        } else if (data.isMaxQuantitys == 'NO') {
                            alert('Sorry, there is not enough item left in stock.');
                            $('#cart-plus-' + $productSuppId).removeClass('fa fa-cart-plus fa-spin');
                            $('#cart-plus-' + $productSuppId).addClass('fa fa-times');
                        }
                    } else {
                        alert('Sorry, there is not enough item left in stock.');
                        $('#cart-plus-' + $productSuppId).removeClass('fa fa-cart-plus fa-spin');
                        $('#cart-plus-' + $productSuppId).addClass('fa fa-times');
                    }
                    //alert(data.shoppingCart);
                    //$addedToCartMessage.addClass('visible');
                }
            });
        } else {
            $(this).parent().find('#quantity').val($maxQnty);
            $(this).parent().find('#maxQnty').val($maxQnty);
            if ($itemQnty == 0) {
                $(this).parent().find('#quantity').val(1);
                alert("Sorry, there is not enough item left in stock.");
            } else {
                //alert($(this).parent().find('#quantity').val() + ' max ' + $(this).parent().find('#maxQnty').val());
                alert("Sorry, there is not enough item left in stock.");
            }
        }
    });

});


