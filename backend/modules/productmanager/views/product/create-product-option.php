<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Product Options</div>
                <div class="panel-body">
                    <div class="alert alert-info">
                        ระบุได้หลาย Option ที่มี เช่นสี เป็น Red,Green,Yellow
                    </div>
                    <?php $form = ActiveForm::begin([
                        'id' => 'options-form',
                        'options' => [
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data'
                        ],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-9">{input}</div>',
                            'labelOptions' => [
                                'class' => 'col-sm-3 control-label'
                            ]
                        ]
                    ]); ?>


                    <?php foreach($productGroupTemplate->productGroupTemplateOptions as $option): ?>
                        <label for=""><?= $option->title; ?></label>
                        <?php
                        // Multiple select without model
                        echo Select2::widget([
                            'name' => "ProductGroupOptionValue[$option->productGroupTemplateOptionId]",
                            'id' => 'ProductGroupOptionValue' . $option->productGroupTemplateOptionId,
                            'value' => isset($data[$option->productGroupTemplateOptionId]) ? $data[$option->productGroupTemplateOptionId] : [], // initial value
                            'data' => isset($data[$option->productGroupTemplateOptionId]) ? $data[$option->productGroupTemplateOptionId] : [], // initial value
                            'options' => [
                                'placeholder' => 'Options',
                                'multiple' => true,
                            ],
                            'pluginOptions' => [
                                'tags' => true,
                                'maximumInputLength' => 200,
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                        <hr>
                    <?php endforeach; ?>
                    <input type="submit" name="previewOptions" value="Preview Options" class="btn btn-primary btn-block">
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-info">
                <div class="panel-heading">Product Combinations</div>
                <div class="panel-body">
                    <div class="row" id="product-row">
                        <div class="col-md-12">
                            <?php if(!isset($productWithOptions) && !$productWithOptions !== []): ?>
                                ไม่มีรายการ
                            <?php else: ?>

                                <?php $form = ActiveForm::begin([
                                    'id' => 'options-form',
                                    'options' => [
                                        'class' => 'form-horizontal',
                                        'enctype' => 'multipart/form-data'
                                    ],
                                    'fieldConfig' => [
                                        'template' => '{label}<div class="col-sm-9">{input}</div>',
                                        'labelOptions' => [
                                            'class' => 'col-sm-3 control-label'
                                        ]
                                    ]
                                ]); ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <?php foreach($productGroupTemplate->productGroupTemplateOptions as $option): ?>
                                            <th><?= $option->title ?></th>
                                        <?php endforeach; ?>
                                        <th>Actions</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach($productWithOptions as $productWithOption): ?>
                                        <tr>
                                            <td class="text-center">Product Master <?= $i ?></td>
                                            <?php foreach($productWithOption as $key => $value): ?>
                                                <td><?= $value ?></td>
                                                <input type="hidden" name="ProductGroupOptionValue[<?= $i ?>][<?= $key ?>]" value="<?= $value ?>">
                                            <?php endforeach; ?>
                                            <td>
                                                <button class="btn btn-danger btn-xs deleteBtn" data-row="<?= $i ?>">X</button>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>

                                    <?php endforeach; ?>
                                </table>
                                <input type="submit" class="btn btn-primary btn-block" name="productOptions" value="Create Product Options">
                                <?php ActiveForm::end(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$this->registerJs("
$('.deleteBtn').click(function(){
    if(confirm('Delete Product Master #'+$(this).attr('data-row'))) {
        $(this).parent().parent().remove();
    }
});
");
?>
