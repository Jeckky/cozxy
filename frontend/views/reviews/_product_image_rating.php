<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
//$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="master-slider-reviews" id="prod-gal-reviews">
    <?php
    //$images = \common\models\costfit\ProductSuppliers::productImagesSuppliers($productSupplierId);
    $images = \common\models\costfit\ProductImageSuppliers::find()->where("productSuppId=" . $productSupplierId . " and status=1")->orderBy("ordering ASC")->one();

    if (count($images->attributes) > 0) {
        ?>
        <div class="ms-slide-reviews col-lg-12 col-md-12 text-center">
            <center>
                <img  src="<?php echo Yii::$app->homeUrl . $images['image']; ?>" data-src="<?php echo Yii::$app->homeUrl . $images['image']; ?>" alt="" class="img-responsive"/>
            </center> 
        </div>
        <?php
    } else {
        echo "<img  class=\"ms-thumb\"  src=\"" . Yii::$app->homeUrl . "images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" width=\"137\" height=\"130\" class=\"img-responsive\"/>";
    }
    ?>
</div>
