<?php

use common\models\costfit\ProductShelf;
use common\models\costfit\ProductSuppliers;
use yii\helpers\Url;
?>
<div class="col-md-3 col-sm-3 col-xs-4  box-product">
    <div class="product-box">

        <div class="product-img text-center">
            <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->productId])) ?>" class="fc-black">
                <img class="media-object fullwidth img-responsive" src="<?= \Yii::$app->homeUrl . $model->productImageThumbnail() ?>">
            </a>
            <div class="v-hover">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->productId])) ?>">
                    <div class="col-xs-6"><i class="fa fa-eye" aria-hidden="true"></i></div>
                </a>
                <?php
                if (Yii::$app->user->id) {
                    if ($model->isInWishlist() == 1) { // เคย wishList ไปแล้ว
                        ?>
                        <a href="javascript:addItemToDefaultWishlist(<?= $model->productId ?>);">
                            <div class="col-xs-6 heart-<?= $model->productId ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                        </a>
                    <?php } else { ?>
                        <a href="javascript:addItemToDefaultWishlist(<?= $model->productId ?>);" id="heartbeat-<?= $model->productId ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                            <div class="col-xs-6 heart-<?= $model->productId ?>"><i class="fa fa-heart" aria-hidden="true"></i></div>
                        </a>
                        <a href="javascript:addItemToDefaultWishlist(<?= $model->productId ?>);" id="heart-o-<?= $model->productId ?>">
                            <div class="col-xs-6 heart-<?= $model->productId ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
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
            <p class="brand" >
                <span class="size14"><?= isset($model->brand) ? strtoupper($model->brand->title) : 'NO BRAND' ?></span>
            </p>
            <p class="name">
                <a href="<?= Url::to(Yii::$app->homeUrl . 'product/' . $model->encodeParams(['productId' => $model->productId])) ?>" class="size18 b"><?= strtoupper($model['title']) ?></a>
            </p>
        </div>
    </div>
</div>
