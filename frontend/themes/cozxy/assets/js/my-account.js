$(function() {
    $('.tabs1').load('myac-profile.php');
    $('.tabs2').load('myac-order.php');
    $('.tabs3').load('myac-fav.php');
    $('.tabs4').load('myac-track.php');
    $('.pill1').click(function() {$('.tabs1').load('myac-profile.php');} );
    $('.pill2').click(function() {$('.tabs2').load('myac-order.php');} );
    $('.pill3').click(function() {$('.tabs3').load('myac-fav.php');} );
    $('.pill4').click(function() {$('.tabs4').load('myac-track.php');} );
});
function edit_profile(x) {
    $('.tabs1').load('myac-edit'+x+'.php');
}