<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'Partner Membership Registration';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this yii\web\View */
$this->registerCss('
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

    .testimonial{
        margin-bottom: 10px;
    }

    .testimonial-section {
        width: 100%;
        height: auto;
        padding: 15px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        position: relative;
        border: 1px solid #fff;
    }
    .testimonial-section:after {
        top: 100%;
        left: 50px;
        border: solid transparent;
        content: " ";
        position: absolute;
        border-top-color: #fff;
        border-width: 15px;
        margin-left: -15px;
    }

    .testimonial-desc {
        margin-top: 20px;
        text-align:left;
        padding-left: 15px;
    }
    .testimonial-desc img {
        border: 1px solid #f5f5f5;
        border-radius: 150px;
        height: 70px;
        padding: 3px;
        width: 70px;
        display:inline-block;
        vertical-align: top;
    }

    .testimonial-writer{
        display: inline-block;
        vertical-align: top;
        padding-left: 10px;
    }

    .testimonial-writer-name{
        font-weight: bold;
    }

    .testimonial-writer-designation{
        font-size: 85%;
    }

    .testimonial-writer-company{
        font-size: 85%;
    }
    /*---- Outlined Styles ----*/
    .testimonial.testimonial-default{

    }
    .testimonial.testimonial-default .testimonial-section{
        border-color: #777;
    }

    .testimonial.testimonial-default .testimonial-section:after{
        border-top-color: #777;
    }

    .testimonial.testimonial-default .testimonial-desc{

    }

    .testimonial.testimonial-default .testimonial-desc img{
        border-color: #777;
    }

    .testimonial.testimonial-default .testimonial-writer-name{
        color: #777;
    }

    .testimonial.testimonial-primary{

    }
    .testimonial.testimonial-primary .testimonial-section{
        border-color: #337AB7;
        color: #286090;
        background-color: rgba(51, 122, 183, 0.1);
    }

    .testimonial.testimonial-primary .testimonial-section:after{
        border-top-color: #337AB7;
    }

    .testimonial.testimonial-primary .testimonial-desc{

    }

    .testimonial.testimonial-primary .testimonial-desc img{
        border-color: #337AB7;
    }

    .testimonial.testimonial-primary .testimonial-writer-name{
        color: #337AB7;
    }

    .testimonial.testimonial-info{

    }
    .testimonial.testimonial-info .testimonial-section{
        border-color: #5BC0DE;
        color: #31b0d5;
        background-color: rgba(91, 192, 222, 0.1);
    }

    .testimonial.testimonial-info .testimonial-section:after{
        border-top-color: #5BC0DE;
    }

    .testimonial.testimonial-info .testimonial-desc{

    }

    .testimonial.testimonial-info .testimonial-desc img{
        border-color: #5BC0DE;
    }

    .testimonial.testimonial-info .testimonial-writer-name{
        color: #5BC0DE;
    }


    .testimonial.testimonial-success{

    }
    .testimonial.testimonial-success .testimonial-section{
        border-color: #5CB85C;
        color: #449d44;
        background-color: rgba(92, 184, 92, 0.1);
    }

    .testimonial.testimonial-success .testimonial-section:after{
        border-top-color: #5CB85C;
    }

    .testimonial.testimonial-success .testimonial-desc{

    }

    .testimonial.testimonial-success .testimonial-desc img{
        border-color: #5CB85C;
    }

    .testimonial.testimonial-success .testimonial-writer-name{
        color: #5CB85C;
    }

    .testimonial.testimonial-warning{

    }
    .testimonial.testimonial-warning .testimonial-section{
        border-color: #F0AD4E;
        color: #d58512;
        background-color: rgba(240, 173, 78, 0.1);
    }

    .testimonial.testimonial-warning .testimonial-section:after{
        border-top-color: #F0AD4E;
    }

    .testimonial.testimonial-warning .testimonial-desc{

    }

    .testimonial.testimonial-warning .testimonial-desc img{
        border-color: #F0AD4E;
    }

    .testimonial.testimonial-warning .testimonial-writer-name{
        color: #F0AD4E;
    }

    .testimonial.testimonial-danger{

    }
    .testimonial.testimonial-danger .testimonial-section{
        border-color: #D9534F;
        color: #c9302c;
        background-color: rgba(217, 83, 79, 0.1);
    }

    .testimonial.testimonial-danger .testimonial-section:after{
        border-top-color: #D9534F;
    }

    .testimonial.testimonial-danger .testimonial-desc{

    }

    .testimonial.testimonial-danger .testimonial-desc img{
        border-color: #D9534F;
    }

    .testimonial.testimonial-danger .testimonial-writer-name{
        color: #D9534F;
    }

    /*---- Filled Styles ----*/
    .testimonial.testimonial-default-filled{

    }
    .testimonial.testimonial-default-filled .testimonial-section{
        color: #fff;
        border-color: #777;
        background-color: #777;
    }

    .testimonial.testimonial-default-filled .testimonial-section:after{
        border-top-color: #777;
    }

    .testimonial.testimonial-default-filled .testimonial-desc{

    }

    .testimonial.testimonial-default-filled .testimonial-desc img{
        border-color: #777;
        background-color: #777;
    }

    .testimonial.testimonial-default-filled .testimonial-writer-name{
        color: #777;
    }

    .testimonial.testimonial-primary-filled{

    }
    .testimonial.testimonial-primary-filled .testimonial-section{
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }

    .testimonial.testimonial-primary-filled .testimonial-section:after{
        border-top-color: #337AB7;
    }

    .testimonial.testimonial-primary-filled .testimonial-desc{

    }

    .testimonial.testimonial-primary-filled .testimonial-desc img{
        border-color: #2e6da4;
        background-color: #337ab7;
    }

    .testimonial.testimonial-primary-filled .testimonial-writer-name{
        color: #337AB7;
    }

    .testimonial.testimonial-info-filled{

    }
    .testimonial.testimonial-info-filled .testimonial-section{
        color: #fff;
        background-color: #5bc0de;
        border-color: #46b8da;
    }

    .testimonial.testimonial-info-filled .testimonial-section:after{
        border-top-color: #5BC0DE;
    }

    .testimonial.testimonial-info-filled .testimonial-desc{

    }

    .testimonial.testimonial-info-filled .testimonial-desc img{
        border-color: #46b8da;
        background-color: #5bc0de;
    }

    .testimonial.testimonial-info-filled .testimonial-writer-name{
        color: #5BC0DE;
    }


    .testimonial.testimonial-success-filled{

    }
    .testimonial.testimonial-success-filled .testimonial-section{
        color: #fff;
        background-color: #5cb85c;
        border-color: #4cae4c;
    }

    .testimonial.testimonial-success-filled .testimonial-section:after{
        border-top-color: #5CB85C;
    }

    .testimonial.testimonial-success-filled .testimonial-desc{

    }

    .testimonial.testimonial-success-filled .testimonial-desc img{
        border-color: #4cae4c;
        background-color: #5cb85c;
    }

    .testimonial.testimonial-success-filled .testimonial-writer-name{
        color: #5CB85C;
    }

    .testimonial.testimonial-warning-filled{

    }
    .testimonial.testimonial-warning-filled .testimonial-section{
        color: #fff;
        background-color: #f0ad4e;
        border-color: #eea236;
    }

    .testimonial.testimonial-warning-filled .testimonial-section:after{
        border-top-color: #F0AD4E;
    }

    .testimonial.testimonial-warning-filled .testimonial-desc{

    }

    .testimonial.testimonial-warning-filled .testimonial-desc img{
        border-color: #eea236;
        background-color: #f0ad4e;
    }

    .testimonial.testimonial-warning-filled .testimonial-writer-name{
        color: #F0AD4E;
    }

    .testimonial.testimonial-danger-filled{

    }
    .testimonial.testimonial-danger-filled .testimonial-section{
        color: #fff;
        background-color: #d9534f;
        border-color: #d43f3a;
    }

    .testimonial.testimonial-danger-filled .testimonial-section:after{
        border-top-color: #D9534F;
    }

    .testimonial.testimonial-danger-filled .testimonial-desc{

    }

    .testimonial.testimonial-danger-filled .testimonial-desc img{
        border-color: #d43f3a;
        background-color: #D9534F;
    }

    .testimonial.testimonial-danger-filled .testimonial-writer-name{
        color: #D9534F;
    }
');
?>

<div class="container login-box be-our-partner">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs my-form"><?= strtoupper('Partner :: STEP Registration') ?></p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>

            <div class="row">
                <div class="col-md-8" style="border-right: 1px #f5f5f5 dotted;">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div id="tb-testimonial" class="testimonial testimonial-default">
                                <div class="testimonial-section">
                                    <strong>1.Registration and waiting approval </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;- Sign up with e-mail.<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;- Awaiting approval.<br>
                                </div>
                                <div class="testimonial-desc">
                                    <img src="/imgs/cozxy.png" alt="">
                                    <div class="testimonial-writer">
                                        <div class="testimonial-writer-name">STEP 1</div>
                                        <div class="testimonial-writer-designation">Cozxy Co.,Ltd.</div>
                                        <a href="#" class="testimonial-writer-company">Administrator</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div id="tb-testimonial" class="testimonial testimonial-default">
                                <div class="testimonial-section">
                                    <strong>2.Information verification and document review</strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;- Upload required documents or send the hardcopies via mail.<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:black_small_square:    A copy of Representative’s Thai National ID or Passport<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:black_small_square:    A copy of Business Registration Certificate<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:black_small_square:    A copy of VAT Registration (Optional)<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:black_small_square:    Other Document / License (Optional)<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;- Verification complete.<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;- Product listing and selling is possible.<br>
                                </div>
                                <div class="testimonial-desc">
                                    <img src="/imgs/cozxy.png" alt="">
                                    <div class="testimonial-writer">
                                        <div class="testimonial-writer-name">STEP 2</div>
                                        <div class="testimonial-writer-designation">Cozxy Co.,Ltd.</div>
                                        <a href="#" class="testimonial-writer-company">Administrator</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
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
                        &nbsp;&nbsp;&nbsp;&nbsp;- Product listing and selling is possible.<br>-->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="<?= Url::to(['partner/partner-membership-registration']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px; margin-left: 20px;">Click >> Partner Membership Registration</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"><p class="size20 size18-xs ">Contact Place</p>
                    <div>
                        <address>
                            Cozxy Co.,Ltd.<br>
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

