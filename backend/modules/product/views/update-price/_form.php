<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\UpdatePrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="update-price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'productPriceOtherWebId')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'createDateTime')->textInput() ?>

    <?= $form->field($model, 'updateDateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
