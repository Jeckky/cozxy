<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Tile-->
<?php if (count($model->productId) > 0) { ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="tile">
            <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId]) ?>">
                <?php
                if (count($model->productImages[0]->image) > 0) {
                    ?>
                    <img src="<?php echo Yii::$app->homeUrl . $model->productImages[0]->image; ?>" alt="1" class="img-responsive">
                <?php } else { ?>
                    <img src="<?php echo Yii::$app->homeUrl; ?>/images/ContentGroup/DUHWYsdXVc.png" alt="1" class="img-responsive"/>
                <?php } ?>
                <?php echo $model->title; ?>
            </a>
            <span class="tile-overlay"></span> 
        </div>
    </div>
<?php } else { ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        &nbsp;
    </div>
<?php } ?>