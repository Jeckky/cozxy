<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="row cs-page">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <h4 class="profile-title-head">
                <span class="profile-title-head">FREE MEMBERSHIP</span>
            </h4>
            <p>Member since <span style="color: #03a9f4;"><?php echo Yii::$app->user->identity->createDateTime; ?></span><!--Apr 9,2016 --></p>
            <hr>
            <p class="col-lg-6 col-md-6 col-sm-6 text-left" style="padding-left: 0px;">You've Saved</p>
            <p class="col-lg-6 col-md-6 col-sm-6 text-right">THB 0.00</p>
            <br>
        </div>

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <p class="col-lg-6 col-md-6 col-sm-6 text-left" style="padding-left: 0px;">Contact Information</p>
            <p class="col-lg-6 col-md-6 col-sm-6 text-right">
                <span class="profile-title"><a href="<?php echo Yii::$app->homeUrl ?>profile/edit-info">Edit</a></span>
            </p>
            <p>Name : <?php echo Yii::$app->user->identity->firstname . '&nbsp;' . Yii::$app->user->identity->lastname ?></p>
            <p>Email : <?php echo Yii::$app->user->identity->email; ?></p>
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

</div>

