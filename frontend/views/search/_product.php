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
    <div id="products-category-searc" class="col-lg-4 col-md-6 col-sm-12 ">
        <div class="tile">
            <div class="badges">
                <span class="sale">Sale</span>
                <?php
                if (common\models\costfit\Product::isSmartItem($suppliers->productId)):
                    ?>
                    <br><span class="sale" style="background-color: #d2d042 !important;">SMART</span>
                    <?php
                endif;
                $price = ProductSuppliers::productPrice($suppliers->productSuppId);
                // throw new \yii\base\Exception($suppliers->productId);
                ?>
            </div>
            <?php if ($price > 0) { ?><div class="price-label"><?= isset($price) ? number_format($price, 2) : "Not Set"; ?> ฿</div><?php } ?>
            <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $suppliers->productId, 'productSupplierId' => $suppliers->productSuppId]) ?>" style="/*min-height: 210px; max-height: 210px;*/">
                <?php
                $image = ProductSuppliers::productImageSuppliers($suppliers->productSuppId);
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
            <div class="footer search-category-footer">
                <div class="" style="max-height: 50px; min-height: 50px;">
                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $suppliers->encodeParams(['productId' => $suppliers->productId, 'productSupplierId' => $suppliers->productSuppId]) ?>">
                        <?= substr($suppliers->title, 0, 40);
                        ?></a>
                </div>
                <span><?php //= $model->shortDescription;            ?></span>
                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $suppliers->encodeParams(['productId' => $suppliers->productId, 'productSupplierId' => $suppliers->productSuppId]) ?>"><button class="btn btn-primary" id="addItemToCart"><i class="fa fa-search"></i>View</button></a>
            </div>
        </div>
    </div>
    <?php
}
?>