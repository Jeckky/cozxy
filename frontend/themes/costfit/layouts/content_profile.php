<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php $this->beginContent('@app/themes/costfit/layouts/main.php'); ?>
<?= $this->render('_modal_login') ?>
<?= $this->render('_header') ?>
<div class="page-content">
    <!--Breadcrumbs-->
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::$app->homeUrl; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "sub Title" ?></a></li>
        <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></a></li>
    </ol><!--Breadcrumbs Close-->

    <!--Profile Left-->
    <section class="blog">
        <div class="container">
            <div class="row">
                <!--Left Column-->
                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                    <h2 class="title">Hello , <?php echo Yii::$app->user->identity->firstname . '&nbsp;' . Yii::$app->user->identity->lastname ?></h2>
                </div>

                <div class="col-lg-8 col-md-8">
                    <?php echo $content; ?>
                </div>
                <!--Default Add New-->
                <div class="col-lg-4 col-md-4 post">
                    <div class="bs-example" data-example-id="btn-tags" style="background-color:#3cc; height:45px; margin-top: 20px;  padding: 10px 12px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
                        <span style="float: left; width: 70%; text-align: left;">Default shipping address</span>
                        <span style="float: left; width: 30%; text-align: right;">
                            <a href="<?php echo Yii::$app->homeUrl; ?>profile/shipping-address" style="color: #fff;"> + Add New </a>
                        </span>
                    </div>
                    <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: 0 0 ">
                        <p>
                            1. 7th floor Ladproa 19,
                            Ladproa Road , Chatuchak , Bangkok , THA Zipcode 10900
                        </p>
                        <p>
                            2. 7th floor Ladproa 19,
                            Ladproa Road , Chatuchak , Bangkok , THA Zipcode 10900
                        </p>
                        <p>
                            3. 7th floor Ladproa 19,
                            Ladproa Road , Chatuchak , Bangkok , THA Zipcode 10900
                        </p>
                    </div>
                    <!--Default Add New-->
                    <div class="bs-example" data-example-id="btn-tags" style="background-color:#3cc; height:45px; margin-top: 20px;  padding: 10px 12px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
                        <span style="float: left; width: 70%; text-align: left;">Default billings address</span>
                        <span style="float: left; width: 30%; text-align: right;">
                            <a href="<?php echo Yii::$app->homeUrl; ?>profile/billings-address" style="color: #fff;"> + Add New </a>
                        </span>
                    </div>
                    <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: 0 0 ">
                        <p>
                            1. 7th floor Ladproa 19,
                            Ladproa Road , Chatuchak , Bangkok , THA Zipcode 10900
                        </p>
                        <p>
                            2. 7th floor Ladproa 19,
                            Ladproa Road , Chatuchak , Bangkok , THA Zipcode 10900
                        </p>
                        <p>
                            3. 7th floor Ladproa 19,
                            Ladproa Road , Chatuchak , Bangkok , THA Zipcode 10900
                        </p>
                    </div>
                    <!-- Default Payment Method -->
                    <div class="bs-example" data-example-id="btn-tags" style="background-color:#3cc; height:45px;  padding: 10px 12px; margin-top: 20px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
                        <span style="float: left; width: 70%; text-align: left;">Default Payment Method</span>
                        <span style="float: left; width: 30%; text-align: right;">
                            <a href="<?php echo Yii::$app->homeUrl; ?>profile/add-payment-method" style="color: #fff;">+ Add New</a>
                        </span>
                    </div>
                    <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: 0 0; ">
                        <p class="col-lg-6 col-md-6 col-sm-6 text-left" style="padding: 6px 12px;">
                            <img src="<?php echo Yii::$app->homeUrl; ?>images/payment-method/payment_method_master_card-48.png" class="img-responsive">
                        </p>
                        <p class="col-lg-6 col-md-6 col-sm-6 text-right">
                            <span class="profile-title">Change</span>
                        </p>
                        <p>
                            &nbsp;
                        </p>
                    </div>

                </div><!-- col-lg-4 col-md-4 post -->

            </div>
        </div>
    </section><!--Blog Sidebar Left Close-->

</div>
<?php echo $this->render('_footer'); ?>
<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
