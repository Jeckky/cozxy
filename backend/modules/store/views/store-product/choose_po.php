<?php
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
    <span class="panel-title"><h3>เลือกรายการ PO ที่ต้องการนำไปจัดเรียง</h3></span>
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
</div>
<?php yii\bootstrap\ActiveForm::end(); ?>
<div class="panel-heading" style="background-color: #ccffff;">
    <span class="panel-title"><h3>รายการ PO ที่ต้องการนำไปจัดเรียง</h3></span>
</div>
<div class="panel-body">
    <table class="table table-bordered">

        <tr style="height: 50px;background-color: #F0FFFF;">
            <th style="vertical-align: middle;text-align: center;width: 5%;">ลำดับที่</th>
            <th style="vertical-align: middle;text-align: center;width: 30%;">PO NO.</th>
            <th style="vertical-align: middle;text-align: center;width: 15%;">จำนวนรายการ</th>
            <th style="vertical-align: middle;text-align: center;width: 20%;">สถานะ</th>
            <th style="vertical-align: middle;text-align: center;width: 15%;">ผู้จัดเรียง</th>
            <th style="vertical-align: middle;text-align: center;width: 15%;">ผู้ตรวจรับ</th>
        </tr>

    </table>
</div>