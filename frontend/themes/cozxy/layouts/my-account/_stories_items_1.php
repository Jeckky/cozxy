<div class="col-sm-4" style="border: 1px #989898 solid; padding: 2px;">
    <div class="col-sm-12 text-right"><code>edit</code></div>
    <div class="media-left">
        <a href="<?= $model['url']; ?>">
            <img alt="64x64" class="media-object img-circle" id="viewPost" data-src="holder.js/64x64" src="<?= $model['image'] ?>" data-holder-rendered="true" style="width: 262px; height: 262px;">
        </a>
        <input type="hidden" id="userId" value="<?= isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : '' ?>">
        <input type="hidden" id="postId" value="<?= $model['productPostId'] ?>">
    </div>
    <div class="media-body col-sm-12">
        <p>&nbsp;<p>
        <h4 class="media-heading size14" style="margin:0px;"><?= $model['title'] ?></h4>
        <p class="size12" style="margin:0px;color:#989898;"><?= $model['head'] ?></p>
        <div class="size12">
            <i class="fa fa-eye" style="color:#989898;"></i>
            <span style="color:rgb(254, 230, 10)"><?= $model['views'] ?></span>&nbsp;&nbsp;<i class="fa fa-star" style="color:#989898;"></i>
            <span style="color:rgb(254, 230, 10);margin-right: 2.5cm;"><?= $model['star'] ?></span>
            <span>
                <?php // \yii\bootstrap\Html::a('<i class="fa fa-pencil-square-o"></i>&nbsp;Edit', \yii\helpers\Url::to(['my-account/edit-billing/']), ['class' => 'text-warning']) ?>
                <!--<a href="" data-loading-text="<a><i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i></a>"  class=" text-danger"><i class="fa fa-trash-o"></i>&nbsp;Delete</a>-->
            </span>
        </div>
    </div>
</div>
