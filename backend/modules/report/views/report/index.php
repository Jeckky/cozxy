<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
//use kartik\widgets\DatePicker;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

//$this->title = 'รายงานยอดขาย';
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><h4>รายงานยอดขาย</h4></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right"><b><h4>ยอดรวม : <?= number_format(common\models\costfit\Order::calculateTotal($model), 2); ?> บาท</h4></b>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php
                $form = ActiveForm::begin([
                            'method' => 'GET',
                            'action' => ['report/index'],
                ]);
                ?>
                <div class="col-lg-3">
                    <?php
                    echo DatePicker::widget(['name' => 'fromDate',
                        'dateFormat' => 'yyyy-MM-dd',
                        'value' => isset($_GET['fromDate']) ? $_GET['fromDate'] : NULL,
                        'options' => ['placeholder' => 'From Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'language' => 'en',
                        ]
                    ])
                    ?>

                </div>
                <div class="col-lg-3">
                    <?=
                    DatePicker::widget(['name' => 'toDate',
                        'dateFormat' => 'yyyy-MM-dd',
                        'value' => isset($_GET['toDate']) ? $_GET['toDate'] : NULL,
                        'options' => ['placeholder' => 'To Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'language' => 'en',
                        ]
                    ])
                    ?>
                </div>
                <div class="col-lg-2">
                    <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true">  ค้นหา</i>', ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <br>
            <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs',
                    ]
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                        ['class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['style' => 'text-align:center'],
                    ],
                        ['attribute' => 'orderNo',
                        'contentOptions' => ['style' => 'text-align:center'],
                        'value' => function($model) {
                            return $model->orderNo;
                        }
                    ],
                        ['attribute' => 'invoiceNo',
                        'contentOptions' => ['style' => 'text-align:center'],
                        'value' => function($model) {
                            return $model->invoiceNo;
                        }
                    ],
                        [
                        'attribute' => 'paymentDateTime',
                        'contentOptions' => ['style' => 'text-align:center'],
                        'value' => function($model) {
                            return (isset($model->paymentDateTime) && !empty($model->paymentDateTime)) ? $this->context->dateThai($model->paymentDateTime, 2) : NULL;
                        }
                    ],
                    // 'createDateTime',
                    ['attribute' => 'summary',
                        'contentOptions' => ['style' => 'text-align:right'],
                        'value' => function($model) {
                            return number_format($model->summary, 2);
                        }
                    ],
                        ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Detail',
                        'contentOptions' => ['style' => 'text-align:center'],
                        'template' => '{view}{history}',
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a('<i class="fa fa-eye" aria-hidden="true"> รายละเอียด</i>', Yii::$app->homeUrl . "order/order/view/" . $model->encodeParams(['id' => $model->orderId]), [
                                            'class' => 'btn btn-success btn-sm']);
                            },]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>