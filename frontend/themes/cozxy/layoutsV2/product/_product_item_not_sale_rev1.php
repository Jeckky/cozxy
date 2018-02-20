<?php

use yii\bootstrap\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductShelf;
use yii\helpers\Url;
use common\helpers\Base64Decode;
use common\helpers\CozxyCalculatesCart;

if (Yii::$app->controller->id == 'product') {
    $width = "width: 195px";
    $height = "height: 195px";
} else {
    $width = "width: 260px";
    $height = "height: 260px";
}
$marketPrice = isset($model->product) ? $model->product->price : 0;
$supplierPrice = isset($model->price) ? $model->price : 0;
$DiscountProduct = CozxyCalculatesCart::DiscountProduct($marketPrice, $supplierPrice);
//GetBrowser::UserAgent() == 'computer'
//print_r($model);

if ($index == 0) {
    $active = 'active';
} else {
    $active = '';
}
?>
<div class="item <?= $active ?>">
    <div class="col-md-2 col-sm-4 col-xs-4 box-product-items">
        <div class="box-product">
            <div class="product-box">

                <div class="product-img text-center">
                    <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->productId])) ?>" class="fc-black" style=" min-height: 256px; max-height: 256px;">
                        <img class="media-object fullwidth img-responsive" src="<?= \Yii::$app->homeUrl . $model->productImageThumbnail() ?>">
                    </a>
                    <div class="v-hover">
                        <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->productId])) ?>">
                            <div class="col-xs-6"><i class="fa fa-eye" aria-hidden="true"></i></div>
                        </a>
                        <?php
                        if (Yii::$app->user->id) {
                            if ($model->isInWishlist() == 1) { // เคย wishList ไปแล้ว
                                ?>
                                <a href="javascript:addItemToDefaultWishlist(<?= $model->productId ?>);">
                                    <div class="col-xs-6 heart-<?= $model->productId ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                                </a>
                            <?php } else { ?>
                                <a href="javascript:addItemToDefaultWishlist(<?= $model->productId ?>);" id="heartbeat-<?= $model->productId ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                                    <div class="col-xs-6 heart-<?= $model->productId ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                                </a>
                                <a href="javascript:addItemToDefaultWishlist(<?= $model->productId ?>);" id="heart-o-<?= $model->productId ?>">
                                    <div class="col-xs-6 heart-<?= $model->productId ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                                </a>
                                <?php
                            }
                        } else {
                            ?>
                            <a href="<?= Yii::$app->homeUrl . 'site/login' ?>" >
                                <div class="col-xs-4"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="product-txt">
                    <p class="brand" >
                        <span class="size14"><?= isset($model->brand) ? strtoupper($model->brand->title) : 'NO BRAND' ?></span>
                    </p>
                    <p class="name">
                        <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->productId])) ?>" class="size18 b"><?= strtoupper($model['title']) ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
