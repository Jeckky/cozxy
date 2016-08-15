<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'default-shipping-address',
    'action' => 'confirmation?id=' . $model->orderId,
    'options' => ['class' => 'space-bottom'],
]);
?>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <h3>ยินยันชำระเงินด้วยบัตรเครดิต</h3>

        <?php echo $this->render("//profile/purchase_order", ['order' => $model]); ?>
        <?php
        echo $this->render("//e_payment/_parameter_form", array(
            'model' => $model,
            'ePayment' => $ePayment));
        ?>
    </div>
    <div class="col-lg-2"></div>
</div>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 text-right">
        <?php echo Html::submitButton("ยินยันชำระเงิน", ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a("ย้อนกลับ", "#", ['class' => 'btn btn-warning', 'onClick' => 'window.history.back()']); ?>
    </div>
    <div class = "col-lg-2"></div>
</div>

<?php ActiveForm::end();
?>


