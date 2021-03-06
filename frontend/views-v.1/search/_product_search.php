<?php

use common\models\costfit\ProductSuppliers;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
// throw new \yii\base\Exception(print_r($model->attributes, true));
//echo 'products id : ' . $model->productId . '<br>';
?>

<!--Tile-->
<?php
if (isset($model->productId)) {
    ?>
    <div id="products-category-searc" class="col-lg-3 col-md-4 col-sm-12 ">
        <div class="tile">
            <div class="badges">
                <!--<span class="sale">Sale</span>-->
                <?php
                if (common\models\costfit\Product::isSmartItem($model->productId)):
                    ?>
                    <br><span class="sale" style="background-color: #d2d042 !important;">SMART</span>
                    <?php
                endif;
                $price = ProductSuppliers::productPrice($model->productSuppId);
                // throw new \yii\base\Exception($model->productId);
                ?>
            </div>
            <?php if ($price > 0) { ?><div class="price-label"><?= isset($price) ? number_format($price, 2) : "Not Set"; ?> ฿</div><?php } ?>
            <div style="height: 294px;">
                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId]) ?>" style="/*min-height: 210px; max-height: 210px;*/">
                    <?php
                    $image = ProductSuppliers::productImageSuppliers($model->productSuppId);
                    //throw new \yii\base\Exception($image);
                    if (isset($image) && !empty($image)):
                        $filename = $image;
                        if (file_exists($filename)) {
                            echo "<img class=\"ms-thumb\" src=\" " . Yii::$app->homeUrl . $image . "  \" alt=\"1\" class=\"img-responsive\"/>";
                        } else {
                            echo "<img  class=\"ms-thumb\"  src=\"" . $baseUrl . "/images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" class=\"img-responsive\"/>";
                        }
                    else:
                        ?>
                        <img src="<?php echo $baseUrl; ?>/images/ContentGroup/DUHWYsdXVc.png" alt="1" class="img-responsive"/>
                    <?php endif; ?>
                    <span class="tile-overlay"></span>
                </a>
            </div>

            <div class="footer search-category-footer">
                <span>
                    <small>in <?php
                        $brand = common\models\costfit\Brand::find()->where('brandId=' . $model->brandId)->one();
                        echo isset($brand) ? $brand->title : "";
                        ?></small>
                </span>
                <div class="" style="height: 60px;">
                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId]) ?>">
                        <?= substr($model->title, 0, 35);
                        ?></a>
                </div>
                <span><?php //= $model->shortDescription;           ?></span>
                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId]) ?>"><button class="btn btn-primary" id="addItemToCart"><i class="fa fa-search"></i>View</button></a>
            </div>
        </div>
    </div>
    <?php
}
?>