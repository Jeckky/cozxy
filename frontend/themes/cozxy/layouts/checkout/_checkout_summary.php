<?php
use yii\helpers\Url;
use kartik\select2\Select2;

\frontend\assets\CheckoutAsset::register($this);
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <div class="col-lg-9 col-md-8 cart-body">
            <div class="row">
                <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                    <p class="size20 size18-xs">YOUR SHIPPING & BILLING ADDRESS</p>
                </div>
                <div class="col-xs-12 bg-white">

                    <!-- Shipping -->
                    <div class="cart-detail">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        Shipping to : <span class="size18">CozxyBox Location</span>
                                    </div>
                                </div>

                                <div class="row fc-g999">
                                    <div class="col-xs-12">
                                        <h4>Map</h4>
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d124008.92046473033!2d100.48062576799724!3d13.762055508253102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x30e29ebe74b07b57%3A0x1892d37c43ed15a7!2z4LiV4Lil4Liy4LiU4Lio4Lij4Li14LiU4Li04LiZ4LmB4LiU4LiH!3m2!1d13.7620654!2d100.55066629999999!5e0!3m2!1sth!2sth!4v1494639156559" frameborder="0" style="width:100%;height:20vh;border:0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        Billing Address
                                    </div>
                                </div>

                                <div class="row fc-g999">
                                    <div class="col-lg-2 col-md-2 col-sm-12">Name:</div>
                                    <div class="col-lg-10 col-md-10 col-sm-12">Inthanon Panyasopa</div>
                                    <div class="size6">&nbsp;</div>
                                    <div class="col-lg-2 col-md-3 col-sm-12">Address:</div>
                                    <div class="col-lg-10 col-md-9 col-sm-12">123 Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit, sed do eiusmod tempor 50000
                                    </div>
                                    <div class="size12">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Cart Items-->
                    <?php for ($i = 0; $i < 4; $i++): ?>
                        <?= $this->render('_checkout_item'); ?>
                    <?php endfor; ?>

                    <div class="size12 size10-xs">&nbsp;</div>
                </div>
            </div>
        </div>

        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?= $this->render('_checkout_total') ?>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>