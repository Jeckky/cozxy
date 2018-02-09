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
    <div class="row">
        <?php
        for ($index1 = 0; $index1 < 6; $index1++) {
            ?>
            <div class="col-md-2 col-sm-3 col-xs-3 box-product new-themes-product-items">
                <div class="product-box">
                    <div class="product-sticker">
                        <div class="rcorners4">
                            <p>
                                <span class="discount"> 25</span><span class="percen-discount">%</span></p><div class="off-style">OFF</div>
                        </div>
                        <div class="triangle"></div>
                    </div>
                    <div class="product-img text-center">
                        <a  href="/cozxy/frontend/web/product/TjVS4zYHodLRoLFcnFkRy3ihL5RZOKxdphrRMIdp2KU%3D" class="fc-black  ">
                            <img class="media-object fullwidth img-responsive" src="https://www.cozxy.com/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg">
                        </a>
                        <div class="v-hover">
                            <a href="/cozxy/frontend/web/product/LpCvpN88FKzYjWip4K85qioA54gcO6VP0UjYU0KzBug%3D">
                                <div class="col-xs-4"><i class="fa fa-eye" aria-hidden="true"></i></div>
                            </a>
                            <a href="javascript:addItemToDefaultWishlist(4997);" id="heartbeat-4997" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                                <div class="col-xs-4 heart-4997"><i class="fa fa-heart" aria-hidden="true"></i></div>
                            </a>
                            <a href="javascript:addItemToDefaultWishlist(4997);" id="heart-o-4997">
                                <div class="col-xs-4 heart-4997"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                            </a>
                            <a href="javascript:addItemToCartUnitys('1891',1,'1','FALSE','4997','33','1')" id="addItemsToCartMulti-1891" data-loading-text="<div class='col-xs-4 shopping-1891'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                                <div class="col-xs-4 shopping-1891"><i id="cart-plus-1891" class="fa fa-cart-plus" aria-hidden="true"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
