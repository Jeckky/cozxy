<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->homeUrl; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "sub Title" ?></a></li>
    <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></a></li>
</ol><!--Breadcrumbs Close-->

<!--Content-->
<div class="coming-soon">

    <section class="container">
        <!--Logo-->
        <!--<a class="logo" href="<?php echo $baseUrl; ?>"><img src="<?php echo Yii::$app->homeUrl; ?>images/logo/costfit.png" alt="cost.fit"></a>-->

        <!--Text-->
        <h1 class="text-center">Thank You</h1>
        <h3 class="text-center">for your registration</h3>
        <!--Countdown Widget-->
        <div class="countdown">
            <h3>We go live in:</h3>
            <div class="social-bar-cost-fit text-center">
                <a href="#" target="_blank"><i class="fa fa-tumblr-square"></i></a>
                <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
            </div>
        </div><!--Countdown Widget Close-->
        <!--Social Bar-->

    </section>

</div><!--Content Close-->
