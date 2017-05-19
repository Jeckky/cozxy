<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="product-box">
        <div class="product-img text-center">
            <img src="<?= $model['image'] ?>" alt="" class="fullwidth">
        </div>
        <div class="product-txt">
            <p class="size16 fc-g666"><?= $model['brand'] ?></p>
            <p class="size14 b"><a href="<?=$model['url']?>" class="fc-black"><?= $model['title'] ?></a></p>
        </div>
        <div class="row text-center">
            <div class="col-md-6"><i class="fa fa-eye"></i> <?=$model['views']?></div>
            <div class="col-md-6"><i class="fa fa-star"></i> <?=$model['star']?></div>
        </div>
    </div>
</div>