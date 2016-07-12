<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style>
    .bs-callout-warning {
        border-left-color: #aa6708;
    }
    .bs-callout {
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #eee;
        /* border-left-width: 5px; */
        border-radius: 3px;
    }
    .profile-title-head{
        color: #000;
    }
    .profile-title{
        color: #3cc;
    }
    .profile-title-taglines{
        color: #000000;
    }
    .profile-title-button{
        color: #fff;
    }

    .input-group-addon , .reveal_current , .reveal_new , .reveal_re  {
        padding: 6px 12px;
        font-size: 1em;
        font-weight: normal;
        line-height: 1;
        color: #ffffff;
        text-align: center;
        background-color: #3cc;
        border: 0px solid #fff;
        border-radius: 0;
    }

    .highlight_bg {
        background-color: #fff; /*  #3cc; */
    }

</style>

<div class="row cs-page">
    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
        <h2 class="title">Hello , Sukanyaa Nithi</h2>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <h4 class="profile-title-head">
                <span class="profile-title-head">FREE MEMBERSHIP</span>
            </h4>
            <p>Member since Apr 9,2016</p>
            <hr>
            <p class="col-lg-6 col-md-6 col-sm-6 text-left" style="padding-left: 0px;">You've Saved</p>
            <p class="col-lg-6 col-md-6 col-sm-6 text-right">THB 2,000.00</p>
            <br>
        </div>

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <p class="col-lg-6 col-md-6 col-sm-6 text-left" style="padding-left: 0px;">Contact Information</p>
            <p class="col-lg-6 col-md-6 col-sm-6 text-right">
                <span class="profile-title">Edit</span>
            </p>
            <p>Name : xxxxxx</p>
            <p>Email : xxxxxx</p>
            <hr>
            <h5>
                <span class="profile-title-head">Password</span>
            </h5>
            <p>
                <small>Current Password</small>
            </p>
            <p>
            <div class="input-group">
                <input type="password" class="form-control pwd1" name="current-password" id="current-password" placeholder="Current Password" required="">
                <span class="input-group-addon">
                    <button class="reveal_current" type="button">
                        <span class="reveal-title-current">Show</span>
                    </button>
                </span>
            </div>
            </p>
            <p>
                <small>New Password</small>
            </p>
            <form>
                <p>
                <div class="input-group">
                    <input type="password" class="form-control pwd2" name="new-password" id="new-password" placeholder="New Password" required="">
                    <span class="input-group-addon">
                        <button class="reveal_new" type="button">
                            <span class="reveal-title-new">Show</span>
                        </button>
                    </span>
                </div>
                </p>
                <p>
                    <small>Re Enter New Password</small>
                </p>
                <p>
                <div class="input-group">
                    <input type="password" class="form-control pwd3" name="re-password" id="re-password" placeholder="Re Enter New Password" required="">
                    <span class="input-group-addon">
                        <button class="reveal_re" type="button">
                            <span class="reveal-title-re">Show</span>
                        </button>
                    </span>
                </div>
                </p>
                <p>
                <div class="input-group">
                    <button class="btn btn-primary" type="submit" style="background-color: #3cc; color: #fff;">
                        Update Password
                    </button>
                </div>
                </p>
            </form>

        </div>

    </div><!-- Zone left --> 

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="bs-example" data-example-id="btn-tags" style="background-color:#3cc; height:45px;  padding: 10px 12px; margin-top: 20px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
            <span style="float: left; width: 70%; text-align: left;">Default Shopping Assress</span>
            <span style="float: left; width: 30%; text-align: right;">
                + Add New
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

        <div class="bs-example" data-example-id="btn-tags" style="background-color:#3cc; height:45px;  padding: 10px 12px; margin-top: 20px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
            <span style="float: left; width: 70%; text-align: left;">Default Payment Method</span>
            <span style="float: left; width: 30%; text-align: right;">
                + Add New
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
    </div><!-- Zone Right -->

</div>

