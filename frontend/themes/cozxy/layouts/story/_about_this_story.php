<div class="panel panel-defailt">
    <h3 class="page-header" style="margin:10px 20px;">About This Story</h3>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-9">
                <span class="size12">Last Update</span><br>
                <?= \frontend\controllers\MasterController::dateThai($productPost->updateDateTime, 4) ?>
            </div>
            <div class="col-md-3">
                <div class="size12">&nbsp;</div>
                <i class="fa fa-calendar size30"></i>
            </div>
        </div>

        <div class="size14">&nbsp;</div>

        <div class="row">
            <div class="col-md-9">
                <span class="size12">Veiw</span><br>
                <?= \frontend\models\DisplayMyStory::postView($productPost->productPostId) ?>
            </div>
            <div class="col-md-3">
                <div class="size12">&nbsp;</div>
                <i class="fa fa-eye size30"></i>
            </div>
        </div>

        <div class="size14">&nbsp;</div>

        <div class="row">
            <div class="col-md-9">
                <span class="size12">Stars</span><br>
                <?php
                $star = \frontend\models\DisplayMyStory::calculatePostRating($productPost->productPostId);
                echo $star[0];
                ?>
            </div>
            <div class="col-md-3">
                <div class="size12">&nbsp;</div>
                <i class="fa fa-star size30"></i>
            </div>
        </div>
    </div>
</div>

