<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\dbworld;
use yii\jui\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\dbworld\Zipcodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zipcodes-form">

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


        <div class="row form-group field-zipcodes-zipcode required ">
            <label class="col-sm-3 control-label" for="zipcodes-zipcode">districtCode</label>
            <div class="col-sm-9">
                <?php
                // Multiple select without model
                echo Select2::widget([
                    'id' => 'zipcodes-districtcode',
                    'name' => 'Zipcodes[districtCode]',
                    'value' => '',
                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\District::find()->asArray()->all(), 'code', 'districtName'),
                    'options' => ['multiple' => FALSE, 'placeholder' => 'Select states ...']
                ]);
                ?>
            </div>
        </div>

        <?//= $form->field($model, 'districtCode', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 20]) ?>
        <?//= $form->field($model, 'districtCode', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(dbworld\District::find()->all(), 'code', 'districtName'), ['prompt' => '-- Select Geography --']) ?>

        <?= $form->field($model, 'zipcode', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 20]) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
