<?php

use common\models\costfit\ProductShelf;

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
<div class="row">
    <div class="col-md-12">
        <a style="cursor: pointer;" id="showCreateWishList" class="btn-yellow btn-lg <?= $fullCol ?>">+ Create my shelf</a>
        <a style="cursor: pointer;display: none;" id="hideCreateWishList" class="btn-yellow btn-lg <?= $fullCol ?>">- Create my shelf</a>
        <div id='newWishList' style='display: none;padding: 15px;margin-top: 70px;'>

            <h4>Shelf's Name</h4>
            <input type='text' name='wishListName' class='fullwidth input-lg' id='wishListName' style='margin-bottom: 10px;'>
            <div class='text-right' style=''>
                <input type='hidden' id='productSuppId' value='no'>
                <a class='btn btn-black' id='cancel-newWishList'>Cancle</a>&nbsp;&nbsp;&nbsp;
                <a class='btn btn-yellow'id='create-newWishList' disabled>Create</a>
            </div>
        </div>
    </div>
</div>
<div id="allShelf2">
    <?php
    $allshelf = ProductShelf::wishListGroup();
    if (isset($allshelf) && count($allshelf) > 0) {
        $i = 0;
        $edit = '';
        $delete = '';
        foreach ($allshelf as $shelf):
            $edit = '';
            $delete = '';
            if ($shelf->type == 1) {
                $a = "<i class='fa fa-heart' aria-hidden='true' style='color:#FFFF00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
            }
            if ($shelf->type == 2) {
                $a = "<i class='fa fa-gratipay' aria-hidden='true' style='color:#FF6699;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
            }
            if ($shelf->type == 3) {
                $a = "<i class='fa fa-star' aria-hidden='true' style='color:#FFCC00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
            }
            ?>

            <a href="javascript:showWishlistGroup(<?= $shelf->productShelfId ?>,0);" style="cursor: pointer;color: #000;display: <?= $i == 0 ? "" : "none" ?>;" id="hideGroup-<?= $shelf->productShelfId ?>"><!-- click for hidden -->
                <div class="<?= $fullCol ?> bg-gray" style="padding:18px 18px 10px;margin-bottom: 10px;">
                    <?= $a . '' . $shelf->title ?><i class="fa fa-chevron-up pull-right" aria-hidden="true"></i>
                </div>
            </a>
            <a href="javascript:showWishlistGroup(<?= $shelf->productShelfId ?>,1);" style="cursor: pointer;color: #000;display: <?= $i == 0 ? 'none' : '' ?>;" id="showGroup-<?= $shelf->productShelfId ?>"><!-- click for show -->
                <div class="<?= $fullCol ?> bg-gray" style="padding:18px 18px 10px;margin-bottom: 10px;">
                    <?= $a . '' . $shelf->title ?><i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                </div>
            </a>
            <?php if ($i == 0) { ?>
                <div id="wishListShelf-<?= $shelf->productShelfId ?>">

                    <?php
                    $wishlists = frontend\models\DisplayMyAccount::myAccountWishList($shelf->productShelfId);
                    if (isset($wishlists) && count($wishlists) > 0) {
                        foreach ($wishlists as $value):
                            product($value['wishlistId'], $value['image'], $value['brand'], $value['title'], $value['price_s'] . ' THB', $value['price_s'] . ' THB', $value['url'], $value['productSuppId'], $value['maxQnty'], $value['fastId'], $value['productId'], $value['supplierId'], $value['receiveType']);
                        endforeach;
                    }
                    ?>
                </div>
            <?php } else {
                ?>
                <div id="wishListShelf-<?= $shelf->productShelfId ?>"></div>
                <?php
            }
            $i++;
        endforeach;
    }
    ?></div>
<?php
$favoriteStories = ProductShelf::favoriteStories();
if (isset($favoriteStories)) {
    $a = "<i class='fa fa-star' aria-hidden='true' style='color:#FFCC00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
    ?>
    <a href="javascript:showFavorite(0);" style="cursor: pointer;color: #000;display:none;" id="hidefav"><!-- click for hidden -->
        <div class="<?= $fullCol ?> bg-gray" style="padding:18px 18px 10px;margin-bottom: 10px;">
            <?= $a . '' . $favoriteStories->title ?><i class="fa fa-chevron-up pull-right" aria-hidden="true"></i>
        </div>
    </a>
    <a href="javascript:showFavorite(1);" style="cursor: pointer;color: #000;" id="showfav"><!-- click for show -->
        <div class="<?= $fullCol ?> bg-gray" style="padding:18px 18px 10px;margin-bottom: 10px;">
            <?= $a . '' . $favoriteStories->title ?><i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
        </div>
    </a>
    <?php
    $favoriteItem = '';
    ?>
    <div id="showFavoriteItem" style="display:none;">
        <div class="row" style="padding: 20px;">
            <?=
            \yii\widgets\ListView::widget([
                'dataProvider' => $favoriteStory,
                'options' => [
                    'tag' => false,
                ],
                'itemView' => function ($model) {
                    return $this->render('@app/themes/cozxy/layouts/my-account/_favorite_stories_items', ['model' => $model]);
                },
                //'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                //'layout'=>"{summary}{pager}{items}"
                'layout' => "{items}",
                'itemOptions' => [
                    'tag' => false,
                ],
            ]);
            ?>
        </div>

        <div class="col-xs-12 size48">&nbsp;</div>
    </div>
<?php }
?>
