<?php

use common\helpers\Base64Decode;

if ($index == 0) {
    $active = 'active';
} else {
    $active = '';
}
?>
<div class="swiper-slide <?= $active ?>">
    <div class="" style="padding: 5px;">
        <div class="product-box box-product">
            <div class="product-img text-center">
                <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>">
                    <img class="media-object fullwidth img-responsive" src="<?= isset($model->product) ? \Yii::$app->homeUrl . $model->product->productImageThumbnail() : Base64Decode::DataImageSvg('Svg260x260') ?>">
                    <!--<img class="media-object fullwidth img-responsive" src="/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/gWYeDn5aopSZD5PWhMJdRbrVAC_6wNVa.jpg">-->
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
        </div>
    </div>
</div>