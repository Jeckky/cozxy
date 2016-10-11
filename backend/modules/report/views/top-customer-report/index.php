<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'ลูกค้าดีเด่น';
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
                ]);
                ?>
                <div class="col-lg-3">
                    <?=
                    DatePicker::widget(['name' => 'fromDate',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['placeholder' => 'From Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'language' => 'en',
                        ],
                        'value' => isset($_GET['fromDate']) ? $_GET['fromDate'] : NULL
                    ])
                    ?>
                </div>
                <div class="col-lg-3">
                    <?=
                    DatePicker::widget(['name' => 'toDate',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['placeholder' => 'To Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'language' => 'en',
                        ],
                        'value' => isset($_GET['toDate']) ? $_GET['toDate'] : NULL
                    ])
                    ?>
                </div>
                <div class="col-lg-2">
                    <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true">  ค้นหา</i>', ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <br>
            <table class="table table-list-order" style="width: 70%">
                <thead>
                    <tr style="background-color: #ccffcc;text-align: center;font-weight: bold;vertical-align: central;">
                        <td>ลำดับ</td>
                        <td>ลูกค้า</td>
                        <td>ยอดซื้อสะสม</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $total = 0;
                    foreach ($model as $index => $pView):
                        ?>
                        <tr style="text-align: center;">
                            <td><span class="<?= ($index == 0) ? "label label-danger" : (($index == 1) ? "label label-success" : (($index == 2) ? "label label-info" : "")) ?>"><?= $i ?></span></td>
                            <td style="text-align: left"><?= isset($pView->user) ? $pView->user->firstname . " " . $pView->user->lastname . "<br>email : " . $pView->user->email : "" ?></td>
                            <td style="text-align: right"><?= number_format($pView->sumSummary, 2) ?></td>
                        </tr>
                        <?php
//                        $total+=$order->summary;
                        $i++;
                    endforeach;
                    ?>
<!--                    <tr>
<td colspan="4" style="text-align: right;"><b>TOTAL </b></td>
<td style="text-align: right;"><b><?//= number_format($total, 2) ?></b></td>
<td></td>
</tr>-->
                </tbody>
            </table>
        </div>
    </div>
</div>