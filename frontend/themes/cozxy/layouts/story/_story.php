<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = isset($productPost->title) ? 'Stories ' . $productPost->title : '';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="col-xs-12 bg-white">
                    <h1 class="page-header"><?= $productPost->title ?> </h1>
                    <p>
                        <?= $productPost->description ?>
                        <input type="hidden" name="postId" value="<?= $productPost->productPostId ?>">
                        <input type="hidden" name="user" value="<?= $productPost->userId ?>">
                    </p>
                    <div class="size12">&nbsp;</div>

                </div>
            </div>

            <div class="size20">&nbsp;</div>

            <div class="panel panel-default row" id="1234" style="border-color:#fff;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 compare-price-ajax">
                            <?= $this->render('@app/themes/cozxy/layouts/story/compare_price', ['productPostId' => $productPost->productPostId, 'productPost' => $productPost, 'comparePrice' => $comparePrice, 'currency' => $currency]) ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?= $this->render('_stars', ['productPost' => $productPost]) ?>
            <?= $this->render('_authors', ['productPost' => $productPost, 'productSuppId' => $productSuppId]) ?>
            <?= $this->render('_about_this_story', ['productPost' => $productPost]) ?>

            <?= $this->render('_popular_stories', ['productSuppId' => $productSuppId, 'popularStories' => $popularStories, 'popularStoriesNoneStar' => $popularStoriesNoneStar, 'urlSeeAll' => $urlSeeAll]) ?>
        </div>
        <?php
        $js = "function top(){
            window.location.hash = '#compare'
           }
           window.onload=top;";
        if (isset($_GET["currencyId"])) {
            $this->registerJS($js);
        }
        //$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        // $scrip = "";
        //$this->registerJs($scrip);
        ?>
    </div>
</div>