<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\dbworld;
use yii\jui\DatePicker;
use common\models\dbworld\countries;

/* @var $this yii\web\View */
/* @var $model common\models\dbworld\Countries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="countries-form">

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

        <?//= $form->field($model, 'countryId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(countries::find()->all(), 'countryId', 'countryName'), ['prompt' => '-- Select Country --']) ?>

        <?= $form->field($model, 'countryId', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 52]) ?>

        <?= $form->field($model, 'countryName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 52]) ?>

        <?= $form->field($model, 'localName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <?= $form->field($model, 'webCode', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 2]) ?>

        <?= $form->field($model, 'region', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 26]) ?>

        <?= $form->field($model, 'continent', ['options' => ['class' => 'row form-group']])->dropDownList([ 'Asia' => 'Asia', 'Europe' => 'Europe', 'North America' => 'North America', 'Africa' => 'Africa', 'Oceania' => 'Oceania', 'Antarctica' => 'Antarctica', 'South America' => 'South America',], ['prompt' => '']) ?>

        <?= $form->field($model, 'latitude', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?= $form->field($model, 'longitude', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?= $form->field($model, 'surfaceArea', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?= $form->field($model, 'population', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
