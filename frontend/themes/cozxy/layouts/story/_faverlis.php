<div class="panel panel-defailt">
    <?php
    if (isset(Yii::$app->user->identity->userId)) {
        ?>
        <div  style="margin:10px 20px;">
            <a class="btn btn-primary btn-radio" id="bookmarkme" href="#" rel="sidebar">
                <?= $productPost->userId != Yii::$app->user->identity->userId ? 'FAV THIS STORY' : 'Your fav this story' ?>
            </a>
        </div>
    <?php } else { ?>
        <div style="margin:10px 20px;">
            <button type="button" class="btn btn-primary" style="margin:10px 20px;">FAV THIS STORY</button>
        </div>
    <?php } ?>

</div>
