<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\Order;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shipping';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #cccccc;vertical-align: middle;">
        <span class="panel-title"><h3>นำส่ง</h3></span>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 15px;">#</th>
                    <th>Bag number</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Action</th>
                <tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($shipToHome as $bag):
                    $order = OrderItemPacking::orderNo($bag->orderItemId);
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $bag->bagNo ?></td>
                        <td><?= $order->shippingFirstname . " " . $order->shippingLastname ?></td>
                        <td><?= PickingPoint::findPickingPoitItem($order->orderId) ?></td>
                        <td><a href="<?= Yii::$app->homeUrl ?>store/shipping/customer-received?bagNo=<?= $bag->bagNo ?>&&orderId=<?= $order->orderId ?>" class="btn btn-success" >ลูกค้ารับของแล้ว </a></td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
            </tbody>
        </table>

    </div>
</div>

