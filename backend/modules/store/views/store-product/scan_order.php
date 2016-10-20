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
    <span class="panel-title"><h3>จัดเก็บสินค้า</h3></span>
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
    <span class="panel-title"><h3>รายการ PO ที่ยังไม่จัดเก็บ</h3></span>
</div>
<div class="panel-body">
    <table class="table table-bordered">

        <tr style="height: 50px;background-color: #F0FFFF;">
            <th style="vertical-align: middle;text-align: center;width: 5%;">ลำดับที่</th>
            <th style="vertical-align: middle;text-align: center;width: 35%;">PO NO.</th>
            <th style="vertical-align: middle;text-align: center;width: 20%;">จำนวนรายการ</th>
            <th style="vertical-align: middle;text-align: center;width: 20%;">สถานะ</th>
            <th style="vertical-align: middle;text-align: center;width: 20%;">ผู้ตรวจรับ</th>
        </tr>
        <?php
        if (isset($allPo) && !empty($allPo)) {
            $i = 1;
            foreach ($allPo as $po):
                ?>
                <tr>
                    <td style="vertical-align: middle;text-align: center;width: 5%;"><?= $i ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 35%;"><?= $po->poNo ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?= \common\models\costfit\StoreProductGroup::countProducts($po->storeProductGroupId) ?> รายการ</td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?= \common\models\costfit\StoreProductGroup::getStatusText($po->status) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?= 'สุรศักดิ์ นาคงาม' ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
        }else {
            ?>
            <tr>
                <th style="vertical-align: middle;text-align: center;width: 5%;background-color:#cccccc;" colspan="5"><i><h4>ไม่รายการ PO ที่ยังไม่จัดเก็บ</h4></i></th>
            </tr>
        <?php } ?>
    </table>
</div>