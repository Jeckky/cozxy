
$(function () {
    /*$('.topbar').on('touchstart click', function (event) {
     alert(event.type);
     if (event.type == "touchstart")
     $(this).off('click').on('click', function (e) {
     e.preventDefault();
     alert('xxxx');
     });
     //your code here
     });*/

});
$(function () {

    //http://blog.grayghostvisuals.com/css/touchevents/
    //grab the object
    /* var el = document.getElementById('nodetarget');
     //custom function handler for event
     function touchStart(event) {
     event.preventDefault();
     var numtouch = event.touches.length;
     alert(numtouch);
     }
     //add event listener
     el.addEventListener('touchstart', touchStart, false);
     */
    $('.topbar .dismiss').on('touchstart click', function () {
        $('.topbar').slideUp();
        $('.topOpener').slideDown();
        return false;
    });
    $('.topOpener').on('touchstart click', function () {
        $('.topbar').slideDown();
        $('.topOpener').slideUp();
    });
    $('.gotoTop').on('touchstart click', function () {
        $('html,body').animate({scrollTop: 0});
        return false;
    });
// Scroll Script
    $(window).scroll(function () {
        var $this = $(this), $top = $(".smallTop");
        if ($this.scrollTop() > 384) {
            $top.fadeIn(384);
        } else {
            $top.fadeOut(384);
        }
    });
// Category Script (PC)
    $('.menu-category').on('touchstart click', function () {
        categoryOff();
        $(this).addClass('active');
    });
    $('.menu-category').mouseover(function () {
        categoryOff();
        $('#categories').collapse('show');
        $(this).addClass('active');
    });
    $('.topbar').mouseover(function () {
        categoryOff();
        $('#categories').collapse('hide');
    });
    $('.headbar').mouseover(function () {
        categoryOff();
        $('#categories').collapse('hide');
    });
// Category Script (SM)
    var mobc = $('.main-category').html();
    $('.mob-maincate').html(mobc);
    $('.mobcategories').on('touchstart click', function () {
        $('body').css('overflow-y', 'hidden');
        $('.xs-category').slideDown(384);
    });
    var mouseo_x = 0;
    var mouseo_y = 0;
    var mouseo_z = 0;
    $('.menubar').hover(function () {
        mouseo_x = 1;
    }, function () {
        mouseo_x = 0;
    });
    $('.main-category').hover(function () {
        mouseo_y = 1;
    }, function () {
        mouseo_y = 0;
    });
    $('.sub2menu').hover(function () {
        mouseo_z = 1;
    }, function () {
        mouseo_z = 0;
    });
    $('.container .row').hover(function () {
        setTimeout(function () {
            if ((mouseo_x + mouseo_y + mouseo_z) <= 0) {
                categoryOut();
            }
        }, 512);
    });
});
// Sub Category Script (PC)
function categoryOut() {
    categoryOff();
    $('#categories').collapse('hide');
}
function categoryOff() {
    $('.menubar .menu-category').removeClass('active');
    $('.categories-submenu .menu-item').removeClass('active');
    $('.sub2menu').hide(0);
}
function categoryLoad(x) {
    $('.categories-submenu .menu-item').removeClass('active');
    $('.categories-submenu .sub-' + x).addClass('active');
    var temp = $('.sub-item-' + x).html();
    if (temp != '') {
        $('.loadCategory').html(temp);
        var cs = $('.categories-submenu').height();
        $('.sub2menu').css('min-height', cs + 'px');
        $('.sub2menu').slideDown(384);
    } else {
        categoryOff();
    }
    //alert(x);
    var path = $baseUrl + "api-other/filter-cat-in-brand";
    $.ajax({
        url: path,
        type: "POST",
        //dataType: "JSON",
        data: {categories: x},
        success: function (data, status) {

            $('.brand_menu_in_brands').html(data);

        }
    });
}
$(document).on('mousemove', function (event) {
    var h1 = $('.topbar').height();
    var h2 = $('.headbar').height();
    var h3 = $('.menubar').height();
    var h4 = $('.categories-submenu').height() + 128;
    var header = (h1 + h2 + h3 + h4);
    if (event.pageY >= header) {
        categoryOff();
        $('#categories').collapse('hide');
    }
});
// Sub Category Script (SM)
function xscategoryOff() {
    $('body').css('overflow-y', 'auto');
    $('.xs-category').slideUp(384);
}
function xscategoryBack() {
    $('.mob-box').animate({left: '0'}, 512);
}
function categoryMob(x) {
    var temp = $('.sub-item-' + x).html();
    if (temp != '') {
        $('.mob-subcate').html(temp);
        $('.mob-box').animate({left: '-100vw'}, 512);
    } else {
        categoryOff();
    }
}
