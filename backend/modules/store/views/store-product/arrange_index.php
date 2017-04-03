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
<input type="hidden" name="storeProductGroupId" value="<?= $chooseStoreProductGroup ?>">
<!--<input type="hidden" name="StoreProductGroup2[poNo]" value="<?//= \common\models\costfit\StoreProductGroup::findPoNo($storeProductGroupId) ?>">-->
<?php
//throw new \yii\base\Exception(print_r($allProducts, true));
foreach ($allProducts as $product):
    ?>
    <input type="hidden" name="allProduct[]" value="<?= $product ?>">
<?php endforeach;
?>
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
    <span class="panel-title"><h3>รายการ สินค้าทั้งหมด</h3></span>
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
        if (isset($allProducts) && !empty($allProducts)) {
            $i = 1;
            foreach ($allProducts as $product):
                $suppProduct = \common\models\costfit\ProductSuppliers::productSupplierName($product);
                ?>
                <tr>
                    <td style="vertical-align: middle;text-align: center;width: 5%;"><?= $i ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 35%;"><?= $suppProduct->title ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?= $suppProduct->isbn ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?= \common\models\costfit\StoreProduct::quantity($product, $chooseStoreProductGroup) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?= \common\models\costfit\StoreProduct::createStatus($product, $chooseStoreProductGroup) ?></td>
                </tr>
        <!--                <tr>
                    <td style="vertical-align: middle;text-align: center;width: 5%;"><?//= $i ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 35%;"><?//= \common\models\costfit\Product::findProductName($product) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?//= \common\models\costfit\Product::findProductIsbn($product) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?//= \common\models\costfit\StoreProduct::quantity($product, $chooseStoreProductGroup) ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 20%;"><?//= \common\models\costfit\StoreProduct::createStatus($product, $chooseStoreProductGroup) ?></td>
                </tr>-->
                <?php
                $i++;
            endforeach;
        }else {
            ?>
            <tr>
                <th style="vertical-align: middle;text-align: center;width: 5%;background-color:#cccccc;" colspan="4"><i><h4>ไม่มีรายการ PO ที่ยังไม่จัดเรียง</h4></i></th>
            </tr>
        <?php } ?>
    </table>
</div>