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
        'id'=>'search-form'
    ]); ?>

    <?//= $form->field($model, 'orderId') ?>

    <?//= $form->field($model, 'userId') ?>

    <?//= $form->field($model, 'pickingId') ?>

    <?//= $form->field($model, 'token') ?>

    <?= $form->field($model, 'orderNo') ?>

    <?php // echo $form->field($model, 'invoiceNo') ?>

    <?php // echo $form->field($model, 'totalExVat') ?>

    <?php // echo $form->field($model, 'vat') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'grandTotal') ?>

    <?php // echo $form->field($model, 'shippingRate') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'userCoin') ?>

    <?php // echo $form->field($model, 'cozxyCoin') ?>

    <?php // echo $form->field($model, 'sendDate') ?>

    <?php // echo $form->field($model, 'addressId') ?>

    <?php // echo $form->field($model, 'isPayNow') ?>

    <?php // echo $form->field($model, 'billingFirstname') ?>

    <?php // echo $form->field($model, 'billingLastname') ?>

    <?php // echo $form->field($model, 'billingCompany') ?>

    <?php // echo $form->field($model, 'billingTax') ?>

    <?php // echo $form->field($model, 'billingAddress') ?>

    <?php // echo $form->field($model, 'billingCountryId') ?>

    <?php // echo $form->field($model, 'billingProvinceId') ?>

    <?php // echo $form->field($model, 'billingAmphurId') ?>

    <?php // echo $form->field($model, 'billingDistrictId') ?>

    <?php // echo $form->field($model, 'billingZipcode') ?>

    <?php // echo $form->field($model, 'billingTel') ?>

    <?php // echo $form->field($model, 'shippingFirstname') ?>

    <?php // echo $form->field($model, 'shippingLastname') ?>

    <?php // echo $form->field($model, 'shippingCompany') ?>

    <?php // echo $form->field($model, 'shippingTax') ?>

    <?php // echo $form->field($model, 'shippingAddress') ?>

    <?php // echo $form->field($model, 'shippingCountryId') ?>

    <?php // echo $form->field($model, 'shippingProvinceId') ?>

    <?php // echo $form->field($model, 'shippingAmphurId') ?>

    <?php // echo $form->field($model, 'shippingDistrictId') ?>

    <?php // echo $form->field($model, 'shippingZipcode') ?>

    <?php // echo $form->field($model, 'shippingTel') ?>

    <?php // echo $form->field($model, 'paymentType') ?>

    <?php // echo $form->field($model, 'couponId') ?>

    <?php // echo $form->field($model, 'checkStep') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'paymentDateTime') ?>

    <?php // echo $form->field($model, 'isSlowest') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'pickerId') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'otp') ?>

    <?php // echo $form->field($model, 'refNo') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'error') ?>

    <?php // echo $form->field($model, 'createDateTime') ?>

    <?php // echo $form->field($model, 'updateDateTime') ?>

    <?php // echo $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'id'=>'searchBtn']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("
$('#searchBtn').click(function(e){
    e.preventDefault();
    
    if($('#order-orderno').val().length > 0) {
        $('#search-form').submit();
    } else {
        alert('Please fill in Order No.');
    }
});
");
?>