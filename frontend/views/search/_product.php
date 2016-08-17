<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Tile-->
<div id="products-category-search" class="col-lg-4 col-md-6 col-sm-12">
    <div class="tile">
        <div class="search-category-badges-price">
            <div class="badges">
                <span class="sale">Sale</span>
            </div>
            <div class="price-label"><?= isset($model->productOnePrice) ? $model->productOnePrice->price : "Not Set"; ?> ฿</div>
        </div>
        <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=<?= $model->productId ?>" style="min-height: 210px; max-height: 210px;">
            <?php if (isset($model->productImages[0]->image) && !empty($model->productImages[0]->image)): ?>
                <img src="<?php echo Yii::$app->homeUrl . $model->productImages[0]->image; ?>" alt="1"/>
            <?php else: ?>
                <img src="<?php echo $baseUrl; ?>/images/ProductImage/15.jpg" alt="1"/>
            <?php endif; ?>
            <span class="tile-overlay"></span>
        </a>
        <div class="footer search-category-footer">
            <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=<?= $model->productId ?>"><?= $model->title; ?></a>
            <span><?//= $model->shortDescription; ?></span>
            <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=<?= $model->productId ?>"><button class="btn btn-primary" id="addItemToCart"><i class="fa fa-search"></i>View</button></a>

        </div>

    </div>
</div>