<?php

use yii\bootstrap\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductShelf;
use yii\helpers\Url;
use common\helpers\Base64Decode;

if (Yii::$app->controller->id == 'product') {
    $width = "width: 195px";
    $height = "height: 195px";
} else {
    $width = "width: 260px";
    $height = "height: 260px";
}
?>
<?php $col = isset($colSize) ? $colSize : '4'; ?>
<div class="col-md-<?= $col ?> col-sm-6 col-xs-12">
    <div class="product-box">
        <div class="product-img text-center">
            <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->productId])) ?>" class="fc-black">
                <img alt="262x262" class="media-object fullwidth img-responsive" data-src="holder.js/262x262" src="<?= isset($model->product) ? \Yii::$app->homeUrl . $model->product->productImageThumbnail() : Base64Decode::DataImageSvg('Svg260x260') ?>" data-holder-rendered="true" style="<?= $width ?>; <?= $height ?>;">
            </a>
            <div class="v-hover">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => isset($model->product->productId) ? $model->product->productId : $model->productId])) ?>">
                    <div class="col-xs-4"><i class="fa fa-eye" aria-hidden="true"></i></div>
                </a>
                <?php
                if (Yii::$app->user->id) {
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
                } else {
                    ?>
                    <a href="<?= Yii::$app->homeUrl . 'site/login' ?>" >
                        <div class="col-xs-4"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                    </a>
                <?php } ?>
                <?php
                if ($model->result > 0) {
                    ?>
                    <a  href="javascript:addItemToCartUnitys('<?= $model->productSuppId ?>',1,'<?= $model->result ?>','FALSE','<?= $model->productId ?>','<?= $model->userId ?>','<?= $model->receiveType ?>')" id="addItemsToCartMulti-<?= $model->productSuppId ?>" data-loading-text="<div class='col-xs-4 shopping-<?= $model->productId ?>'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 shopping-<?= $model->productId ?>"><i id="cart-plus-<?= $model->productId ?>" class="fa fa-cart-plus" aria-hidden="true"></i></div>
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
                echo '';
            }
            ?>

            <p class="name">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->product->productId])) ?>" class="size18 b">
                    <?= strtoupper($model->title) ?>
                </a>
            </p>
            <?php
            if ($model->price > 0) {
                ?><p class="price">
                    <span class="size16"><?= number_format($model->price, 2) ?> THB</span><br>
                    <span class="size10 onsale"><?= number_format($model->product->price, 1) ?> THB</span>
                </p>
                <?php
            } else {
                echo '';
            }
            ?>

        </div>
    </div>
</div>
