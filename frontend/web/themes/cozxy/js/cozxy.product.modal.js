// Ready Function
$(function () {
    $('.mod-blur').click(function () {
        $('.mod-body').html('');
        modPreviewClose();
        return false;
    });
    $('.mod-close').click(function () {
        $('.mod-body').html('');
        modPreviewClose();
        return false;
    });
});

// Popup Modal Script
function modPreviewClose() {
    $('body').css('overflow-y', 'auto');
    $('.mod-bg').fadeOut(384);
}
function modPreviewOpen() {
    $('body').css('overflow-y', 'hidden');
    $('.mod-bg').fadeIn(384);
}
function popProduct(x) {
    if (x != '') {
        $('.mod-body').load('product-modal.php?id=' + x);
        modPreviewOpen();
    } else {
        modPreviewClose();
    }
}

// Modal Quantity
function qmSet(x) {
    var temp = parseInt($('.mod-body .quantity').val());
    if (isNaN(temp)) {
        temp = 1;
    }
    temp += x;
    if (temp < 1) {
        temp = 1;
    }
    $('.mod-body .quantity').val(temp);
}
$('.mod-body .color-s').click(function () {
    return false;
});

// Slide Thumbnail for Product View
function scrolling2Left() {
    $('.product-detail .product-thumb').animate({scrollLeft: "-=94"});
}
function scrolling2Right() {
    $('.product-detail .product-thumb').animate({scrollLeft: "+=94"});
}
function pic2Zoom(src, zoom) {
    var temp = src;
    var large = zoom;
    var ez = $('#zoom-img').data('elevateZoom');
    console.log(temp);
    console.log(large);
    ez.swaptheimage(temp, large);
    $('.product-detail .zoom-box a').attr('href', temp);
}

// Slide Thumbnail for Product Modal
function scrolling4Left() {
    $('.mod-body .product-thumb').animate({scrollLeft: "-=94"});
}
function scrolling4Right() {
    $('.mod-body .product-thumb').animate({scrollLeft: "+=94"});
}
function pic4Zoom(src) {
    var temp = src;
    $('.mod-body .zoom-box img').attr('src', temp);
    $('.mod-body .zoom-box a').attr('href', temp);
}