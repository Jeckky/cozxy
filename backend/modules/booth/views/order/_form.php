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

    <?= $form->field($model, 'pickingId')->textInput() ?>

    <?= $form->field($model, 'token')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'orderNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoiceNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'totalExVat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grandTotal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingRate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userCoin')->textInput() ?>

    <?= $form->field($model, 'cozxyCoin')->textInput() ?>

    <?= $form->field($model, 'sendDate')->textInput() ?>

    <?= $form->field($model, 'addressId')->textInput() ?>

    <?= $form->field($model, 'isPayNow')->textInput() ?>

    <?= $form->field($model, 'billingFirstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingLastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingCompany')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingTax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingAddress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'billingCountryId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingProvinceId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingAmphurId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingDistrictId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingZipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billingTel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingFirstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingLastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingCompany')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingTax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingAddress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'shippingCountryId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingProvinceId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingAmphurId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingDistrictId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingZipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shippingTel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymentType')->textInput() ?>

    <?= $form->field($model, 'couponId')->textInput() ?>

    <?= $form->field($model, 'checkStep')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'paymentDateTime')->textInput() ?>

    <?= $form->field($model, 'isSlowest')->textInput() ?>

    <?= $form->field($model, 'color')->textInput() ?>

    <?= $form->field($model, 'pickerId')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'error')->textInput() ?>

    <?= $form->field($model, 'createDateTime')->textInput() ?>

    <?= $form->field($model, 'updateDateTime')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
