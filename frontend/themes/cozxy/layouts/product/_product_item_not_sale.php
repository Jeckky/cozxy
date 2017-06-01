<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="product-box">
        <div class="product-img text-center">
            <img src="<?= $model['image'] ?>" alt="" class="fullwidth">
            <div class="v-hover">
                <a href="<?= $model['url'] ?>">
                    <div class="col-xs-6"><i class="fa fa-eye" aria-hidden="true"></i></div>
                </a>
                <a href="javascript:addItemToWishlist(<?= $model['productSuppId'] ?>);" id="addItemToWishlist-<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-6'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>">
                    <div class="col-xs-6"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                </a>
            </div>
        </div>
        <div class="product-txt">
            <p class="size16 fc-g666" ><?= $model['brand'] ?></p>
            <p class="size14 b" style="height:50px;"><a href="<?= $model['url'] ?>" class="fc-black"><?= $model['title'] ?></a></p>
        </div>
    </div>
</div>