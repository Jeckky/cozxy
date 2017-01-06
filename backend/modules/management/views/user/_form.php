<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-form">

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

        <?= $form->field($model, 'code', ['options' => ['class' => 'row form-group ']])->textInput()->label('Code') ?>

        <?= $form->field($model, 'passportNo', ['options' => ['class' => 'row form-group ']])->textInput()->label('Passport No') ?>

        <?= $form->field($model, 'firstname', ['options' => ['class' => 'row form-group ']])->textInput(['maxlength' => 200])->label('ชื่อ') ?>

        <?= $form->field($model, 'lastname', ['options' => ['class' => 'row form-group ']])->textInput(['maxlength' => 200])->label('นามสกุล') ?>

        <?= $form->field($model, 'password', ['options' => ['class' => 'row form-group']])->passwordInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'email', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'type')->radioList(['1' => 'Frontend', '2' => 'Backend', '3' => 'Frontend and Backend', '4' => 'Suppliers'])->label('ประเภท') ?>

        <?= $form->field($model, 'gender')->radioList(['1' => 'เพศชาย', '0' => 'เพศหญิง'])->label('เพศ') ?>

        <?= $form->field($model, 'tel', ['options' => [ 'class' => 'row form-group']])->textInput(['maxlength' => 20, 'placeholder' => 'Phone: (999) 999-9999']) ?>

        <?= $form->field($model, 'passportImage', ['options' => ['class' => 'row form-group']])->fileInput() ?>

        <?= (isset($model->passportImage) && !empty($model->passportImage)) ? Html::hiddenInput((new ReflectionClass($model))->getShortName() . '[imageOld]', $model->passportImage) : ''; ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <script>
        init.push(function () {
            $("#user-tel").mask("(999) 999-9999");
            // Add phone validator
            $.validator.addMethod(
                    "phone_format",
                    function (value, element) {
                        var check = false;
                        return this.optional(element) || /^\(\d{3}\)[ ]\d{3}\-\d{4}$/.test(value);
                    },
                    "Invalid phone number."
                    );

        });
    </script>
</div>
