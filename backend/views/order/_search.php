<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\search\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'orderId') ?>

    <?= $form->field($model, 'userId') ?>

    <?= $form->field($model, 'token') ?>

    <?= $form->field($model, 'orderNo') ?>

    <?= $form->field($model, 'invoiceNo') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'sendDate') ?>

    <?php // echo $form->field($model, 'billingCompany') ?>

    <?php // echo $form->field($model, 'billingTax') ?>

    <?php // echo $form->field($model, 'billingAddress') ?>

    <?php // echo $form->field($model, 'billingCountryId') ?>

    <?php // echo $form->field($model, 'billingProvinceId') ?>

    <?php // echo $form->field($model, 'billingAmphurId') ?>

    <?php // echo $form->field($model, 'billingZipcode') ?>

    <?php // echo $form->field($model, 'billingTel') ?>

    <?php // echo $form->field($model, 'shippingCompany') ?>

    <?php // echo $form->field($model, 'shippingTax') ?>

    <?php // echo $form->field($model, 'shippingAddress') ?>

    <?php // echo $form->field($model, 'shippingCountryId') ?>

    <?php // echo $form->field($model, 'shippingProvinceId') ?>

    <?php // echo $form->field($model, 'shippingAmphurId') ?>

    <?php // echo $form->field($model, 'shippingZipcode') ?>

    <?php // echo $form->field($model, 'shippingTel') ?>

    <?php // echo $form->field($model, 'paymentType') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createDateTime') ?>

    <?php // echo $form->field($model, 'updateDateTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
