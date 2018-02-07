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

