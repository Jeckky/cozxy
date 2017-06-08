<div class="panel panel-defailt">
    <?php
    if (isset(Yii::$app->user->identity->userId)) {
        ?>
        <h3 class="page-header" style="margin:10px 20px;"><?= $productPost->userId != Yii::$app->user->identity->userId ? 'Rate this sotry' : 'Your story rate' ?></h3>
    <?php } else { ?>
        <h3 class="page-header" style="margin:10px 20px;">Story rate</h3>
    <?php } ?>
    <div class="panel-body text-center fc-yellow3 size24">
        <?php
        if (isset(Yii::$app->user->identity->userId)) {
            if ($productPost->userId != Yii::$app->user->identity->userId) {
                ?>
                <?=
                \yii2mod\rating\StarRating::widget([
                    'name' => "star_rate",
                    'value' => \frontend\models\DisplayMyStory::userStarRating($productPost->userId, $productPost->productPostId),
                    'options' => [
                        // Your additional tag options
                        'id' => 'reviews-rate',
                        'class' => 'reviews-rate-see',
                        'style' => 'zoom:1.7;'
                    ],
                    'clientOptions' => [
                    // Your client options
                    ],
                ]);
                ?>

                <?php
            } else {
                $star = \frontend\models\DisplayMyStory::calculatePostRating($productPost->productPostId);
                $value = [];
                if ($star != '') {
                    $value = explode(",", $star);
                }
                for ($i = 0; $i < $value[1]; $i++):
                    ?>
                    <i class="fa fa-star" aria-hidden="true" style="zoom:1.2;"></i>
                    <?php
                    if ($value[2] != 0) {
                        ?>
                        <i class="fa fa-star-half-o" aria-hidden="true" style="zoom:1.2;"></i>
                        <?php
                    }
                endfor;
                if ($value[2] != 0) {
                    $value[1] += 1;
                }
                $oStar = 5 - $value[1];
                for ($i = 0; $i < $oStar; $i++):
                    ?>
                    <i class="fa fa-star-o" aria-hidden="true" style="zoom:1.2;"></i>
                    <?php
                endfor;
                if ($value[0] > 1) {
                    $text = 'Stars';
                } else {
                    $text = 'Star';
                }
                echo '<br><span style="color:#000;font-size: 15pt;">' . $value[0] . ' ' . $text . '</span>';
            }
        } else {
            $star = \frontend\models\DisplayMyStory::calculatePostRating($productPost->productPostId);
            $value = [];
            if ($star != '') {
                $value = explode(",", $star);
            }
            for ($i = 0; $i < $value[1]; $i++):
                ?>
                <i class="fa fa-star" aria-hidden="true" style="zoom:1.2;"></i>
                <?php
                if ($value[2] != 0) {
                    ?>
                    <i class="fa fa-star-half-o" aria-hidden="true" style="zoom:1.2;"></i>
                    <?php
                }
            endfor;
            if ($value[2] != 0) {
                $value[1] += 1;
            }
            $oStar = 5 - $value[1];
            for ($i = 0; $i < $oStar; $i++):
                ?>
                <i class="fa fa-star-o" aria-hidden="true" style="zoom:1.2;"></i>
                <?php
            endfor;
            if ($value[0] > 1) {
                $text = 'Stars';
            } else {
                $text = 'Star';
            }
            echo '<br><span style="color:#000;font-size: 15pt;">' . $value[0] . ' ' . $text . '</span>';
        }
        ?>
        <input type="hidden" id="userId" value="<?= $productPost->userId ?>">
        <input type="hidden" id="postId" value="<?= $productPost->productPostId ?>">
    </div>
</div>
