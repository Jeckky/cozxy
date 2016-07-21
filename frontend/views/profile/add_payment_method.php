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
            <label>&nbsp; 1.5% OFF</label><br>
            <small>Some rules and restrictions apply.  <a href="#">See details</a></small>
        </div>

    </div>
</div>


<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h4>Default Payment Method</h4>

    <form class="space-bottom" role="form" method="post">
        <div class="form-group">
            <label for="cs-email">Credit card number</label>
            <input type="email" class="form-control" id="cs-email" placeholder="Credit card number">
        </div>
        <div class="form-group">
            <label for="cs-password">Name on card</label>
            <input type="password" class="form-control" id="cs-password" placeholder="Name on card">
        </div>
        <div class="form-group">
            <div class="form-group col-md-6" style="padding-left: 0px;">
                <label for="cs-password">Expiration date</label>
                <input type="password" class="form-control" id="cs-password" placeholder="Expiration date">
            </div>
            <div class="form-group col-md-6" style="padding-left: 0px;">
                <label for="cs-password">Security Code</label>
                <input type="password" class="form-control" id="cs-password" placeholder="Security Code">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Payment Method</button>
    </form>

</div>
