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
        color: #434b50;
    }
    .asc{
        color: #292c2e;
    }
    th {
        font-weight: 500;
    }
</style>

<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h3>รายการใบสั่งซื้อสินค้าทั้งหมด</h3>

    <?php
    echo GridView::widget([//   table-striped table-bordered  //
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-light',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // Simple columns defined by the data contained in $dataProvider.
            // Data from the model's column will be used.
            [
                'attribute' => 'orderNo',
                'value' => function ($model) {
                    if ($model->total != null) {
                        return 'Order No : ' . $model->orderNo . '<br><span style ="font-size: 12px;"> ยอดรวม : ' . $model->summary . ' THB</span>';
                        //or: return Html::encode($model->some_attribute)
                    } else {
                        return '';
                    }
                },
                'format' => 'html',
                'filterInputOptions' => ['class' => 'form-control input-sm  col-sm-4', 'placeholder' => 'Search Order No ...'],
            ],
            [
                'attribute' => 'วันที่สั่งซื้อ',
                'value' => function($model) {
                    return date("d M Y h:i:s", strtotime($model->createDateTime));
                },
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'name' => 'Order[createDateTime]',
                    'size' => 'sm',
                    'language' => 'th',
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
                'attribute' => 'สถานะ',
                'value' => function($model) {
                    return ($model->paymentType == 1) ? '<span style="color: #ac2925">ยังไม่ชำระเงิน</span>' : '<span style="color: #006600">ชำระเงินแล้ว</span>';
                },
                'format' => 'raw',
            ],
            // More complex one.
            ['class' => 'yii\grid\ActionColumn', 'options' => ['style' => ' width:120px; text-align: center;'],
                'header' => 'จัดการ',
                'template' => ' {Order} ',
                'buttons' => [
                    'Order' => function($url, $model, $baseUrl) {
                        return Html::a('ดู Order เพิ่มเติม', Yii::$app->homeUrl . "profile/purchase-order/" . $model->encodeParams(['orderId' => $model->orderId]), [
                                    'title' => Yii::t('app', ' View Order No :' . $model->orderId),]);
                    },
                        ]
                    ],
                ], 'layout' => "{pager}\n{items}\n",
            ]);
            ?>
</div>

