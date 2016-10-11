<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
// throw new \yii\base\Exception(print_r($model->attributes, true));
//echo 'products id : ' . $model->productId . '<br>';
?>

<!--Tile-->
<?php if (isset($model->productId)): ?>
    <div id="products-category-searc" class="col-lg-4 col-md-6 col-sm-12 ">
        <div class="tile">
            <div class="badges">
                <span class="sale">Sale</span>
                <?php if (common\models\costfit\Product::isSmartItem($model->productId)): ?>
                    <br><span class="sale" style="background-color: #d2d042 !important;">SMART</span>
                <?php endif; ?>
            </div>
            <div class="price-label"><?= isset($model->productOnePrice) ? $model->productOnePrice->price : "Not Set"; ?> ฿</div>
            <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $model->productId]) ?>" style="/*min-height: 210px; max-height: 210px;*/">
                <?php
                if (isset($model->productImages[0]->imageThumbnail1) && !empty($model->productImages[0]->imageThumbnail1)):
                    $filename = $model->productImages[0]->imageThumbnail1;
                    if (file_exists($filename)) {
                        echo "<img class=\"ms-thumb\" src=\" " . Yii::$app->homeUrl . $model->productImages[0]->imageThumbnail1 . "  \" alt=\"1\" class=\"img-responsive\"/>";
                    } else {
                        echo "<img  class=\"ms-thumb\"  src=\"" . $baseUrl . "/images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" class=\"img-responsive\"/>";
                    }
                else:
                    ?>
                    <img src="<?php echo $baseUrl; ?>/images/ContentGroup/DUHWYsdXVc.png" alt="1" class="img-responsive"/>
                <?php endif; ?>
                <span class="tile-overlay"></span>
            </a>
            <div class="footer search-category-footer">
                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId]) ?>"><?= $model->title; ?></a>
                <span><?//= $model->shortDescription; ?></span>
                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId]) ?>"><button class="btn btn-primary" id="addItemToCart"><i class="fa fa-search"></i>View</button></a>
            </div>
        </div>
    </div>
<?php endif; ?>