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

        <?= $form->field($model, 'headTitle', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

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
        <?= (isset($model->image) && !empty($model->image)) ? Html::img(Yii::$app->homeUrl . $model->image, ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : ''; ?>

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
