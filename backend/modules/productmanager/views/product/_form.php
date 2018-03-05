<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditor as CKEditor2;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\Product */
/* @var $form yii\widgets\ActiveForm */
$disabled = (Yii::$app->controller->action->id == 'update' && $model->parentId !== null) ? true : false;
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
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

    <?php /*
    <?= $form->field($model, 'userId')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'parentId')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'suppCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'merchantCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'optionName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smallUnit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'createDateTime')->textInput() ?>

    <?= $form->field($model, 'updateDateTime')->textInput() ?>

    <?= $form->field($model, 'approve')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'productSuppId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approveCreateBy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approvecreateDateTime')->textInput() ?>

    <?= $form->field($model, 'receiveType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step')->textInput() ?>

    <?= $form->field($model, 'width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'depth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
    */ ?>
    <?= $form->field($model, 'productGroupTemplateId')->dropDownList($productGroupTemplateFilter, ['disabled' => $disabled]) ?>

    <?= $form->field($model, 'brandId')->dropDownList($brandFilter, ['disabled' => $disabled]) ?>

    <?= $form->field($model, 'categoryId')->dropDownList($categoryFilter, ['disabled' => $disabled]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shortDescription')->textarea(['rows' => 6]) ?>


    <?php
    echo $form->field($model, 'description')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
            //
            //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
            'contentsLangDirection' => 'th',
            'height' => 400,
            //            'filebrowserBrowseUrl' => 'browse-images',
            'filebrowserUploadUrl' => Yii::$app->homeUrl . 'productmanager/product/upload-description-image',
            //'extraPlugins' => ['imageuploader', 'image2'],
            'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
        ]
    ]);
    ?>
    <?php
    echo $form->field($model, 'specification')->widget(CKEditor2::className(), [
        'options' => [
            'rows' => 6,
        ],
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserUploadUrl' => Yii::$app->homeUrl . 'productmanager/product/upload-description-image',
        ]
    ]);
    ?>

    <?php
    /**
     * Product Price Currency
     */
    ?>
    <?= $form->field($productPriceCurrencyModel, 'currencyId')->dropDownList($currencyModel->currencyCodeArray)?>
    <?= $form->field($productPriceCurrencyModel, 'price')->textInput() ?>

    <?php if($model->parentId !== NULL): ?>
        <?= $form->field($model, 'isbn')->textInput() ?>
    <?php endif; ?>

    <div class="form-group">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-block btn-lg' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
