/**
 * Created by npr on 5/17/2017 AD.
 */
$(function() {
    var ww = $(window).width();
    if (ww>992) {
        descSet();
    }
});
function descSet() {
    var ww = $(window).width();
    if (ww>992) {
        var pg = $('.cart-body').height()-92;
        $('.total-price').css('min-height', pg+'px');
    }
}
$(window).resize(function() { descSet(); });
function qSet(y,x){
    var temp = parseInt($('.quantity-'+y).val());
    if (isNaN(temp)) {temp = 1;} temp+=x;
    if (temp<1) {temp = 1;}
    $('.quantity-'+y).val(temp);
    if (temp>1) {
        $('.multi-'+y).html( temp +' x ');
    } else {
        $('.multi-'+y).html('');
    }
}
