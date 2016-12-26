<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$form = yii\bootstrap\ActiveForm::begin([
            'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-9">{input}</div>',
                'labelOptions' => [
                    'class' => 'col-sm-3 control-label'
                ]
            ]
        ]);
?>

<div class="panel-heading" style="background-color: #ccffcc;">
    <span class="panel-title"><h3>สแกนรายการ PO ที่ต้องการนำไปจัดเรียง</h3></span>
</div>
<div class="panel-body">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th style="vertical-align: middle;text-align: center;"><h4><b>Scan PO Barcode : </b></h4></th>
                <td><?= \yii\helpers\Html::textInput('StoreProductGroup[poNo]', NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?></td>
            </tr>
        </tbody>
    </table>
    <br><h4>:: สแกน Qr Code ของใบ Po เพื่อนำสินค้าไปจัดเรียง ::</h4>
</div>
<?php yii\bootstrap\ActiveForm::end(); ?>
<?php
if (isset($chooseId) && !empty($chooseId)) {
    //throw new \yii\base\Exception(print_r($chooseId, true));
    $i = 1;
    ?>
    <div class="panel-heading" style="background-color: #ccffff;">
        <span class="panel-title"><h4>รายการ PO ที่ต้องการนำไปจัดเรียง</h4></span>
    </div>
    <div class="panel-body">

        <table class="table table-bordered">

            <tr style="height: 50px;background-color: #F0FFFF;">
                <th style="vertical-align: middle;text-align: center;width: 5%;">ลำดับที่</th>
                <th style="vertical-align: middle;text-align: center;width: 30%;">PO NO.</th>
                <th style="vertical-align: middle;text-align: center;width: 15%;">จำนวนรายการ</th>
                <th style="vertical-align: middle;text-align: center;width: 15%;">สถานะ</th>
                <th style="vertical-align: middle;text-align: center;width: 15%;">ผู้จัดเรียง</th>
                <th style="vertical-align: middle;text-align: center;width: 15%;">ผู้ตรวจรับ</th>
                <th style="vertical-align: middle;text-align: center;width: 5%;">ลบ</th>
            </tr>
            <?php foreach ($chooseId as $id): ?>
                <tr style="height: 35px;">
                    <td style="vertical-align: middle;text-align: center;width: 5%;"><?= $i ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 30%;"><?= $id->poNo ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 15%;"><?= \common\models\costfit\StoreProductGroup::countProducts($id->storeProductGroupId) ?> รายการ</td>
                    <td style="vertical-align: middle;text-align: center;width: 15%;"><?= \common\models\costfit\StoreProductGroup::getStatusText($id->status) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 15%;"><?= isset($id->arranger) ? \common\models\costfit\User::userName($id->arranger) : '' ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 15%;"><?= isset($id->receiveBy) ? common\models\costfit\User::userName($id->receiveBy) : '' ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 5%;"><?=
                        Html::a('<i class="fa fa-times" aria-hidden="true"></i>', ['delete-choose-po',
                            'id' => $id->storeProductGroupId
                                ], ['class' => 'btn btn-xs btn-danger'])
                        ?></td>
                </tr>
            <?php endforeach;
            ?>
        </table>
        <?php
        if (isset($chooseId) && !empty($chooseId)) {
            echo '<div class="pull-right">' . Html::a('<i class="fa fa-check-square-o" aria-hidden="true"></i> นำไปจัดเรียง', ['arrange'], ['class' => 'btn btn-lg btn-success']) . '</div>';
        }
        $i++;
    }
    ?>
</div>