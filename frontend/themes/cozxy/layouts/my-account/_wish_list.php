<?php

function product($id, $img, $txt, $txt_d, $price, $price_s, $url, $productSuppId, $maxQnty, $fastId, $productId, $supplierId, $receiveType) {
    echo '
		<div class="col-md-3 col-sm-6 item-to-wishlist-' . $id . '">
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
						<span class="size18">&nbsp;</span> &nbsp;
						<span class="size14">&nbsp;</span>
					</p>';
    }
    '<p class="size14 fc-g999">' . $txt . '</p>';
    if ($maxQnty > 0 && $price > 0) {
        echo '<p><a href="javascript:addItemToCartUnitys(' . $productSuppId . ',1,' . $maxQnty . ',\'' . $fastId . '\',' . $productId . ',' . $supplierId . ',' . $receiveType . ')" id="addItemsToCartMulti-' . $id . '" data-loading-text="ADD TO CART" class="btn-yellow">ADD TO CART</a> &nbsp; <a href="javascript:deleteItemToWishlist(' . $id . ');" id="deletetemToWishlists-' . $id . '"  class="fc-g999" data-loading-text="<a><i class=\'fa fa-circle-o-notch fa-spin\' aria-hidden=\'true\'></i></a>">REMOVE</a></p>';
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

<div class="row">
    <?php
    //product('01', 'imgs/product01.jpg', 'PREMIUM BAG', 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG', '43,000 THB', '59,000 THB', 'product-view.php');
    //product('02', 'imgs/product07.jpg', 'PREMIUM BAG', 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG', '43,000 THB', '59,000 THB', 'product-view.php');
    // product('03', 'imgs/product03.jpg', 'PREMIUM BAG', 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG', '43,000 THB', '59,000 THB', 'product-view.php');
    //product('04', 'imgs/product04.jpg', 'PREMIUM BAG', 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG', '43,000 THB', '59,000 THB', 'product-view');

    /*
     * By Taninut.Bm
     * 24-05-2017
     */
    if (count($wishList->allModels) > 0) {
        foreach ($wishList->allModels as $key => $value) {
            product($value['wishlistId'], $value['image'], $value['brand'], $value['title'], $value['price_s'] . ' THB', $value['price_s'] . ' THB', $value['url'], $value['productSuppId'], $value['maxQnty'], $value['fastId'], $value['productId'], $value['supplierId'], $value['receiveType']);
        }
    } else {

    }
    ?>
</div>