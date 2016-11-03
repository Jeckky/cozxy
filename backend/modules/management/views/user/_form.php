<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
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

        <?//= $form->field($model, 'username',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?//= $form->field($model, 'password_hash',['options'=>['class'=>'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?//= $form->field($model, 'firstname',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?//= $form->field($model, 'password',['options'=>['class'=>'row form-group']])->passwordInput(['maxlength' => 200]) ?>

        <?//= $form->field($model, 'lastname',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?//= $form->field($model, 'email',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?//= $form->field($model, 'token',['options'=>['class'=>'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?= $form->field($model, 'type', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?//= $form->field($model, 'auth_key',['options'=>['class'=>'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?//= $form->field($model, 'auth_type',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 255]) ?>

        <?//= $form->field($model, 'birthDate',['options'=>['class'=>'row form-group']])->textInput() ?>

        <?//= $form->field($model, 'gender',['options'=>['class'=>'row form-group']])->textInput() ?>

        <?//= $form->field($model, 'tel',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 20]) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
