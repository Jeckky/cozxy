<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;

//use kartik\;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$createDateTime = $this->context->dateThai(Yii::$app->user->identity->createDateTime, 1);
?>

<div class="row cs-page">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <h4 class="profile-title-head">
                <span class="profile-title-head">Reviews </span>
            </h4>

            <hr>

            <br>
        </div>

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">


        </div>
    </div><!-- Zone left -->

</div>

