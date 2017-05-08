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
            ?>
            <div style="height: 228px; width: 100%;">
                <img src="<?= (isset($productImages->image)) ? $productImages->image : Yii::$app->homeUrl . "images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1"/>
            </div>
            <span class="tile-overlay"></span>
            <div class="footer" id="products-popular-footer" style="max-height: 320px;min-height: 80px;">
                <span>
                    <small>in <?php echo $model->category->title; ?> by <?php echo $model->brand->title; ?></small>
                </span>
                <div style="height: 60px;">
                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId]) ?>"><?= substr($model->title, 0, 35); ?></a>
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