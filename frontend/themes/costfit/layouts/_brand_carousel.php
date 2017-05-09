<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//$browserAgent = $_SERVER['HTTP_USER_AGENT'];
//echo $browserAgent;
?>

<!--Brands Carousel Widget-->
<section class="brand-carousel">
    <div class="container">
        <h2>Brands in our shop</h2>
        <div class="inner">
            <?php
            $brands = common\models\costfit\Brand::find()->all();
            foreach ($brands as $brand) {
                //$params = \common\models\ModelMaster::encodeParams(['brandId' => trim($brand->brandId)]);
                //echo $brand->brandId . '<br>';
                if (file_exists(Yii::$app->basePath . "/web" . $brand->image) && !empty($brand->image)) {
                    $image = $brand->image;
                } else {
                    $image = Yii::$app->homeUrl . "images/no-image.jpg";
                }
                ?>
                <a class="" href="">
                    <img src="<?php echo $image; ?>" alt="" title="ขนาด : 164x120" width="164" height="120" class="img-responsive"/></a>
                    <?php
                }
                ?>
        </div>
    </div>
</section><!--Brands Carousel Close-->