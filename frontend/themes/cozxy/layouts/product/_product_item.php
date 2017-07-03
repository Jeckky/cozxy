<?php

use yii\bootstrap\ActiveForm;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductShelf;

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
            <img alt="262x262" class="media-object fullwidth img-responsive" data-src="holder.js/262x262" src="<?= $model['image'] ?>" data-holder-rendered="true" style="<?= $width ?>; <?= $height ?>;">
            <div class="v-hover">
                <a href="<?= $model['url'] ?>">
                    <div class="col-xs-4"><i class="fa fa-eye" aria-hidden="true"></i></div>
                </a>
                <?php
                if ($model['wishList'] == 1) { // เคย wishList ไปแล้ว
                    ?>
                    <a href="" data-toggle="modal" data-target="#wishListGroup<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 heart-<?= $model['productSuppId'] ?>"><i class="fa fa-heartbeat" aria-hidden="true"></i></div>
                    </a>
                <?php } else { ?>
                    <a href="javascript:addItemToWishlist(<?= $model['productSuppId'] ?>);" id="addItemToWishlist-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 heart-<?= $model['productSuppId'] ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                    </a>
                    <a href="" data-toggle="modal" data-target="#wishListGroup<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 heart-<?= $model['productSuppId'] ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                    </a>
                <?php } ?>
                <?php
                if ($model['maxQnty'] > 0) {
                    ?>
                    <a  href="javascript:addItemToCartUnitys('<?= $model['productSuppId'] ?>',1,'<?= $model['maxQnty'] ?>','<?= $model['fastId'] ?>','<?= $model['productId'] ?>','<?= $model['supplierId'] ?>','<?= $model['receiveType'] ?>')" id="addItemsToCartMulti-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4 shopping-<?= $model['productSuppId'] ?>'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 shopping-<?= $model['productSuppId'] ?>"><i id="cart-plus-<?= $model['productSuppId'] ?>" class="fa fa-cart-plus" aria-hidden="true"></i></div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="product-txt">
            <?php
            if (isset($model['brand'])) {
                ?>
                <p class="size16 fc-g666"><?= $model['brand'] ?></p>
                <?php
            } else {
                echo '';
            }
            ?>

            <p class="size14 b" style="height:40px;"><a href="<?= $model['url'] ?>" class="fc-black"><?= $model['title'] ?></a></p>

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
<div class="modal fade" id="wishListGroup<?= $model['productSuppId'] ?>" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
                </button>
                <h3>Save to Wish List</h3>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <a style="cursor: pointer;" id="showCreateWishList">Create New Wish List Group</a>
                <a style="cursor: pointer;display: none;" id="hideCreateWishList" >Create New Wish List Group</a>
                <div id="newWishList" style="display: none;">

                    <h4>Name</h4>
                    <input type="text" name="wishListName" class="fullwidth input-lg" id="wishListName" style="margin-bottom: 10px;">
                    <div class="text-right" style="">
                        <a class="btn btn-black" id="cancel-newWishList">Cancle</a>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-yellow"id="create-newWishList" disabled>Create</a>
                    </div>
                </div>
                <div id="allGroup">
                    <?php
                    $whishListGroup = ProductShelf::wishListGroup();
                    if (isset($whishListGroup) && count($whishListGroup) > 0) {
                        foreach ($whishListGroup as $group):
                            $isAdd = ProductShelf::isAddToWishList($model['productSuppId'], $group->productShelfId);
                            ?> <hr>
                            <div class="row">
                                <a href="javascript:addItemToWishlist(<?= $model['productSuppId'] ?>,<?= $group->productShelfId ?>,<?= $isAdd ?>);" id="addItemToWishlist-<?= $model['productSuppId'] ?>" style="color: #000;">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-left text-left">
                                        <?= $group->title ?>
                                    </div>
                                    <?php
                                    //$isAdd = ProductShelf::isAddToWishList($model['productSuppId'], $group->productShelfId);
                                    if ($isAdd) {
                                        ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;color: #ffcc00;" id="heartbeat<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heartbeat" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;display: none;" id="heart-o<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;" id="heart-o<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;display: none;color: #ffcc00;" id="heartbeat<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heartbeat" aria-hidden="true"></i>
                                        </div>
                                    <?php } ?>
                                </a>
                            </div>

                            <?php
                        endforeach;
                    }
                    ?>
                </div>
                <div col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left><hr style=""></div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><img src="<?= Yii::$app->homeUrl . ProductSuppliers::productImageSuppliers($model['productSuppId']) ?>" style="border: #cccccc solid thin;"></div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 text-left">
                        <h3><?= ProductSuppliers::productSupplierName($model['productSuppId'])->title ?></h3>
                        <?= ProductSuppliers::productSupplierName($model['productSuppId'])->shortDescription ?>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>