<div class="col-md-6 col-sm-6 col-xs-6 box-product">
    <div class="product-box">
        <div class="product-img text-center">
            <a href="<?php echo $model['url']; ?>" class="fc-black">
                <img class="media-object img-responsive" src="<?= $model['image'] ?>" width="100%" height="230">
            </a>
        </div>

    </div>
    <div class="text-center">
        <p class="category">
            <a href="<?php echo $model['url']; ?>"><span class="size18"><?= strtoupper($model['title']) ?></span></a>
        </p>
    </div>
</div>
