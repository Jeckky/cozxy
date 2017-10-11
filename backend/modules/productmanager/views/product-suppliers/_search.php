<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\search\ProductSuppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-suppliers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'productSuppId') ?>

    <?= $form->field($model, 'userId') ?>

    <?= $form->field($model, 'brandId') ?>

    <?= $form->field($model, 'categoryId') ?>

    <?= $form->field($model, 'isbn') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'suppCode') ?>

    <?php // echo $form->field($model, 'merchantCode') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'optionName') ?>

    <?php // echo $form->field($model, 'shortDescription') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'specification') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'depth') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'smallUnit') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createDateTime') ?>

    <?php // echo $form->field($model, 'updateDateTime') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'approve') ?>

    <?php // echo $form->field($model, 'productId') ?>

    <?php // echo $form->field($model, 'approveCreateBy') ?>

    <?php // echo $form->field($model, 'approvecreateDateTime') ?>

    <?php // echo $form->field($model, 'receiveType') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'warrantyType') ?>

    <?php // echo $form->field($model, 'warrantyPeriod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
