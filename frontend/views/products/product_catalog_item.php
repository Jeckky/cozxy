<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Product Description-->
<div class="col-lg-6 col-md-6">
    <h1>Minaudière</h1>
    <div class="old-price">815,00 $</div>
    <div class="price">715,00 $</div>
    <div class="buttons group">
        <div class="qnt-count">
            <a class="incr-btn" href="#">-</a>
            <input id="quantity" class="form-control" type="text" value="2">
            <a class="incr-btn" href="#">+</a>
        </div>
        <a class="btn btn-primary btn-sm" id="addItemToCart" href="<?php echo Yii::$app->homeUrl; ?>cart"><i class="icon-shopping-cart"></i>Add to cart</a>
        <a class="btn btn-black btn-sm" href="#"><i class="icon-heart"></i>Add to wishlist</a>
    </div>
    <p class="p-style2">Product page was developed with the help of consultants with great and successful experience in e-commerce. It's all you need to effectively demonstrate your product. The opportunity to quickly buy a product or save it to a wishlist will definitely increase the conversion rate.</p>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-5">
            <h3>Tell friends</h3>
            <div class="social-links">
                <a href="#"><i class="fa fa-tumblr-square"></i></a>
                <a href="#"><i class="fa fa-pinterest-square"></i></a>
                <a href="#"><i class="fa fa-facebook-square"></i></a>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-7">
            <h3>Tags</h3>
            <div class="tags">
                <a href="#">Backpack</a>,
                <a href="#">Chanel</a>,
                <a href="#">Wristlet</a>
            </div>
        </div>
    </div>
    <div class="promo-labels">
        <div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-truck"></i>Free delivery</div>
        <div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-space-shuttle"></i>Deliver even on Mars</div>
        <div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-shield"></i>Safe Buy</div>
    </div>
</div>

<!--Product Gallery-->
<div class="col-lg-6 col-md-6">
    <div class="prod-gal master-slider" id="prod-gal">
        <?php
        for ($index = 0; $index <= 5; $index++) {
            // รูปภาพ default : /cost.fit/assets/img/catalog/product-gallery/th_1.jpg
            ?>
            <!--Slide1-->
            <div class="ms-slide">
                <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $baseUrl; ?>/images/ProductImage/15.jpg" alt="Lorem ipsum"/>
                <img class="ms-thumb" src="<?php echo $baseUrl; ?>/images/ProductImage/15.jpg" alt="thumb" />
            </div>
            <!--Slide2-->
            <?php
            $index = $index++;
        }
        ?>
    </div>
</div>