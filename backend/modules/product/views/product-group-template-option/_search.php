<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductGroupTemplateOptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-group-template-option-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'productGroupTemplateOptionId') ?>

    <?= $form->field($model, 'productGroupTemplateId') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createDateTime') ?>

    <?php // echo $form->field($model, 'updateDateTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
