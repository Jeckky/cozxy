<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style>
    .table-light{
        font-size: 14px;
        color: #292c2e;
    }
    .asc{
        color: #292c2e;
    }
</style>
<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h3>รายการใบสั่งซื้อสินค้าทั้งหมด</h3>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-light',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // Simple columns defined by the data contained in $dataProvider.
            // Data from the model's column will be used.
            [
                'attribute' => 'orderNo',
                'format' => 'raw',
                'filterInputOptions' => ['class' => 'form-control input-sm', 'placeholder' => 'Search Order No ...'],
            ],
            [
                'attribute' => 'summary',
                'value' => function ($model) {
                    if ($model->total != null) {
                        return $model->total . ' บาท';
                        //or: return Html::encode($model->some_attribute)
                    } else {
                        return '';
                    }
                },
                'format' => 'html',
                'filter' => FALSE
            ],
            [
                'attribute' => 'วันที่สั่งซื้อ',
                'value' => 'createDateTime',
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'name' => 'Order[createDateTime]',
                    'size' => 'sm',
                    'language' => 'th',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => [
                        'placeholder' => 'Search date ...',
                        'class' => 'input-sm',
                    ],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
                ]),
            ],
            // More complex one.
            ['class' => 'yii\grid\ActionColumn', 'options' => ['style' => ' width:20px; text-align: center;'],
                'header' => 'จัดการ',
                'template' => ' {Order} ',
                'buttons' => [
                    'Order' => function($url, $model, $baseUrl) {
                        return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', Yii::$app->homeUrl . "profile/purchase-order/" . $model->encodeParams(['orderId' => $model->orderId]), [
                                    'title' => Yii::t('app', ' View Order No :' . $model->orderId),]);
                    },
                        ]
                    ],
                ], 'layout' => "{pager}\n{items}\n",
            ]);
            ?>
</div>

