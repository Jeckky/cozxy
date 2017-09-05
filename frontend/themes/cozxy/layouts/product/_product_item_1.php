<?php

use yii\bootstrap\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductShelf;
use yii\helpers\Html;
use yii\helpers\Url;

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
            <a href="<?= $model['url'] ?>" class="fc-black">
                <img alt="262x262" class="media-object fullwidth img-responsive" data-src="holder.js/262x262" src="<?= $model['image'] ?>" data-holder-rendered="true" style="<?= $width ?>; <?= $height ?>;">
            </a>
            <div class="v-hover">
                <a href="<?= $model['url'] ?>">
                    <div class="col-xs-4">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                </a>
                <?php
                if (Yii::$app->user->id) {
                    if ($model['wishList'] == 1) { // เคย wishList ไปแล้ว
                        ?>
                        <a href="javascript:addItemToDefaultWishlist(<?= $model['productSuppId'] ?>);">
                            <div class="col-xs-4 heart-<?= $model['productSuppId'] ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                        </a>
                    <?php } else { ?>
                        <a href="javascript:addItemToDefaultWishlist(<?= $model['productSuppId'] ?>);" id="heartbeat-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                            <div class="col-xs-4 heart-<?= $model['productSuppId'] ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                        </a>
                        <a href="javascript:addItemToDefaultWishlist(<?= $model['productSuppId'] ?>);" id="heart-o-<?= $model['productSuppId'] ?>">
                            <div class="col-xs-4 heart-<?= $model['productSuppId'] ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                        </a>
                        <?php
                    }
                } else {
                    ?>
                    <a href="<?= Yii::$app->homeUrl . 'site/login' ?>" >
                        <div class="col-xs-4"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                    </a>
                    <?php
                }
                //echo 'Asset28 :' . Url::home() . 'imgs/Asset28.png';
                ?>
                <?php
                if ($model['maxQnty'] > 0) {
                    if ($model['receiveType'] != '') {
                        $receiveType = $model['receiveType'];
                    } else {
                        $receiveType = 1;
                    }
                    ?>
                    <a  href="javascript:addItemToCartUnitys('<?= $model['productSuppId'] ?>',1,'<?= $model['maxQnty'] ?>','<?= $model['fastId'] ?>','<?= $model['productId'] ?>','<?= $model['supplierId'] ?>','<?= $receiveType ?>')" id="addItemsToCartMulti-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4 shopping-<?= $model['productSuppId'] ?>'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 shopping-<?= $model['productSuppId'] ?>">
                            <i id="cart-plus-<?= $model['productSuppId'] ?>" class="fa fa-cart-plus" aria-hidden="true"></i>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="product-txt">
            <?php
            if (isset($model['brand'])) {
                ?>
                <p class="size14 fc-g666"><?= strtoupper($model['brand']) ?></p>
                <?php
            } else {
                echo '';
            }
            ?>
            <p class="size18 b" style="height:40px;"><a href="<?= $model['url'] ?>" class="fc-black"><?= strtoupper($model['title']) ?></a></p>
            <?php
            if ($model['price'] > 0) {
                ?><p>
                    <span class="size18"><?= $model['price'] ?> THB</span><br>
                    <span class="size14 onsale"><?= $model['price_s'] ?> THB</span>
                </p>
                <?php
            } else {
                echo '';
            }
            ?>

        </div>
    </div>
</div>
