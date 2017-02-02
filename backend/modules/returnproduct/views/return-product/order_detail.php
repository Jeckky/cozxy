
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\ProductSuppliers;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//throw new \yii\base\Exception($baseUrl);
?>
<div class="order-index">
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

            <?= \yii\helpers\Html::textInput('isbn', NULL, ['class' => 'input-lg productQr', 'autofocus' => 'autofocus', 'placeholder' => 'Product Qr Code']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?>
            <?php
            $form = ActiveForm::begin([
                        'method' => 'POST',
                        'id' => 'returnDetail',
                        'action' => ['return-product/confirm-return'],
            ]);
            ?>
            <input type="hidden" name="orderId" id="orderId" value="<?= $order->orderId ?>">
            <input type="hidden" id="ticketId" value="<?= $ticketId ?>">
            <div id="returnList" style="margin-top: 10px;">
                <?php if (isset($returnList) && !empty($returnList)) { ?>
                    <table class="table">
                        <tr style="height: 50px;background-color: #999999;">
                            <th style="vertical-align: middle;text-align: center;width: 5%;">No.</th>
                            <th style="vertical-align: middle;text-align: center;width: 30%;">สินค้า</th>
                            <th style="vertical-align: middle;text-align: center;width: 10%;">สั่งซื้อ</th>
                            <th style="vertical-align: middle;text-align: center;width: 35%;">จำนวนที่ต้องการคืน</th>
                            <th style="vertical-align: middle;text-align: center;width: 15%;">Remark</th>
                            <th style="vertical-align: middle;text-align: center;width: 5%;">ยกเลิก</th>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($returnList as $rItem):
                            ?>
                            <tr style="height: 50px;">
                                <td style="vertical-align: middle;text-align: center;"> <?= $i ?></td>
                                <td style="vertical-align: middle;text-align: center;"><img src="<?= $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($rItem->productSuppId)[0]->image ?>" style="width:150px;height: 100px;"><br>
                                    <?= ProductSuppliers::productSupplierName($rItem->productSuppId)->title ?></td>
                                <td style="vertical-align: middle;text-align: center;"><?= $rItem->quantity ?></td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <a class="btn" id="incr-return">-</a>
                                    <input type="text" class="text-center" style="width:35px;height:35px;" id="qnty-return<?= $rItem->returnProductId ?>" value="<?= $rItem->quantity ?>" readonly="true">
                                    <a class="btn" id="incr-return">+</a>
                                </td>
                                <td style="vertical-align: middle;text-align: center;"><textarea name="remark[<?= $rItem->returnProductId ?>]" id="remark<?= $rItem->returnProductId ?>" required="true"><?= isset($rItem->remark) ? $rItem->remark : '' ?></textarea></td>

                            <input type="hidden" id="pSuppId" value="<?= $rItem->returnProductId ?>">
                            <input type="hidden" id="pOrderId" value="<?= $order->orderId ?>">
                            <td style="vertical-align: middle;text-align: center;font-size: 25pt;"><i class="fa fa-times-circle deleteR" id="deleteR<?= $rItem->returnProductId ?>" aria-hidden="true" style="cursor: pointer;"></i></td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    </table>
                    <a class="btn-lg pull-right" id="confirm-return" style="background-color: #000;color: #ffcc00;cursor: pointer;"><i class="fa fa-check-square-o" aria-hidden="true"></i> คืนสินค้า</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
