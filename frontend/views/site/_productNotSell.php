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
            $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $model->productSuppId)->orderBy('productImageId asc')->all();
            ?>
            <img src="<?= (isset($productImages->image)) ? Yii::$app->homeUrl . $productImages->image : Yii::$app->homeUrl . "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1"/>
            <span class="tile-overlay"></span>
            <div class="footer" id="products-popular-footer" style="max-height: 320px;min-height: 80px;">
                <div style="height: 60px;">
                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId]) ?>"><?= substr($model->title, 0, 40); ?></a>
                </div>
                <span>
                    <small>in <?php echo $model->category->title; ?></small>
                </span>
                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId]) ?>"><button class="btn btn-primary btn-sm">view</button></a>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        &nbsp;
    </div>
<?php } ?>