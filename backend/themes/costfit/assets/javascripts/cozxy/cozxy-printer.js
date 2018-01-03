
var $baseUrl = window.location.protocol + "//" + window.location.host;

if (window.location.host == 'localhost') {
    //$baseUrl = window.location.protocol + "//" + window.location.host + '/cozxy-backend/';
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cozxy/backend/web/';

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
$url = $baseUrl;
$(document).on('click', '.links', function (e) {
    var status = $(this).attr('status');
    var orderId = $(this).attr('orderId');
    var url = $url + 'order/order/detail2';
    // alert(orderId + '->' + status);
    $.ajax({
        url: url,
        data: {status: status, orderId: orderId},
        type: 'post',
        success: function (data) {
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
// ONLY NUMBER KEYPRESS
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
// END ONLY NUMBER
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
            r = r * 7;
            g = g * 7;
            b = b * 7;
            if (r > 255) {
                r = 255;
            }
            if (g > 255) {
                g = 255;
            }
            if (b > 255) {
                b = 255;
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
        r = r * 7;
        g = g * 7;
        b = b * 7;
        if (r > 255) {
            r = 255;
        }
        if (g > 255) {
            g = 255;
        }
        if (b > 255) {
            b = 255;
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
            r = r * 7;
            g = g * 7;
            b = b * 7;
            if (r > 255) {
                r = 255;
            }
            if (g > 255) {
                g = 255;
            }
            if (b > 255) {
                b = 255;
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
        r = r * 7;
        g = g * 7;
        b = b * 7;
        if (r > 255) {
            r = 255;
        }
        if (g > 255) {
            g = 255;
        }
        if (b > 255) {
            b = 255;
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
            r = r * 7;
            g = g * 7;
            b = b * 7;
            if (r > 255) {
                r = 255;
            }
            if (g > 255) {
                g = 255;
            }
            if (b > 255) {
                b = 255;
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
        r = r * 7;
        g = g * 7;
        b = b * 7;
        if (r > 255) {
            r = 255;
        }
        if (g > 255) {
            g = 255;
        }
        if (b > 255) {
            b = 255;
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
$(document).on('click', '.reprint', function (e) {
    var url = $url + 'order/order/reprint-real-time';
    //var url = 'http://localhost/cozxy/backend/web/order/order/reprint-real-time';
    $.ajax({
        url: url,
        data: 'status=1',
        type: 'post',
        success: function (data) {
            $('#allPoes').html(data);
            $('#allPoes').fadeToggle('fade')
        },
    });
    $('.reprint').hide();
    $('.reprint2').show();
});
$(document).on('click', '.reprint2', function (e) {
    $('#allPoes').hide();
    $('.reprint').show();
    $('.reprint2').hide();
});
$(document).on('keyup', '.productQr', function (event) {
    var code = event.keyCode;
    if (code == 13) {
        var isbn = $(".productQr").val();
        var orderId = $(this).parent().find("#orderId").val();
        var ticketId = $(this).parent().find("#ticketId").val();
        var url = $url + 'returnproduct/return-product/return-list';
        $.ajax({
            url: url,
            data: {orderId: orderId, isbn: isbn, ticketId: ticketId},
            dataType: 'JSON',
            type: 'post',
            success: function (data) {
                if (data.errors != '1') {
                    alert(data.errors);
                } else {
                    $('#returnList').html(data.dataList);
                    $(".productQr").val('');
                }
                //$('#returnList').fadeToggle('fade')
            },
        });
    }
});
$(document).on('click', '.deleteR', function () {
    var returnId = $(this).parent().parent().find("#pSuppId").val();
    var orderId = $(this).parent().parent().find("#pOrderId").val();
    var url = $url + 'returnproduct/return-product/delete-return-list';
    $.ajax({
        url: url,
        data: {returnId: returnId, pOrderId: orderId},
        dataType: 'JSON',
        type: 'POST',
        success: function (data) {
            if (data.status) {

                $('#returnList').html(data.dataList);
            } else {
                $('#returnList').html('');
            }
            //$('#returnList').fadeToggle('fade')
        },
    });
});
$(document).on('click', '#incr-return', function () {
    var button = $(this);
    var returnId = $(this).parent().parent().find("#pSuppId").val();
    var orderId = $(this).parent().parent().find("#pOrderId").val();
    var qntyReturn = $(this).parent().find("#qnty-return" + returnId).val();
    var incr = '';
    if (button.text() == "+") {
        incr = "+";
    } else {
        incr = "-";
    }
    var url = $url + 'returnproduct/return-product/change-quantity-return-list';
    $.ajax({
        url: url,
        data: {returnId: returnId, orderId: orderId, qnty: qntyReturn, incr: incr},
        dataType: 'JSON',
        type: 'POST',
        success: function (data) {
            if (data.status) {
                $("#qnty-return" + returnId).val(data.quantity);
            } else {
                alert(data.messege);
            }
        },
    });

});
$(document).on('click', '#confirm-return', function () {
    var orderId = $(this).parent().parent().find("#orderId").val();
    var url = $baseUrl + 'returnproduct/return-product/check-remark';

    $.ajax({
        url: url,
        data: {orderId: orderId},
        dataType: 'JSON',
        type: 'POST',
        success: function (data) {
            // if (data.status) {
            var a = 1;
            for (var i = 0; i < data.counts; i++) {
                if ($("#remark" + data.returnId[i]).val() == '') {
                    a = 2;
                }
            }
            if (a == 1) {
                $("#returnDetail").submit();
            } else {
                alert("กรุณาใส่เหตุผลที่คืนสินค้า");
            }
        }

    });
});
$(document).on('click', '#approve', function () {
    var ticketId = $(this).parent().find("#ticketId").val();
    var approve = 'Approve';
    var url = $url + 'returnproduct/return-product/approve-ticket';
    if (confirm('ต้องการอนุมัติรายการนี้ ?')) {
        $.ajax({
            url: url,
            data: {ticketId: ticketId, approve: approve},
            dataType: 'JSON',
            type: 'POST',
            success: function (data) {
                if (data.status) {

                    window.location.href = $url + 'returnproduct/return-product/request-ticket';

                }
            }

        });
    }
});
$(document).on('click', '#approve-by-cozxy', function () {
    var ticketId = $(this).parent().find("#ticketId").val();
    var approve = $('#approve').text();
    var url = $url + 'returnproduct/return-product/approve-ticket-cozxy';
    //alert(ticketId);
    if (confirm('ต้องการอนุมัติรายการ ?')) {
        $.ajax({
            url: url,
            data: {ticketId: ticketId, approve: 'Approve'},
            dataType: 'JSON',
            type: 'POST',
            success: function (data) {
                if (data.status) {
                    window.location.href = $url + 'returnproduct/return-product/cozxy-approve-return';

                }
            }

        });
    }
});
$(document).on('click', '#not-approve', function () {
    $('#remark').show();
});
$(document).on('click', '#not-approve-cozxy', function () {
    $('#remark').show();
});
$(document).on('click', '#send-remark', function () {//////////////
    var ticketId = $(this).parent().parent().find("#ticketId").val();
    var remark = $(this).parent().find("#remark").val();
    var url = $url + 'returnproduct/return-product/approve-ticket';
    if (remark == '') {
        alert('กรุณากรอก Remark (เหตุผลที่ไม่อนุมัติ)');
        return false;
    } else {
        $.ajax({
            url: url,
            data: {ticketId: ticketId, approve: 'not', remark: remark},
            dataType: 'JSON',
            type: 'POST',
            success: function (data) {
                if (!data.status) {
                    alert('ดำเนินการเรียบร้อย');
                    window.location.href = $url + 'returnproduct/return-product/request-ticket';
                }
            }

        });
    }

});
$(document).on('click', '#send-remark-cozxy', function () {//////////////
    var ticketId = $(this).parent().parent().find("#ticketId").val();
    var remark = $(this).parent().find("#remark").val();
    var url = $url + 'returnproduct/return-product/approve-ticket-cozxy';
    if (remark == '') {
        alert('กรุณากรอก Remark (เหตุผลที่ไม่อนุมัติ)');
        return false;
    } else {
        $.ajax({
            url: url,
            data: {ticketId: ticketId, approve: 'not', remark: remark},
            dataType: 'JSON',
            type: 'POST',
            success: function (data) {
                if (!data.status) {
                    alert('ดำเนินการเรียบร้อย');
                    window.location.href = $url + 'returnproduct/return-product/cozxy-approve-return';
                }
            }

        });
    }

});
$(document).on('click', '#sendMessage', function () {
    var message = $(this).parent().parent().find("#message").val();
    var orderId = $(this).parent().parent().find("#orderId").val();
    var userId = $(this).parent().parent().find("#userId").val();
    var ticketId = $(this).parent().parent().find("#ticketId").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $url + 'returnproduct/return-product/save-message',
        data: {message: message, orderId: orderId, userId: userId, ticketId: ticketId},
        success: function (data) {
            if (data.status) {
                $("#message").val('');
            }
        }
    });
});
$(document).on('keyup', '#message', function (e) {
    var message = $(this).parent().parent().find("#message").val();
    var orderId = $(this).parent().parent().find("#orderId").val();
    var userId = $(this).parent().parent().find("#userId").val();
    var ticketId = $(this).parent().parent().find("#ticketId").val();

    if (e.keyCode == 13) {
        $("#message").val('');
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: $url + 'returnproduct/return-product/save-message',
            data: {message: message, orderId: orderId, userId: userId, ticketId: ticketId},
            success: function (data) {
                if (data.status) {
                    $("#messege").val('');
                }
            }
        });
    }
});
$(document).on('keyup', '#search-wait', function (e) {
    var ms = $("#search-wait").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $url + 'returnproduct/return-product/search-wait',
        data: {ms: ms},
        success: function (data) {
            $("#search-w").html(data.wait);
        }
    });
});
$(document).on('keyup', '#search-approve', function (e) {
    var ms = $("#search-approve").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $url + 'returnproduct/return-product/search-approve',
        data: {ms: ms},
        success: function (data) {
            $("#search-a").html(data.wait);
        }
    });
});
$(document).on('keyup', '#search-approve-cozxy', function (e) {
    var ms = $("#search-approve-cozxy").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $url + 'returnproduct/return-product/search-approve-cozxy',
        data: {ms: ms},
        success: function (data) {
            $("#search-ac").html(data.wait);
        }
    });
});
$(document).on('keyup', '#search-not-approve-cozxy', function (e) {
    var ms = $("#search-not-approve-cozxy").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $url + 'returnproduct/return-product/search-not-approve-cozxy',
        data: {ms: ms},
        success: function (data) {
            $("#search-not-ac").html(data.wait);
        }
    });
});
$(document).on('keyup', '#search-wait-cozxyapprove', function (e) {
    var ms = $("#search-wait-cozxyapprove").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $url + 'returnproduct/return-product/search-wait-cozxy',
        data: {ms: ms},
        success: function (data) {
            $("#search-wc").html(data.wait);
        }
    });
});
$(document).on('keyup', '#search-wait-cozxy-confirm', function (e) {
    var ms = $("#search-wait-cozxy-confirm").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $url + 'returnproduct/return-product/search-wait-cozxy-confirm',
        data: {ms: ms},
        success: function (data) {
            $("#search-wcc").html(data.wait);
        }
    });
});
$(document).on('keyup', '#search-notApprove', function (e) {
    var ms = $("#search-notApprove").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $url + 'returnproduct/return-product/search-not-approve',
        data: {ms: ms},
        success: function (data) {
            $('#search-n').html(data.wait);
        }
    });
});
$(document).on('click', '#export-txt', function (e) {
    var fromDate = $(this).parent().find("#fromDate").val();
    var toDate = $(this).parent().find("#toDate").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: $url + 'report/report/export',
        data: {fromDate: fromDate, toDate: toDate},
        success: function (data) {
            if (data.status) {

                window.location.href = $url + 'report/report/download?files=' + data.file;
                alert("Download successful,please check '" + data.filename + "' in Download folder");
            } else {
                alert('Please try to search and download again');
            }
        }
    });
});
function hideRemark(id) {
    $('#remark' + id).hide();
}
function showRemark(id) {
    $('#remark' + id).show();
}
function saveIsbn(productSuppId, poItemId) {
    var isbn = $("#inputIsbn" + poItemId).val();
    //var url = 'http://localhost/cozxy/backend/web/store/store-product/save-isbn';
    var url = $url + 'store/store-product/save-isbn';
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: url,
        data: {productSuppId: productSuppId, isbn: isbn},
        success: function (data) {
            if (data.status) {
                $("#isbn" + poItemId).modal("hide");
                $("#addIsbn" + poItemId).hide();
                $("#submit" + poItemId).show();
                location.reload();
            } else {
                alert(data.error);
            }
        },
    });
}
/*
 * sprint 1 =======> sak
 *
 */
function enableEdit(id) {
    $("#optionValue" + id).removeAttr('disabled');
    $("#edit" + id).hide();
    $("#save" + id).show();
}
function saveEdit(id, value) {
    // var url = 'http://localhost/cozxy/backend/web/product/product-group/edit-option';
    var url = $url + 'product/product-group/edit-option';
    var newVal = $("#optionValue" + id).val();
    if (newVal != '') {
        $.ajax({
            url: url,
            data: {id: id, newVal: newVal},
            dataType: 'JSON',
            type: 'post',
            success: function (data) {
                if (!data.status) {
                    alert(data.error);
                }
                $("#optionValue" + id).attr('disabled', 'disabled');
                $("#edit" + id).show();
                $("#save" + id).hide();

            },
        });
    } else {
        alert("Option can not empty");
        $("#optionValue" + id).val(value);
        $("#optionValue" + id).attr('disabled', 'disabled');
        $("#edit" + id).show();
        $("#save" + id).hide();
    }
}
function changeProductGroupTitle() {

    $("#masterTitle").hide();
    $("#editProductGroup").hide();
    $("#productTitle").show();
    $("#saveChangeProductGroup").show();
}
function disableInput(templateOptionId) {
    $("#newProduct" + templateOptionId).attr('disabled', 'disabled');
}
function savceChangeProductGroupTitle(id) {
    //var url = 'http://localhost/cozxy/backend/web/product/product-group/edit-title';
    var url = $url + 'product/product-group/edit-title';
    var newVal = $("#productTitle").val();
    if (confirm('Are you sure to change this title to "' + newVal + '"')) {
        $.ajax({
            url: url,
            data: {id: id, newVal: newVal},
            dataType: 'JSON',
            type: 'post',
            success: function (data) {
                if (!data.status) {
                    alert(data.message);
                } else {
                    $("#masterTitle").text(newVal);
                    $("#masterTitle").show();
                    $("#editProductGroup").show();
                    $("#productTitle").hide();
                    $("#saveChangeProductGroup").hide();
                }

            },
        });
    } else {
        return false;
    }

}
function orderingImage(id, total, action) {
    //var url = 'http://localhost/cozxy/backend/web/product/product-group/edit-sort-image';
    var url = $url + 'product/product-group/edit-sort-image';
    $.ajax({
        url: url,
        data: {id: id, total: total, action: action},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (data.status) {
                $("#ordering" + id).text(data.ordering);
            } else {
                return false;
            }
        },
    });
}
function orderingImageMaster(id, total, action) {
    //var url = 'http://localhost/cozxy/backend/web/product/product-group/edit-sort-image-master';
    var url = $url + 'product/product-group/edit-sort-image-master';
    $.ajax({
        url: url,
        data: {id: id, total: total, action: action},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (data.status) {
                $("#ordering" + id).text(data.ordering);
            } else {
                return false;
            }
        },
    });
}
function changeImageStatus(id) {
    //var url = 'http://localhost/cozxy/backend/web/product/product-group/image-active';
    var url = $url + 'product/product-group/image-active';
    $.ajax({
        url: url,
        data: {id: id},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (!data.status) {
                alert("เกิดข้อผิดพลาดกรุณาติดต่อผู้ดูแลระบบ");
            }
        },
    });
}
function changeImageMasterStatus(id) {
    //var url = 'http://localhost/cozxy/backend/web/product/product-group/image-master-active';
    var url = $url + 'product/product-group/image-master-active';
    $.ajax({
        url: url,
        data: {id: id},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (!data.status) {
                alert("เกิดข้อผิดพลาดกรุณาติดต่อผู้ดูแลระบบ");
            }
        },
    });
}

/*
 * End sprint 1 =======> sak
 *
 */
/*sprint3 sak*/
function confirmDel(sectionId) {
    if (confirm("Are you sure to delete this section?")) {
        window.location.href = $url + 'productpost/section/delete?id=' + sectionId;
        //window.location.href = 'http://localhost/cozxy/backend/web/productpost/section/delete?id=' + sectionId;
    }
}
function confirmDelItem(sectionItemId) {
    if (confirm("Are you sure to delete this item?")) {
        window.location.href = $url + 'productpost/section/delete-item?id=' + sectionItemId;
        //window.location.href = 'http://localhost/cozxy/backend/web/productpost/section/delete-item?id=' + sectionItemId;
    }
}
function selectProduct(sectionId, productId, productSuppId) {
    //var url = 'http://localhost/cozxy/backend/web/productpost/section/add-product-to-section';

    var url = $url + 'productpost/section/add-product-to-section';
    $.ajax({
        url: url,
        data: {sectionId: sectionId, productId: productId, productSuppId: productSuppId},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (!data.status) {
                ("#showNotSuccess").show();
                $("#showNotSuccess").html("เกิดข้อผิดพลาดกรุณาติดต่อผู้ดูแลระบบ");
                $("#showSuccess").hide();
            } else {
                $("#showNotSuccess").hide();
                $("#showSuccess").html(data.text);

            }
        },
    });
}
function showSection(sectionId) {
    //var url = 'http://localhost/cozxy/backend/web/productpost/section/show-section';
    var url = $url + 'productpost/section/show-section';
    $.ajax({
        url: url,
        data: {sectionId: sectionId},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {

        }
    });
}
function showSectionItem(sectionItemId) {
    //var url = 'http://localhost/cozxy/backend/web/productpost/section/show-section-item';
    var url = $url + 'productpost/section/show-section-item';
    $.ajax({
        url: url,
        data: {sectionItemId: sectionItemId},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {

        },
    });
}
function orderingSection(id, total, action) {
    //var url = 'http://localhost/cozxy/backend/web/productpost/section/sort-section';
    var url = $url + 'productpost/section/sort-section';
    $.ajax({
        url: url,
        data: {id: id, total: total, action: action},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (data.status) {
                $("#orderingSection" + id).text(data.sort);
            } else {
                return false;
            }
        },
    });
}
function orderingTemplateOption(id, total, action) {

    var url = $url + 'product/product-group-template-option/sort-template-option';
    $.ajax({
        url: url,
        data: {id: id, total: total, action: action},
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (data.status) {
                $("#orderingTemplate" + id).text(data.sort);
            } else {
                return false;
            }
        },
    });
}

/*End sprint3 sak */
/*sptint 5 */
function checkAllBrand(brandId) {
    var value = $("#allBrand").val();
    var url = $url + 'promotion/promotion/all-brand';
    $.ajax({
        url: url,
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (value == 1) {
                for (var i = 0; i < data.count; i++) {
                    $("#brand" + data.brandId[i]).prop("checked", "checked");
                }
                $("#allBrand").val(0);
            } else {
                for (var i = 0; i < data.count; i++) {
                    $("#brand" + data.brandId[i]).removeAttr("checked");
                }
                $("#allBrand").val(1);
            }

        },
    });
}
function checkAllCate(cateId) {
    var value = $("#allCate").val();
    var url = $url + 'promotion/promotion/all-cate';
    $.ajax({
        url: url,
        dataType: 'JSON',
        type: 'post',
        success: function (data) {
            if (value == 1) {
                for (var i = 0; i < data.count; i++) {
                    $("#cate" + data.cateId[i]).prop("checked", "checked");
                }
                $("#allCate").val(0);
            } else {
                for (var i = 0; i < data.count; i++) {
                    $("#cate" + data.cateId[i]).removeAttr("checked");
                }
                $("#allCate").val(1);
            }

        },
    });
}