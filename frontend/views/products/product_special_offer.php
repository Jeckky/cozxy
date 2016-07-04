<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="container">
    <h2>Special offer</h2>
    <div class="row">
        <!--Tile-->
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="tile">
                <div class="price-label">715,00 $</div>
                <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888"><img src="<?php echo $baseUrl; ?>/images/ProductImage/tv5.jpg" alt="Special Offer" title="ขนาดรูป : 260x215"/></a>
                <div class="footer"><a href="<?php echo $directoryAsset; ?>/img/offers/special-offer.png">VIZIO UItra HD</a></div>
            </div>
        </div>
        <!--Plus-->
        <div class="col-lg-1 col-md-1 col-sm-1">
            <div class="sign">+</div>
        </div>
        <!--Tile-->
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="tile">
                <div class="price-label">715,00 $</div>
                <a href="#"><img src="<?php echo $directoryAsset; ?>/img/offers/special-offer.png" alt="Special Offer"/></a>
                <div class="footer"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888">The Buccaneer</a></div>
            </div>
        </div>
        <!--Equal-->
        <div class="col-lg-1 col-md-1 col-sm-1">
            <div class="sign">=</div>
        </div>
        <!--Offer-->
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="offer">
                <h3 class="light-color">save</h3>
                <h4 class="text-primary">100,00 $</h4>
                <a class="btn btn-primary" href="<?php echo Yii::$app->homeUrl; ?>cart">Buy for 1200$</a>
            </div>
        </div>
    </div>
</div>