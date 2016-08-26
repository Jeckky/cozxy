<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//echo '<pre>';
?>

<link href="/cost.fit-frontend/assets/243cd55c/masterslider/style/masterslider.css" rel="stylesheet">

<div class="col-lg-12 col-md-12" id="productImage" style="position: relative;  padding-right: 0px; padding-left: 0px;">
    <div class="prod-gal master-slider ms-wk" id="prod-gal" style="margin: 0px; visibility: visible; opacity: 1">
        <div class="ms-showcase2-template">
            <!-- masterslider -->
            <div class="master-slider ms-skin-default" id="masterslider">
                <?php
                $num = 0;
                foreach ($model->productImages as $image) {
                    // รูปภาพ default : /cost.fit/assets/img/catalog/product-gallery/th_1.jpg
                    if (isset($image->imageThumbnail2)) {
                        $imageThumb = $image->imageThumbnail2;
                    } else {
                        $imageThumb = '/images/ContentGroup/DUHWYsdXVc.png';
                    }
                    ?>
                    <div class="ms-slide">
                        <img src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="images/1.jpg" alt="lorem ipsum dolor sit"/>
                        <img class="ms-thumb" src="<?php echo Yii::$app->homeUrl . $imageThumb; ?>" data-src="<?php echo Yii::$app->homeUrl . $imageThumb ?>" alt="thumb" width="137" height="130" />
                    </div>
                    <?php
                    $num = ++$num;
                }
                ?>
            </div>
            <!-- end of masterslider -->
        </div>
    </div>
</div>
<!-- template -->

<!-- end of template -->

<!-- Master Slider -->
<script src="/cost.fit-frontend/assets/243cd55c/js/plugins/masterslider.min.js"></script>
<script type="text/javascript">

    var slider = new MasterSlider();

    slider.control('arrows');
    slider.control('thumblist', {autohide: false, dir: 'h', arrows: false, align: 'bottom', width: 127, height: 137, margin: 5, space: 5});


    slider.setup('masterslider', {
        width: 553,
        height: 484,
        space: 5,
        view: 'scale',
    });

</script>
