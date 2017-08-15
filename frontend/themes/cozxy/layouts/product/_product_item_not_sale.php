<?php

use common\models\costfit\ProductShelf;
use common\models\costfit\ProductSuppliers;
?>
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="product-box">
        <div class="product-img text-center">
            <a href="<?= $model['url'] ?>" class="fc-black">
                <img src="<?= $model['image'] ?>" alt="" class="fullwidth img-responsive" style="width: 260px; height: 260px;">
            </a>
            <div class="v-hover">
                <a href="<?= $model['url'] ?>">
                    <div class="col-xs-6"><i class="fa fa-eye" aria-hidden="true"></i></div>
                </a>
                <?php /*
                  if ($model['wishList'] == 1) {// เคย wishList ไปแล้ว
                  ?>
                  <a>
                  <div class="col-xs-4"><i class="fa fa-heart" aria-hidden="true"></i></div>
                  </a>
                  <?php } else { ?>

                  <a href="javascript:addItemToWishlist(<?= $model['productSuppId'] ?>);" id="addItemToWishlist-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-6'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>">
                  <div class="col-xs-6"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                  </a>
                  <?php } */ ?>
                <?php
                if (Yii::$app->user->id) {
                    if ($model['wishList'] == 1) { // เคย wishList ไปแล้ว
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
                } else {
                    ?>
                    <a href="<?= Yii::$app->homeUrl . 'site/login' ?>" >
                        <div class="col-xs-4"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="product-txt">
            <p class="size14 fc-g666" ><?= strtoupper($model['brand']) ?></p>
            <p class="size18 b" style="height:40px;"><a href="<?= $model['url'] ?>" class="fc-black"><?= strtoupper($model['title']) ?></a></p>
        </div>
    </div>
</div>
