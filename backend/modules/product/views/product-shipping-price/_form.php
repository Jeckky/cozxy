<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\productShippingPrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-shipping-price-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel-heading">
        <span class="panel-title"><?= $title ?></span>
    </div>

    <div class="panel-body">
        <div class="col-lg-12 text-center"><h3><?php echo $productName; ?></h3></div>
        <div class="col-lg-4"> </div>
        <div class="col-lg-4">

            <?= $form->field($model, 'shippingTypeId')->dropDownList($shippingType) ?>

            <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type')->dropDownList($discountType) ?>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <div class="col-lg-4"> </div>

        <div class="form-group">

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
