<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//echo '<pre>';
?>

<link href="/cost.fit-frontend/assets/243cd55c/masterslider/style/masterslider.css" rel="stylesheet">
<div class="col-lg-12 col-md-12" id="productImage" style="position: relative;  padding-right: 0px; padding-left: 0px;">
    <div class="prod-gal master-slider ms-wk" id="prod-gal" style="margin: 0px; visibility: visible; opacity: 1;">
        <div class="ms-display-template">
            <div class="ms-display-cont">
                <!--<img src="images/display.png" class="ms-display-bg" />-->
                <div class="ms-dis-slider-cont">
                    <!-- masterslider -->
                    <div class="master-slider ms-skin-default" id="masterslider">
                        <?php
                        $num = 0;
                        foreach ($model->productImages as $image) {
                            // รูปภาพ default : /cost.fit/assets/img/catalog/product-gallery/th_1.jpg
                            ?>
                            <div class="ms-slide">
                                <img src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="images/1.jpg" alt="lorem ipsum dolor sit"/>
                            </div>
                            <?php
                            $num = ++$num;
                        }
                        ?>
                    </div>
                    <div class="master-slider ms-skin-default" id="mastersliderThumb">
                        <?php
                        $num = 0;
                        foreach ($model->productImages as $image) {
                            // รูปภาพ default : /cost.fit/assets/img/catalog/product-gallery/th_1.jpg
                            ?>
                            <div class="ms-slide">
                                <img src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="images/1.jpg" alt="lorem ipsum dolor sit"/>
                            </div>
                            <?php
                            $num = ++$num;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Master Slider -->
        <script src="/cost.fit-frontend/assets/243cd55c/js/plugins/masterslider.min.js"></script>
        <script type="text/javascript">

            var slider = new MasterSlider();
            slider.setup('masterslider', {
                width: 553,
                height: 484,
                speed: 20,
                preload: 0,
                space: 2,
                view: 'flow'
            });
            slider.control('arrows');
            slider.control('bullets', {autohide: false});

            var slider2 = new MasterSlider();
            slider2.setup('mastersliderThumb', {
                width: 137,
                height: 130,
                speed: 20,
                preload: 0,
                space: 2,
                view: 'flow'
            });
            slider2.control('arrows');
            slider2.control('bullets', {autohide: false});

        </script>
