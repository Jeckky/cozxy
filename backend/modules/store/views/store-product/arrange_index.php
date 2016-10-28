<?php

use yii\helpers\Html;

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
<input type="hidden" name="storeProductGroupId" value="<?= $storeProductGroupId ?>">
<input type="hidden" name="StoreProductGroup2[poNo]" value="<?= \common\models\costfit\StoreProductGroup::findPoNo($storeProductGroupId) ?>">
<div class="panel-heading" style="background-color: #ccffcc;">
    <span class="panel-title"><h3>สแกนสินค้าเพื่อจัดเรียง</h3></span>
</div>
<div class="panel-body">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th style="vertical-align: middle;text-align: center;"><h4><b>Scan Barcode สินค้า : </b></h4></th>
                <td><?= \yii\helpers\Html::textInput('StoreProduct[isbn]', NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php yii\bootstrap\ActiveForm::end(); ?>
<div class="panel-heading" style="background-color: #ffffcc;">
    <div class="pull-right" style="margin-top: 10px;"><?=
        Html::a('<i class="fa fa-hand-lizard-o" aria-hidden="true"></i> เลือก PO อื่น', ['arrange'], ['class' => 'btn btn-md btn-primary'])
        ?></div>
    <span class="panel-title"><h3>รายการ สินค้าใน PO : <?= \common\models\costfit\StoreProductGroup::findPoNo($storeProductGroupId) ?></h3></span>
</div>
<div class="panel-body">
    <table class="table table-bordered">

        <tr style="height: 50px;background-color: #FFFFE0;">
            <th style="vertical-align: middle;text-align: center;width: 5%;">ลำดับที่</th>
            <th style="vertical-align: middle;text-align: center;width: 35%;">สินค้า</th>
            <th style="vertical-align: middle;text-align: center;width: 20%;">Bar code</th>
            <th style="vertical-align: middle;text-align: center;width: 20%;">จำนวน</th>
            <th style="vertical-align: middle;text-align: center;width: 20%;">สถานะ</th>
        </tr>
        <?php
        if (isset($storeProducts) && !empty($storeProducts)) {
            $i = 1;
            foreach ($storeProducts as $storeProduct):
                ?>
                <tr>
                    <td style="vertical-align: middle;text-align: center;width: 5%;"><?= $i ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 35%;"><?= \common\models\costfit\Product::findProductName($storeProduct->productId) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?= \common\models\costfit\Product::findProductIsbn($storeProduct->productId) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?= $storeProduct->importQuantity ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?= $model->getStatusText($storeProduct->status) ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
        }else {
            ?>
            <tr>
                <th style="vertical-align: middle;text-align: center;width: 5%;background-color:#cccccc;" colspan="4"><i><h4>ไม่รายการ PO ที่ยังไม่จัดเก็บ</h4></i></th>
            </tr>
        <?php } ?>
    </table>
</div>