<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'Partner Membership Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    body{
        background-image: url("/images/be-our-partner/become-partner.jpg") ;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    }
    .be-our-partner{
        /* for IE */
        filter:alpha(opacity=60);
        /* CSS3 standard */
        opacity:0.9;
        color: #000000;
    }
    .my-form{
        color: #000;
    }
</style>
<div class="container login-box be-our-partner">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs my-form"><?= strtoupper('Partner :: STEP Registration') ?></p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        1.Registration and waiting approval <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;- Sign up with e-mail.<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;- Awaiting approval.<br>
                        2.Information verification and document review<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;- Upload required documents or send the hardcopies via mail.<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:black_small_square:    A copy of Representative’s Thai National ID or Passport<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:black_small_square:    A copy of Business Registration Certificate<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:black_small_square:    A copy of VAT Registration (Optional)<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:black_small_square:    Other Document / License (Optional)<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;- Verification complete.<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;- Product listing and selling is possible.<br>
                    </div>
                    <div class="form-group">
                        <a href="<?= Url::to(['partner/partner-membership-registration']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">Click >> Partner Membership Registration</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <address>
                            <strong>Cozxy Co.,Ltd.</strong><br>
                            5 Soi Ram Intra 5 Yeak 4, Ram Intra Road, Anusawari, Bang Khen, Bangkok 10220<br>
                            <abbr title="Phone">Phone:</abbr> 02-093-4356
                            <abbr title="Phone">Fax:</abbr> 02-345-4376
                        </address>

                        <address>
                            <strong>Email</strong><br>
                            <a href="mailto:info@cozxy.com">info@cozxy.com</a>
                        </address>
                    </div>
                </div>
            </div>

            <div class="size18 size14-xs">&nbsp;</div>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>