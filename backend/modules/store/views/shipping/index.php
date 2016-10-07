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

<div class="panel">
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
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> Scan Qr code Order No :</span>
    </div>
    <div class="panel-body ">
        <div class="col-sm-5">
            <input type="text" name="orderNo" autofocus="true" id="orderNo" class="form-control" placeholder="Search or Scan Qr code">
           <div id="character-limit-input-label" class="limiter-label form-group-margin"><!--Characters left: <span class="limiter-count">20</span>--></div>
        </div>
    </div>
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

<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?> ( Order มาจาก Packing )</div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        &nbsp;
                    </div>
                </div>
            </div>
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
                            'orderId',
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
                                    return $model->orderNo . ', มี ' . \common\models\costfit\Order::CountOrderItems($model->orderId) . ' รายการ';
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
                                        $txt = 'กำลังจะส่ง';
                                    } else if ($model->status == 15) {
                                        $txt = 'ของอยู่ใน lockers แล้ว';
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
                                'attribute' => 'pickingId',
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
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => ' {items} ',
                                'buttons' => [
                                    'items' => function($url, $model) {
                                        if ($model->status == 14) {
                                            return Html::a('นำใส่ lockers', Yii::$app->homeUrl . "store/lockers/index?orderId=" . $model->orderId, [
                                                        'title' => Yii::t('app', 'picking point'),]);
                                        } else {
//                                    return Html::a('รอปิดถุงแล้ว', '', [
//                                                'title' => Yii::t('app', 'picking point'),]);
                                        }
                                    }
                                        ],
                                    ],
                                ],
                            ]);
                            ?>
        </div>
    </div>

</div>