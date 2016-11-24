<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\ProductSuppliers;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPriceSuppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-price-suppliers-form">

    <?php
    $form = ActiveForm::begin([
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
        <span class="panel-title"><?= $title ?></span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>

        <?//= $form->field($model, 'productSuppId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ProductSuppliers::find()->all(), 'productSuppId', 'title'), ['prompt' => '-- Select Product --']) ?>
        <?php
        /*
          echo $form->field($model, 'productSuppId')->widget(kartik\select2\Select2::classname(), [
          'data' => yii\helpers\ArrayHelper::map(common\models\costfit\ProductSuppliers::find()->all(), 'productSuppId', 'title'),
          'pluginOptions' => [
          'loadingText' => '-- Select Product Suppliers --',
          ],
          'options' => [
          'placeholder' => 'Select Product Suppliers ...',
          'id' => 'unitId',
          'class' => 'required'
          ],
          ])->label('Product Suppliers'); */
        echo $form->field($model, 'productSuppId')->hiddenInput(['value' => $_GET['id']])->label(false);
        ?>
        <?= $form->field($model, 'quantity', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 5]) ?>

        <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'discountType', ['options' => ['class' => 'row form-group']])->dropDownList($model->getDiscountTypeArray(), ['prompt' => '-- Select Discount Type --']) ?>

        <?= $form->field($model, 'discountValue', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs("
           init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#productpricesuppliers-description').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            }
        });

", \yii\web\View::POS_END); ?>