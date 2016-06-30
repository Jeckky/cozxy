<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Brands Carousel Widget-->
<section class="brand-carousel">
    <div class="container">
        <h2>Brands in our shop</h2>
        <div class="inner">
            <a class="item" href="#"><img src="<?php echo $baseUrl; ?>/images/brands-carousel/18.jpg" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $baseUrl; ?>/images/brands-carousel/19.jpg" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $baseUrl; ?>/images/brands-carousel/20.jpg" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $baseUrl; ?>/images/brands-carousel/21.jpg" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $baseUrl; ?>/images/brands-carousel/22.jpg" alt="1"/></a>

        </div>
    </div>
</section><!--Brands Carousel Close-->