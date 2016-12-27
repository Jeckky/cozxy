<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Order */
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
    <table class="table" >
        <tr style="height: 50px;background-color: #ffffcc;">
            <th style="vertical-align: middle;text-align: center;width: 10%;">ลำดับที่</th>
            <th style="vertical-align: middle;text-align: center;width: 30%;">PO NO.</th>
            <th style="vertical-align: middle;text-align: center;width: 15%;">วันที่สร้าง</th>
            <th style="vertical-align: middle;text-align: center;width: 30%;">สถานะ</th>
            <th style="vertical-align: middle;text-align: center;width: 30%;">พิมพ์ซ้ำ</th>
        </tr>

        <?php
        $poes = \common\models\costfit\StoreProductGroup::allPurchaseOrder();

        if (isset($poes) && !empty($poes)) {
            $i = 1;
            $a = 0;
            $orderId = [];
            foreach ($poes as $po):
                ?>
                <tr>
                    <td style="vertical-align: middle;text-align: center;width: 5%;"><?= $i ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 30%;"><?= $po->poNo ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 15%;"><?= $this->context->dateThai($po->createDateTime, 1) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 15%;"><?= \common\models\costfit\StoreProductGroup::getStatusText($po->status) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 15%;"><?= Html::a('<i class="fa fa-print" aria-hidden="true"></i> พิมพ์ซ้ำ', ['reprint-po', 'storeProductGroupId' => $po->storeProductGroupId], ['class' => 'btn btn-md btn-warning pono', 'target' => '_blank']) ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>

            <?php
        } else {
            ?>
            <tr><td colspan="5" style="text-align: center; background-color: #cccccc;"><h4> ไม่มีข้อมูล</h4></td></tr>
        <?php }
        ?>
    </table>
</div>
