<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shipping List';
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
    <div class="panel-heading"  style="background-color: #ccffcc;vertical-align: middle;">
        <span class="panel-title"><h3><?= $this->title ?></h3></span>
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
<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #ccffff;vertical-align: middle;">
        <span class="panel-title"><h4><?= $this->title ?> ( Order ที่มาจาก Packing )</h4></span>
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
                        return $model->orderNo . ', มีสินค้า ' . \common\models\costfit\Order::CountOrderItems($model->orderId) . ' รายการ';
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

                        return ' สถานที่ส่งของ : ' . $title . ' , ' . $localNamecitie . ' , ' . $localNamestate . ' , ' . 'ประเทศ' . $localNamecountrie . ' '; // status items 6 : แพ็คใส่ถุงแล้ว
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
