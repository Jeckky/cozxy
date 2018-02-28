<?php

use yii\bootstrap\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductShelf;
use yii\helpers\Url;
use common\helpers\Base64Decode;
use common\helpers\CozxyCalculatesCart;

$UserAgent = common\helpers\GetBrowser::UserAgent();
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
    $active = 'clearfix d-none d-md-block';
}
?>
<div class="swiper-slide" data-id="<?= $index ?>">
    <div class="product-box box-product">
        <?php if ($DiscountProduct != 'Lessthan10') { ?>
            <div class="product-sticker" style="right: 7%;">
                <div class="rcorners4">
                    <p>
                        <?php
                        //echo Yii::$app->controller->id;
                        if (Yii::$app->controller->id == 'search') {
                            //echo 'SALE';
                            echo $DiscountProduct;
                            echo '<div class="off-style">OFF</div>';
                        } else if (Yii::$app->controller->id == 'site' || Yii::$app->controller->id == 'home') {
                            //echo 'SALE';
                            echo $DiscountProduct;
                            echo '<div class="off-style">OFF</div>';
                        } else {
                            echo 'SAVE';
                        }
                        ?></p>
                    <p><?php
                        if (Yii::$app->controller->id == 'search') {
                            //echo '-' . $DiscountProduct;
                        } else if (Yii::$app->controller->id == 'site' || Yii::$app->controller->id == 'home') {
                            //echo '-' . $DiscountProduct;
                            //echo 'OFF';
                        } else {
                            echo $DiscountProduct;
                        }
                        ?>
                    </p>
                </div>
                <div class="triangle"></div>
            </div>
        <?php } ?>
        <div class="product-img text-center">
            <?php
            //$images = common\models\costfit\ProductImage::find()->where('productId=' . $model->product->productId)->one();
            ?>
            <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->productId])) ?>" style=" min-height: 256px; max-height: 256px;">
                <img class="media-object fullwidth img-responsive" src="<?= isset($model->product) ? \Yii::$app->homeUrl . $model->product->productImageThumbnail() : Base64Decode::DataImageSvg('Svg260x260') ?>">
                  <!--<img class="media-object fullwidth img-responsive" src="https://www.cozxy.com/<?//= $images['imageThumbnail1'] ?>">-->
            </a>
            <?php
            if ($UserAgent != 'mobile') {
                ?>
                <div class="v-hover">
                    <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => isset($model->product->productId) ? $model->product->productId : $model->productId])) ?>">
                        <div class="col-xs-4"><i class="fa fa-eye" aria-hidden="true"></i></div>
                    </a>
                    <?php
                    if (Yii::$app->user->id) {
                        if (isset($model->product)) {
                            if ($model->product->isInWishlist() == 1) { // เคย wishList ไปแล้ว
                                ?>
                                <a href="javascript:addItemToDefaultWishlist(<?= $model->productId ?>);">
                                    <div class="col-xs-4 heart-<?= $model->productId ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                                </a>
                            <?php } else { ?>
                                <a href="javascript:addItemToDefaultWishlist(<?= $model->productId ?>);" id="heartbeat-<?= $model->productId ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                                    <div class="col-xs-4 heart-<?= $model->productId ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                                </a>
                                <a href="javascript:addItemToDefaultWishlist(<?= $model->productId ?>);" id="heart-o-<?= $model->productId ?>">
                                    <div class="col-xs-4 heart-<?= $model->productId ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                                </a>
                                <?php
                            }
                        }
                    } else {
                        ?>
                        <a href="<?= Yii::$app->homeUrl . 'site/login' ?>" >
                            <div class="col-xs-4"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                        </a>
                    <?php } ?>
                    <?php
                    if ($model->result > 0) {
                        if ($model->receiveType != '') {
                            $receiveType = $model->receiveType;
                        } else {
                            $receiveType = 1;
                        }
                        ?>
                        <a  href="javascript:addItemToCartUnitys('<?= $model->productSuppId ?>',1,'<?= $model->result ?>','FALSE','<?= $model->productId ?>','<?= $model->userId ?>','<?= $receiveType ?>')" id="addItemsToCartMulti-<?= $model->productSuppId ?>" data-loading-text="<div class='col-xs-4 shopping-<?= $model->productSuppId ?>'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                            <div class="col-xs-4 shopping-<?= $model->productSuppId ?>"><i id="cart-plus-<?= $model->productSuppId ?>" class="fa fa-cart-plus" aria-hidden="true"></i></div>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="product-txt text-left">
            <?php
            if ($UserAgent != 'mobile') {
                if (isset($model->product->brand->title)) {
                    ?>
                    <p class="brand">
                        <span class="<?= ($UserAgent != 'mobile') ? 'size14' : 'size10' ?>"><?= strtoupper($model->product->brand->title) ?></span>
                    </p>
                <?php } else {
                    ?>
                    <p class="brand">
                        <span class="<?= ($UserAgent != 'mobile') ? 'size14' : 'size10' ?>">NO BRAND</span>
                    </p>
                    <?php
                }
            }
            ?>
            <p class="name">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => isset($model->product->productId) ? $model->product->productId : $model->productId])) ?>" class="<?= ($UserAgent != 'mobile') ? 'size14 b' : 'size14' ?>">
                    <?= isset($model->product) ? strtoupper($model->product->title) : '' ?>
                </a>
            </p>
            <?php
            if ($model->price > 0) {
                if (isset($hotDeal)) {
                    ?>
                    <p class="price" >
                        <span class="<?= ($UserAgent != 'mobile') ? 'size14 b' : 'size10' ?> fc-red"><?= number_format($model->price) . ' THB' ?> </span>
                        <span class="<?= ($UserAgent != 'mobile') ? 'size12' : 'size10' ?> onsale"><?= isset($model->product) ? number_format($model->product->price) . ' THB' : '' ?> </span>
                    </p>
                <?php } else {
                    ?>
                    <p class="price" >
                        <span class="<?= ($UserAgent != 'mobile') ? 'size14 b' : 'size10' ?> fc-red" ><?= number_format($model->price) . ' THB' ?> </span>
                        <span class="<?= ($UserAgent != 'mobile') ? 'size12' : 'size10' ?> onsale"><?= isset($model->product) ? number_format($model->product->price) . ' THB' : '' ?> </span>
                    </p>
                    <?php
                }
            } else {
                echo '';
            }
            ?>
        </div>
    </div>
</div>
