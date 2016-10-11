<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'รายงานยอดขาย';
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><h4><?= $this->title ?></h4></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
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
                    <?=
                    DatePicker::widget(['name' => 'fromDate',
                        'options' => ['placeholder' => 'From Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'dateFormat' => 'yyyy-MM-dd',
                            'language' => 'en',
                        ]
                    ])
                    ?>
                </div>
                <div class="col-lg-3">
                    <?=
                    DatePicker::widget(['name' => 'toDate',
                        'options' => ['placeholder' => 'To Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'dateFormat' => 'yyyy-MM-dd',
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
            <table class="table table-list-order">
                <thead>
                    <tr style="background-color: #ccffcc;text-align: center;font-weight: bold;vertical-align: central;">
                        <td>No.</td>
                        <td>Order No.</td>
                        <td>Invoice No.</td>
                        <td>Payment DateTime</td>
                        <td>Summary (Baht/TH)</td>
                        <td>Detail</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $total = 0;
                    foreach ($model as $order):
                        ?>
                        <tr style="text-align: center;">
                            <td><?= $i ?></td>
                            <td><?= $order->orderNo ?></td>
                            <td><?= $order->invoiceNo ?></td>
                            <td><?= $order->paymentDateTime ?></td>
                            <td style="text-align: right;"><?= $order->summary ?></td>
                            <td> <?= Html::a('<i class="fa fa-eye" aria-hidden="true"> รายละเอียด</i>', $baseUrl . '/view', ['class' => 'btn btn-success btn-sm']) ?></td>
                        </tr>
                        <?php
                        $total+=$order->summary;
                        $i++;
                    endforeach;
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: right;"><b>TOTAL </b></td>
                        <td style="text-align: right;"><b><?= number_format($total, 2) ?></b></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>