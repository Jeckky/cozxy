<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Tile-->
<?php
if (isset($model)) {
    ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="tile">
            <?php
            $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $model->productSuppId)->orderBy('ordering asc')->one();
            $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $model->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
            ?>
            <div class="price-label"  style="background-color: red !important;">
                <?php if ($productPrice->price > 0): ?>
                    <span class="sale pull-right" style="background-color: red !important;"><?php echo number_format($productPrice->price, 2); ?> <i class="fa fa-star"></i></span>
                <?php endif; ?>
                <?php // if (common\models\costfit\Product::isSmartItem($model->productId)):  ?>
    <!--<br><span class="sale" style="background-color: #d2d042 !important;">SMART</span>-->
                <?php // endif;  ?>
            </div>
            <img src="<?= (isset($productImages->image)) ? Yii::$app->homeUrl . $productImages->image : Yii::$app->homeUrl . "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1"/>
            <span class="tile-overlay"></span>
            <div class="footer" id="products-popular-footer" style="max-height: 320px;min-height: 80px;">
                <span>
                    <small>in <?php echo $model->category->title; ?></small>
                </span>
                <div style="height:60px;">
                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId]) ?>"><?= substr($model->title, 0, 35); ?> </a>
                </div>

                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId]) ?>"><button class="btn btn-primary btn-sm">view</button></a>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        &nbsp;
    </div>
<?php } ?>