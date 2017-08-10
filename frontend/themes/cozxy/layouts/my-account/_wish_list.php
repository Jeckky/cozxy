<?php

use common\models\costfit\ProductShelf;
use frontend\models\DisplayMyAccount;
use common\models\costfit\FavoriteStory;
use common\models\costfit\ProductSuppliers;

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
        <div class="alert alert-warning" style="display: <?= isset($_GET['p']) ? '' : 'none' ?>">

            <?php
            if (isset($_GET['p'])) {
                echo 'Added &nbsp;&nbsp;&nbsp;"' . $_GET['p'] . '" &nbsp;&nbsp;&nbsp;to wishlist.';
            }
            ?>
        </div>
        <a style="cursor: pointer;" id="showCreateWishList" class="btn-yellow btn-lg <?= $fullCol ?>">+ Create my shelf</a>
        <a style="cursor: pointer;display: none;" id="hideCreateWishList" class="btn-yellow btn-lg <?= $fullCol ?>">- Create my shelf</a>
        <div id='newWishList' style='display: none;padding: 15px;margin-top: 70px;'>

            <h4>Shelf Name</h4>
            <input type='text' name='wishListName' class='fullwidth input-lg' id='wishListName' style='margin-bottom: 10px;'>
            <div class='text-right' style=''>
                <input type='hidden' id='productSuppId' value='no'>
                <a class='btn btn-black' id='cancel-newWishList'>Cancle</a>&nbsp;&nbsp;&nbsp;
                <a class='btn btn-yellow'id='create-newWishList' disabled>Create</a>
            </div>
        </div>
    </div>
</div>
<div id="allShelf1">
    <?php
    $defalutWishlist = ProductShelf::defaultWishList1();
    if (isset($defalutWishlist)) {
        $i = 0;
        $a = "<i class='fa fa-heart' aria-hidden='true' style='color:#FFFF00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
        ?>

        <a href="javascript:showWishlistGroup(<?= $defalutWishlist->productShelfId ?>,0);" style="cursor: pointer;color: #000;display: <?= $i == 0 ? "" : "none" ?>;" id="hideGroup-<?= $defalutWishlist->productShelfId ?>"><!-- click for hidden -->
            <div class="<?= $fullCol ?> bg-gray" style="padding:18px 18px 10px;margin-bottom: 10px;">
                <?= $a . '' . $defalutWishlist->title ?><i class="fa fa-chevron-up pull-right" aria-hidden="true"></i>
            </div>
        </a>
        <a href="javascript:showWishlistGroup(<?= $defalutWishlist->productShelfId ?>,1);" style="cursor: pointer;color: #000;display: <?= $i == 0 ? 'none' : '' ?>;" id="showGroup-<?= $defalutWishlist->productShelfId ?>"><!-- click for show -->
            <div class="<?= $fullCol ?> bg-gray" style="padding:18px 18px 10px;margin-bottom: 10px;">
                <?= $a . '' . $defalutWishlist->title ?><i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
            </div>
        </a>
        <?php if ($i == 0) { ?>
            <div id="wishListShelf-<?= $defalutWishlist->productShelfId ?>">

                <?php
                $wishlists = DisplayMyAccount::myAccountWishList($defalutWishlist->productShelfId, 8);
                if (isset($wishlists) && count($wishlists) > 0) {
                    foreach ($wishlists as $value):
                        product($value['wishlistId'], $value['image'], $value['brand'], $value['title'], $value['price_s'] . ' THB', $value['price_s'] . ' THB', $value['url'], $value['productSuppId'], $value['maxQnty'], $value['fastId'], $value['productId'], $value['supplierId'], $value['receiveType']);
                    endforeach;
                }
                $isShowSeemore = DisplayMyAccount::wishlistItems($defalutWishlist->productShelfId);
                if ($isShowSeemore > 8) {
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" style="margin-bottom:20px;cursor:pointer;">
                        <a href="<?= Yii::$app->homeUrl ?>my-account/all-wishlist?s=<?= $defalutWishlist->productShelfId ?>">See more >></a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        } else {
            ?>
            <div id="wishListShelf-<?= $defalutWishlist->productShelfId ?>"></div>
            <?php
        }
    }
    ?></div>
<?php
$favoriteStories = ProductShelf::favoriteStories();
$allFavorite = FavoriteStory::allFavoriteStories();
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
    <div id="showFavoriteItem" style="display:none;">
        <div class="row" style="padding: 20px;">
            <?php
            if ($allFavorite == 0) {
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left" style="margin-bottom:20px;cursor:pointer;">
                    <h4>
                        You have not added any stories to your favorite stories <span style="margin-left:20px;"><a href="<?= Yii::$app->homeUrl ?>site/faqs" target="_blank"> What's this?</a></span>
                    </h4>
                </div>
            <?php } else {
                ?>
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
            <?php } ?>
        </div>
        <?php
        // throw new \yii\base\Exception(count($allFavorite));

        if (isset($allFavorite) && $allFavorite > 8) {
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" style="margin-bottom:20px;cursor:pointer;">
                <a href="<?= Yii::$app->homeUrl ?>my-account/all-favorite-story">See more favorite stories >></a>
            </div>
            <?php
        }
        ?>
    </div>
<?php }
?>
<div id="allShelf2">
    <?php
    $allshelf = ProductShelf::wishListGroup();
    if (isset($allshelf) && count($allshelf) > 0) {
        foreach ($allshelf as $shelf):
            if ($shelf->type == 2) {
                $a = "<i class='fa fa-gratipay' aria-hidden='true' style='color:#FF6699;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
            }
            ?>

            <div class="col-lg-10 bg-gray" style="cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(<?= $shelf->productShelfId ?>, 1);" id="showGroup-<?= $shelf->productShelfId ?>">
                <?= $a . '' . $shelf->title ?>
            </div>
            <div class="col-lg-10 bg-gray" style="display: none;cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(<?= $shelf->productShelfId ?>, 0);" id="hideGroup-<?= $shelf->productShelfId ?>">
                <?= $a . '' . $shelf->title ?>
            </div>
            <div class="col-lg-2 bg-gray text-right" style="padding:18px 18px 10px;margin-bottom: 10px; color:#FF6699;">
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:editShelf(<?= $shelf->productShelfId ?>, 1)" id="showEditShelf<?= $shelf->productShelfId ?>"></i>
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;display: none;" onclick="javascript:editShelf(<?= $shelf->productShelfId ?>, 0)" id="hideEditShelf<?= $shelf->productShelfId ?>"></i>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-trash" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:deleteShelf(<?= $shelf->productShelfId ?>)"></i>
            </div>
            <div id="editShelf<?= $shelf->productShelfId ?>" style="display: none;" class="col-md-12">

                <h4>Shelf's Name</h4>
                <input type="text" name="shelfName" class="fullwidth input-lg" id="shelfName<?= $shelf->productShelfId ?>" style="margin-bottom: 10px;" value="<?= $shelf->title ?>">
                <div class='text-right' style=''>
                    <input type="hidden" id="productSuppId" value="no">
                    <a href="javascript:cancelEditShelf(<?= $shelf->productShelfId ?>)"class="btn btn-black" id="cancelEditShelf<?= $shelf->productShelfId ?>">Cancle</a>&nbsp;&nbsp;&nbsp;
                    <a href="javascript:updateShelf(<?= $shelf->productShelfId ?>)"class="btn btn-yellow"id="updateShelf<?= $shelf->productShelfId ?>">Update</a>
                </div>
            </div>
            <div id="wishListShelf-<?= $shelf->productShelfId ?>" style="display: none;">

                <?php
                $wishlists = DisplayMyAccount::myAccountWishList($shelf->productShelfId, 8);
                if (isset($wishlists) && count($wishlists) > 0) {
                    foreach ($wishlists as $value):
                        product($value['wishlistId'], $value['image'], $value['brand'], $value['title'], $value['price_s'] . ' THB', $value['price_s'] . ' THB', $value['url'], $value['productSuppId'], $value['maxQnty'], $value['fastId'], $value['productId'], $value['supplierId'], $value['receiveType']);
                    endforeach;
                }
                $isShowSeemore = DisplayMyAccount::wishlistItems($shelf->productShelfId);
                if ($isShowSeemore > 8) {
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" style="margin-bottom:20px;cursor:pointer;">
                        <a href="<?= Yii::$app->homeUrl ?>my-account/all-wishlist?s=<?= $shelf->productShelfId ?>">See more >></a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        endforeach;
    }
    ?></div>
