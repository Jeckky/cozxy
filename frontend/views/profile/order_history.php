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
    <h3>รายการใบสั่งซื้อสินค้าทั้งหมด</h3>

    <?php
    echo GridView::widget([//   table-striped table-bordered  //
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-light  table-hover',
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
                    return $this->context->dateThai($model->createDateTime, 1);
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
                        if ($model->paymentType == 1) { // ชำระเงินแล้ว
                            return Html::a('ดูเพิ่มเติม', Yii::$app->homeUrl . "profile/purchase-order/" . $model->encodeParams(['orderId' => $model->orderId]), ['class' => 'btn btn-primary btn-xs'], [
                                        'title' => Yii::t('app', ' '),]);
                        } else {
                            return Html::a('<i class="fa fa-print" aria-hidden="true"></i> ดูเพิ่มเติม', Yii::$app->homeUrl . "payment/print-receipt/" . $model->encodeParams(['orderId' => $model->orderId]) . '/' . $model->orderNo, ['class' => 'btn btn-black   btn-xs'], [
                                        'title' => Yii::t('app', ' ')]);
                        }
                    },
                        ]
                    ],
                ], 'layout' => "{pager}\n{items}\n",
            ]);
            ?>
</div>

