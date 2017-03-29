<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$form = ActiveForm::begin([
            'id' => 'default-shipping-address',
            'action' => $baseUrl . '/checkout/confirmation/' . $model->encodeParams(['orderId' => $model->orderId]),
            'options' => ['class' => 'space-bottom'],
        ]);
?>

<section class="support">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>ยินยันชำระเงิน</h3>

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
            <h4 style="text-align: center;">* ระบบจะทำการชำระเงินด้วย Point หลังจากกด ปุ่ม "ยืนยันการชำระเงิน"</h4><br><br><!--sak-->
            <div class="col-lg-12 text-right">
                <?php echo Html::submitButton("ยืนยันชำระเงิน", ['class' => 'btn btn-primary']) ?>
                <?php echo Html::a("ย้อนกลับ", Yii::$app->homeUrl . "checkout/reverse-order-to-cart/" . common\models\ModelMaster::encodeParams(['orderId' => $model->orderId]), ['class' => 'btn btn-warning']); ?>
            </div>
            <div class = "col-lg-2"></div>
        </div>
    </div>
</section>

<?php ActiveForm::end();
?>


