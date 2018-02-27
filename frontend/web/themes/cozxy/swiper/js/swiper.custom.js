/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



var swiper = new Swiper('.swiper-container', {
    slidesPerView: 6,
    spaceBetween: 5,
    slidesPerGroup: 6,
    loop: true,
    loopFillGroupWithBlank: true,
    passiveListeners: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    // Responsive breakpoints
    breakpoints: {
        // when window width is <= 320px
        320: {
            slidesPerView: 1,
            spaceBetween: 10
        },
        // when window width is <= 480px
        480: {
            slidesPerView: 3,
            spaceBetween: 2
        },
        // when window width is <= 640px
        640: {
            slidesPerView: 3,
            spaceBetween: 2,

        },

    }
});
