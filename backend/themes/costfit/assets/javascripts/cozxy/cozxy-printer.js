
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
$(document).on('keypress', '#ledcolor-r', function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code > 57) {
        return false;
    } else if (code < 48 && code != 8) {
        return false;
    }
});
$(document).on('keypress', '#ledcolor-g', function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code > 57) {
        return false;
    } else if (code < 48 && code != 8) {
        return false;
    }
});
$(document).on('keypress', '#ledcolor-b', function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code > 57) {
        return false;
    } else if (code < 48 && code != 8) {
        return false;
    }
});
$(document).on('keyup', '#ledcolor-r', function (event) {
    if (event.keyCode > 98 || event.keyCode < 105) {
        var a = event.keyCode;
        event.keyCode = newKey(a);
    }
    if (event.keyCode < 48 || event.keyCode > 57) {
        if (event.keyCode != 8) {
            event.returnValue = false;
        } else {
            $(".showColor").hide();
            var r = $("input#ledcolor-r").val();
            var g = $("input#ledcolor-g").val();
            var b = $("input#ledcolor-b").val();
            if (r == '') {
                r = '0';
            }
            if (g == '') {
                g = '0';
            }
            if (b == '') {
                b = '0';
            }
            $(".showColor").html('<input type="text" name="result" class="form-control" disabled style="background-color: rgb(' + r + ', ' + g + ', ' + b + ');">');
            $(".showColor").show();
        }
    } else {
//alert(r + g + b);
        $(".showColor").hide();
        var r = $("input#ledcolor-r").val();
        var g = $("input#ledcolor-g").val();
        var b = $("input#ledcolor-b").val();
        if (r == '') {
            r = '0';
        }
        if (g == '') {
            g = '0';
        }
        if (b == '') {
            b = '0';
        }
        $(".showColor").html('<input type="text" name="result" class="form-control" disabled style="background-color: rgb(' + r + ', ' + g + ', ' + b + ');">');
        $(".showColor").show();
    }

});
$(document).on('keyup', '#ledcolor-g', function (event) {
    if (event.keyCode > 98 || event.keyCode < 105) {
        var a = event.keyCode;
        event.keyCode = newKey(a);
    }
    if (event.keyCode < 48 || event.keyCode > 57) {
        if (event.keyCode != 8) {
            event.returnValue = false;
        } else {
            $(".showColor").hide();
            var r = $("input#ledcolor-r").val();
            var g = $("input#ledcolor-g").val();
            var b = $("input#ledcolor-b").val();
            if (r == '') {
                r = '0';
            }
            if (g == '') {
                g = '0';
            }
            if (b == '') {
                b = '0';
            }
            $(".showColor").html('<input type="text" name="result" class="form-control" disabled style="background-color: rgb(' + r + ', ' + g + ', ' + b + ');">');
            $(".showColor").show();
        }
    } else {
//alert(r + g + b);
        $(".showColor").hide();
        var r = $("input#ledcolor-r").val();
        var g = $("input#ledcolor-g").val();
        var b = $("input#ledcolor-b").val();
        if (r == '') {
            r = '0';
        }
        if (g == '') {
            g = '0';
        }
        if (b == '') {
            b = '0';
        }
        $(".showColor").html('<input type="text" name="result" class="form-control" disabled style="background-color: rgb(' + r + ', ' + g + ', ' + b + ');">');
        $(".showColor").show();
    }

});
$(document).on('keyup', '#ledcolor-b', function (event) {
    if (event.keyCode > 98 || event.keyCode < 105) {
        var a = event.keyCode;
        event.keyCode = newKey(a);
    }
    if (event.keyCode < 48 || event.keyCode > 57) {
        if (event.keyCode != 8) {
            event.returnValue = false;
        } else {
            $(".showColor").hide();
            var r = $("input#ledcolor-r").val();
            var g = $("input#ledcolor-g").val();
            var b = $("input#ledcolor-b").val();
            if (r == '') {
                r = '0';
            }
            if (g == '') {
                g = '0';
            }
            if (b == '') {
                b = '0';
            }
            $(".showColor").html('<input type="text" name="result" class="form-control" disabled style="background-color: rgb(' + r + ', ' + g + ', ' + b + ');">');
            $(".showColor").show();
        }
    } else {
        $(".showColor").hide();
        var r = $("input#ledcolor-r").val();
        var g = $("input#ledcolor-g").val();
        var b = $("input#ledcolor-b").val();
        if (r == '') {
            r = '0';
        }
        if (g == '') {
            g = '0';
        }
        if (b == '') {
            b = '0';
        }
        $(".showColor").html('<input type="text" name="result" class="form-control" disabled style="background-color: rgb(' + r + ', ' + g + ', ' + b + ');">');
        $(".showColor").show();
    }

});
function newKey(key) {
    if (key == 96) {
        var a = 48;
    }
    if (key == 97) {
        var a = 49;
    }
    if (key == 98) {
        var a = 50;
    }
    if (key == 99) {
        var a = 51;
    }
    if (key == 100) {
        var a = 52;
    }
    if (key == 101) {
        var a = 53;
    }
    if (key == 102) {
        var a = 54;
    }
    if (key == 103) {
        var a = 55;
    }
    if (key == 104) {
        var a = 56;
    }
    if (key == 105) {
        var a = 57;
    }
    return a;
}