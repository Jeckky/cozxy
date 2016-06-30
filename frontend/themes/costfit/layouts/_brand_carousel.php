<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Brands Carousel Widget-->
<section class="brand-carousel">
    <div class="container">
        <h2>Brands in our shop</h2>
        <div class="inner">
            <?php for ($index = 0; $index <= 10; $index++) {
                ?>
                <a class="item" href="#"><img src="<?php echo $baseUrl; ?>/images/brands-carousel/18.jpg" alt="" title="ขนาด : 164x120" class="img-responsive"/></a>
                    <?php
                    $index = $index++;
                }
                ?>
        </div>
    </div>
</section><!--Brands Carousel Close-->