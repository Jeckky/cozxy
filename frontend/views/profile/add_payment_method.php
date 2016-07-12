<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h4 class="profile-title-head">
        <span class="profile-title-head">All major cards accepted.</span>
    </h4>
    <div class="col-md-12">
        <div class="form-group col-md-2">
            <img src="<?php echo Yii::$app->homeUrl; ?>images/payment-method/payment_method_american_express_card-48.png" class="img-responsive">
        </div>
        <div class="form-group col-md-2">
            <img src="<?php echo Yii::$app->homeUrl; ?>images/payment-method/payment_method_discover_network_card-48.png" class="img-responsive">
        </div>
        <div class="form-group col-md-2">
            <img src="<?php echo Yii::$app->homeUrl; ?>images/payment-method/payment_method_card_visa-48.png" class="img-responsive">
        </div>
        <div class="form-group col-md-2">
            <img src="<?php echo Yii::$app->homeUrl; ?>images/payment-method/payment_method_master_card-48.png" class="img-responsive">
        </div>
    </div>
    <br>
    <h5>
        <small>Get extra savings wit</small>
    </h5>

    <div class="form-inline">
        <div class="form-group">
            <img src="<?php echo Yii::$app->homeUrl; ?>images/payment-method/direct_debit-48.png" class="img-responsive" style="display: inline-block;">
            <label>&nbsp; 1.5% OFF</label>
        </div>

    </div>
</div>

<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <p class="col-lg-12 col-md-12 col-sm-12 text-left" style="padding-left: 0px;">Default Payment Method</p>

    <form class="space-bottom" role="form" method="post">
        <div class="form-group">
            <label for="cs-email">First Name</label>
            <input type="email" class="form-control" id="cs-email" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="cs-password">Last Name</label>
            <input type="password" class="form-control" id="cs-password" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label for="cs-password">Street Address</label>
            <input type="password" class="form-control" id="cs-password" placeholder="Street Address">
        </div>
        <div class="form-group">
            <label for="cs-password">Apt., Floor, Unit (Optional) </label>
            <input type="password" class="form-control" id="cs-password" placeholder="Apt., Floor, Unit (Optional) ">
        </div>
        <div class="form-group">
            <label for="cs-password">Shipping Zip Code</label>
            <input type="password" class="form-control" id="cs-password" placeholder="Shipping Zip Code">
        </div>
        <div class="form-group">
            <label for="cs-password">Phone Number</label>
            <input type="password" class="form-control" id="cs-password" placeholder="Phone Number">
        </div>
        <button type="submit" class="btn btn-primary">Save Payment Method</button>
    </form>

</div>
