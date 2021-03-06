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
                        <?= Html::img(Url::home() . 'imgs/Asset30.png', ['width' => '50', 'height' => '30', 'style' => 'margin-top: -10px;']) ?>
                        <!--<i class="fa fa-eye" aria-hidden="true"></i>-->
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
                    <a  href="javascript:addItemToCartUnitys('<?= $model['productSuppId'] ?>',1,'<?= $model['maxQnty'] ?>','<?= $model['fastId'] ?>','<?= $model['productId'] ?>','<?= $model['supplierId'] ?>','<?= $receiveType ?>')" id="addItemsToCartMulti-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4 shopping-<?= $model['productSuppId'] ?>'><img class='fa fa-cart-plus fa-spin' src='<?= Url::home() ?>imgs/Asset28.png' width='50' height='30' alt='' style='margin-top: -10px;'></div>"><!--<i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i>-->
                        <div class="col-xs-4 shopping-<?= $model['productSuppId'] ?>">
                        <!--<i id="cart-plus-<?//= $model['productSuppId'] ?>" class="fa fa-cart-plus" aria-hidden="true"></i>-->
                            <span id="cart-plus-<?= $model['productSuppId'] ?>">
                                <?= Html::img(Url::home() . 'imgs/Asset28.png', ['width' => '50', 'height' => '30', 'style' => 'margin-top: -10px;', 'class' => 'fa fa-cart-plus']) ?>
                            </span>
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
<div class="modal fade" id="wishListGroup<?= $model['productSuppId'] ?>" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWishlistModal"><i class="fa fa-times"></i>
                </button>
                <h3>Save to shelves</h3>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <a style="cursor: pointer;" id="showCreateWishList">Create New shelves</a>
                <a style="cursor: pointer;display: none;" id="hideCreateWishList" >Create New shelves</a>
                <div id="newWishList" style="display: none;">

                    <h4>Name</h4>
                    <input type="text" name="wishListName" class="fullwidth input-lg" id="wishListName" style="margin-bottom: 10px;">
                    <div class="text-right" style="">
                        <a class="btn btn-black" id="cancel-newWishList">Cancle</a>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-yellow"id="create-newWishList" disabled>Create</a>
                        <input type="hidden" id="productSuppId" name="productSuppId" value="<?= $model['productSuppId'] ?>">
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
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;display: none;" id="heart-o<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;" id="heart-o<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;display: none;color: #ffcc00;" id="heartbeat<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
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
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><img src="<?= Yii::$app->homeUrl . ProductSuppliers::productImageSuppliersSmall($model['productSuppId']) ?>" style="border: #cccccc solid thin;"></div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left pull-right">
                        <?= ProductSuppliers::productSupplierName($model['productSuppId'])->title ?><br>
                        <?= ProductSuppliers::productSupplierName($model['productSuppId'])->shortDescription ?>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>