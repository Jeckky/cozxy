<?php

use common\models\costfit\ProductShelf;
use frontend\models\DisplayMyAccount;
use common\models\costfit\FavoriteStory;
use common\models\costfit\ProductSuppliers;

$fullCol = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
$col10 = "col-lg-10 col-md-10 col-sm-9 col-xs-9";
$col2 = "col-lg-2 col-md-2 col-sm-3 col-xs-3";
?>
<?php

function product($id, $img, $txt, $txt_d, $price, $price_s, $url, $productSuppId, $maxQnty, $fastId, $productId, $supplierId, $receiveType, $shelfId) {
    $quantity = 1;
    if ($receiveType != '') {
        $receiveType = $receiveType;
    } else {
        $receiveType = 1;
    }
    echo '
		<div class="col-md-4 col-sm-6 col-xs-6 box-product  item-to-wishlist-' . $id . ' box-product">
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
        echo '<p><a href="javascript:addItemToCartUnitys(\'' . $productSuppId . '\',\'' . $quantity . '\',\'' . $maxQnty . '\',\'' . $fastId . '\',\'' . $productId . '\',\'' . $supplierId . '\',\'' . $receiveType . '\')" id="addItemsToCartMulti-' . $id . '" data-loading-text="ADD TO CART" class="btn-yellow btn-black-s-my-shelves">ADD TO CART</a> &nbsp; <a href="javascript:deleteItemToWishlist(' . $id . ',' . $shelfId . ');" id="deletetemToWishlists-' . $id . '"  class="fc-g999 btn-black-s-my-shelves" data-loading-text="<a><i class=\'fa fa-circle-o-notch fa-spin\' aria-hidden=\'true\'></i></a>">REMOVE</a></p>';
    } else {
        echo '<p><a class="btn-black-s-s btn-black-s-my-shelves">NOT AVAILABLE</a> &nbsp; <a href="javascript:deleteItemToWishlist(' . $id . ',' . $shelfId . ');" id="deletetemToWishlists-' . $id . '" class="fc-g999 btn-black-s-my-shelves" data-loading-text="<a><i class=\'fa fa-circle-o-notch fa-spin\' aria-hidden=\'true\'></i></a>">REMOVE</a></p>';
    }
    echo '
                </div>
            </div>
        </div>
    ';
}
?>
<div class="row-my-account">
    <div class="col-md-12 padding-product-detail">
        <div class="alert alert-warning" style="display: <?= isset($_GET['p']) ? '' : 'none' ?>">

            <?php
            if (isset($_GET['p'])) {
                echo 'Added &nbsp;&nbsp;&nbsp;"' . $_GET['p'] . '" &nbsp;&nbsp;&nbsp;to wishlist.';
            }
            ?>
        </div>
        <a style="cursor: pointer;" id="showCreateWishList" class="btn-yellow btn-lg <?= $fullCol ?>">+ <?= strtoupper('Create my shelf') ?></a>
        <a style="cursor: pointer;display: none;" id="hideCreateWishList" class="btn-yellow btn-lg <?= $fullCol ?>">- Create my shelf</a>
        <div id='newWishList' style='display: none;padding: 15px;margin-top: 70px;'>

            <h4>Shelf Name &nbsp;&nbsp;&nbsp;<span style="font-size: 12pt;"><a href="" data-toggle="modal" data-target="#ShelfModal"><u>What's this?</u></a></span></h4>
            <input type='text' name='wishListName' class='fullwidth input-lg' id='wishListName' style='margin-bottom: 10px;'>
            <div class='text-right' style=''>
                <input type='hidden' id='productId' value='no'>
                <a class='btn btn-black' id='cancel-newWishList'>Cancel</a>&nbsp;&nbsp;&nbsp;
                <a class='btn btn-yellow'id='create-newWishList' disabled>Create</a>
            </div>
        </div>
    </div>
</div>
<div id="allShelf1">
    <?php
//default Wishlist
    $defalutWishlist = ProductShelf::defaultWishList1();
    if (isset($defalutWishlist)) {
        $i = 0;
        $a = "<i class='fa fa-heart' aria-hidden='true' style='color:#FFFF00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
        ?>
        <!-- click for hidden -->
        <!--<a href="javascript:showWishlistGroup(<?//= $defalutWishlist->productShelfId ?>,0);" style="cursor: pointer;color: #000;display: none;" id="hideGroup-<?//= $defalutWishlist->productShelfId ?>">
            <div class="<?//= $fullCol ?> bg-my-shelf" style="padding:18px 18px 10px;margin-bottom: 10px;">
        <?//= $a . '' . $defalutWishlist->title ?><i class="fa fa-chevron-up pull-right" aria-hidden="true"></i>
            </div>
        </a>-->
        <!-- click for show -->
        <!--<a href="javascript:showWishlistGroup(<?//= $defalutWishlist->productShelfId ?>,1);" style="cursor: pointer;color: #000;" id="showGroup-<?//= $defalutWishlist->productShelfId ?>">
            <div class="<?//= $fullCol ?> bg-my-shelf" style="padding:18px 18px 10px;margin-bottom: 10px;">
        <?//= $a . '' . $defalutWishlist->title ?><i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
            </div>
        </a>-->
        <div class="<?= $fullCol ?> bg-my-shelf" style="padding:18px 18px 10px;margin-bottom: 10px;">
            <a href="javascript:showWishlistGroup(<?= $defalutWishlist->productShelfId ?>,0);" style="cursor: pointer;color: #000;display: none;" id="hideGroup-<?= $defalutWishlist->productShelfId ?>"><!-- click for hidden -->
                <?= $a . '' . strtoupper($defalutWishlist->title) ?><i class="fa fa-chevron-up pull-right" aria-hidden="true"></i>
            </a>
            <a href="javascript:showWishlistGroup(<?= $defalutWishlist->productShelfId ?>,1);" style="cursor: pointer;color: #000;" id="showGroup-<?= $defalutWishlist->productShelfId ?>"><!-- click for show -->
                <?= $a . '' . strtoupper($defalutWishlist->title) ?><i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
            </a>
            <a href="" data-toggle="modal" data-target="#WishlistModal" class="pull-right">
                <u>What's this? </u>
            </a>
        </div>

        <div id="wishListShelf-<?= $defalutWishlist->productShelfId ?>" style="display: none;">
            <?php
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
    }
    ?>
</div>
<div id="fav">
    <?php
//favorit story
    $favoriteStories = ProductShelf::favoriteStories();
    $allFavorite = FavoriteStory::allFavoriteStories();

    if (isset($favoriteStories)) {
        $a = "<i class='fa fa-star' aria-hidden='true' style='color:#FFCC00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
        ?><!-- click for hidden -->
        <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="">
            <a href="javascript:showFavorite(0);" style="cursor: pointer;color: #000;display:none; padding:18px 18px 10px;margin-bottom: 10px;" id="hidefav" class="bg-my-shelf">
        <?//= $a . '' . $favoriteStories->title ?><i class="fa fa-chevron-up pull-right" aria-hidden="true"></i>
            </a>
        </div>-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-my-shelf" style="padding:18px 18px 10px;margin-bottom: 10px;">
            <a href="javascript:showFavorite(0);" style="cursor: pointer;color: #000;display:none;" id="hidefav" class="bg-my-shelf"><!-- click for hidden -->
                <?= $a . '' . strtoupper($favoriteStories->title) ?><i class="fa fa-chevron-up pull-right" aria-hidden="true"></i>
            </a><!-- click for show -->
            <a href="javascript:showFavorite(1);" style="cursor: pointer;color: #000;" id="showfav">
                <?= $a . '' . strtoupper($favoriteStories->title) ?><i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
            </a>
            <a href="" data-toggle="modal" data-target="#FavoriteModal" class="pull-right">
                <u>What's this? </u>
            </a>
        </div>

        <?php
        if ($allFavorite != FALSE) {
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
            <?php
        } else {
            ?>
            <div class="<?= $fullCol ?>"id="showFavoriteItem" style="display:none;">
                <h4>No story in fav item <span style="margin-left:20px;font-size:12pt;">
                        <!--<a href="" data-toggle="modal" data-target="#FavoriteModal"><u>What's this? </u></a></span>-->
                </h4>
            </div>
            <?php
        }
    }
    ?>
</div>
<div id="allShelf2">
    <?php
    //shelf
    $allshelf = ProductShelf::wishListGroup();
    if (isset($allshelf) && count($allshelf) > 0) {
        foreach ($allshelf as $shelf):
            if ($shelf->type == 2) {
                $a = "<i class='fa fa-gratipay' aria-hidden='true' style='color:#FF6699;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
            }
            ?>
            <div class="<?= $col10 ?> bg-my-shelf" style="cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(<?= $shelf->productShelfId ?>, 1);" id="showGroup-<?= $shelf->productShelfId ?>">
                <?= $a . '' . $shelf->title ?>
            </div>
            <div class="<?= $col10 ?> bg-my-shelf" style="display: none;cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(<?= $shelf->productShelfId ?>, 0);" id="hideGroup-<?= $shelf->productShelfId ?>">
                <?= $a . '' . $shelf->title ?>
            </div>

            <div class="<?= $col2 ?> bg-my-shelf text-right" style="padding:18px 18px 10px;margin-bottom: 10px; color:#FF6699;">
                <a href="" data-toggle="modal" data-target="#ShelfModal" class="pull-left">
                    <u>What's this? </u>
                </a>
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:editShelf(<?= $shelf->productShelfId ?>, 1)" id="showEditShelf<?= $shelf->productShelfId ?>"></i>
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;display: none;" onclick="javascript:editShelf(<?= $shelf->productShelfId ?>, 0)" id="hideEditShelf<?= $shelf->productShelfId ?>"></i>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-trash" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:deleteShelf(<?= $shelf->productShelfId ?>)"></i>
            </div>
            <div id="editShelf<?= $shelf->productShelfId ?>" style="display: none;" class="col-md-12">

                <h4>Shelf Name</h4>
                <input type="text" name="shelfName" class="fullwidth input-lg" id="shelfName<?= $shelf->productShelfId ?>" style="margin-bottom: 10px;" value="<?= $shelf->title ?>">
                <div class='text-right' style=''>
                    <input type="hidden" id="productSuppId" value="no">
                    <a href="javascript:cancelEditShelf(<?= $shelf->productShelfId ?>)"class="btn btn-black" id="cancelEditShelf<?= $shelf->productShelfId ?>">Cancel</a>&nbsp;&nbsp;&nbsp;
                    <a href="javascript:updateShelf(<?= $shelf->productShelfId ?>)"class="btn btn-yellow"id="updateShelf<?= $shelf->productShelfId ?>">Update</a>
                </div>
            </div>
            <div id="wishListShelf-<?= $shelf->productShelfId ?>" style="display: none;">

                <?php
                $wishlists = DisplayMyAccount::myAccountWishList($shelf->productShelfId, 8);
                if (isset($wishlists) && count($wishlists) > 0) {
                    foreach ($wishlists as $value):
                        product($value['wishlistId'], $value['image'], $value['brand'], $value['title'], $value['price_s'] . ' THB', $value['price_s'] . ' THB', $value['url'], $value['productSuppId'], $value['maxQnty'], $value['fastId'], $value['productId'], $value['supplierId'], $value['receiveType'], $shelf->productShelfId);
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
    ?>
</div>
<div class="modal fade" id="ShelfModal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWishlistModal"><i class="fa fa-times"></i>
                </button>
                <h3>MY SHELF</h3>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <?= common\helpers\Faq::Faqs('My Shelf') ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<div class="modal fade" id="WishlistModal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWishlistModal"><i class="fa fa-times"></i>
                </button>
                <h3>MY WISHLIST</h3>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <?= common\helpers\Faq::Faqs('My WISHLIST') ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<div class="modal fade" id="FavoriteModal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWishlistModal"><i class="fa fa-times"></i>
                </button>
                <h3>MY FAVORITE STORY</h3>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <?= common\helpers\Faq::Faqs('My favorite story') ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>