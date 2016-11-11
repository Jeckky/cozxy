/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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

//$.get($baseUrl + "store/virtual/leditems", function (data, status) {
//    var json_obj = $.parseJSON(data); //parse JSON
//    /*
//     * 1 :  สีเขียว
//     2 : สีแดง
//     3 : สีน้ำเงิน
//     4 :สีชมพู่
//     5 :สีเหลือง
//     * */
//    for (var i in json_obj)
//    {
//        //console.log(json_obj[i].code + ",  " + json_obj[i].slot + ' , ' + json_obj[i].color);
//        // fa fa-circle
//        // fa-circle-o text-default
//        if (json_obj[i].color == 1) {
//            var color_text = 'fa fa-circle text-success';
//        } else if (json_obj[i].color == 2) {
//            var color_text = 'fa fa-circle text-danger';
//        } else if (json_obj[i].color == 3) {
//            var color_text = 'fa fa-circle text-primary';
//        } else if (json_obj[i].color == 4) {
//            var color_text = 'fa fa-circle text-pink';
//        } else if (json_obj[i].color == 5) {
//            var color_text = 'fa fa-circle text-warning';
//        } else {
//            var color_text = 'fa fa-circle-o text-default';
//        }
//        $('#' + json_obj[i].slot + '').find('#' + json_obj[i].slot + '-' + json_obj[i].color).attr('class', '' + color_text + '');
//        console.log(json_obj[i].slot + '-' + json_obj[i].color);
//    }
//});

function pingHardware(ip, tagId, url)
{
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: url,
        data: {ip: ip},
        success: function (data) {
            if (data.status)
            {
                $('.' + tagId).addClass('label-success');
            } else
            {
                $('.' + tagId).removeClass('label-success');
            }
        }
    });
}

function showLedList(slotCode, url)
{

    $.ajax({
        type: 'POST',
//        dataType: 'JSON',
        url: url,
        data: {slotCode: slotCode},
        success: function (data) {
            if (data)
            {
                $('.divModal').html(data);
                $('.slotCode').val(slotCode);
                $('.ledList').modal('show');
            }
        }
    });
}
function saveModal(url)
{
    var slotCode = $('.slotCode').val();
    var id = $('.led').val();
    $.ajax({
        type: 'POST',
//        dataType: 'JSON',
        url: url,
        data: {slotCode: slotCode, id: id},
        success: function (data) {
            if (data)
            {
                $('.ledList').modal('hide');
                location.reload();
            }
        }
    });

//    alert($('led').val());
//    alert(111);
}

function show(id)
{
    //alert(id);
    $('#all' + id).show();
    $('#notAll' + id).show();

}
function hide(id)
{
    //alert(id);
    $('#all' + id).hide();
    $('#notAll' + id).hide();

}

// remark-chanels
$('.remark-chanels').on('click', function () {
    var dataBind = this.getAttribute('data-bind');
    var resDataBind = dataBind.split(",");
    var pickingItemsId = resDataBind[0];
    var pickingId = resDataBind[1];
    $(".remark-chanels-form-" + pickingItemsId).addClass("show");
});

$('.remark-chanels-ok').on('click', function () {
    var dataBind = this.getAttribute('data-bind');
    var resDataBind = dataBind.split(",");
    var pickingItemsId = resDataBind[0];
    var pickingId = resDataBind[1];
    if (pickingItemsId != '') {
        $.ajax({
            url: 'remark-channels',
            data: {"pickingItemsId": pickingItemsId, "status": 'ok', "pickingId": pickingId},
            type: 'post',
            success: function (result) {
                //alert(result);
                alert('ตรวจเช็คช่องแล้ว');
                var JSONObject2 = JSON.parse(result);
                //alert(JSONObject2.pickingItemsId);
                alert(JSONObject2.CountChannelsInspector);
                $(".search-content-new-" + JSONObject2.pickingItemsId).html('<h4>ตรวจสอบแล้วเรียบร้อย</h4>');
                if (JSONObject2.CountChannelsInspector == 1) {
                    alert('redirect!!');
                    window.location = $baseUrl + 'lockers/lockers/lockers?boxcode=' + JSONObject2.pickingId;
                } else if (JSONObject2.CountChannelsInspector == 0) {
                    window.location = $baseUrl + 'lockers/lockers/lockers?boxcode=' + JSONObject2.pickingId;
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                //debugger;
                // alert(errorThrown);
            }
        });
    } else {
        alert('ระบุปัญหาที่เจอทุกครั้ง ก่อน Submit')
    }
});

$('.remark-cancel').on('click', function () {
    var dataBind = this.getAttribute('data-bind');
    var resDataBind = dataBind.split(",");
    var pickingItemsId = resDataBind[0];
    var pickingId = resDataBind[1];
    $(".remark-chanels-form-" + pickingItemsId).removeClass("show");
});

$('.remark-submit').on('click', function () {


    var dataBind = this.getAttribute('data-bind');
    var resDataBind = dataBind.split(",");
    var pickingItemsId = resDataBind[0];
    var pickingId = resDataBind[1];
    //var pickingItemsId = document.getElementById("pickingItemsIdHidden").value;
    //var pickingId = document.getElementById("pickingIdHidden").value;
    var desc = document.getElementById("remarkDesc-" + pickingItemsId).value;
    var type = $('input:radio[name=type-' + pickingItemsId + ']:checked').val();
    // console.log(type);
    // alert(desc);
    // alert(pickingItemsId);
    if (!type) {
        alert("Please select your type.");
        return false;
    }
    if (desc != '' && pickingItemsId != '') {
        // alert('OK');
        $.ajax({
            url: 'remark-channels',
            data: {"pickingItemsId": pickingItemsId, "remarkDesc": desc, 'status': 'no', "pickingId": pickingId, 'type': type},
            type: 'post',
            success: function (result) {
                alert('ตรวจเช็คช่องแล้ว');
                var JSONObject2 = JSON.parse(result);
                alert(JSONObject2.CountChannelsInspector);
                $(".search-content-new-" + JSONObject2.pickingItemsId).html('<h4><code>' + JSONObject2.remark + '<code></h4>');
                if (JSONObject2.CountChannelsInspector == 1) {
                    alert('redirect!!');
                    window.location = $baseUrl + 'lockers/lockers/lockers?boxcode=' + JSONObject2.pickingId;
                } else if (JSONObject2.CountChannelsInspector == 0) {
                    window.location = $baseUrl + 'lockers/lockers/lockers?boxcode=' + JSONObject2.pickingId;
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                //debugger;
                // alert(errorThrown);
            }
        });
    } else {
        alert('ระบุปัญหาที่เจอทุกครั้ง ก่อน Submit')
    }
});


