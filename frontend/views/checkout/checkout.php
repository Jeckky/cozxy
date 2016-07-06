<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<section class="checkout">
    <div class="container">
        <!--Expandable Panels-->
        <div class="row">
            <div class="col-lg-12">
                <h2>Checkout</h2>
                <!--Hidden Panels-->
                <a class="panel-toggle" href="#login"><i></i>Returning customer? Click here to login</a>
                <div class="row">
                    <div class="hidden-panel" id="login">
                        <?php echo $this->render('@app/views/register/form_login'); ?>
                    </div>
                </div>
                <a class="panel-toggle" href="#coupon"><i></i>Have a coupon? Click here to enter your code</a>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="hidden-panel" id="coupon">
                            <?php echo $this->render('@app/views/coupon/coupon'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Checkout Form-->
        <div class="row">
            <form id="checkout-form" method="post" action="<?php echo Yii::$app->homeUrl; ?>tracking">
                <!--Left Column-->
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h3>Billing adress</h3>
                    <div class="form-group">
                        <label for="co-country">Country *</label>
                        <div class="select-style">
                            <select name="co-country" id="co-country">
                                <option>Australia</option>
                                <option>Belgium</option>
                                <option>Germany</option>
                                <option>United Kingdom</option>
                                <option>Switzerland</option>
                                <option>USA</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="co-first-name">First Name *</label>
                            <input type="text" class="form-control" id="co-first-name" name="co-first-name" placeholder="First name" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="co-last-name">Last Name *</label>
                            <input type="text" class="form-control" id="co-last-name" name="co-last-name" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="co-company-name">Company name</label>
                        <input type="text" class="form-control" id="co-company-name" name="co-company-name" placeholder="Company name">
                    </div>
                    <div class="form-group">
                        <label for="co-str-adress">Adress *</label>
                        <input type="text" class="form-control" id="co-str-adress" name="co-str-adress" placeholder="Street adress" required>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="co-appartment">Appartment</label>
                        <input type="text" class="form-control" id="co-appartment" name="co-appartment" placeholder="Appartment" required>
                    </div>
                    <div class="form-group">
                        <label for="co-city">Town/ city *</label>
                        <input type="text" class="form-control" id="co-city" name="co-city" placeholder="Town/ city" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="co-state">County/ state</label>
                            <input type="text" class="form-control" id="co-state" name="co-state" placeholder="County/ state">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="co_postcode">Postcode *</label>
                            <input type="text" class="form-control" id="co_postcode" name="co_postcode" placeholder="Postcode/ ZIP" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="co-email">Email *</label>
                            <input type="email" class="form-control" id="co-email" name="co-email" placeholder="Email adress" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="co_phone">Phone *</label>
                            <input type="text" class="form-control" id="co_phone" name="co_phone" placeholder="Phone number" required>
                        </div>
                    </div>
                    <div class="checkbox form-group">
                        <label><input type="checkbox" name="create-account"> Create an account?</label>
                    </div>
                    <div class="checkbox form-group">
                        <label><span>Ship to a different adress?</span> <input type="checkbox" name="ship-to-dif-adress"></label>
                    </div>
                    <h3>Order notes</h3>
                    <div class="form-group">
                        <label class="sr-only" for="order-notes">Order notes</label>
                        <textarea class="form-control" name="order-notes" id="order-notes" rows="4" placeholder="Order notes"></textarea>
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


