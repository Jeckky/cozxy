<?php

/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$dataProvider = $searchModel->search(Yii::$app->request->get());
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
            'attribute' => 'total',
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
            'attribute' => 'Create Date',
            'value' => 'createDateTime',
            'format' => 'raw',
            'filter' => DatePicker::widget([
                'name' => 'createDateTime',
                'size' => 'sm',
                'type' => DatePicker::TYPE_INPUT,
                'options' => [
                    'placeholder' => 'Search date ...',
                    'class' => 'input-sm',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-M-yyyy',
                ],
            ]),
        ],
        // More complex one.
        ['class' => 'yii\grid\ActionColumn', 'options' => ['style' => ' width:20px; text-align: center;'],
            'header' => 'Actions',
            'template' => ' {Order} ',
            'buttons' => [
                'Order' => function($url, $model, $baseUrl) {
                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', Yii::$app->homeUrl . "profile/purchase-order?OrderNo=" . $model->orderId, [
                                'title' => Yii::t('app', ' View Order No'),]);
                },
                    ]
                ],
            ], 'layout' => "{pager}\n{items}\n",
        ]);
        ?>

