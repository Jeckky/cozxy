<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\User;
use common\models\costfit\ProductGroup;
use common\models\costfit\Brand;
use common\models\costfit\Category;
use yii\redactor\widgets\Redactor;

//use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductSuppliers */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .dropzone {
        position: relative;
        min-height: 284px;
        border: 3px dashed #ddd;
        border-radius: 3px;
        vertical-align: middle;
        width: 100%;
        cursor: pointer;
        padding: 0 15px 15px 0;
        -webkit-transition: all .2s;
        transition: all .2s;
    }
</style>
<div class="product-suppliers-form">
    <!-- Light info -->
    <div class="panel panel-info" style="margin-bottom: 0px;">
    </div> <!-- / .panel -->
    <?php
    $form = ActiveForm::begin([
        //'action' => '#',
        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-3 control-label  '
            ]
        ]
    ]);
    ?>

    <div class="panel-heading">
        <span class="panel-title">ค้นหาจาก Products System หรือ New <?= $title ?></span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>

        <div class="form-group col-sm-12 text-center">
            <duv class="status-system-hidden"></duv>
        </div>
        <?//= $form->field($model, 'productGroupId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ProductGroup::find()->all(), 'productGroupId', 'title'), ['prompt' => '-- Select ProductGroup --']) ?>
        <?php
        echo $form->field($model, 'productGroupId')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\ProductGroup::find()->all(), 'productGroupId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Product group --',
            //'params' => ['input-type-1', 'input-type-2']
            ],
            'options' => [
                'placeholder' => 'SelectSelect Product group ...',
                'id' => 'productGroupId',
                'class' => 'required'
            ],
        ]); //->label('Category');
        ?>
        <?php
        //echo Html::hiddenInput('input-type-1', $model->categoryId, ['id' => 'input-type-1']);
        //echo Html::hiddenInput('input-type-2', $model->categoryId, ['id' => 'input-type-2']);
        echo $form->field($model, 'categoryId')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Category System --',
            //'params' => ['input-type-1', 'input-type-2']
            ],
            'options' => [
                'placeholder' => 'Select Category System ...',
                'id' => 'categoryId',
                'class' => 'required'
            ],
        ]); //->label('Category');
        echo $form->field($model, 'brandId')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Brand::find()->all(), 'brandId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Brand --',
            ],
            'options' => [
                'placeholder' => 'Select Brand ...',
                'id' => 'brandId',
                'class' => 'required'
            ],
        ]); //->label('Brand');
        ?>
        <?//= $form->field($model, 'categoryId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Category::find()->all(), 'categoryId', 'title'), ['prompt' => '-- Select Category --']) ?>

        <?= $form->field($model, 'isbn', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?//= $form->field($model, 'code', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'optionName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?php
        echo $form->field($model, 'shortDescription')->widget(mihaildev\ckeditor\CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                'contentsLangDirection' => 'th',
                'height' => 400,
                //'filebrowserBrowseUrl' => Yii::$app->homeUrl . 'productpost/product-post/browse-images/',
                //'filebrowserUploadUrl' => Yii::$app->homeUrl . 'productpost/product-post/upload-images/',
                //'extraPlugins' => ['imageuploader', 'image2'],
                'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
            ],
        ]);
        ?>
        <?php
        echo $form->field($model, 'description')->widget(mihaildev\ckeditor\CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                'contentsLangDirection' => 'th',
                'height' => 400,
                //'filebrowserBrowseUrl' => Yii::$app->homeUrl . 'productpost/product-post/browse-images/',
                //'filebrowserUploadUrl' => Yii::$app->homeUrl . 'productpost/product-post/upload-images/',
                //'extraPlugins' => ['imageuploader', 'image2'],
                'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
            ],
        ]);
        ?>
        <?php
        echo $form->field($model, 'specification')->widget(mihaildev\ckeditor\CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                'contentsLangDirection' => 'th',
                'height' => 400,
                //'filebrowserBrowseUrl' => Yii::$app->homeUrl . 'productpost/product-post/browse-images/',
                //'filebrowserUploadUrl' => Yii::$app->homeUrl . 'productpost/product-post/upload-images/',
                //'extraPlugins' => ['imageuploader', 'image2'],
                'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
            ],
        ]);
        ?>

        <?= $form->field($model, 'width', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'height', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'depth', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'weight', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?//= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'quantity', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?php
        echo $form->field($model, 'unit')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Unit::find()->all(), 'unitId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Unit --',
            ],
            'options' => [
                'placeholder' => 'Select Unit ...',
                'id' => 'unitId',
                'class' => 'required'
            ],
        ]); //->label('Unit');
        ?>
        <?= $form->field($model, 'tags', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 255]) ?>

        <br>
        <div class="form-group col-sm-12 text-center">
            <duv class="product-system-hidden">
                <input type="hidden" name="productIds" id="productIds" value="">
                <input type="hidden" name="approve" id="approve" value="new">
            </duv>
        </div>
        <div class="form-group col-sm-12 text-right">
            <?= Html::submitButton($model->isNewRecord ? 'Next step' : 'Duplicate', [ 'class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php $this->registerJs("
          /* init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#productsuppliers-shortdescription').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
                $('#productsuppliers-description').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
                $('#productsuppliers-specification').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            }

        });*/

", \yii\web\View::POS_END); ?>

</div>
