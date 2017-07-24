<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="product-box">
        <div class="product-img text-center">
            <img src="<?= $model['image'] ?>" alt="" class="fullwidth img-responsive" style="width: 260px; height: 260px;">
        </div>
        <div class="product-txt">
            <p class="size14 fc-g666 text-center">in <?= $model['brand'] ?></p>
            <h4 class="media-heading size14" style="margin:0px; height: 20px; margin-top: 3px;">
                <a href="<?= $model['url'] ?>" class="fc-black"><?= substr($model['head'], 0, 40); ?></a>
            </h4>
            <p class="size12" style="margin:0px;color:#989898; margin-top: 10px;">
                (<a href="<?= $model['url'] ?>" style="color:#989898;word-break: break-all; font-weight: normal;"><?= $model['title'] ?></a>)
            </p>
        </div>
        <div class="row text-center">
            <div class="col-md-6"><i class="fa fa-eye"></i> <?= $model['views'] ?></div>
            <div class="col-md-6"><i class="fa fa-star"></i> <?= $model['star'] ?></div>
        </div>
        <div class="size14">&nbsp;</div>
    </div>
</div>