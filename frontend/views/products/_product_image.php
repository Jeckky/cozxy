<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
//$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="prod-gal master-slider" id="prod-gal">
    <?php
//    throw new \yii\base\Exception(count($model->productImages));
    foreach ($model->productImages as $image) {
        // รูปภาพ default : /cost.fit/assets/img/catalog/product-gallery/th_1.jpg
        ?>
        <div class="ms-slide">
            <img src="<?php echo Yii::$app->homeUrl . $image->image; ?>" data-src="<?php echo Yii::$app->homeUrl . $image->image; ?>" alt="<?= $image->title ?>" class="img-responsive img-thumbnail"/>
            <?php
            //echo 'imageThumbnail2 : ' . count($image->imageThumbnail2);
//            throw new \yii\base\Exception(Yii::$app->basePath . "/web/" . $image->imageThumbnail1);
//            throw new \yii\base\Exception(Yii::$app->homeUrl);
            if (isset($image->imageThumbnail1) && !empty($image->imageThumbnail1)) {
                if (file_exists(Yii::$app->basePath . "/web/" . $image->imageThumbnail1)) {
                    echo "<img class=\"ms-thumb\" src=\" " . Yii::$app->homeUrl . $image->imageThumbnail1 . "  \" alt=\"1\" class=\"img-responsive img-thumbnail\"/>";
                } else {
                    echo "<img  class=\"ms-thumb\"  src=\"" . Yii::$app->homeUrl . "images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" width=\"137\" height=\"130\" class=\"img-responsive img-thumbnail\"/>";
                }
            } else {
//                throw new \yii\base\Exception(111);
                ?>
                <img class="ms-thumb" src="<?php echo Yii::$app->homeUrl . "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1" width="137" height="130" class="img-responsive img-thumbnail"/>
            <?php } ?>
        </div>
        <?php
    }
    ?>
</div>
