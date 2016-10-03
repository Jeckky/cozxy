<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//$browserAgent = $_SERVER['HTTP_USER_AGENT'];
//echo $browserAgent;
?>

<!--Brands Carousel Widget-->
<section class="brand-carousel">
    <div class="container-fluid">
        <h2>Brands in our shop</h2>
        <div class="inner">
            <?php
            $brands = common\models\costfit\Brand::find()->all();
            foreach ($brands as $brand) {
                ?>
                <a class="item" href="#"><img src="<?php echo Yii::$app->homeUrl . $brand->image; ?>" alt="" title="ขนาด : 164x120" width="164" height="120" class="img-responsive"/></a>
                    <?php
                }
                ?>
        </div>
    </div>
</section><!--Brands Carousel Close-->