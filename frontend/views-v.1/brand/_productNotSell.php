<?php

use common\models\costfit\ProductSuppliers;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
// throw new \yii\base\Exception(print_r($model->attributes, true));
//echo 'products id : ' . $model->productId . '<br>';
//echo $model->productId;
?>

<!--Tile-->

<?php
if (isset($model->productId)):
    $suppliers = \common\models\costfit\Product::lowestPriceContent($model->productId);
    if ($suppliers != NULL) {//ถ้ามีใน suppliers แสดงราคาที่ถูกที่สุด(กรณีมีหลายซัพ)
        ?>
        <div id="products-category-searc" class="col-lg-3 col-md-4 col-sm-12 ">
            <div class="tile">
                <div class="badges">
                    <!--<span class="sale">Sale</span>-->
                    <?php
                    //if (common\models\costfit\Product::isSmartItem($suppliers->productId)):
                    ?>
                        <!--<br><span class="sale" style="background-color: #d2d042 !important;">SMART</span>-->
                    <?php
                    // endif;
                    $price = ProductSuppliers::productPrice($suppliers->productSuppId);
                    // throw new \yii\base\Exception($suppliers->productId);
                    ?>
                </div>
                <?php if ($price > 0) { ?><div class="price-label"><?= isset($price) ? number_format($price, 2) : "Not Set"; ?> ฿</div><?php } ?>
                <div class="img-height-cozxy" style="height: 263px; width: 100%;">
                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $suppliers->productId, 'productSupplierId' => $suppliers->productSuppId]) ?>">
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
                        <span class="tile-overlay tile-overlay-cozxy"></span>
                    </a>
                </div>
                <div class="footer search-category-footer">
                    <span>
                        <small>in <?php
                            if (isset($suppliers->brandId)) {
                                $brand = common\models\costfit\Brand::find()->where('brandId=' . $suppliers->brandId)->one();
                                if (isset($brand)) {
                                    echo $brand->title;
                                }
                            } else {

                            }
                            ?></small>
                    </span>
                    <div class="" style="height: 60px;">
                        <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $suppliers->encodeParams(['productId' => $suppliers->productId, 'productSupplierId' => $suppliers->productSuppId]) ?>">
                            <?= substr($suppliers->title, 0, 35);
                            ?></a>
                    </div>
                    <span><?php //= $model->shortDescription;                                            ?></span>
                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $suppliers->encodeParams(['productId' => $suppliers->productId, 'productSupplierId' => $suppliers->productSuppId]) ?>"><button class="btn btn-primary" id="addItemToCart"><i class="fa fa-search"></i>View</button></a>
                </div>
            </div>
        </div>
        <?php
    }
endif;
?>