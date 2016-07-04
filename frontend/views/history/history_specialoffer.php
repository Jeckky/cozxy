<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

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
                <a href="#">
                    <img src="<?php echo $directoryAsset; ?>/img/offers/special-offer.png" alt="Special Offer"/>
                    <span class="tile-overlay"></span>
                </a>
                <div class="footer"><a href="#">The Buccaneer</a></div>
            </div>
        </div>
        <!--Tile-->
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="tile">
                <div class="price-label">715,00 $</div>
                <a href="#">
                    <img src="<?php echo $directoryAsset; ?>/img/offers/special-offer.png" alt="Special Offer"/>
                    <span class="tile-overlay"></span>
                </a>
                <div class="footer"><a href="#">The Buccaneer</a></div>
            </div>
        </div>
        <!--Tile-->
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="tile">
                <div class="price-label">715,00 $</div>
                <a href="#">
                    <img src="<?php echo $directoryAsset; ?>/img/offers/special-offer.png" alt="Special Offer"/>
                    <span class="tile-overlay"></span>
                </a>
                <div class="footer"><a href="#">The Buccaneer</a></div>
            </div>
        </div>
        <!--Tile-->
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="tile">
                <div class="price-label">715,00 $</div>
                <a href="#">
                    <img src="<?php echo $directoryAsset; ?>/img/offers/special-offer.png" alt="Special Offer"/>
                    <span class="tile-overlay"></span>
                </a>
                <div class="footer"><a href="#">The Buccaneer</a></div>
            </div>
        </div>

    </div>
</div>