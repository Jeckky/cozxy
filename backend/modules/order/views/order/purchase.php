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
$baseUrl = '';
$js = "
$(function () {
    var url = 'real-time';
    setInterval(function () { // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที
        // 1 วินาที่ เท่ากับ 1000
        var getData = $.ajax({// ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล
            url: url,
            data: 'rev=1',
            async: false,
            success: function (getData) {
                $('#showData').html(getData); // ส่วนที่ 3 นำข้อมูลมาแสดง
            }
        }).responseText;
    }, 1000);
});";
$this->registerJs($js);
?>
<div class="panel-heading" style="background-color: #000;">
    <span class="panel-title"><h3 style="color: #ffcc00">รายการ Orders ที่ยังไม่สร้าง PO</h3></span>
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
