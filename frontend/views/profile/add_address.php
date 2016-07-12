<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <p class="col-lg-12 col-md-12 col-sm-12 text-left" style="padding-left: 0px;">Default shipping address</p>

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
        <button type="submit" class="btn btn-primary">Add Address</button>
    </form>

</div>
