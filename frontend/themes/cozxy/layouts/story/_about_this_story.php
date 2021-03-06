<div class="panel panel-defailt">
    <?php
    //echo $productPost->userId;
    if (isset(Yii::$app->user->identity->userId)) {
        if (Yii::$app->user->identity->userId == $productPost->userId) {
            $txtStory = 'Dashboard';
        } else {
            $txtStory = 'ABOUT';
        }
    } else {
        $txtStory = 'ABOUT';
    }
    ?>
    <h3 class="page-header" style="margin:10px 20px;">ABOUT THIS STORY</h3>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-9">
                <span class="size12">Last Update</span><br>
                <?= \frontend\controllers\MasterController::dateThai($productPost->updateDateTime, 4) ?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="size12">&nbsp;</div>
                <i class="fa fa-calendar size30"></i>
            </div>
        </div>

        <div class="size14">&nbsp;</div>

        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-9">
                <span class="size12">View</span><br>
                <?= \frontend\models\DisplayMyStory::postView($productPost->productPostId) ?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="size12">&nbsp;</div>
                <i class="fa fa-eye size30"></i>
            </div>
        </div>

        <div class="size14">&nbsp;</div>

        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-9">
                <span class="size12">Stars</span><br>
                <?php
                $star = \frontend\models\DisplayMyStory::calculatePostRating($productPost->productPostId);
                $star = $productPost->averageStar();
                //throw new \yii\base\Exception($productPost->productPostId . '=>' . $star);
                $value = explode(",", $star);
                echo $value[0];
                ?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="size12">&nbsp;</div>
                <i class="fa fa-star size30"></i>
            </div>
        </div>
    </div>
</div>

