<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Order */
?>
<?php
$baseUrl = $js = "$(document).on('click', '.reprint', function (e) {
    var url = 'order/order/reprint-real-time';
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
});";
$this->registerJs($js);
?>
<div class="panel-heading" style="background-color: #ccffcc;">
    <span class="panel-title"><h3>รายการ Orders ที่ยังไม่สร้าง PO</h3></span>
    <span class="pull-right refresh"><img src="<?= Yii::$app->homeUrl . 'images/icon/refresh.png' ?>" style="width:50px;height:50px;margin-top: -70px;cursor: pointer;"></span>
    <span class="pull-right refresh2" style="display: none;"><img src="<?= Yii::$app->homeUrl . 'images/icon/refresh.png' ?>" style="width:70px;height:70px;margin-top: -70px;cursor: pointer;"></span>
</div>
<div class="panel-body" id="showData">
</div>
<div class="panel-heading reprint" style="background-color: #99ccff;color: #F0FFFF;cursor: pointer;">
    <h3><b><i class="fa fa-plus-circle" aria-hidden="true"></i> Reprint PO</b></h3>
</div>
<div class="panel-heading reprint2" style="background-color: #99ccff;color: #F0FFFF;cursor: pointer; display: none;">
    <h3><b><i class="fa fa-minus-circle" aria-hidden="true"></i> Reprint PO</b></h3>
</div>
<div class="panel-body" style="display: none;" id="allPoes">

</div>
