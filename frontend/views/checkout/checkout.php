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
</style>
<section class="checkout">
    <div class="container">
        <!--Expandable Panels-->
        <div class="row">
            <?php
            $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data', 'id' => 'checkout-form'],
                        'fieldConfig' => [
                            //        'template' => '{label}<div class="col-sm-9">{input}</div>',
                            'labelOptions' => [
                            //            'class' => 'col-sm-3 control-label'
                            ]
                        ]
            ]);
            ?>
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
                        <?php echo $this->render('_address', ['type' => 2, 'address' => $address, 'addresses' => $address_shipping, 'user' => $user]); ?>
                        <div class=" form-group" >
                            <label class="ship-to-dif-adress btn btn-primary"><span>Click for Billing to a different adress?</span></label>
                        </div>
                        <div class="shippingArea hide">
                            <?php echo $this->render('_address', ['type' => 1, 'address' => $address, 'addresses' => $address_billing, 'user' => $user]); ?>
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
                                <input type="radio" name="Order[payment]" id="payment01" <?= ($i == 1) ? "checked" : "" ?>> <?= $paymentMethod->title; ?>
                                <p><?= Html::img(Yii::$app->homeUrl . $paymentMethod->image, ['style' => 'width:100%']); ?></p>
                                <p><?= $paymentMethod->description; ?></p>
                            </label>
                        </div>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </div>
                <!--
                <input class="btn btn-black btn-block" type="submit"onclick="$('#checkout-form').submit();" name="place-order" value="Place order">
                -->
                <input class="btn btn-black btn-block" type="submit" name="place-order" id="place-order" value="Place order">
            </div>
            <!--</form>-->
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>


