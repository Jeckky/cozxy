/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cost.fit-backend/';
} else if (window.location.host == '192.168.100.8' || window.location.host == '192.168.100.20') {
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

function init_quick_import(id) {
    console.log(id);
    window.location = $baseUrl + 'inbound/check-po-items/quick-import';
}

function delete_data() {

}