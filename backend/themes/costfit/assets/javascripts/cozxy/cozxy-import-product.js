
var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cozxy/backend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
$(document).on('change', '#product-productgrouptemplateid', function (e) {

    var productGroupTemplateId = $(this).val();
    var url = $url + 'productmanager/import-product/template-format';
    $.ajax({
        url: url,
        data: {productGroupTemplateId: productGroupTemplateId},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (data.status) {
                $("#templateColumn").html('');
                $("#templateColumn").html(data.text);
                $("#templateId").html('');
                $("#templateId").html('<input type="hidden" name="templateId" value="' + productGroupTemplateId + '">');
            }
        },
    });
});
$(document).on('click', '#deleteUser', function (e) {
    if (!confirm("Are you sure to delete selected items?")) {
        return false;
    }
});
