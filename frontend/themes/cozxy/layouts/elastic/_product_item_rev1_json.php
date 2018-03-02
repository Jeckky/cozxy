<?php

use yii\bootstrap\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductShelf;
use yii\helpers\Url;
use common\helpers\Base64Decode;
use common\helpers\CozxyCalculatesCart;

if (isset($model['brandId'])) {
    $productBrand = common\models\costfit\Product::productBrand($model['brandId']);
} else {
    $productBrand = null;
}

$cozxyIsInWishlist = new common\models\costfit\Product();
$cozxyIsInWishlist = $cozxyIsInWishlist->isInWishlist($model['productId']);

if (Yii::$app->controller->id == 'product') {
    $width = "width: 195px";
    $height = "height: 195px";
} else {
    $width = "width: 260px";
    $height = "height: 260px";
}

if (isset($model['suppliers']) && !empty($model['suppliers'])) {
    $cozxySellingsPrice = $model['suppliers']['lowestSupplier']['price'];
    $cozxyproductSuppId = $model['suppliers']['lowestSupplier']['productSuppId'];
    $cozxyResult = $model['suppliers']['lowestSupplier']['result'];
    $marketPriceMaster = $model['price'];
} else {
    $cozxySellingsPrice = 0;
    $cozxyResult = '';
    $marketPriceMaster = 0;
    $cozxyproductSuppId = '';
}
$marketPrice = isset($marketPriceMaster) ? $marketPriceMaster : 0;
$supplierPrice = isset($cozxySellingsPrice) ? $cozxySellingsPrice : 0;
$DiscountProduct = CozxyCalculatesCart::DiscountProduct($marketPrice, $supplierPrice);
$UserAgent = common\helpers\GetBrowser::UserAgent();
?>
<?php $col = isset($colSize) ? $colSize : '4'; ?>
<div class="col-md-3 col-sm-3 col-xs-6 box-product cozxy-items-<?= $model['productId'] . '-' . $model['brandId'] ?>">
    <div class="product-box">
        <?php
        if ($cozxySellingsPrice > 0) {
            if ($DiscountProduct != 'Lessthan10') {
                ?>
                <div class="product-sticker">
                    <div class="rcorners4">
                        <p>
                            <?php
                            if (Yii::$app->controller->id == 'search') {
                                echo $DiscountProduct;
                                echo '<div class="off-style">OFF</div>';
                            } else if (Yii::$app->controller->id == 'site') {
                                echo $DiscountProduct;
                                echo '<div class="off-style">OFF</div>';
                            } else {
                                echo 'SAVE';
                            }
                            ?>
                        </p>
                        <p>
                            <?php
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
                <?php
            }
        }
        ?>
        <div class="product-img text-center">
            <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . common\models\ModelMaster::encodeParams(['productId' => $model['productId']])) ?>" class="fc-black">
                <img class="media-object fullwidth img-responsive" src="<?= $model['imageThumbnail1']//$productImageThumbnail                                                                                      ?>"  >
            </a>
            <div class="v-hover">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . common\models\ModelMaster::encodeParams(['productId' => isset($model->product->productId) ? $model->product->productId : $model['productId']])) ?>">
                    <div class="col-xs-4"><i class="fa fa-eye" aria-hidden="true"></i></div>
                </a>
                <?php
                if (Yii::$app->user->id) {
                    if (isset($cozxyIsInWishlist)) {
                        if ($cozxyIsInWishlist == 1) { // เคย wishList ไปแล้ว
                            ?>
                            <a href="javascript:addItemToDefaultWishlist(<?= $model['productId'] ?>);">
                                <div class="col-xs-4 heart-<?= $model['productId'] ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                            </a>
                        <?php } else { ?>
                            <a href="javascript:addItemToDefaultWishlist(<?= $model['productId'] ?>);" id="heartbeat-<?= $model['productId'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                                <div class="col-xs-4 heart-<?= $model['productId'] ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                            </a>
                            <a href="javascript:addItemToDefaultWishlist(<?= $model['productId'] ?>);" id="heart-o-<?= $model['productId'] ?>">
                                <div class="col-xs-4 heart-<?= $model['productId'] ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
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
                    if ($model['receiveType'] != null) {
                        $receiveType = $model['receiveType'];
                    } else {
                        $receiveType = 1;
                    }
                    ?>
                    <a href="javascript:addItemToCartUnitys('<?= isset($model['productSuppId']) ? $model['productSuppId'] : $cozxyproductSuppId ?>',1,'<?= $cozxyResult ?>','FALSE','<?= $model['productId'] ?>','<?= isset($model['userId']) ? $model['userId'] : 0 ?>','<?= $receiveType ?>')" id="addItemsToCartMulti-<?= isset($model['productSuppId']) ? $model['productSuppId'] : $cozxyproductSuppId ?>" data-loading-text="<div class='col-xs-4 shopping-<?= isset($model['productSuppId']) ? $model['productSuppId'] : $cozxyproductSuppId ?>'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 shopping-<?= isset($model['productSuppId']) ? $model['productSuppId'] : $cozxyproductSuppId ?>"><i id="cart-plus-<?= isset($model['productSuppId']) ? $model['productSuppId'] : $cozxyproductSuppId ?>" class="fa fa-cart-plus" aria-hidden="true"></i></div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="product-txt">
            <?php
            if ($UserAgent != 'mobile') {
                if (isset($productBrand)) {
                    ?>
                    <p class="brand">
                        <span class="size12"><?= strtoupper($productBrand['title']) ?></span>
                    </p>
                <?php } else {
                    ?>
                    <p class="brand">
                        <span class="size12">NO BRAND</span>
                    </p>
                    <?php
                }
            }
            ?>
            <p class="name">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . common\models\ModelMaster::encodeParams(['productId' => isset($model['productId']) ? $model['productId'] : $model['productId']])) ?>" class="<?= ($UserAgent != 'mobile') ? 'size14 b' : 'size14' ?>" title="<?= $model['productId'] ?>">

                    <?= isset($model['title']) ? (strlen(strtoupper($model['title'])) <= 40) ? strtoupper($model['title']) : substr(strtoupper($model['title']), 0, 40) : '' ?>
                </a>
            </p>
            <?php
            if ($cozxySellingsPrice > 0) {
                if (isset($hotDeal)) {
                    ?>
                    <p class="price">
                        <span class="<?= ($UserAgent != 'mobile') ? 'size14 b' : 'size14' ?> fc-red"><?= isset($cozxySellingsPrice) ? number_format($cozxySellingsPrice) . ' THB' : 'NONE' ?> </span>
                        <span class="size14 onsale"><?= isset($marketPrice) ? number_format($marketPrice) . ' THB' : '' ?> </span>
                    </p>
                <?php } else {
                    ?>
                    <p class="price" >
                        <span class="<?= ($UserAgent != 'mobile') ? 'size14 b' : 'size14' ?> fc-red"><?= isset($cozxySellingsPrice) ? number_format($cozxySellingsPrice) : 'NONE' . ' THB' ?> </span>
                        <span class="size14 onsale"><?= isset($marketPrice) ? number_format($marketPrice) . ' THB' : '' ?> </span>
                    </p>
                    <?php
                }
            } else {
                //echo 'EYEWEAR-(PRODUCTS)';
                ?>
                <p class="price" >
                    <span class="size18 fc-red">&nbsp;<!--EXPLORE PRODUCTS--></span>
                    <span class="size14 ">&nbsp;</span>
                </p>
                <?php
            }
            ?>

        </div>
    </div>
</div>
