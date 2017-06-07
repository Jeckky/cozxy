<?php

use yii\bootstrap\ActiveForm;

$this->registerCss('
.hr-margin {
	margin-top: 24px;
	border-top: 1px solid #ddd;
}
.contag {
	display: inline-block;
	width: 64px;
}
');
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">CONTACT US</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="row">
                <!-- Contact -->
                <?php
                $form = ActiveForm::begin([
                    'id' => 'default-shipping-cart',
                    'action' => Yii::$app->homeUrl . 'site/contact-mail',
                    'options' => ['class' => 'space-bottom'],
                ]);
                ?>
                <div class="col-md-6">
                    <div class="size24">&nbsp;</div>
                    <p>Contact Form</p>
                    <div class="row">

                        <?= isset($msg) ? '  <div class="col-md-12" >' . $msg . '</div>' : '' ?>

                        <div class="col-md-6">
                            <input type="text" name="name" class="fullwidth" placeholder="YOUR NAME" required></div>
                        <div class="col-md-6">
                            <input type="text" name="phone" class="fullwidth" placeholder="PHONE NUMBER" required>
                        </div>

                    </div>
                    <input type="text" name="email" class="fullwidth" placeholder="EMAIL ADDRESS" required>
                    <textarea name="message" class="fullwidth" style="height:28vh" placeholder="MESSAGE" required></textarea>
                    <div class="text-right">
                        <!--                            <a href="#" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">SEND</a>-->
                        <button type="submit"class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">SEND</button>
                    </div>
                    <div class="size12 size10-xs">&nbsp;</div>
                </div>
                <?php ActiveForm::end(); ?>
                <!-- Map -->
                <div class="col-md-6">
                    <div class="size24">&nbsp;</div>
                    <p>Address</p>
                    <h3>Cozxy Co.,Ltd.</h3>
                    <div class="size8">&nbsp;</div>
                    <p class="fc-g666">5 Soi Ram Intra 5 Yeak 4, Ram Intra Road, Anusawari, Bang Khen, Bangkok 10220</p>
                    <p class="fc-g666"><span class="contag">Email:</span> info@cozxy.com</p>
                    <p class="fc-g666"><span class="contag">Phone:</span> 02-093-4356</p>
                    <p class="fc-g666"><span class="contag">Fax:</span> 02-345-4376</p>
                    <div class="size24 hr-margin">&nbsp;</div>
                    <p>Map</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.4604385127327!2d100.61513151535414!3d13.871394790270138!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e282aa513abbc1%3A0x6a10bb1b8202e493!2sCozxy+HQ!5e0!3m2!1sth!2sth!4v1496810708571" frameborder="0" style="width:100%;height:20vh;border:0" allowfullscreen></iframe>
                </div>
                <!-- E -->
            </div>
        </div>
    </div>
</div>