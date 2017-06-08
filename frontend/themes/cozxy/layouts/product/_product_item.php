<?php
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
                    <a>
                        <div class="col-xs-4 heartbeat"><i class="fa fa-heartbeat" aria-hidden="true"></i></div>
                    </a>
                <?php } else { ?>
                    <a href="javascript:addItemToWishlist(<?= $model['productSuppId'] ?>);" id="addItemToWishlist-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 heart"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                    </a>
                <?php } ?>
                <?php
                if ($model['maxQnty'] > 0) {
                    ?>
                    <a  href="javascript:addItemToCartUnitys('<?= $model['productSuppId'] ?>',1,'<?= $model['maxQnty'] ?>','<?= $model['fastId'] ?>','<?= $model['productId'] ?>','<?= $model['supplierId'] ?>','<?= $model['receiveType'] ?>')" id="addItemsToCartMulti-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                        <div class="col-xs-4 shopping"><i class="fa fa-cart-plus" aria-hidden="true"></i></div>
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
