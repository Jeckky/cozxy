<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\Product;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-price-form">

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

        <?= $form->field($model, 'productId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Product::find()->all(), 'productId', 'title'), ['prompt' => '-- Select Product --']) ?>

        <?= $form->field($model, 'quantity', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 5]) ?>
        <?php $price = Product::createSupplierProductPrice($model->productId) ?>
        <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15, 'value' => $price != NULL ? $price : '']) ?>

        <?= $form->field($model, 'discountType', ['options' => ['class' => 'row form-group']])->dropDownList($model->getDiscountTypeArray(), ['prompt' => '-- Select Discount Type --']) ?>

        <?= $form->field($model, 'discountValue', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?php
        echo $form->field($model, 'description')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                'contentsLangDirection' => 'th',
                'height' => 400,
                //'filebrowserBrowseUrl' => 'browse-images',
                //'filebrowserUploadUrl' => 'upload-images',
                //'extraPlugins' => ['imageuploader', 'image2'],
                'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
            ],
        ]);
        ?>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>

</div>
