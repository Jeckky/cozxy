<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Picking List';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="order-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Order', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'method' => 'GET',
                        'action' => ['packing/index'],
            ]);
            ?>

            <h4>   Order No QR code : <input type="text" name="orderNo" autofocus="true" id="orderNo" required="true"></h4>
                <?= $this->registerJS("
                            $('#orderNo').blur(function(event){
                                if(event.which == 13 || event.keyCode == 13)
                                {
                                   $('#form').submit();
                                }
                            });
                ") ?>
                <?=
                GridView::widget([
                    'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'options' => ['class' => 'pagination pagination-xs']
                    ],
                    'options' => [
                        'class' => 'table-light'
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'orderNo',
                        [
                            'attribute' => 'countItem',
                            'format' => 'html',
                            'value' => function($model) {
                                $countItemsArray = common\models\costfit\OrderItem::countPickingItemsArray($model->orderId);
                                return $countItemsArray['countItems'] . " รายการ<br>" . $countItemsArray['sumQuantity'] . " ชิ้น";
                            }
                        ],
//                        ['class' => 'yii\grid\ActionColumn',
//                            'header' => 'Actions',
//                            'template' => '',
//                            'buttons' => [
//                                'view' => function($url, $model) {
//                                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>View', Yii::$app->homeUrl . "order/order/view/" . $model->encodeParams(['id' => $model->orderId]), [
//                                                'title' => Yii::t('app', ' View Order No :' . $model->orderId), 'class' => 'btn btn-info']);
//                                },
//                                    ]
//                                ],
                    ],
                ]);
                ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
