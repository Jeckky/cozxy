<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//echo '<pre>';
?>
<div class="col-lg-12 col-md-12" id="productImage" style="position: relative;  padding-right: 0px; padding-left: 0px;">
    <div class="prod-gal master-slider ms-wk" id="prod-gal" style="margin: 0px; visibility: visible; opacity: 1;">

        <div class="ms-container">
            <div class="ms-inner-controls-cont" style="max-width: 550px;">
                <div class="ms-view ms-fade-view ms-grab-cursor" style="width: 550px; height: 484px;">
                    <div class="ms-slide-container">
                        <?php
                        $num = 0;
                        foreach ($model->productImages as $image) {
                            // รูปภาพ default : /cost.fit/assets/img/catalog/product-gallery/th_1.jpg
                            ?>
                            <div class="ms-slide <?php if ($num == 0) { ?>ms-sl-selected <?php } ?> " style="width: 550px; height: 484px; <?php if ($num == 0) { ?>opacity: 1 <?php } else { ?> opacity: 0 <?php } ?>;  <?php if ($num != 0) { ?> visibility: hidden; <?php } ?>">
                                <div class="ms-slide-bgcont" style="height: 100%; opacity: 1;">
                                    <img src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="<?php echo Yii::$app->homeUrl . $image->image; ?>" alt="<?= $image->title ?>" style="height: 484px; width: 691.429px; margin-top: 0px;margin-left: -70.5px;"/>
                                </div>
                            </div>
                            <?php
                            $num = ++$num;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="ms-thumb-list ms-dir-h ms-align-bottom" style="margin-top: 15px; position: relative; height: 130px;">
            <div class="ms-thumbs-cont" style="width: 959px;">
                <?php
                $num = 0;
                foreach ($model->productImages as $image) {
                    if (isset($image->imageThumbnail2)) {
                        $imageThumb = $image->imageThumbnail2;
                    } else {
                        $imageThumb = '/images/ContentGroup/DUHWYsdXVc.png';
                    }
                    ?>
                    <div class="ms-thumb-frame <?php if ($num == 0) { ?>ms-thumb-frame-selected<?php } ?>" style="width: 137px; height: 130px; margin-right: 0px;">
                        <img class="ms-thumb" src="<?php echo Yii::$app->homeUrl . $imageThumb; ?>" data-src="<?php echo Yii::$app->homeUrl . $image->imageThumbnail2; ?>" alt="1" width="137" height="130">
                        <div class="ms-thumb-ol"></div>
                    </div>
                    <?php
                    $num = ++$num;
                }
                ?>
            </div>

        </div>



    </div>

</div>













