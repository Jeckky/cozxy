<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use yii\redactor\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

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

        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

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

        <?= (isset($model->image) && !empty($model->image)) ? Html::img(Yii::$app->homeUrl . $model->image, ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : ''; ?>

        <?= $form->field($model, 'image', ['options' => ['class' => 'row form-group']])->fileInput() ?>

        <?= (isset($model->image) && !empty($model->image)) ? Html::hiddenInput((new ReflectionClass($model))->getShortName() . '[imageOld]', $model->image) : ''; ?>

        <?= $form->field($model, 'status')->checkbox(['checked'])->label("Show") ?>

        <?//= $form->field($model, 'parentId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'), ['prompt' => '-- Select Parent --']) ?>
        <?php
        echo $form->field($model, 'parentId')->widget(kartik\select2\Select2::classname(), [
            'data' => common\models\costfit\Category::findCategoryArrayWithMultiLevelBackend(),
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
        ?>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php $this->registerJs("


", \yii\web\View::POS_END); ?>

</div>
