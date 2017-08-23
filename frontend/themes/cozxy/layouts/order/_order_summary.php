<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

\frontend\assets\CartAsset::register($this);
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <?php
        $form = ActiveForm::begin([
                    'id' => 'confirm-checkout',
                    'action' => Yii::$app->homeUrl . 'checkout/confirm',
                    'options' => ['class' => 'space-bottom'],
        ]);
        ?>
        <div class="col-lg-9 col-md-8 cart-body">
            <div class="row">
                <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                    <p class="size20 size18-xs">YOUR ORDER SUMMARY</p>
                </div>
                <div class="col-xs-12 bg-white">
                    <!--Cart Items-->
                    <?=
                    $this->render('@app/themes/cozxy/layouts/order/purchase_order', ['order' => $order,
                        'addressIdsummary' => $addressIdsummary,
                        'systemCoin' => $systemCoin
                    ])
                    ?>

                    <?php /*
                      echo $this->render("//e_payment/_parameter_form", array(
                      'model' => $model,
                      'ePayment' => $ePayment)); */
                    ?>

                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/']) ?>" class="b btn-black" style="padding:12px 32px">CONTINUE SHOPPING</a> &nbsp;
                        <?php
                        if (($userPoint->currentPoint + $systemCoin) >= $order->summary) {
                            //throw new \yii\base\Exception($addressIdsummary);
                            ?>
                            <input type="hidden" name="systemCoin" value="<?= $systemCoin ?>">
                            <input type="hidden" name="addressId" value="<?= $addressIdsummary ?>">
                            <input type="hidden" name="orderId" value="<?= $order->orderId ?>">
                            <input type="button" value="CONFIRM" class="b btn-yellow" onclick="javascript:checkItemInOrder(<?= $order->orderId ?>)">
                            <!--<input type="submit" value="Confirm" class="b btn-yellow">-->
                        <?php } else {
                            ?>
                            <a href="/top-up?needMore=<?= $order->summary - $userPoint->currentPoint ?>" class="b btn-success" style="padding:12px 32px; margin:10px auto 12px">TOP UP COZXYCOIN</a>
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
                'userPoint' => $userPoint,
                'systemCoin' => $systemCoin
            ])
            ?>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>
<style>
    #notEnough .modal-dialog{
        width:70%;
    }
</style>
<div class="modal fade" id="notEnough">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow3">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
                <h3 class="modal-title">ITEMS SOLD OUT</h3>
            </div>
            <div style="padding: 15px;">Sorry, this item is no longer available. Please remove it from your cart. Add them to your wishlist and we’ll let you know when it’s back in stock!</div>

            <div class="modal-body" id="soldoutItem">


            </div>
            <div class="modal-footer">
                <a href="<?= Yii::$app->homeUrl ?>cart" class="btn btn-yellow"><< BACK TO CART</a>
                <button type="button" class="btn  btn-black" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>