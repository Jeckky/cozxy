<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\search\ProductPromotion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-promotion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'productPromotionId') ?>

    <?= $form->field($model, 'productId') ?>

    <?= $form->field($model, 'statusDate') ?>

    <?= $form->field($model, 'endDate') ?>

    <?= $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'discountType') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createDateTime') ?>

    <?php // echo $form->field($model, 'updateDateTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
