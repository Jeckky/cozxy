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
?>
<style type="text/css">

</style>
<?php $col = isset($colSize) ? $colSize : '4'; ?>
<div class="col-md-4 col-sm-6 col-xs-6 box-product">
    <div class="product-box">
        <div class="product-sticker">
            <div class="rcorners4">
                <span>SAVE</span>
                <span>
                    <?php
                    $marketPrice = isset($model->product) ? $model->product->price : 0;
                    $supplierPrice = isset($model->price) ? $model->price : 0;
                    echo CozxyCalculatesCart::DiscountProduct($marketPrice, $supplierPrice)
                    ?>
                </span>
            </div>
            <div class="triangle"></div>
        </div>
        <div class="product-img text-center">
            <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->productId])) ?>" class="fc-black">
                <img class="media-object fullwidth img-responsive" src="<?= isset($model->product) ? \Yii::$app->homeUrl . $model->product->productImageThumbnail() : Base64Decode::DataImageSvg('Svg260x260') ?>" style="max-height: 230px;">
            </a>
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
        </div>
        <div class="product-txt">
            <?php
            if (isset($model->product->brand->title)) {
                ?>
                <p class="brand">
                    <span class="size14"><?= strtoupper($model->product->brand->title) ?></span>
                </p>
                <?php
            } else {
                echo 'NO BRAND';
            }
            ?>

            <p class="name">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => isset($model->product->productId) ? $model->product->productId : $model->productId])) ?>" class="size18 b">
                    <?= strtoupper($model->product->title) ?>
                </a>
            </p>
            <?php
            if ($model->price > 0) {
                if (isset($hotDeal)) {
                    ?>
                    <p class="price" style="height: 50px;">
                        <span class="size18 col-lg-9 col-md-9 col-sm-10 col-xs-12" style="background-color: red; height: 25px;padding: 5px;color: white;"><?= number_format($model->price) . ' THB' ?> </span><br><br>
                        <span class="size16 onsale"><?= isset($model->product) ? number_format($model->product->price) . ' THB' : '' ?> </span>

                    </p>
                <?php } else {
                    ?>
                    <p class="price" style="height: 50px;">
                        <span class="size18 col-lg-9 col-md-9 col-sm-10 col-xs-12" style="height: 25px;padding: 5px;"><?= number_format($model->price) . ' THB' ?> </span><br><br>
                        <span class="size16 onsale"><?= isset($model->product) ? number_format($model->product->price) . ' THB' : '' ?> </span>

                        <?php
                    }
                } else {
                    echo '';
                }
                ?>

        </div>
    </div>
</div>
