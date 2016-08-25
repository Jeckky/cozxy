<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Tile-->
<?php if (count($model->productId) > 0) { ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="tile">
            <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId]) ?>">
                <img src="<?php echo Yii::$app->homeUrl . $model->productImages[0]->imageThumbnail1; ?>" alt="1" class="img-responsive"></a>
            <span class="tile-overlay"></span>
            <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $model->encodeParams(['productId' => $model->productId]) ?>"><?php echo $model->title; ?></a>
        </div>
    </div>
<?php } else { ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        &nbsp;
    </div>
<?php } ?>