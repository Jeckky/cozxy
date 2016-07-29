<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\productSupplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-supplier-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-heading">
        <span class="panel-title"><?= $title ?></span>
    </div>

    <div class="panel-body">
        <div class="col-lg-12 text-center"><h3><?php echo $productName; ?></h3></div>
        <div class="col-lg-4"> </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'supplierId')->dropDownList($supplier) ?>
            <?= $form->field($model, 'maxQuantity')->textInput() ?>
            <?= $form->field($model, 'leaseTime')->textInput() ?>
            <?= $form->field($model, 'status')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-lg-4"> </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
