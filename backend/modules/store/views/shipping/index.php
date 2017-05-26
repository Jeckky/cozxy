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
<?php
if (\Yii::$app->params['shippingScanTrayOnly'] == true) {
    $form = ActiveForm::begin([
                'method' => 'GET',
                'action' => ['shipping/index'],
    ]);
} else if (\Yii::$app->params['shippingScanTrayOnly'] == False) {
    $form = ActiveForm::begin([
                'method' => 'GET',
                'action' => ['shipping/scanbag'],
    ]);
}
?>
<div class="panel panel-default">
    <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
        <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
    </div>
    <div class="panel-body ">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="vertical-align: middle;text-align: center;"><h4><b>Order No QR code : </b></h4></th>
                    <td><?= \yii\helpers\Html::textInput('orderNo', NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?></td>
                </tr>
            </tbody>
        </table>
        <br><h4>:: หมายเหตุ : Scan Qr Code Order No ทุกครั้งก่อนนำส่ง ::</h4>
        <?= $this->registerJS("
                $('#orderNo').blur(function(event){
                    if(event.which == 13 || event.keyCode == 13)
                    {
                       $('#form').submit();
                    }
                });
    ") ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>
<?php
if (isset($orderInCar) && !empty($orderInCar) && isset($pickingPoints) && !empty($pickingPoints)) {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #cccccc;vertical-align: middle;">
            <span class="panel-title"><h3>นำส่ง</h3></span>
        </div>
        <div class="panel-body">

            <?php
            $colors = ["#FFFFCC", "#FFFF99", "#FFFF66", "#FFFF33", "#FFFF00", "#FFCC66"];
            $color = 0;
            foreach ($pickingPoints as $pickingPoint):
                $order = OrderItemPacking::findOrderAtPoint($pickingPoint);

                $pickingPointName = PickingPoint::pickingPointName($pickingPoint);
                // throw new \yii\base\Exception($pickingPoint);
                ?>
                <div class="col-lg-12 text-center" style="height: 60px;background-color: <?= $colors[$color] ?>;font-size: 15pt;padding-top:15px;margin-bottom: 15px;">
                    <?= $pickingPointName ?><div class="pull-right"><?= OrderItemPacking::countBagAtPoint($pickingPoint) ?> ถุง</div>
                </div>
                <?php
                //throw new \yii\base\Exception(print_r($order, true));
                foreach ($order as $orderId):
                    ?>
                    <div class="row">
                        <div class="col-lg-5 col-lg-offset-1 col-sm-5 col-sm-offset-1 col-xs-5 col-xs-offset-1 col-md-5 col-md-offset-1" style="font-size: 12pt;">
                            <?= Order::findOrderNo($orderId) ?>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" style="font-size: 10pt;">
                            <?php
                            $orderItems = Order::getItemString($orderId);
                            $bagNoes = OrderItemPacking::findBagNo($orderItems);
                            foreach ($bagNoes as $bagNo):
                                echo '<div class="col-lg-12" style="margin-bottom:10px;"><b>' . $bagNo . '</b></div>';
                            endforeach;
                            ?>

                        </div>
                    </div>
                    <hr>
                    <?php
                endforeach;
                $color++;
                if ($color > 5) {
                    $color = 0;
                }
            endforeach;
            ?>

        </div>
    </div>
<?php } ?>
<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #ffcc00;vertical-align: middle;">
        <span class="panel-title"><h4> Order รอส่ง(แพ๊คแล้ว) </h4></span>
    </div>
    <div class="panel-body">

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'rowOptions' => function($model) {
                if ($model->status == 14) {
                    return ['class' => 'warning'];
                } else if ($model->status == 15) {
                    return ['class' => 'success'];
                }
            },
            'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                //'orderId',
                //'orderItemId',
                //'orderNo',
                [
                    'attribute' => 'orderNo',
                    'value' => function($model) {
                        //if ($model->status == 6) {
                        //$txt = 'แพ็คใส่ถุงแล้ว';
                        //} else if ($model->status == 14) {
                        //$txt = 'กำลังจะส่ง';
                        //}
                        //return $model->orderNo . ' ,มี' . count($model->orderItemId) . 'รายการ';
                        return $model->orderNo;
                        // return $model->orderNo . ', มีสินค้า ' . \common\models\costfit\Order::CountOrderItems($model->orderId) . ' รายการ';
                    }
                ],
                //'bagNo',
                //'status',
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        if ($model->status == 6) {
                            $txt = 'แพ็คใส่ถุงแล้ว';
                        } else if ($model->status == 14) {
                            $txt = 'กำลังจัดส่ง';
                        } else if ($model->status == 15) {
                            $txt = 'สินค้ายังอยู่ใน lockers';
                        } else if ($model->status == 13) {
                            $txt = 'แพ็คเสร็จแล้ว';
                        }
                        return isset($txt) ? $txt : ''; // status items 6 : แพ็คใส่ถุงแล้ว
                    }
                ],
                    [
                    'attribute' => 'จำนวน bagNo',
                    'value' => function($model) {
                        return \common\models\costfit\OrderItemPacking::shipPacking($model->orderItemId) . "  ถุง";
                    }
                ],
                //'pickingId',
                [
                    'attribute' => 'สถานที่นำส่ง',
                    'value' => function($model) {
                        $name = isset($model->pickingpointitems->name) ? $model->pickingpointitems->name : '';
                        $code = isset($model->pickingpointitems->code) ? $model->pickingpointitems->code : '';
                        $title = isset($model->pickingpoint->title) ? $model->pickingpoint->title : '';
                        $localNamecitie = isset($model->pickingpoint->citie->localName) ? $model->pickingpoint->citie->localName : '';
                        $localNamestate = isset($model->pickingpoint->state->localName) ? $model->pickingpoint->state->localName : '';
                        $localNamecountrie = isset($model->pickingpoint->countrie->localName) ? $model->pickingpoint->countrie->localName : '';

                        return ' สถานที่ส่งของ : ' . $title . ', ' . $localNamecitie . ', ' . $localNamestate; // status items 6 : แพ็คใส่ถุงแล้ว
                    }
                ],
            // 'type',
            // 'createDateTime',
            // 'updateDateTime',
            ],
        ]);
        ?>

    </div>
</div>
