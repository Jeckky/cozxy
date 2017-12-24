
<?php
if (isset($model->user->avatar) && !empty($model->user->avatar)) {
    $i = '1';
    $avatar = \Yii::$app->homeUrl . 'images/user/avatar/' . $model->user->avatar;
} else {
    $i = '2';
    $avatar = \Yii::$app->homeUrl . 'images/user/avatar/15102837165a0519c4d1f007.74678703.png';
    //\Yii::$app->homeUrl . 'images/user/avatar/150952763159f9904f9095d6.52583311.jpg'
}
?>
<div class=" item-to-stories-<?= $model->productPostId ?> card"  style="float: left;  border-top: 1px #d8d8d8 solid; padding: 5px; width: 100% !important;">
    <!--<div class="col-sm-3" style=" padding: 2px; ">-->
    <div class="hovercard product-img">
        <img id="viewPost" data-src="holder.js/64x64" src="<?= isset($model->product) ? \Yii::$app->homeUrl . $model->product->productImageThumbnail() : Base64Decode::DataImageSvg('Svg260x260') ?>" class="fullwidth"  style="border-bottom: 1px #d8d8d8 solid;">
        <div class="avatar" id="<?= $i ?>">
            <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>">
                <img src="<?= $avatar ?>" alt=""/>
            </a>
        </div>
        <div class="info">

            <p class="brand">
                <span class="size14"><?= isset($model->product->brand) ? strtoupper($model->product->brand->title) : 'NO BRAND' ?></span>
            </p>
            <p class="name">
                <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>" class="fc-black size14 b"><?= isset($model->product->title) ? substr($model->product->title, 0, 35) : '' ?></a>
            </p>
            <p class="name">
                <a href="<?= Yii::$app->homeUrl . 'story/' . $model->encodeParams(['productPostId' => $model->productPostId]) ?>"> <?= isset($model->title) ? substr($model->title, 0, 35) : '' ?></a>
            </p>
            <div class="desc">
                <i class="fa fa-eye" style="color:#989898;"></i>&nbsp;<span style="color:rgb(254, 230, 10)"><?= $model->countView() ?></span>&nbsp;
                <i class="fa fa-star" style="color:#989898;"></i>&nbsp;<span style="color:rgb(254, 230, 10); "><?= $model->averageStar() ?></span>
            </div>
            <div class="desc"></div>
        </div>


    </div>
</div>