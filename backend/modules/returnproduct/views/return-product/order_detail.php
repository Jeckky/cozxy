
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\ProductSuppliers;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="order-index">
    <?php Pjax::begin(['id' => 'return-product']); ?>
    <div class="panel panel-default">
        <div class="panel-heading"  style="vertical-align: middle;background-color: #000;">
            <span class="panel-title"><h3 style="color:#ffcc00;">รายละเอียดลูกค้า</h3></span>
        </div>
        <div class="panel-body" style="font-size: 13pt;">
            <div class="col-lg-3 col-md-3 col-xs-6" style="height: 40px;">ชื่อ - นามสกุล : </div><div class="col-lg-9 col-md-9 col-xs-6" style="height: 40px;"><?= common\models\costfit\User::userName($order->userId) ?></div>
            <div class="col-lg-3 col-md-3 col-xs-6" style="height: 40px;margin-bottom: 10px;">ที่อยู่ : </div><div class="col-lg-9 col-md-9 col-xs-6" style="height: 40px; margin-bottom: 10px;"><?= $addressText ?></div>
            <div class="col-lg-3 col-md-3 col-xs-6" style="height: 40px;">จุดรับสินค้า : </div><div class="col-lg-9 col-md-9 col-xs-6" style="height: 40px;"><?= $pickingPoint ?></div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"  style="vertical-align: middle;background-color: #000;">
            <span class="panel-title"><h3 style="color: #ffcc00">รายการสินค้าที่ต้องการคืน</h3></span>
        </div>
        <div class="panel-body" style="font-size: 13pt;">
            <?= \yii\helpers\Html::textInput('orderNo', NULL, ['class' => 'input-lg productQr', 'autofocus' => 'autofocus', 'placeholder' => 'Product Qr Code']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?>
            <input type="hidden" id="orderId" value="<?= $order->orderId ?>">
            <div id="returnList" style="margin-top: 10px;">
                <?php if (isset($returnList) && !empty($returnList)) { ?>
                    <table class="table">
                        <tr style="height: 50px;background-color: #999999;">
                            <th style="vertical-align: middle;text-align: center;width: 10%;">ลำดับที่</th>
                            <th style="vertical-align: middle;text-align: center;width: 30%;">สินค้า</th>
                            <th style="vertical-align: middle;text-align: center;width: 15%;">จำนวนที่สั่งซื้อ</th>
                            <th style="vertical-align: middle;text-align: center;width: 35%;">จำนวนที่ต้องการคืน</th>
                            <th style="vertical-align: middle;text-align: center;width: 10%;">ยกเลิก</th>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($returnList as $rItem):
                            ?>
                            <tr style="height: 50px;">
                                <td style="vertical-align: middle;text-align: center;"> <?= $i ?></td>
                                <td style="vertical-align: middle;text-align: center;"><?= ProductSuppliers::productSupplierName($rItem->productSuppId)->title ?></td>
                                <td style="vertical-align: middle;text-align: center;"><?= $rItem->quantity ?></td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <button class="btn-md"> - </button>
                                    <input type="text" class="text-center" style="width:35px;height:35px;" value="<?= $rItem->quantity ?>">
                                    <button class="btn-md"> + </button></td>
                                <td style="vertical-align: middle;text-align: center;font-size: 25pt;"><i class="fa fa-times-circle" id="deleteR<?= $rItem->returnProductId ?>" aria-hidden="true" style="cursor: pointer;"></i></td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
