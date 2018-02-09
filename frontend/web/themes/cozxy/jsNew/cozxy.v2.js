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
$('.topbar').mouseover(function () {
    categoryOff();
    $('#categories-brands').collapse('hide');
});
$('.headbar').mouseover(function () {
    categoryOff();
    $('#categories-brands').collapse('hide');
});
function categoryOff() {
    $('.menubar-cozxy .menu-category-brands').removeClass('active');
    $('.categories-submenu-brands .menu-item').removeClass('active');
    $('.sub2menu').hide(0);
}

$(".menu-category-brands")
        .mouseout(function () {
            categoryOff();
        })
        .mouseover(function () {
            //categoryOff();
            $('#categories-brands').collapse('show');
            $('#categories-brands').addClass('active');
        });