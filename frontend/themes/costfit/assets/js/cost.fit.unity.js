/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$.post("checkout/child-states", {// child-states //
    'depdrop_parents[]': 2526,
    'depdrop_all_params[]': 2526
}, function (data, status) {
    alert(status);
    if (status == "success") {
        var JSONObjectB1 = JSON.parse(data);
        for (i in JSONObjectB1.output)
        {
            if (JSONObjectB1.output[i].id === JSONObject.provinceId) {
//alert(JSONObject2.output[i].id);
                $('.form-group').find('#' + $('.form-group-billing').find('#statesDDId').val()).append('<option selected value=' + JSONObjectB1.output[i].id + '>' + JSONObjectB1.output[i].name + '</option>');
            } else {
                $('.form-group').find('#' + $('.form-group-billing').find('#statesDDId').val()).append('<option value=' + JSONObjectB1.output[i].id + '>' + JSONObjectB1.output[i].name + '</option>');
            }
        }
//                    $('.form-group').find('#' + $('.form-group').find('#statesDDId').val()).depdrop('init');
        $('.form-group').find('#' + $('.form-group-billing').find('#statesDDId').val()).val(JSONObject.provinceId).trigger('change');
    } else {
//alert(status);
    }

}); // child-states //