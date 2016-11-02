
var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cost.fit-backend/';
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

$(document).on('click', '.closeBag', function () {
    var $orderId = $(this).parent().parent().find("#orderId").val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $baseUrl + 'store/packing/print-label',
        data: {orderId: $orderId},
        success: function (data)
        {
            if (data != '') {
                var newWin = window.open($baseUrl + 'store/packing/bag-label?bag=' + data, '_blank');
                //newWin.focus();
            } else {
                alert(data);
            }
        },
        error: function (data)
        {
            alert('ไม่พบ ORDER ID');
        }
    });
});
