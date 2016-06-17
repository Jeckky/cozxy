<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'token')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'orderNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoiceNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sendDate')->textInput() ?>

    <?= $form->field($model, 'billingCompany')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingTax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingAddress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'billingCountryId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingProvinceId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingAmphurId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingZipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingTel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingCompany')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingTax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingAddress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'shippingCountryId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingProvinceId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingAmphurId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingZipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingTel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymentType')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'createDateTime')->textInput() ?>

    <?= $form->field($model, 'updateDateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
