<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style type="text/css">
    .hidden-panel.expanded {
        max-height: 1200px;

    }
</style>
<section class="checkout">
    <div class="container">
        <!--Expandable Panels-->
        <div class="row">
            <form id="checkout-form" method="post" action="<?php echo Yii::$app->homeUrl; ?>tracking">
                <!--Left Column-->
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Checkout</h2>
                            <!--Hidden Panels-->
                            <?php if (Yii::$app->user->isGuest): ?>
                                <!--Checkout Form Click here to login-->
                                <a class="panel-toggle" href="#login"><i></i>Returning customer? Click here to login</a>
                                <div class="row">
                                    <div class="hidden-panel" id="login">
                                        <?php echo $this->render('@app/views/register/form_login'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!isset($this->params['cart']['discount'])): ?>
                                <!--Checkout Form coupon-->
                                <a class="panel-toggle" href="#coupon"><i></i>Have a coupon? Click here to enter your code</a>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="hidden-panel" id="coupon">
                                            <?php echo $this->render('@app/views/coupon/coupon'); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!--Checkout Form New Address-->
                            <a class="panel-toggle" href="#costfit"><i></i>New Address</a>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="hidden-panel" id="costfit">
                                        <?php echo $this->render('form_billing'); ?>
                                    </div>
                                </div>
                            </div>
                            <!--Checkout Form Select  Address-->
                            <a class="panel-toggle active action" href="#costfit-select-address"><i></i>Select Address</a>
                            <div class="row" style="background-color: rgba(249, 249, 249, 0.32);">
                                <div class="col-lg-12">
                                    <div class="hidden-panel expanded" id="costfit-select-address" style="color: #292c2e;">
                                        <?php echo $this->render('address_new'); ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <?php echo $this->render('form_billing'); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!--Right Column-->
                <div class="col-lg-3 col-lg-offset-1 col-md-4 col-sm-4">
                    <h3>Your order</h3>

                    <?php echo $this->render('@app/views/cart/checkout_totals_right'); ?>

                    <div class="payment-method">
                        <div class="radio light">
                            <label><input type="radio" name="payment" id="payment01" checked> Direct Bank Transfer</label>
                        </div>
                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                        <div class="radio light">
                            <label><input type="radio" name="payment" id="payment02"> Cheque Payment</label>
                        </div>
                        <div class="radio light">
                            <label><input type="radio" name="payment" id="payment03"> PayPal <span class="pp-label"></span></label>
                        </div>
                    </div>
                    <input class="btn btn-black btn-block" type="submit" name="place-order" value="Place order">
                </div>
            </form>
        </div>
    </div>
</section>


