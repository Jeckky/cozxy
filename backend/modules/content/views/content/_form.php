<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\ContentGroup;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

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
        <span class="panel-title"><?= $title ?><?php
            if (isset($contentGroup)) {
                echo " : " . $contentGroup;
            } else {
                echo "";
            }
            ?></span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>

        <?//= $form->field($model, 'headTitle', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?//= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?//= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>
        <?//= $form->field($model, 'headTitle', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>
        <?//= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>
        <?//= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>
        <?php
        echo $form->field($model, 'headTitle')->widget(mihaildev\ckeditor\CKEditor::className(), [
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
        echo $form->field($model, 'title')->widget(mihaildev\ckeditor\CKEditor::className(), [
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
        <?=
        $form->field($model, 'startDate')->textInput()->widget(\yii\jui\DatePicker::classname(), ['options' => ['class' => 'form-control'],
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',]);
        ?>
        <?=
        $form->field($model, 'endDate')->textInput()->widget(\yii\jui\DatePicker::classname(), ['options' => ['class' => 'form-control'],
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',]);
        ?>
        <?= (isset($model->image) && !empty($model->image)) ? Html::img($model->image, ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : ''; ?>

        <?= $form->field($model, 'image', ['options' => ['class' => 'row form-group']])->fileInput() ?>

        <?= $form->field($model, 'linkTitle', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'link', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= (isset($model->image) && !empty($model->image)) ? Html::hiddenInput((new ReflectionClass($model))->getShortName() . '[imageOld]', $model->image) : ''; ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs("

", \yii\web\View::POS_END); ?>