<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\costfit\User;
use yii\widgets\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Unit;
use common\models\costfit\Address;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders from Cozxy.com';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topup-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
        </div>

        <div class="panel-body">
            <?php
            if (count($productSuppIds) > 0) {
                ?>
                <h4>* มีรายการสั่งสินค้าจากทาง Cozxy dot com ถึง <b><?= Address::CompanyName(Yii::$app->user->identity->userId) ?></b></h4>
                <h4> กรุณาเตรียมสินค้าตามรายด้านล่าง ทาง Cozxy dot com จะดำเนินการส่ง Po ตามมาภายหลัง </h4>
                <br>
<?php } ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="vertical-align: middle;text-align: center;">#</th>
                        <th style="vertical-align: middle;text-align: center;">Image</th>
                        <th style="vertical-align: middle;text-align: center;">Isbn</th>
                        <th style="vertical-align: middle;text-align: center;">Product name</th>
                        <th style="vertical-align: middle;text-align: center;">Quantity</th>
                        <th style="vertical-align: middle;text-align: center;">Unit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($productSuppIds) > 0) {
                        $i = 1;
                        foreach ($productSuppIds as $productSuppId):
                            ?>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"><?= $i ?></td>
                                <td style="text-align: center;"><img src="<?= Yii::$app->homeUrl . ProductSuppliers::productImageSuppliers($productSuppId) ?>" style="width: 80px;height: 80px;border: #ff9900 thin solid;"></td>
                                <td style="text-align: center;vertical-align: middle;"><?= ProductSuppliers::productSupplierName($productSuppId)->isbn ?></td>
                                <td style="text-align: left;vertical-align: middle;"><?= ProductSuppliers::productSupplierName($productSuppId)->title ?></td>
                                <td style="text-align: center;vertical-align: middle;"><?= count(ProductSuppliers::productOrder($productSuppId)) ?></td>
                                <td style="text-align: center;vertical-align: middle;"><?= Unit::unitName($productSuppId) ?></td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                    } else {
                        ?>
                        <tr>
                            <td style="text-align: center;" colspan="6"><i>There are no order now!!</i></td>

                        </tr>
                    </tbody>
<?php } ?>
            </table>
        </div>
    </div>
</div>

