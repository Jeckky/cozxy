<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <?php
        $form = ActiveForm::begin([
                    'id' => 'default-shipping-cart',
                    'action' => Yii::$app->homeUrl . 'checkout/confirm',
                    'options' => ['class' => 'space-bottom'],
        ]);
        ?>
        <div class="col-lg-9 col-md-8 cart-body">
            <div class="row">
                <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                    <p class="size20 size18-xs">YOUR Order Summary</p>
                </div>
                <div class="col-xs-12 bg-white">
                    <!--Cart Items-->
                    <?= $this->render('@app/themes/cozxy/layouts/order/purchase_order', ['order' => $order, 'addressIdsummary' => $addressIdsummary]) ?>

                    <?php /*
                      echo $this->render("//e_payment/_parameter_form", array(
                      'model' => $model,
                      'ePayment' => $ePayment)); */
                    ?>

                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/search/cozxy-product']) ?>" class="b btn-black" style="padding:12px 32px">CONTINUE SHOPPING</a> &nbsp;
                        <?php
                        if ($userPoint->currentPoint >= $order->summary) {
                            ?>
                            <input type="hidden" name="addressId" value="<?= $addressIdsummary ?>">
                            <input type="hidden" name="orderId" value="<?= $order->orderId ?>">
                            <input type="submit" value="Confirm" class="b btn-yellow">
                        <?php } else {
                            ?>
                            <a href="/top-up?needMore=<?= $order->summary - $userPoint->currentPoint ?>" class="b btn-success" style="padding:12px 32px; margin:10px auto 12px">TOP UP CozxyCoin</a>
                        <?php } ?>
                    </div>
                    <div class="size12 size10-xs">&nbsp;</div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?=
            $this->render('_order_summary_cozxy_coin', [
                'order' => $order,
                'userPoint' => $userPoint
            ])
            ?>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>