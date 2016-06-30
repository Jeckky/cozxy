<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Brands Carousel Widget-->
<section class="brand-carousel">
    <div class="container">
        <h2>Brands in our shop</h2>
        <div class="inner">
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
        </div>
    </div>
</section><!--Brands Carousel Close-->