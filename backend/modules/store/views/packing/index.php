<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Packing List';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="order-index">
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
        </div>
        <div class="panel-body">

            <?php
            $form = ActiveForm::begin([
                        'method' => 'GET',
                        'action' => ['packing/index'],
            ]);
            ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="vertical-align: middle;text-align: center;"><h4><b>Order No QR code : </b></h4></th>
                <td><?= \yii\helpers\Html::textInput('orderNo', NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?></td>
                </tr>
                </tbody>
            </table>
            <br><h4>สแกน Qr Code ของ Order เพื่อแพ็คสินค้า</h4>
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
        <div class="panel-heading" style="background-color:#ffcc00;vertical-align: middle;">
            <span class="panel-title"><h4> รายการ Order เตรียมแพ็ค / แพ็คแล้ว </h4></span>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'method' => 'GET',
                        'action' => ['packing/index'],
            ]);
            ?>
            <div class="row col-lg-12 col-md-12" style="margin-bottom:20px;">
                <div class="col-lg-3 col-md-3">
                    <input type="text" class="form-control" name="bagNumberSearch" placeholder="Bag number" value="<?= isset($_GET["bagNumberSearch"]) ? $_GET["bagNumberSearch"] : '' ?>">
                </div>
                <div class="col-lg-3 col-md-3">
                    <input type="text" class="form-control" name="orderNumberSearch" placeholder="Order number" value="<?= isset($_GET["orderNumberSearch"]) ? $_GET["orderNumberSearch"] : '' ?>">
                </div>
                <div class="col-lg-3 col-md-3">
                    <input type="text" class="form-control" name="invoiceNumberSearch" placeholder="Invoice number" value="<?= isset($_GET["invoiceNumberSearch"]) ? $_GET["invoiceNumberSearch"] : '' ?>">
                </div>
                <div class="col-lg-3 col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

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
                'rowOptions' => function ($model, $index, $widget, $grid) {
            if ($model->status == common\models\costfit\Order::ORDER_STATUS_PACKED)
                return ['class' => 'success'];
        },
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
                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => function($model) {
                            return $model->createStatus2($model->orderId);
                        }
                    ],
                    [
                        'attribute' => 'Reprint',
                        'format' => 'html',
                        'value' => function($model) {
                            if ($model->status >= \common\models\costfit\Order::ORDER_STATUS_PACKED) {
                                return Html::a('<i class="fa fa-print" aria-hidden="true"></i> Reprint Bag Label', Yii::$app->homeUrl . "store/packing/all-bag-label?orderId=" . $model->orderId);
                            } else {
                                return '';
                            }
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
    <?php Pjax::end(); ?>
</div>