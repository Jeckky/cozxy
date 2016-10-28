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
        <div class="panel-heading"  style="background-color: #ccffcc;vertical-align: middle;">
            <span class="panel-title"><h3><?= $this->title ?></h3></span>
        </div>
        <div class="panel-body">

            <?php
            $form = ActiveForm::begin([
                'method' => 'GET',
                'action' => ['packing/index'],
            ]);
            ?>

            <h3>   Order No QR code : <input class="input-lg"type="text" name="orderNo" autofocus="true" id="orderNo" required="true"></h3>
            <br><h4>:: สแกน Qr Code ของ Order เพื่อแพ๊คสินค้า ::</h4><hr>
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
                        'value' => function($model) {
                            return $model->getStatusText($model->status);
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
    <!--    <div id="printableArea">
            <h1>Print me</h1>
        </div>-->

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
<!--<input type="button" onclick="printDiv('printableArea')" value="print a div!" />
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>-->