<?php

use common\helpers\Base64Decode;
?>
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="product-box">
        <div class="product-img text-center">
            <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>">
                <img src="<?= isset($model->product) ? $model->product->productImageThumbnail() : Base64Decode::DataImageSvg('Svg260x260') ?>" alt="" class="fullwidth img-responsive" style="width: 260px; height: 260px;">
            </a>
        </div>
        <div class="product-txt">
            <?php $pid = $model->product; ?>
            <p class="brand">
                <span class="size14"><?= strtoupper($model->product->brand->title) ?></span>
            </p>
            <p class="name" style="height:40px;">
                <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>" class="size18 b"><?= strtoupper($model->title) ?></a>
            </p>
        </div>
        <div class="row text-center">
            <div class="col-md-6"><i class="fa fa-eye"></i> <?= $model->averageStar() ?></div>
            <div class="col-md-6"><i class="fa fa-star"></i> <?= $model->countView() ?></div>
            <p>&nbsp;</p>
        </div>
    </div>
</div>