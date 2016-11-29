
var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cozxy-backend/';
} else if (window.location.host == '192.168.100.8') {
    //console.log($baseUrl);
    var str = window.location.pathname;
    var res = str.split("/");
    //console.log(window.location.pathname);
    //console.log(res);
    // console.log(res[1])
    $baseUrl = window.location.protocol + "//" + window.location.host + '/' + res[1] + '/backend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}

$(document).on('click', '.links', function (e) {
    var status = $(this).attr('status');
    var orderId = $(this).attr('orderId');
    var url = $baseUrl + 'order/order/detail2';
    $.ajax({
        url: url,
        data: {"status": status, "orderId": orderId},
        type: 'post',
        success: function (data) {
            //alert(status);
            var JSONObject2 = JSON.parse(data);
            $(".item").html('' + JSONObject2 + '');
            $('.modal').modal('show');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            debugger;
            alert(errorThrown);
        }
    });
});
$(document).on('keydown', '#ledcolor-r', function (e) {
    var id = $(this).val();
    if (event.keyCode < 48 || event.keyCode > 57) {
        event.returnValue = false;
    }
});
