<?php

use common\helpers\Base64Decode;
?>
<div class="col-md-4 col-sm-6 col-xs-6 box-product">
    <div class="product-box" style="padding-right: 0px; padding-left: 0px;">
        <div class="product-img text-center">
            <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>">
                <img class="media-object fullwidth img-responsive" src="<?= isset($model->product) ? \Yii::$app->homeUrl . $model->product->productImageThumbnail() : Base64Decode::DataImageSvg('Svg260x260') ?>" >
            </a>
        </div>
        <div class="product-txt">
            <?php $pid = $model->product; ?>
            <p class="brand">
                <span class="size14"><?= isset($model->product->brand->title) ? strtoupper($model->product->brand->title) : 'NO BRAND' ?></span>
            </p>
            <p class="name">
                <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>" class="size18 b"><?= strtoupper($model->title) ?></a>
            </p>
        </div>
        <div class="row text-center">
            <div class="col-md-4 col-sm-6 col-xs-6"><i class="fa fa-eye"></i> <?= $model->countView() ?></div>
            <div class="col-md-4 col-sm-6 col-xs-6"><i class="fa fa-star"></i> <?= $model->averageStar() ?></div>
            <p>&nbsp;</p>
        </div>
        <br>
    </div>
</div>