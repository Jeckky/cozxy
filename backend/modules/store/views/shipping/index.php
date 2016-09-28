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
    $form = ActiveForm::begin([
                'method' => 'GET',
                'action' => ['shipping/index'],
    ]);
    ?>
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> Scan Qr code Order No :</span>
    </div>
    <div class="panel-body">
        <input type="text" name="orderNo" autofocus="true" id="orderNo" class="form-control" placeholder="Search or Scan Qr code">
        <input type="hidden" id="orderId" name="orderId" value="">
        <div id="character-limit-input-label" class="limiter-label form-group-margin"><!--Characters left: <span class="limiter-count">20</span>--></div>
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
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'orderId',
                    'orderNo',
                    //'bagNo',
                    //'status',
                    [
                        'attribute' => 'status',
                        'value' => function($model) {
                            return isset($model->status) ? 'แพ็คใส่ถุงแล้ว' : ''; // status items 6 : แพ็คใส่ถุงแล้ว
                        }
                    ],
                    [
                        'attribute' => 'จำนวน bagNo',
                        'value' => function($model) {
                            return count($model->orderItems) . "  ถุง";
                        }
                    ],
                    //'pickingId',
                    [
                        'attribute' => 'pickingId',
                        'value' => function($model) {
                            return 'จุดรับของที่' . $model->pickingpoint->title . ' , ' . $model->pickingpoint->citie->localName . ' , ' . $model->pickingpoint->state->localName . ' , ' . 'ประเทศ' . $model->pickingpoint->countrie->localName; // status items 6 : แพ็คใส่ถุงแล้ว
                        }
                    ],
                    // 'type',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '  ',
                        'buttons' => [
                        /* 'items' => function($url, $model) {
                          return Html::a('รอ Picking Points ', Yii::$app->homeUrl . "picking/picking/index?pickingId=" . $model->pickingId, [
                          'title' => Yii::t('app', 'picking point'),]);
                          } */
                        ],
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

</div>