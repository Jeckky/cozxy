<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\receive */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="receive-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orderId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pickingId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isUse')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'createDateTime')->textInput() ?>

    <?= $form->field($model, 'updateDateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
