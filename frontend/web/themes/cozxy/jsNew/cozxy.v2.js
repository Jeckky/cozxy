/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('#media').carousel({
        pause: true,
        interval: false,
    });
    $('#media1').carousel({
        pause: true,
        interval: false,
    });
    $('#media2').carousel({
        pause: true,
        interval: false,
    });
    $('#media3').carousel({
        pause: true,
        interval: false,
    });
    $('#media4').carousel({
        pause: true,
        interval: false,
    });
    $('#media5').carousel({
        pause: true,
        interval: false,
    });

    $('#fruitscarousel').carousel({
        pause: true,
        interval: false,
    });


    $('#cozxycarousel1').carousel({
        pause: true,
        interval: false,
    });

    $('#cozxyCarousel2').carousel({
        pause: true,
        interval: false,
    });

    $('#cozxyCarousel3').carousel({
        pause: true,
        interval: false,
    });

    $('#cozxyCarousel4').carousel({
        pause: true,
        interval: false,
    });

    $('#cozxyCarousel5').carousel({
        pause: true,
        interval: false,
    });

    $('#cozxyCarousel6').carousel({
        pause: true,
        interval: false,
    });

    $('#media1').find('.item').first().addClass('active');
});

/*$('.menu-category-brands').mouseover(function () {
 categoryOff();
 $('#categories-brands').collapse('show');
 $(this).addClass('active');
 });

 $('.menu-category-brands').mouseout(function () {
 $('.menubar .menu-category-brands').removeClass('active');
 $('.categories-submenu-brands .menu-item').removeClass('active');
 $('.sub2menu').hide(0);
 });*/



/*  menu nav Brand   */

$('.topbar').mouseover(function () {
    categoryOffBrands();
    $('#categories-brands').collapse('hide');
});
$('.headbar').mouseover(function () {
    categoryOffBrands();
    $('#categories-brands').collapse('hide');
});

function categoryOffBrands() {
    $('.menubar-cozxy .menu-category-brands').removeClass('active');
    $('.categories-submenu-brands .menu-item').removeClass('active');
    $('.sub2menu').hide(0);
}

$(".menu-category-brands").mouseout(function () {
    categoryOffBrands();
}).mouseover(function () {
    //categoryOff();
    $('#categories-brands').collapse('show');
    $('#categories-brands').addClass('active');
    /* hide */
    $('#categories-clearance').collapse('hide');
    $('#categories').collapse('hide');
    $('#categories-pomotion').collapse('hide');
});

/*  menu nav clearance   */

$('.topbar').mouseover(function () {
    categoryOffClearance();
    $('#categories-clearance').collapse('hide');
});
$('.headbar').mouseover(function () {
    categoryOffClearance();
    $('#categories-clearance').collapse('hide');
});

function categoryOffClearance() {
    $('.menubar-cozxy .menu-category-clearance').removeClass('active');
    $('.categories-submenu-clearance .menu-item').removeClass('active');
    $('.sub2menu').hide(0);
}

$(".menu-category-clearance").mouseout(function () {
    categoryOffClearance();
}).mouseover(function () {

    $('#categories-clearance').collapse('show');
    $('#categories-clearance').addClass('active');
    /* hide */
    $('#categories-brands').collapse('hide');
    $('#categories').collapse('hide');
    $('#categories-pomotion').collapse('hide');
});


/*  menu nav pomotion   */

$('.topbar').mouseover(function () {
    categoryOffClearance();
    $('#categories-pomotion').collapse('hide');
});
$('.headbar').mouseover(function () {
    categoryOffClearance();
    $('#categories-pomotion').collapse('hide');
});

function categoryOffClearance() {
    $('.menubar-cozxy .menu-category-pomotion').removeClass('active');
    $('.categories-submenu-pomotion .menu-item').removeClass('active');
    $('.sub2menu').hide(0);
}

$(".menu-category-pomotion").mouseout(function () {
    categoryOffClearance();
}).mouseover(function () {

    $('#categories-pomotion').collapse('show');
    $('#categories-pomotion').addClass('active');
    /* hide brands*/
    $('#categories-brands').collapse('hide');
    $('#categories-clearance').collapse('hide');
    $('#categories').collapse('hide');
});


/* menu nav categories   */

$('.topbar').mouseover(function () {
    categoryOff();
    $('#categories').collapse('hide');
});
$('.headbar').mouseover(function () {
    categoryOff();
    $('#categories').collapse('hide');
});

function categoryOff() {
    $('.menubar-cozxy .menu-category').removeClass('active');
    $('.categories-submenu .menu-item').removeClass('active');
    $('.sub2menu').hide(0);
}

$(".menu-category").mouseout(function () {
    categoryOff();
}).mouseover(function () {
    $('#categories').collapse('show');
    $('#categories').addClass('active');
    /* hide brands*/
    $('#categories-brands').collapse('hide');
    $('#categories-clearance').collapse('hide');
    $('#categories-pomotion').collapse('hide');
});


/*jQuery(document).ready(function () {

 jQuery('.carousel[data-type="multi"] .item').each(function () {
 var next = jQuery(this).next();
 if (!next.length) {
 next = jQuery(this).siblings(':first');
 }
 next.children(':first-child').clone().appendTo(jQuery(this));

 for (var i = 0; i < 4; i++) {
 next = next.next();
 if (!next.length) {
 next = jQuery(this).siblings(':first');
 }
 next.children(':first-child').clone().appendTo($(this));
 }
 });

 });*/


jQuery(document).ready(function () {

    jQuery('.carousel[data-type="multi"] .item').each(function () {
        var next = jQuery(this).next();
        if (!next.length) {
            next = jQuery(this).siblings(':first').addClass('active');
        }
        next.children(':first-child').clone().appendTo(jQuery(this));
        //console.log(next.children(':first-child'));
        for (var i = 0; i < 4; i++) {
            var itemType = $(this).data('id');
            next = next.next();
            if (!next.length) {
                next = jQuery(this).siblings(':first').addClass('active');
            }
            //$('.box-product-items').attr("items-id", itemType);
            next.children(':first-child').clone().appendTo($(this));
        }
    });

});

