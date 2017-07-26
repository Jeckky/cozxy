<?php

use common\models\costfit\ProductShelf;
use frontend\models\DisplayMyAccount;

$fullCol = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
?>
<?php

function product($id, $img, $txt, $txt_d, $price, $price_s, $url, $productSuppId, $maxQnty, $fastId, $productId, $supplierId, $receiveType) {
    $quantity = 1;
    echo '
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 item-to-wishlist-' . $id . '">
			<div class="product-box">
				<div class="product-img text-center">
					<a href="' . $url . '"><img src="' . $img . '" alt="' . $txt_d . '" class="fullwidth"></a>
				</div>
				<div class="product-txt">
					<p class="size16"  style="height:50px;"><a href="' . $url . '" class="fc-black">' . $txt_d . '</a></p>';
    if ($price > 0) {
        echo '<p>
						<span class="size18">' . $price . '</span> &nbsp;
						<span class="size14 onsale">' . $price_s . '</span>
					</p>';
    } else {
        echo '<p>
						<span class="size18">&nbsp</span> &nbsp;
						<span class="size14">&nbsp;</span>
					</p>';
    }
    '<p class="size14 fc-g999">' . $txt . '</p>';
    if ($maxQnty > 0 && $price > 0) {
        echo '<p><a href="javascript:addItemToCartUnitys(\'' . $productSuppId . '\',\'' . $quantity . '\',\'' . $maxQnty . '\',\'' . $fastId . '\',\'' . $productId . '\',\'' . $supplierId . '\',\'' . $receiveType . '\')" id="addItemsToCartMulti-' . $id . '" data-loading-text="ADD TO CART" class="btn-yellow">ADD TO CART</a> &nbsp; <a href="javascript:deleteItemToWishlist(' . $id . ');" id="deletetemToWishlists-' . $id . '"  class="fc-g999" data-loading-text="<a><i class=\'fa fa-circle-o-notch fa-spin\' aria-hidden=\'true\'></i></a>">REMOVE</a></p>';
    } else {
        echo '<p><a class="btn-black-s">NO TO CART</a> &nbsp; <a href="javascript:deleteItemToWishlist(' . $id . ');" id="deletetemToWishlists-' . $id . '" class="fc-g999" data-loading-text="<a><i class=\'fa fa-circle-o-notch fa-spin\' aria-hidden=\'true\'></i></a>">REMOVE</a></p>';
    }
    echo '
                </div>
            </div>
        </div>
    ';
}
?>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row bg-white">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <div class="size20 size18-xs col-lg-7 col-md-7 col-sm-6 col-xs-6"><?= $title ?></div>
            <div class="size20 size18-xs col-lg-5 col-md-5 col-sm-6 col-xs-6 pull-right text-right" >
                <a href="<?= Yii::$app->homeUrl ?>my-account?act=2" style="color: black;"> << Back to wishlist</a>
            </div>
        </div>

        <?php
        if (isset($wishlists) && count($wishlists) > 0) {
            foreach ($wishlists as $value):
                product($value['wishlistId'], $value['image'], $value['brand'], $value['title'], $value['price_s'] . ' THB', $value['price_s'] . ' THB', $value['url'], $value['productSuppId'], $value['maxQnty'], $value['fastId'], $value['productId'], $value['supplierId'], $value['receiveType']);
            endforeach;
        }
        ?>
    </div>
</div>


