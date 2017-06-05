<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="product-box">
        <div class="product-img text-center">
            <img src="<?= $model['image'] ?>" alt="" class="fullwidth img-responsive" style="width: 260px; height: 260px;">
            <div class="v-hover">
                <a href="<?= $model['url'] ?>">
                    <div class="col-xs-6"><i class="fa fa-eye" aria-hidden="true"></i></div>
                </a>
                <?php
                if ($model['wishList'] == 1) {// เคย wishList ไปแล้ว
                    ?>
                    <a>
                        <div class="col-xs-4"><i class="fa fa-heartbeat" aria-hidden="true"></i></div>
                    </a>
                <?php } else { ?>

                    <a href="javascript:addItemToWishlist(<?= $model['productSuppId'] ?>);" id="addItemToWishlist-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-6'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>">
                        <div class="col-xs-6"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                    </a>
                <?php } ?>

            </div>
        </div>
        <div class="product-txt">
            <p class="size16 fc-g666" ><?= $model['brand'] ?></p>
            <p class="size14 b" style="height:50px;"><a href="<?= $model['url'] ?>" class="fc-black"><?= $model['title'] ?></a></p>
        </div>
    </div>
</div>