<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'รายงานวันเกิดลูกค้า';
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

                $month = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"]
                ?>
                <div class="col-lg-3">
                    <?=
                    Html::dropDownList('fromDate', isset($_GET['fromDate']) ? $_GET['fromDate'] : $thisMonth - 1, $month, ['class' => 'form-control',
                        'value' => isset($_GET['fromDate']) ? $_GET['fromDate'] : $thisMonth - 1,
                        'style' => 'border-color: #66CCFF;height: 40px;',
                    ])
                    ?>
                </div>
                <div class="col-lg-3">
                    <?=
                    Html::dropDownList('toDate', isset($_GET['toDate']) ? $_GET['toDate'] : $thisMonth - 1, $month, ['class' => 'form-control',
                        'value' => isset($_GET['toDate']) ? $_GET['toDate'] : $thisMonth - 1,
                        'style' => 'border-color: #66CCFF;height: 40px;',
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
                    <tr style="background-color: #ccffcc;text-align: center;font-weight: bold;">
                        <td>ลำดับ</td>
                        <td>ชื่อ - นามสกุล</td>
                        <td>วันเกิด (วัน / เดือน /ปี)</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $total = 0;
                    foreach ($model as $user):
                        ?>
                        <tr style="text-align: center;">
                            <td><?= $i ?></td>
                            <td style="text-align: left"><?= $user->firstname . " " . $user->lastname ?></td>
                            <td><?= isset($user->birthDate) ? $this->context->dateThai($user->birthDate, 1) : "-" ?></td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>