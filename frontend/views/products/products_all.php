<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$category = \common\models\costfit\Category::getRootText($model->categoryId);

//echo 'category :' . $category;
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
<ol class="breadcrumb" style="text-align: left;">
    <!--<li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>-->
    <li>
        <a href="<?php echo Yii::$app->homeUrl; ?>">Home</a> >
        <?php echo isset($category) ? $category : 'not set'; ?> >
        <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId]) ?>">
            <?= isset($this->context->subTitle) ? $this->context->subTitle : "subTitle" ?></a>
    </li>
    <!--
    <li><a href="<?php //echo Yii::$app->homeUrl . Yii::$app->controller->id;      ?>?productId=<?php //echo $model->productId;    ?>">
    <?//= isset($this->context->subTitle) ? $this->context->subTitle : "subTitle" ?></a></li>-->
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
            <?php echo $this->render('product_catalog_item', ['productPostViewMem' => $productPostViewMem, 'productPost' => $productPost, 'model' => $model, 'productSupplierId' => $productSupplierId, 'getPrductsSupplirs' => $getPrductsSupplirs, 'supplierPrice' => $supplierPrice]); ?>
        </div>
    </div>
</section><!--Catalog Single Item Close-->
<!--Special Offer-->
<section class="special-offer">
    <?//php echo $this->render('product_special_offer'); ?>
</section><!--Special Offer Close-->

<!--Brands Carousel Widget-->

<?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
<?php echo $this->render('@app/views/modal/GuestaddItemToWishlist'); ?>
