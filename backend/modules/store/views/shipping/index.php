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
<div class="order-index">
    <?php
    $form = ActiveForm::begin([
                'method' => 'GET',
                'action' => ['shipping/index'],
    ]);
    ?>

    <h4>   Order No : <input type="text" name="orderNo" autofocus="true" id="orderNo"></h4>

    <?= $this->registerJS("
                $('#orderNo').blur(function(event){
                    if(event.which == 13 || event.keyCode == 13)
                    {
                       $('#form').submit();
                    }
                });
    ") ?>
    <?php ActiveForm::end(); ?>
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
                    //'pickingId',
                    'orderId',
                    //'quantity',
                    //'bagNo',
                    //'status',
                    [
                        'attribute' => 'สถานะ',
                        'value' => function($model) {
                            return 'หยิบเสร็จแล้ว';
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
