<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="product-box">
        <div class="product-img text-center">
            <a href="<?= $model['url'] ?>">
                <img src="<?= $model['image'] ?>" alt="" class="fullwidth img-responsive" style="width: 260px; height: 260px;">
            </a>
        </div>
        <div class="product-txt">
            <p class="brand">
                <span class="size14"><?= isset($model['brand']) ? strtoupper($model['brand']) : 'no information' ?></span>
            </p>
            <p class="name" style="height:40px;">
                <a href="<?= $model['url'] ?>" class="size18 b"><?= strtoupper($model['title']) ?></a>
            </p>
        </div>
        <div class="row text-center">
            <div class="col-md-6"><i class="fa fa-eye"></i> <?= $model['views'] ?></div>
            <div class="col-md-6"><i class="fa fa-star"></i> <?= $model['star'] ?></div>
        </div>
    </div>
</div>