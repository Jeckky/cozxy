<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style>
    .wishlist-message {
        width: 100%;
        max-width: 1140px;
        max-height: 0;
        overflow: hidden;
        margin: 12px auto 0 auto;
        padding: 0 25px;
        background: #292c2e;
        color: #fff;
        border-radius: 0;
        opacity: 0;
        transition: all .3s
    }

    .wishlist-message.visible {
        max-height: 800px;
        padding: 12px 25px;
        opacity: 1
    }

    .wishlist-message p,
    .wishlist-message i {
        display: block;
        float: left;
        line-height: 1.3;
        margin-top: 9px;
        margin-bottom: 10px;
        color: #fff
    }

    .wishlist-message i {
        margin-right: 20px
    }

    .wishlist-message a {
        display: block;
        float: right
    }

    .wishlist-message:after {
        visibility: hidden;
        display: block;
        content: "";
        clear: both;
        height: 0
    }
</style>
<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>
    <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>?productId=<?php echo $model->productId; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "subTitle" ?></a></li>

</ol><!--Breadcrumbs Close-->

<!--Shopping Cart Message-->
<section class="cart-message">
    <i class="fa fa-check-square"></i>
    <p class="p-style3">"Nikon" was successfully added to your cart.</p>
    <a class="btn-outlined-invert btn-black btn-sm" href="<?php echo Yii::$app->homeUrl; ?>cart">View cart</a>
</section><!--Shopping Cart Message Close-->

<section class="wishlist-message">
    <i class="fa fa-check-square"></i>
    <p class="p-style3">"Nikon" was successfully added to your wishlist.</p>
    <a class="btn-outlined-invert btn-black btn-sm" href="<?php echo Yii::$app->homeUrl; ?>wishlist">View Wishlist</a>
</section>

<!--Catalog Single Item-->
<section class="catalog-single">
    <div class="container" >
        <div class="row" id="productItem">
            <?php echo $this->render('product_catalog_item', ['model' => $model, 'fastDate' => $fastDate, 'fastId' => $fastId]); ?>
        </div>
    </div>
</section><!--Catalog Single Item Close-->

<!--Tabs Widget-->
<section class="tabs-widget">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#descr" data-toggle="tab">Description</a></li>
        <li><a href="#specs" data-toggle="tab">Specs</a></li>
        <li><a href="#review" data-toggle="tab">Term & Condition</a></li>
    </ul>
    <div class="tab-content" id="productTabs">
        <?php echo $this->render('product_tabs_widget', ['model' => $model]); ?>
    </div>
</section><!--Tabs Widget Close-->

<!--Special Offer-->
<section class="special-offer">
    <?php //echo $this->render('product_special_offer'); ?>
</section><!--Special Offer Close-->

<!--Brands Carousel Widget-->

<?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
<?php echo $this->render('@app/views/modal/GuestaddItemToWishlist'); ?>
