
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\OrderItem;
use common\models\costfit\Order;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">คืนสินค้าเรียบร้อย</h3></span>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="panel panel-default col-lg-8 col-md-8 col-xs-12" style="border: #FFF;">
                    <div class="panel-heading"  style="background-color: #666666;vertical-align: middle;">
                        <span class="panel-title"><h4 style="color:#ffcc00;">ประวัติการคืนสินค้า</h4></span>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>

                                <td style="width: 40%;text-align: center;">สินค้า</td>
                                <td style="width: 20%;text-align: center;">Invoice</td>
                                <td style="width: 5%;text-align: center;">จำนวน</td>
                                <td style="width: 10%;text-align: center;">เครดิต</td>
                                <td style="width: 25%;text-align: center;">วันที่</td>
                            </tr>
                            <?php
                            $total = 0;
                            foreach ($returnHistory as $history):
                                ?>
                                <tr>
                                    <td style="vertical-align: middle;text-align: center;"><img src="<?= $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($history->productSuppId)[0]->image ?>" style="width:80px;height: 50px;"><br>
                                        <?= ProductSuppliers::productSupplierName($history->productSuppId)->title ?>
                                    </td>
                                    <td style="vertical-align: middle;text-align: right;"><?= Order::invoiceNo($history->orderId) ?></td>
                                    <td style="vertical-align: middle;text-align: right;"><?= number_format($history->quantity, 2) ?></td>
                                    <td style="vertical-align: middle;text-align: right;"><?= number_format($history->credit, 2) ?></td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $this->context->dateThai($history->createDateTime, 4) ?></td>
                                </tr>
                                <?php
                                $total += $history->credit;
                            endforeach;
                            ?>
                            <tr>
                                <td colspan="3" style="text-align: right"><b>รวม</b></td>
                                <td style="text-align: right;background-color: #cccccc;"><b><?= number_format($total, 2) ?></b></td>
                                <td><b>บาท</b></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default col-lg-4 col-md-4 col-xs-12 pull-right" style="border: #FFF;">
                    <div class="panel-heading"  style="background-color: #666666;vertical-align: middle;width: 100%">
                        <span class="panel-title"><h4 style="color:#ffcc00;">Cozxy coin</h4></span>
                    </div>
                    <div class="panel-body" style="border: #cccccc solid thin;width: 100%;text-align: center;">
                        <h4>คุณ <?= \common\models\costfit\User::userName($userId) ?></h4><br>
                        <h4>ยอดคงเหลือ</h4>
                        <b><h3><?= number_format($userTotalCredit->currentPoint, 2) ?> บาท</h3></b>
                    </div>
                    <a href="<?= $baseUrl . 'request-ticket' ?>">
                        <div style="width: 100%;text-align: center;background-color: #ffcc00;color: #FFF;height: 80px">
                            <hr style="size: 1px;color: #FFF;">
                            <h1><i class="fa fa-home" aria-hidden="true"></i> กลับสู่หน้าหลัก</h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
