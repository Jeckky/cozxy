
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\OrderItem;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">ยืนยันการคืนสินค้า</h3></span>
        </div>
        <div class="panel-body">

            <table class="table">
                <tr>
                    <td style="text-align: center;width:30%;">สินค้า</td>
                    <td style="text-align: center;">จำนวน</td>
                    <td style="text-align: center;">ราคา/ชิ้น</td>
                    <td style="text-align: center;">รวม</td>
                    <td style="text-align: center;">ส่วนลด/ชิ้น</td>
                    <td style="text-align: center;">รวมส่วนลด</td>
                    <td style="text-align: center;">สถานะ</td>
                    <td style="text-align: center;">ยอดคืน(Coin)</td>
                </tr>
                <?php
                $totalReturn = 0;
                foreach ($returnProducts as $return):
                    ?>
                    <tr >
                        <td style="vertical-align: middle;text-align: center;"><img src="<?= $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($return->productSuppId)[0]->image ?>" style="width:100px;height: 80px;"><br>
                            <?= ProductSuppliers::productSupplierName($return->productSuppId)->title ?>
                        </td>
                        <td style="vertical-align: middle;text-align: center;"><?= $return->quantity ?></td>
                        <td style="vertical-align: middle;text-align: right;"><?= number_format($return->price, 2) ?></td>
                        <td style="vertical-align: middle;text-align: right;"><?= number_format($return->quantity * $return->price, 2) ?></td>
                        <td style="vertical-align: middle;text-align: right;"><?= number_format(OrderItem::calculateReturnDiscount($return->orderItemId), 2) ?></td>
                        <td style="vertical-align: middle;text-align: right;"><?= number_format($return->totalDiscount, 2) ?></td>
                        <td style="vertical-align: middle;text-align: right;"><?= $return->status == 2 ? 'รับคืน' : 'ไม่รับคืน' ?></td>
                        <td style="vertical-align: middle;text-align: right;"><?= $return->status == 2 ? number_format($return->credit, 2) : 0 ?></td>
                    </tr>
                    <?php
                    if ($return->status == 2) {
                        $totalReturn += $return->credit;
                    }
                endforeach;
                ?>
                <tr>
                    <td colspan="7" style="text-align: right"><b>รวม</b></td>
                    <td style="text-align: right;background-color: #cccccc;"><?= number_format($totalReturn, 2) ?></td>
                </tr>
            </table>
            <?php
            $form = ActiveForm::begin([
                        'method' => 'POST',
                        'id' => 'confirmation',
            ]);
            ?>
            <input type="hidden" name="confirm" value="<?= $orderId ?>">
            <input type="hidden" name="ticketId" value="<?= $ticketId ?>">
            <input type="hidden" name="totalReturn" value="<?= $totalReturn ?>">
            <?php
            if ($totalReturn != 0) {
                ?>
                <button type="submit" class="btn-lg pull-right" style="background-color: #000;color: #ffcc00;cursor: pointer;"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ส่ง cozxy ตรวจสอบ</button>
            <?php } else { ?>
                <button type="submit" class="btn-lg pull-right" style="background-color: #000;color: #ffcc00;cursor: pointer;"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ส่งของคืนลูกค้าแล้ว</button>
            <?php } ?>
            <a href="<?= $baseUrl . 'order-detail?orderId=' . $orderId . '&ticketId=' . $ticketId ?>&reEdit=1" class="btn-lg pull-right" style="background-color: #000;color: #ffcc00;cursor: pointer;margin-right: 5px;"><i class="fa fa-pencil" aria-hidden="true"></i> แก้ไขรายการ</a>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
