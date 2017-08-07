/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*  By  Taninut.B , 7-08-2016 */

var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost' || window.location.host == 'dev') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cozxy/frontend/web/';
} else if (window.location.host == '192.168.100.8' || window.location.host == '192.168.100.20') {
//console.log($baseUrl);
    var str = window.location.pathname;
    var res = str.split("/");
    //console.log(window.location.pathname);
    //console.log(res);
    // console.log(res[1])
    $baseUrl = window.location.protocol + "//" + window.location.host + '/' + res[1] + '/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}

function ComparePriceStory() {
    var $form = $("#default-add-new-compare-price-story"),
            data = $form.data("yiiActiveForm");
    $.each(data.attributes, function () {
        this.status = 3;
    });
    $form.yiiActiveForm("validate");
    var $this = $('#acheckoutNewBillingz');
    $this.button('loading');
    setTimeout(function () {
        $this.button('reset');
    }, 8000);
    var productPostId = $('#productPostId').val();
    var shopName = $('#productpost-shopname').val();
    var price = $('#productpostcompareprice-price').val();
    var country = $('#productpost-country').val();
    var currency = $('#productpost-currency').val();
    var statusPrice = $('#statusPrice').val();
    var productId = $('#productId').val();
    var comparePriceId = $('#comparePriceId').val();
    var latitude = $('#latitude').val();
    var longitude = $('#longitude').val();
    var dataIndex = $('#dataIndex').val();
    //var tRow = document.getElementById("compare-price-").getElementsByTagName("tr");
    //alert(productPostId);
    //alert(idTds);

    if (shopName == "")
    {
        $('.field-productpost-shopname').find(".help-block-error").html('ShopName cannot be blank.').css('color', 'red');
        return false;
    } else {
        $('.field-productpost-shopname').find(".help-block-error").html('').removeAttr('style');
    }

    if (price == "")
    {
        $('.field-productpostcompareprice-price').find(".help-block-error").html('Price cannot be blank.').css('color', 'red');
        return false;
    } else {
        $('.field-productpostcompareprice-price').find(".help-block-error").html('').removeAttr('style');
    }

    /* if (country == "")
     {
     $('.field-productpost-country').find(".help-block-error").html('Country cannot be blank.').css('color', 'red');
     return false;
     } else {
     $('.field-productpost-country').find(".help-block-error").html('').removeAttr('style');
     }*/

    if (currency == "")
    {
        $('.field-productpost-currency').find(".help-block-error").html('Currency cannot be blank.').css('color', 'red');
        return false;
    } else {
        $('.field-productpost-currency').find(".help-block-error").html('').removeAttr('style');
    }

    //alert(price);
    var path = $baseUrl + "story/compare-price-story/";
    $data = '';
    if (statusPrice == 'add') {
        // alert('status : add new price');
        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {'productPostId': productPostId, 'shopName': shopName, 'price': price,
                'country': country, 'currency': currency,
                'statusPrice': statusPrice, 'productId': productId,
                'latitude': latitude, 'longitude': longitude
            },
            success: function (data, status) {
                // console.log(data.price);
                //var JSONObject = JSON.parse(data);
                if (status == "success") {

                    var table = document.getElementById("table-compare-price-cozxy");
                    var row = table.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    var cell6 = row.insertCell(5);
                    var rowCount = table.rows.length;
                    cell1.innerHTML = rowCount - 1;
                    cell2.innerHTML = data.currency_code + ' (' + data.country + ' )';
                    cell3.innerHTML = data.shopName
                    cell4.innerHTML = data.currency_code + ' ' + data.price;
                    //console.log(data.price);
                    //$.each(data, function (i, field) {
                    var price = data.price;
                    var currency_code = data.currency_code;
                    demo = function (data) {
                        fx.rates = data.rates
                        var rate = fx(price).from(currency_code).to("THB")
                        //alert("£1 = $" + rate.toFixed(4))
                        cell5.innerHTML = 'THB ' + rate.toFixed(4).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                    }
                    $.getJSON("http://api.fixer.io/latest?base=ZAR", demo);
                    //});
                    //cell5.innerHTML = JSONObject.LocalPrice;
                    cell6.innerHTML = '<code><a class="text-danger" onclick="CozxyComparePriceModernBest(' + data.comparePriceId + ',' + '\'edit\'' + ',' + dataIndex + ')"><i class=\'fa fa-pencil-square-o\'></i>Edit Price</a></code>';
                    $('#compare-price-' + productPostId).append($data);
                    /*clear input*/
                    $('#productpost-shopname').val('');
                    $('#productpost-currency').val('').trigger('change');
                    $('#productpostcompareprice-price').val('');
                    $('#productpost-currency').val('');
                    $('#latitude').val('');
                    $('#longitude').val('');
                    $(".bs-example-modal-lg").modal("hide");
                } else {
                    alert('error');
                }
            }
        });
    } else {
        //alert('edit Price ::' + comparePriceId);
        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {'productPostId': productPostId, 'shopName': shopName, 'price': price,
                'country': country, 'currency': currency, 'statusPrice': statusPrice,
                'comparePriceId': comparePriceId, 'latitude': latitude, 'longitude': longitude
            },
            success: function (data, status) {
                // console.log(data.price);
                //var JSONObject = JSON.parse(data);
                if (status == "success") {
                    var price = data.price;
                    var currency_code = data.currency_code;
                    var comparePriceId = data.comparePriceId;
                    //$data += "<tr id='compare-price-" + JSONObject.comparePriceId + "'>";
                    $data += "<td>" + dataIndex + "</td>";
                    $data += "<td>" + data.currency_code + '(' + data.country + ")</td>";
                    $data += " <td>" + data.shopName + "</td>";
                    $data += "<td>" + data.currency_code + ' ' + data.price + "</td>";
                    $data += '<td id="local-price-' + data.comparePriceId + '">-';

                    $data += "</td>";
                    //$data += "</tr>";
                    $data += "<td>";
                    $data += '<code><a class="text-danger"  onclick="CozxyComparePriceModernBest(' + data.comparePriceId + ',' + '\'edit\'' + ',' + '\'edit\'' + ',' + dataIndex + ')"><i class=\'fa fa-pencil-square-o\'></i>';
                    $data += "&nbsp;&nbsp;<span style=\"font-size: 11px;\">Edit Price</span></a></code>";
                    $data += "</td>";
                    $('#compare-price-' + data.comparePriceId).html($data).attr('class', 'info');
                    demo = function (data) {
                        fx.rates = data.rates
                        var rate = fx(price).from(currency_code).to("THB")
                        //alert("£1 = $" + rate.toFixed(4))
                        //$('#local-price-' + data.comparePriceId).html('THB ' + rate.toFixed(4).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
                        $('#local-price-' + comparePriceId).html('THB ' + rate.toFixed(4).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')).attr('class', 'warning');
                    }
                    $.getJSON("http://api.fixer.io/latest?base=ZAR", demo);

                    $(".bs-example-modal-lg").modal("hide");
                } else {
                    alert('error');
                }
            }
        });
    }

}

function CurrencyExchangeRate(id) {
    //alert(id);
    var currencyId = id;
    var controller = str[1];
    var id = str[2]
    //alert(id);
    var productPostId = $('#productPostId').val();
    //alert('productPostId : ' + productPostId);
    $.ajax({
        url: $baseUrl + "story/compare-price-story-currency-exchange-rate/?id=" + id + '&currencyId=' + currencyId,
        type: "GET",
        dataType: "JSON",
        //data: {'id': id},
        success: function (data, status) {
            if (status == "success") {
                console.log(data.comparePrice);
                console.log(data.currencyCode);
                //console.log(JSON.stringify(data));
                // var price = data[0].price;
                // var currency_code = data[0].currency_code;
                // var fx;
                var datax = data.comparePrice;
                var currencyCodes = data.currencyCode;
                var currencyNames = data.currencyName;
                console.log(currencyCodes);
                $.each(datax, function (i, field) {
                    //console.log(JSON.stringify(field));
                    //var fields = JSON.stringify(field);
                    //console.log(field.price + ':' + field.currency_code);
                    var demo = function (datax) {
                        fx.rates = datax.rates;
                        var rate = fx(field.price).from(field.currency_code).to(currencyCodes);//to("THB");
                        //alert(rate);
                        //alert(field.currency_code + "= THB" + '::' + +rate.toFixed(4));
                        $('#local-price-' + field.comparePriceId).html('<span style="color: #128a05;font-weight: bold;"> ' + currencyCodes + '</span> ' + rate.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
                    }
//
                    $.getJSON("http://api.fixer.io/latest?base=ZAR", demo);
                });
                //$('#local-price-85').html('xxxxx');
            } else {
                alert('error');
            }
        }
    });

    /*var fx;
     var demo = function (data) {
     fx.rates = data.rates
     var rate = fx(1).from("USD").to("THB")
     alert("£1 = $" + rate.toFixed(4))
     }
     $.getJSON("http://api.fixer.io/latest", demo);*/
}

var str = window.location.pathname.split('/');
if (str[1] == 'story') {
    //alert('story');
    var controller = str[1];
    var id = str[2]
    //alert(id);
    var productPostId = $('#productPostId').val();
    $.ajax({
        url: $baseUrl + "story/compare-price-story-currency/?id=" + id,
        type: "GET",
        dataType: "JSON",
        //data: {'id': id},
        success: function (data, status) {
            if (status == "success") {
                //console.log(JSON.stringify(data));
                // var price = data[0].price;
                // var currency_code = data[0].currency_code;
                // var fx;
                $.each(data, function (i, field) {
                    //console.log(JSON.stringify(field));
                    //var fields = JSON.stringify(field);
                    //console.log(field.price + ':' + field.currency_code);
                    var demo = function (data) {
                        fx.rates = data.rates;
                        var rate = fx(field.price).from(field.currency_code).to("THB");
                        //alert(field.currency_code + "= THB" + '::' + +rate.toFixed(4));
                        $('#local-price-' + field.comparePriceId).html('THB ' + rate.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
                    }
//
                    $.getJSON("http://api.fixer.io/latest?base=ZAR", demo);
                });
                //$('#local-price-85').html('xxxxx');
            } else {
                alert('error');
            }
        }
    });

    /*
     var fx;
     var demo = function (data) {
     fx.rates = data.rates
     var rate = fx(100).from("USD").to("THB")
     //alert("£1 = $" + rate.toFixed(4))
     }

     $.getJSON("http://api.fixer.io/latest", demo)*/
}

