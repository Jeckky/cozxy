<?php

use common\models\costfit\FavoriteStory;
?>
<div class="panel panel-defailt">
    <?php
    if (isset(Yii::$app->user->identity->userId)) {
        $isAdd = FavoriteStory::isAddToFavorite($productPost->productPostId);
        ?>
        <div  style="margin:10px 20px;">
            <a href="javascript:addToFavoriteStory(<?= $productPost->productPostId ?>);" class="btn btn-primary btn-radio" id="favorite" style="display:<?= $isAdd ? 'none;' : '' ?>">
                <?= $productPost->userId != Yii::$app->user->identity->userId ? 'Add to Favorite Stories' : 'Your Favorite Stories' ?>
            </a>
            <a href="javascript:unFavoriteStory(<?= $productPost->productPostId ?>);" class="btn btn-warning btn-radio" id="unfavorite" style="display: <?= $isAdd ? '' : 'none' ?>">
                <?= $productPost->userId != Yii::$app->user->identity->userId ? 'UNFAV THIS STORY' : 'Your Favorite Stories' ?>
            </a>
            <div style="margin-top:10px; display: none;" id="showAddSuccess">Add to favorite successful.</div>
            <div style="margin-top:10px; display: none;" id="showDelSuccess">Delete from favorite successful.</div>
        </div>
    <?php } else { ?>
        <div style="margin:10px 20px;">
            <!--            <button type="button" class="btn btn-primary btn-radio" style="margin:10px 20px;">
                           Add to Favorite Stories
                        </button>-->
            <a class="btn btn-primary btn-radio" id="bookmarkme" href="<?= Yii::$app->homeUrl ?>site/login" rel="sidebar">Add to Favorite Stories
            </a>
        </div>
    <?php } ?>

</div>
