<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Tile-->
<?php
if (count($model->product) > 0) {
    ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="tile">
            <div class="badges" >
                <span class="sale" style="background-color: red !important;"><i class="fa fa-star"></i> HOT <i class="fa fa-star"></i></span>
                <?php // if (common\models\costfit\Product::isSmartItem($model->productId)):  ?>
                    <!--<br><span class="sale" style="background-color: #d2d042 !important;">SMART</span>-->
                <?php // endif;  ?>
            </div>
            <div class="price-label" ><?php echo $model->price// number_format($model->calProductPrice($model->productId, 1, 0, 1), 2)    ?> ฿</div>

            <img src="<?= (isset($model->images[0])) ? $baseUrl . $model->images[0]->image : Yii::$app->homeUrl . "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1"/>
            <span class="tile-overlay"></span>

            <div class="footer" id="products-popular-footer" style="max-height: 320px;min-height: 80px;">
                <a href="<?php echo $baseUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productId]) ?>"><?//= $model->title; ?></a>
                <span>
                    <small>in <?php //echo $model->category->title;        ?></small>
                </span>
                <a href="<?php echo $baseUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productId]) ?>"><button class="btn btn-primary btn-sm">view</button></a>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        &nbsp;
    </div>
<?php } ?>