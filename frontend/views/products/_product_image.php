<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="prod-gal master-slider" id="prod-gal">
    <?php
    foreach ($model->productImages as $image) {
        // รูปภาพ default : /cost.fit/assets/img/catalog/product-gallery/th_1.jpg
        ?> 
        <div class="ms-slide">
            <img src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="<?php echo Yii::$app->homeUrl . $image->image; ?>" alt="<?= $image->title ?>"/>
            <?php
            //echo 'imageThumbnail2 : ' . count($image->imageThumbnail2);
            if (count($image->imageThumbnail2) > 0) {
                ?>
                <img class="ms-thumb" src="<?php echo Yii::$app->homeUrl . $image->imageThumbnail2; ?>" alt="1"/>
            <?php } else { ?>
                <img class="ms-thumb" src="<?php echo $baseUrl; ?>/images/ContentGroup/DUHWYsdXVc.png" alt="1" width="137" height="130" class="img-responsive img-thumbnail"/>
            <?php } ?>
        </div>
        <?php
    }
    ?>
</div>
