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

<div class="panel-heading">
    <span class="panel-title">ค้นหาสินค้าเพื่อจัดเรียง</span>
</div>

<div class="panel-body">
    <?//= \yii\helpers\Html::textInput("StoreProduct[isbn]", NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']) ?>
    <?//= \yii\helpers\Html::submitButton("ค้นหา", ['class' => 'btn btn-success btn-lg']) ?>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Barcode : </th>
                <td><?= \yii\helpers\Html::textInput('StoreProduct[isbn]', NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']); ?><?= isset($ms) ? ' <code> ' . $ms . '</code>' : '' ?></td>
            </tr>
<!--            <tr>
                <th>Quantity : </th>
                <td><?= \yii\helpers\Html::textInput('quantity', NULL, ['class' => 'input-lg']); ?></td>
            </tr>
            <tr>
                <th>Slot : </th>
                <td><?= \yii\helpers\Html::textInput('slot', NULL, ['class' => 'input-lg']); ?></td>
            </tr>-->
            <tr>
                <td colspan="2" class="text-center"><?= \yii\helpers\Html::submitButton("จัดเรียง", ['class' => 'btn btn-success btn-lg']) ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php yii\bootstrap\ActiveForm::end(); ?>
