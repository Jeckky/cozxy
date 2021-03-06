<div class="media">
    <div class="media-left">
        <a href="<?= $model['url']; ?>">
            <img alt="64x64" class="media-object img-circle" id="viewPost" data-src="holder.js/64x64" src="<?= $model['image'] ?>" data-holder-rendered="true" style="width: 64px; height: 64px;">
        </a>
        <input type="hidden" id="userId" value="<?= isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : '' ?>">
        <input type="hidden" id="postId" value="<?= $model['productPostId'] ?>">
    </div>
    <div class="media-body">
        <h4 class="media-heading size14" style="margin:0px;"><?= $model['head'] ?></h4>
        <p class="size12" style="margin:0px;color:#989898;"><?= $model['title'] ?></p>
        <div class="size12">
            <i class="fa fa-eye" style="color:#989898;"></i>
            <span style="color:rgb(254, 230, 10)"><?= $model['views'] ?></span>&nbsp;&nbsp;<i class="fa fa-star" style="color:#989898;"></i>
            <span style="color:rgb(254, 230, 10)"><?= $model['star'] ?></span>
        </div>
    </div>
</div>
<hr>