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

$.get($baseUrl + "store/virtual/leditems", function (data, status) {
    var json_obj = $.parseJSON(data); //parse JSON
    /*
     * 1 :  สีเขียว
     2 : สีแดง
     3 : สีน้ำเงิน
     4 :สีชมพู่
     5 :สีเหลือง
     * */
    for (var i in json_obj)
    {
        //console.log(json_obj[i].code + ",  " + json_obj[i].slot + ' , ' + json_obj[i].color);
        // fa fa-circle
        // fa-circle-o text-default
        if (json_obj[i].color == 1) {
            var color = 'fa fa-circle text-success';
        } else if (json_obj[i].color == 2) {
            var color = 'fa fa-circle text-danger';
        } else if (json_obj[i].color == 3) {
            var color = 'fa fa-circle text-primary';
        } else if (json_obj[i].color == 4) {
            var color = 'fa fa-circle text-pink';
        } else if (json_obj[i].color == 5) {
            var color = 'fa fa-circle text-warning';
        } else {
            var color = 'fa fa-circle-o text-default';
        }
        $('#' + json_obj[i].slot + '').find('#' + json_obj[i].slot + '-' + json_obj[i].color).attr('class', '' + color + '');
        //console.log(json_obj[i].slot + '-' + json_obj[i].color);
    }
});


