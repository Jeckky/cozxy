<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>
    <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "subTitle" ?></a></li>
    <li><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></li>
</ol><!--Breadcrumbs Close-->

<!--Shopping Cart Message-->
<section class="cart-message">
    <i class="fa fa-check-square"></i>
    <p class="p-style3">"Nikon" was successfully added to your cart.</p>
    <a class="btn-outlined-invert btn-black btn-sm" href="shop-single-item-v2.html">View cart</a>
</section><!--Shopping Cart Message Close-->

<!--Catalog Single Item-->
<section class="catalog-single">
    <div class="container">
        <div class="row">
            <?php echo $this->render('product_catalog_item', ['model' => $model]); ?>
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
    <div class="tab-content">
        <?php echo $this->render('product_tabs_widget', ['model' => $model]); ?>
    </div>
</section><!--Tabs Widget Close-->

<!--Special Offer-->
<section class="special-offer">
    <?php echo $this->render('product_special_offer'); ?>
</section><!--Special Offer Close-->

<!--Brands Carousel Widget-->

<?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
