/**
 * Created by npr on 5/17/2017 AD.
 */
$(function() {
    $('.topbar .dismiss').click(function(){$('.topbar').slideUp();$('.topOpener').slideDown();return false;});
    $('.topOpener').click(function(){$('.topbar').slideDown();$('.topOpener').slideUp();});
    $('.gotoTop').click(function(){$('html,body').animate({scrollTop:0});return false;});
    // Scroll Script
    $(window).scroll(function(){
        var $this = $(this), $top = $(".smallTop");
        if ($this.scrollTop()>384) {
            $top.fadeIn(384);
        } else {
            $top.fadeOut(384);
        }
    });
});