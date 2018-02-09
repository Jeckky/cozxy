
var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cozxy/backend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
$(document).on('click', '#checkAllMail', function (e) {
    var value = $(this).val();
    var url = $url + 'mailstore/verify-email/all-user';
    $.ajax({
        url: url,
        data: {value: value},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (value == 0) {
                for (var i = 0; i < data.count; i++) {
                    $("#user" + data.userId[i] + "").prop("checked", "checked");
                }
                $("#checkAllMail").val(1);
            } else {
                for (var i = 0; i < data.count; i++) {
                    $("#user" + data.userId[i]).removeAttr("checked");
                }
                $("#checkAllMail").val(0);
            }

        },
    });
});
$(document).on('click', '#deleteUser', function (e) {
    if (!confirm("Are you sure to delete selected items?")) {
        return false;
    }
});
