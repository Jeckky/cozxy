<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\StoreProductGroup;
use common\models\costfit\Store;
use common\models\costfit\Product;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\StoreProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-product-form">

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

        <?= $form->field($model, 'storeProductGroupId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(StoreProductGroup::find()->all(), 'storeProductGroupId', 'poNo'), ['prompt' => '-- Select StoreProductGroup --']) ?>

        <?= $form->field($model, 'storeId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Store::find()->all(), 'storeId', 'title'), ['prompt' => '-- Select Store --']) ?>

        <?=
        $form->field($model, 'productId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Product::find()->all(), 'productId', 'title', function($model) {
            return isset($model->productGroup) ? $model->productGroup->title : "--No Group--";
        }), ['prompt' => '-- Select Product --'])
        ?>

        <?php
//        echo $form->field($model, 'productId')->widget(kartik\select2\Select2::classname(), [
//            'data' => ArrayHelper::map(Product::find()->all(), 'productId', 'title'),
//            'language' => 'en',
//            'options' => ['placeholder' => 'Select Product ...', 'theme' => kartik\select2\Select2::THEME_KRAJEE],
//            'pluginOptions' => [
//                'allowClear' => true
//            ],
//        ]);
        ?>
        <?php
//        echo $form->field($model, 'productId')->widget(kartik\select2\Select2::classname(), [
////            'options' => ['id' => 'address-countryid'],
//            'data' => ArrayHelper::map(Product::find()->all(), 'productId', 'title'),
//            'pluginOptions' => [
//                'placeholder' => 'Select...',
//                'loadingText' => 'Loading Product ...',
//            //'initialize' => true,
//            ],
//            'options' => [
//                'placeholder' => 'Select Product ...',
//            ],
//        ]);
        ?>

        <?= $form->field($model, 'paletNo', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'quantity', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'shippingFromType', ['options' => ['class' => 'row form-group']])->dropDownList($model->findAllShippingFromTypeArray(), ['prompt' => '-- Shipping From Type --']) ?>

        <?//= $form->field($model, 'total', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
