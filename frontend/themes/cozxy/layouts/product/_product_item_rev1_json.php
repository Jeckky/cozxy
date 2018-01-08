<?php

use yii\bootstrap\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductShelf;
use yii\helpers\Url;
use common\helpers\Base64Decode;
use common\helpers\CozxyCalculatesCart;

$cozxyResult = NULL;
$cozxyMarketPrice = NULL;
$cozxyBrandTitle = NULL;

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
?>
<?php $col = isset($colSize) ? $colSize : '4'; ?>
<div class="col-md-4 col-sm-6 col-xs-6 box-product">
    <div class="product-box">
        <?php if ($DiscountProduct != 'Lessthan10') { ?>
            <div class="product-sticker">
                <div class="rcorners4">
                    <p>
                        <?php
                        //echo Yii::$app->controller->id;
                        if (Yii::$app->controller->id == 'search') {
                            //echo 'SALE';
                            echo $DiscountProduct;
                            echo '<div class="off-style">OFF</div>';
                        } else if (Yii::$app->controller->id == 'site') {
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
                        } else if (Yii::$app->controller->id == 'site') {
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
            <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . common\models\ModelMaster::encodeParams(['productId' => $model['productid']])) ?>" class="fc-black">
                <img class="media-object fullwidth img-responsive" src="<?= isset($model->product) ? \Yii::$app->homeUrl . $model->product->productImageThumbnail() : Base64Decode::DataImageSvg('Svg260x260') ?>"  >
            </a>
            <div class="v-hover">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . common\models\ModelMaster::encodeParams(['productId' => isset($model->product->productId) ? $model->product->productId : $model['productid']])) ?>">
                    <div class="col-xs-4"><i class="fa fa-eye" aria-hidden="true"></i></div>
                </a>
                <?php
                if (Yii::$app->user->id) {
                    if (isset($model->product)) {
                        if ($model->product->isInWishlist() == 1) { // เคย wishList ไปแล้ว
                            ?>
                            <a href="javascript:addItemToDefaultWishlist(<?= $model['productid'] ?>);">
                                <div class="col-xs-4 heart-<?= $model['productid'] ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                            </a>
                        <?php } else { ?>
                            <a href="javascript:addItemToDefaultWishlist(<?= $model['productid'] ?>);" id="heartbeat-<?= $model['productid'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                                <div class="col-xs-4 heart-<?= $model['productid'] ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                            </a>
                            <a href="javascript:addItemToDefaultWishlist(<?= $model['productid'] ?>);" id="heart-o-<?= $model['productid'] ?>">
                                <div class="col-xs-4 heart-<?= $model['productid'] ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
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
                if ($cozxyResult > 0) {
                    if ($model->receiveType != '') {
                        $receiveType = $model->receiveType;
                    } else {
                        $receiveType = 1;
                    }
                    ?>
                    <a  href="javascript:addItemToCartUnitys('<?= $model->productSuppId ?>',1,'<?= $cozxyResult ?>','FALSE','<?= $model['productid'] ?>','<?= $model->userId ?>','<?= $receiveType ?>')" id="addItemsToCartMulti-<?= $model->productSuppId ?>" data-loading-text="<div class='col-xs-4 shopping-<?= $model->productSuppId ?>'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 shopping-<?= $model->productSuppId ?>"><i id="cart-plus-<?= $model->productSuppId ?>" class="fa fa-cart-plus" aria-hidden="true"></i></div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="product-txt">
            <?php
            if (isset($cozxyBrandTitle) && empty($cozxyBrandTitle)) {
                ?>
                <p class="brand">
                    <span class="size14"><?= strtoupper($cozxyBrandTitle) ?></span>
                </p>
            <?php } else {
                ?>
                <p class="brand">
                    <span class="size16">NO BRAND</span>
                </p>
                <?php
            }
            ?>
            <p class="name">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . common\models\ModelMaster::encodeParams(['productId' => isset($model['productid']) ? $model['productid'] : $model['productid']])) ?>" class="size18 b" title="<?= $model['productid'] ?>">
                    <?= strtoupper($model['title']) ?>
                </a>
            </p>
            <?php
            if ($model['price'] > 0) {
                if (isset($hotDeal)) {
                    ?>
                    <p class="price" >
                        <span class="size18 fc-red"><?= isset($model['cozxyMarketPrice']) ? number_format($model['cozxyMarketPrice']) : 'NONE' . ' THB' ?> </span><br>
                        <span class="size14 onsale"><?= isset($model['price']) ? number_format($model['price']) . ' THB' : '' ?> </span>
                    </p>
                <?php } else {
                    ?>
                    <p class="price" >
                        <span class="size18 fc-red"><?= isset($model['cozxyMarketPrice']) ? number_format($model['cozxyMarketPrice']) : 'NONE' . ' THB' ?> </span><br>
                        <span class="size14 onsale"><?= isset($model['price']) ? number_format($model['price']) . ' THB' : '' ?> </span>
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
