<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

//KYOCERA TEST
?>
<style>
    .table-light{
        font-size: 13px;
        color: #434b50;
    }
    .asc{
        color: #292c2e;
    }
    th {
        font-weight: 500;
    }
</style>

<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="font-size: 14px;">
    <h3>Order History</h3>

    <?php
    echo GridView::widget([//   table-striped table-bordered  //
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-light  table-hover',
        ],
        'rowOptions' => function ($model, $index, $widget, $grid) {

            if ($model->status == \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS) {
                return ['class' => 'alert alert-success'];
            } elseif ($model->status == \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_PENDING) {
                return ['class' => 'alert alert-warning'];
            } elseif ($model->status == \common\models\costfit\Order::ORDER_STATUS_FINANCE_REJECT) {
                return ['class' => 'alert alert-danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // Simple columns defined by the data contained in $dataProvider.
            // Data from the model's column will be used.
            [
                'attribute' => 'order #',
                'value' => function ($model) {
                    if ($model->total != null) {
                        if (!isset($model->invoiceNo) && empty($model->invoiceNo)) {
                            return 'Order No : ' . $model->orderNo . '<br><span style ="font-size: 12px;"> Total : ' . number_format($model->summary, 2) . ' THB</span>';
                        } else {
                            return '<span style="font-weught:bold;">Invoice No : ' . $model->invoiceNo . '</span><br><span style ="font-size: 12px;"> Total : ' . number_format($model->summary, 2) . ' THB</span>';
                        }
                        //or: return Html::encode($model->some_attribute)
                    } else {
                        return '';
                    }
                },
                'format' => 'html',
                'filterInputOptions' => ['class' => 'form-control input-sm  col-sm-4', 'placeholder' => 'Search Order No ...'],
            ],
            [
                'attribute' => 'Order date',
                'value' => function($model) {
                    return $this->context->dateThai($model->createDateTime, 4);
                },
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'name' => 'Order[createDateTime]',
                    'size' => 'sm',
                    'language' => 'en',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => [
                        'placeholder' => 'Search date ...',
                        'class' => 'input-sm col-sm-6',
                    ],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
                ]),
            ],
            [
                'attribute' => 'Status',
                'value' => function($model) {
                    return $model->getStatusTextEn($model->status);
                },
                'format' => 'raw',
            ],
            // More complex one.
            ['class' => 'yii\grid\ActionColumn', 'options' => ['style' => ' width:120px; text-align: center;'],
                'header' => 'Manage',
                'template' => ' {Order} ',
                'buttons' => [
                    'Order' => function($url, $model, $baseUrl) {
                        if ($model->status < \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS || $model->status == \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_PENDING) { // ชำระเงินแล้ว
                            return Html::a('See more', Yii::$app->homeUrl . "profile/purchase-order/" . $model->encodeParams(['orderId' => $model->orderId]), ['class' => 'btn btn-primary btn-xs'], [
                                'title' => Yii::t('app', ' '),]);
                        } else {
                            return Html::a('<i class="fa fa-print" aria-hidden="true"></i> See more', Yii::$app->homeUrl . "payment/print-receipt/" . $model->encodeParams(['orderId' => $model->orderId]) . '/' . $model->orderNo, ['class' => 'btn btn-black btn-xs', 'target' => '_blank'
                                , 'title' => Yii::t('app', ' ')]);
                        }
                    },
                ]
            ],
        ], 'layout' => "{pager}\n{items}\n",
    /* 'pager' => [
      'firstPageLabel' => 'first',
      'lastPageLabel' => 'last',
      'nextPageLabel' => 'next',
      'prevPageLabel' => 'previous',
      'maxButtonCount' => 3,
      ], */
    ]);
    ?>
</div>

