<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style type="text/css">
    .hidden-panel.expanded {
        max-height: 1200px;
    }
    .checkbox .iradio, .radio .iradio {
        background: url(../img/forms/radio.png) no-repeat 0 0;
        border: 10px;
    }
    .edit_select checkout_update_address_shipping > .checkout_update_address_shipping{
        border: 10px #000 solid;
    }
    #costfit-select-Billing-address{
        height: 162px;
        overflow-y: auto;
    }
</style>
<section class="checkout">
    <div class="container">
        <!--Expandable Panels-->
        <div class="row">
            <!--Left Column-->
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Checkout</h2>
                        <!--Hidden Panels-->
                        <?php if (Yii::$app->user->isGuest): ?>
                            <!--Checkout Form Click here to login-->
                            <a class="panel-toggle active action" href="#login"><i></i>Returning customer? Click here to login</a>
                            <div class="row">
                                <div class="hidden-panel expanded" id="login">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <h4>Login</h4>
                                            <!--<form class="login-form" method="post">-->
                                            <label>Use social accounts</label>
                                            <div class="social-login">
                                                <a class="facebook" href="#"><i class="fa fa-facebook-square"></i></a>
                                                <a class="google" href="#"><i class="fa fa-google-plus-square"></i></a>
                                                <a class="twitter" href="#"><i class="fa fa-twitter-square"></i></a>
                                            </div>
                                            <div class="form-group group">
                                                <label for="log-email2">Email</label>
                                                <input type="email" class="form-control" name="log-email2" id="log-email2" placeholder="Enter your email" required>
                                                <!--<a class="help-link" href="#">Forgot email?</a>-->
                                            </div>
                                            <div class="form-group group">
                                                <label for="log-password2">Password</label>
                                                <input type="text" class="form-control" name="log-password2" id="log-password2" placeholder="Enter your password" required>
                                                <a class="help-link" href="#">Forgot password?</a>
                                            </div>
                                            <div class="checkbox">
                                                <!--<label><input type="checkbox" name="remember"> Remember me</label>-->
                                            </div>
                                            <input class="btn btn-primary" type="submit" value="Login">
                                            <!--</form>-->
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12" style="border-left:1px solid black">
                                            <h4>Register</h4>
                                            <?php $form = ActiveForm::begin(['id' => 'register-form', 'action' => $baseUrl . '/register/register', 'options' => ['class' => 'registr-form']]); ?>
                                            <?//= $form->errorSummary($model); ?>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-xs-12">
                                                    <?= $form->field($user, 'firstname')->textInput() ?>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-12">
                                                    <?= $form->field($user, 'lastname') ?>
                                                </div>
                                            </div>
                                            <?= $form->field($user, 'email') ?>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-xs-12">
                                                    <?= $form->field($user, 'password')->passwordInput() ?>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-12">
                                                    <?= $form->field($user, 'confirmPassword')->passwordInput() ?>
                                                </div>
                                            </div>
                                            <input class="btn btn-primary" type="submit" value="Register">
                                            <?php ActiveForm::end(); ?>
                                        </div>
                                    </div>
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
                        <div class="form-group" style="margin-bottom: 10px;  background-color: #f5f5f5; padding: 5px;">
                            <label class="ship-to-dif-adress" style="margin-bottom:0px;">
                                <h3 style="margin-bottom: 8px;">
                                    Click for picking point ?
                                </h3>
                            </label>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-xs-12" style="margin-bottom: 10px;  background-color: #ffffff; padding: 5px;">
                            <?php
                            echo $this->render('picking_point', ['pickingPoint' => $pickingPoint, 'address' => $address]);
                            ?>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px;  background-color: #f5f5f5; padding: 5px;">
                            <label class="ship-to-dif-adress" style="margin-bottom:0px;">
                                <h3 style="margin-bottom: 8px;">
                                    Click for Billing to a different adress?
                                </h3>
                            </label>
                        </div>
                        <div class="shippingArea">
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <?php
                                if (count($user->addresses) > 0):
                                    ?>
                                    <a class="panel-toggle active action" href="#costfit-select-Billing-address" style="margin-left: 10px;"><i></i>Select Billing Address </a>
                                    <div class="row" style="background-color: rgba(249, 249, 249, 0.32); width: 98%; margin-left: 2%; ">
                                        <div class="col-lg-12">
                                            <div class="hidden-panel expanded " id="costfit-select-Billing-address" style="color: #292c2e;">
                                                <?php
                                                foreach ($address_billing as $value) {
                                                    ?>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 main-shipping-address" >
                                                        <div class="tile address text-center" style=" <?= ($value->isDefault == 1) ? "background-color: rgba(31, 30, 30, 0.03)" : '' ?>; padding: 10px; font-size: 12px;">
                                                            <div class="main-title">
                                                                <?php
                                                                echo ($value->firstname != null) ? $value->firstname : $user->firstname;
                                                                echo '&nbsp;&nbsp;';
                                                                echo ($value->lastname != '') ? $value->lastname : $user->lastname;
                                                                ?><br>
                                                                <?php echo ($value->company) ? $value->company : $value->company . ' ,'; ?><br>
                                                                <?php echo ($value->address) ? $value->address : '' . ' ,'; ?><br>
                                                                <?php echo ($value->district['localName']) ? $value->district['localName'] : '' . ' ,'; ?>
                                                                <?php echo ($value->cities['cityName']) ? $value->cities['cityName'] : '' . ' ,'; ?>
                                                                <?php echo ($value->states['stateName']) ? $value->states['stateName'] : '' . ' ,'; ?>
                                                                <?php echo '<br>' . ($value->countries['localName']) ? $value->countries['localName'] : '' . ' ,'; ?>
                                                                <?php echo '<br>Zipcode ' . $value->zipcode; ?>
                                                            </div>
                                                            <div class="footer-cost-fit">
                                                                <a class="panel-toggle" href="#NewShipping"><!--address1-->
                                                                    <div class="radio light">
                                                                        <div class="btn-group" data-toggle="buttons">
                                                                            <label class="btn btn-sm btn-info checkout_select_address<?= ($value->type == 1) ? "_billing" : "_shipping" ?>">
                                                                                <input type="radio" name="checkout_select_address<?= ($value->type == 1) ? "_billing" : "_shipping" ?>" id="checkout_select_address<?= ($value->type == 1) ? "_billing" : "_shipping" ?>"
                                                                                <?php
                                                                                //if ($type == 2) {
                                                                                echo ($value->isDefault == 1) ? 'checked' : '';
                                                                                //}
                                                                                ?> value="<?php echo $value->addressId; ?>"> เลือก
                                                                            </label>
                                                                            <label class="btn btn-sm btn-black edit_select checkout_update_address<?= ($value->type == 1) ? "_billing" : "_shipping" ?>" style="width: 38%;">
                                                                                <input type="hidden" id="edit-form-biiling-checkout" name="edit-form-biiling-checkout" value="<?php echo $value->addressId; ?>">
                                                                                <!--<input type="radio" id="edit-form-biiling-checkout" name="edit-form-biiling-checkout" value="<?//php echo $value->addressId; ?>">-->แก้ไข<span class="pp-label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <a class="panel-toggle" href="#billing"><i></i>New Billing Address</a>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="hidden-panel actionFormEdit<?= ($value->type == 1) ? "Billing" : "Shipping" ?>" id="billing">
                                                        <?php echo $this->render('form_billing', ['address' => $address, 'type' => $value->type, 'isUpdate' => true]); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <h3>Order notes</h3>
                        <div class="form-group">
                            <label class="sr-only" for="order-notes">Order notes</label>
                            <textarea class="form-control input-sm" name="Order[note]" id="order-notes" rows="4" placeholder="Order notes"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!--Right Column-->
            <div class="col-lg-3 col-lg-offset-1 col-md-4 col-sm-4">
                <h3>Your order</h3>
                <?php echo $this->render('@app/views/cart/checkout_totals_right'); ?>
                <div class="payment-method">
                    <?php
                    $i = 1;
                    foreach ($paymentMethods as $paymentMethod):
                        ?>
                        <div class="radio light ">
                            <label>
                                <input type="radio" name="Order[payment]" id="payment01" <?= ($i == 1) ? "checked" : "" ?> value="<?php echo $paymentMethod->paymentMethodId; ?>"> <?= $paymentMethod->title; ?>
                                <p><?= Html::img(Yii::$app->homeUrl . $paymentMethod->image, ['style' => 'width:100%']); ?></p>
                                <p><?= $paymentMethod->description; ?></p>
                            </label>
                        </div>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </div>

                <?php
                if (count($this->params['cart']['orderId'])) {
                    $orderId = $this->params['cart']['orderId'];
                } else {
                    $orderId = NULL;
                }
                echo Html::hiddenInput("placeUserId", (!Yii::$app->user->isGuest) ? Yii::$app->user->id : 0, ['id' => 'placeUserId']);
                echo Html::hiddenInput("placeOrderId", $orderId, ['id' => 'placeOrderId']);
                echo Html::hiddenInput("countItems", (count($this->params['cart']['items']) > 0) ? count($this->params['cart']['items']) : NULL, ['id' => 'countItems']);
                ?>
                <input class="btn btn-black btn-block" type="submit" name="place-order" id="place-order" value="Place order">
            </div>
            <!--</form>-->
            <?php //ActiveForm::end();     ?>
        </div>
    </div>
</section>




