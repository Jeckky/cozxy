<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="prod-gal master-slider" id="prod-gal">
    <?php
    foreach ($model->productImages as $image) {
        // รูปภาพ default : /cost.fit/assets/img/catalog/product-gallery/th_1.jpg
        ?>
        <!--Slide1-->
        <div class="ms-slide">
            <img src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="<?php echo Yii::$app->homeUrl . $image->image; ?>" alt="<?= $image->title ?>"/>
            <img class="ms-thumb" src="<?php echo Yii::$app->homeUrl . $image->image; ?>" alt="thumb" />
        </div>
        <!--Slide2-->
        <?php
    }
    ?>
    <div class="ms-slide">
        <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $directoryAsset; ?>/img/catalog/product-gallery/1.jpg" alt="Lorem ipsum"/>
        <img class="ms-thumb" src="<?php echo $directoryAsset; ?>/img/catalog/product-gallery/th_1.jpg" alt="thumb" />
    </div>
</div>