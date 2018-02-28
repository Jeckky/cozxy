<?php

use common\helpers\Base64Decode;

$UserAgent = common\helpers\GetBrowser::UserAgent();
if ($index == 0) {
    $active = 'active';
} else {
    $active = '';
}
?>
<div class="swiper-slide">
    <div class="">
        <div class="product-box box-product">
            <div class="product-img text-center">
                <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>">
                    <img class="media-object fullwidth img-responsive" src="<?= isset($model->product) ? \Yii::$app->homeUrl . $model->product->productImageThumbnail() : Base64Decode::DataImageSvg('Svg260x260') ?>">
                    <!--<img class="media-object fullwidth img-responsive" src="/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/gWYeDn5aopSZD5PWhMJdRbrVAC_6wNVa.jpg">-->
                </a>
            </div>
            <div class="product-txt text-left">
                <?php $pid = $model->product; ?>
                <p class="brand">
                    <span class="<?= ($UserAgent != 'mobile') ? 'size12' : 'size10' ?>"><?= isset($model->product->brand->title) ? strtoupper($model->product->brand->title) : 'NO BRAND' ?></span>
                </p>
                <p class="name">
                    <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>" class="<?= ($UserAgent != 'mobile') ? 'size14 b' : 'size12' ?>">
                        <?= isset($model->title) ? (strlen(strtoupper($model->title)) <= 40) ? strtoupper($model->title) : substr(strtoupper($model->title), 0, 40) : '' ?>

                    </a>
                </p>
                <br>
            </div>
        </div>
    </div>
</div>