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
    var orderItemPackingId = resDataBind[2];
    if (pickingItemsId != '') {
        $.ajax({
            url: 'remark-channels',
            data: {"pickingItemsId": pickingItemsId, "status": 'ok', "pickingId": pickingId, 'orderItemPackingId': orderItemPackingId},
            type: 'post',
            success: function (result) {
                //alert(result);
                alert('ตรวจเช็คช่องแล้ว');
                var JSONObject2 = JSON.parse(result);
                //alert(JSONObject2.pickingItemsId);
                //alert(JSONObject2.CountChannelsInspector);
                $(".search-content-new-" + JSONObject2.pickingItemsId).html('<h4>ตรวจสอบแล้วเรียบร้อย</h4>');
                if (JSONObject2.CountChannelsInspector == 1) {
                    //alert('redirect!!');
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
    var orderItemPackingId = resDataBind[2];
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
            data: {"pickingItemsId": pickingItemsId, "remarkDesc": desc, 'status': 'no', "pickingId": pickingId, 'type': type, 'orderItemPackingId': orderItemPackingId},
            type: 'post',
            success: function (result) {
                alert('ตรวจเช็คช่องแล้ว');
                var JSONObject2 = JSON.parse(result);
                //alert(JSONObject2.CountChannelsInspector);
                $(".search-content-new-" + JSONObject2.pickingItemsId).html('<h4><code>' + JSONObject2.remark + '<code></h4>');
                if (JSONObject2.CountChannelsInspector == 1) {
                    //alert('redirect!!');
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

$('.test-test').on('click', function () {
    var dataBind = this.getAttribute('data-bind');
    var resDataBind = dataBind.split(",");
    var pickingItemsId = resDataBind[0];
    var pickingId = resDataBind[1];
    var orderItemPackingId = resDataBind[2];
    //alert(pickingItemsId + ',' + pickingId + ',' + orderItemPackingId);
    $.ajax({
        url: 'channels-packing-items',
        data: {"pickingItemsId": pickingItemsId, "pickingId": pickingId, 'orderItemPackingId': orderItemPackingId},
        type: 'post',
        success: function (result) {
            //alert(JSONObject2);
            var JSONObject2 = JSON.parse(result);
            $(".tes-test").html('' + JSONObject2 + '');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //debugger;
            // alert(errorThrown);
        }
    });

    $('#uidemo-modals-alerts-info').modal('show');
});

function suppliers(productId) {
    $.ajax({
        url: 'products-system',
        data: {"productId": productId},
        type: 'post',
        success: function (result) {
            //alert(JSONObject2);
            var JSONObject2 = JSON.parse(result);
            //alert(JSONObject2.title);
            // $(".tes-test").html('' + JSONObject2 + '');
            // ------- kartik  -------- //
            //$('#categoryId').val(JSONObject2.categoryId);
            //$('#brandId').val(JSONObject2.brandId);
            //$('#unitId').val(JSONObject2.unitId);
            //$('#smallUnit').val(JSONObject2.smallUnit);
            $('#categoryId').val(JSONObject2.categoryId).trigger('change');
            $('#brandId').val(JSONObject2.brandId).trigger('change');
            $('#unitId').val(JSONObject2.unit).trigger('change');
            $('#smallUnit').val(JSONObject2.smallUnit).trigger('change');
            //$('#categoryId').append('<option selected value=' + JSONObject2.categoryId + '>' + JSONObject2.categoryId + '</option>');
            // ------ end kartik ------ //
            $('#productsuppliers-isbn').val(JSONObject2.isbn);
            $('#productsuppliers-code').val(JSONObject2.code);
            $('#productsuppliers-isbn').prop('readonly', true);
            $('#productsuppliers-code').prop('readonly', true);
            $('#productsuppliers-title').val(JSONObject2.title);
            $('#productsuppliers-optionname').val(JSONObject2.optionName);
            // ---- summernote ---- //
            //$('#productsuppliers-shortdescription').val(JSONObject2.shortdescription);
            $('#productsuppliers-shortdescription').summernote(
                    $("#productsuppliers-shortdescription").code(JSONObject2.shortdescription)
                    );
            //$('#productsuppliers-description').val(JSONObject2.description);
            $('#productsuppliers-description').summernote(
                    $("#productsuppliers-description").code(JSONObject2.description)
                    );
            //$('#productsuppliers-specification').val(JSONObject2.specification);
            $('#productsuppliers-specification').summernote(
                    $("#productsuppliers-specification").code(JSONObject2.specification)
                    );
            // ---- end summernote ---- //
            $('#productsuppliers-width').val(JSONObject2.width);
            $('#productsuppliers-height').val(JSONObject2.height);
            $('#productsuppliers-depth').val(JSONObject2.depth);
            $('#productsuppliers-weight').val(JSONObject2.weight);
            $('#productsuppliers-price').val(JSONObject2.price);
            //$('#unitId').val(JSONObject2.title);
            //$('#smallUnit').val(JSONObject2.title);
            $('#productsuppliers-tags').val(JSONObject2.tags);
            $('.form-group').find('.product-system-hidden').html('<input type="hidden" name="productIds" id="productIds" value="' + JSONObject2.productId + '"><input type="hidden" name="approve" id="approve" value="old">');
            $('.form-group').find('.status-system-hidden').html('<h3><code>สถานะ :</code> ค้นหาจาก Product System <code>หรือ</code> <span class="suppliers-clear-data btn btn-primary" onclick="suppliersClearData()">กดปุ่ม "เคลียร์" ต้องการเพิ่มข้อมูลใหม่</span></h3>');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //debugger;
            // alert(errorThrown);
        }
    });
}

function suppliersClearData() {
    $('#categoryId').empty();
    $('#brandId').empty();
    $('#productsuppliers-isbn').val('');
    $('#productsuppliers-code').val('');
    $('#productsuppliers-title').val('');
    $('#productsuppliers-isbn').prop('readonly', false);
    $('#productsuppliers-code').prop('readonly', false);
    $('#productsuppliers-optionname').val('');
    /// summernote //
    $('#productsuppliers-shortdescription').summernote(
            $("#productsuppliers-shortdescription").code('')
            );
    $('#productsuppliers-description').summernote(
            $("#productsuppliers-description").code('')
            );
    $('#productsuppliers-specification').summernote(
            $("#productsuppliers-specification").code('')
            );
    // end summernote //
    //$('#productsuppliers-shortdescription').val('');
    //$('#productsuppliers-description').val('');
    //$('#productsuppliers-specification').val('');
    $('#productsuppliers-width').val('');
    $('#productsuppliers-height').val('');
    $('#productsuppliers-depth').val('');
    $('#productsuppliers-weight').val('');
    $('#productsuppliers-price').val('');
    $('#unitId').empty();
    $('#smallUnit').empty();
    $('#productsuppliers-tags').val('');
    $('.form-group').find('.product-system-hidden').html('<input type="hidden" name="productIds" id="productIds" value=""><input type="hidden" name="approve" id="approve" value="new">');
    $('.form-group').find('.status-system-hidden').html('<h3><span class="text-success">สถานะ : เคลียร์ข้อมูลสำเร็จ</span></h3>');
}


function suppliersCreate() {
    var productIds = $('#productIds').val();
    var approve = $('#approve').val();

    var categoryId = $('#categoryId').val();
    var brandId = $('#brandId').val();
    var isbn = $('#productsuppliers-isbn').val();
    var code = $('#productsuppliers-code').val();
    var title = $('#productsuppliers-title').val();
    var optionname = $('#productsuppliers-optionname').val();
    var shortdescription = $('#productsuppliers-shortdescription').code();
    var description = $('#productsuppliers-description').code();
    var specification = $('#productsuppliers-specification').code();
    var width = $('#productsuppliers-width').val();
    var height = $('#productsuppliers-height').val();
    var depth = $('#productsuppliers-depth').val();
    var weight = $('#productsuppliers-weight').val();
    var price = $('#productsuppliers-price').val();
    var unit = $('#unitId').val();
    var smallUnit = $('#smallUnit').val();
    var tags = $('#productsuppliers-tags').val();

    $.ajax({
        url: 'create',
        data: {"productIds": productIds, 'approve': approve, 'categoryId': categoryId,
            'brandId': brandId, 'isbn': isbn, 'code': code,
            'title': title, 'optionname': optionname, 'shortdescription': shortdescription,
            'description': description, 'specification': specification
            , 'width': width, 'height': height, 'depth': depth, 'weight': weight,
            'price': price, 'unit': unit, 'smallUnit': smallUnit, 'tags': tags,
            'ProductSuppliers': 'ProductSuppliers'
        },
        type: 'post',
        success: function (result) {
            //alert(JSONObject2);
            //var JSONObject2 = JSON.parse(result);

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //debugger;
            // alert(errorThrown);
        }
    });

}

