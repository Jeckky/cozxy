<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="product-box">
        <div class="product-img text-center">
            <a href="<?= $model['url'] ?>" class="fc-black">
                <img src="<?= $model['image'] ?>" alt="" class="fullwidth img-responsive" style="width: 260px; height: 260px;">
            </a>
        </div>
        <div class="product-txt">
            <p class="size14 fc-g666"><?= strtoupper($model['brand']) ?></p>
            <p class="size18 b" style="height:40px;"><a href="<?= $model['url'] ?>" class="fc-black"><?= strtoupper($model['title']) ?></a></p>
        </div>
        <div class="row text-center">
            <div class="col-md-6"><i class="fa fa-eye"></i> <?= $model['views'] ?></div>
            <div class="col-md-6"><i class="fa fa-star"></i> <?= $model['star'] ?></div>
        </div>
        <br>
    </div>
</div>