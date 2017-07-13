<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = isset($productPost->title) ? 'Stories ' . $productPost->title : '';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .btn-radio {
        width: 100%;
    }
    .img-radio {
        opacity: 0.5;
        margin-bottom: 5px;
    }

    .space-20 {
        margin-top: 20px;
    }
</style>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="col-xs-12 bg-white">
                    <h1 class="page-header"><?= $productPost->title ?> </h1>
                    <?php
                    if (isset($productPost->shortDescription)) {
                        ?>
                        <p>
                            <?= $productPost->shortDescription ?>
                        </p>
                        <hr>
                    <?php } ?>
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
                            <?php
                            ?>
                            <?= $this->render('@app/themes/cozxy/layouts/story/compare_price', ['modelComparePrices' => $modelComparePrices, 'country' => $country, 'productPostId' => $productPost->productPostId, 'productPost' => $productPost, 'comparePrice' => $comparePrice, 'currency' => $currency]) ?>
                        </div>
                    </div>
                </div>
                <?php
                if (isset(Yii::$app->user->id)) {
                    ?>
                    <div id="1234" style="border-color:#fff;">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9">
                                    <form class="form-horizontal" role="form" style="margin-bottom: 15px;">
                                        <div class="row">
                                            <?php if (Yii::$app->user->id == $productPost->userId) { ?>
                                                <div class="col-xs-4">
                                                    <a class="btn btn-primary btn-radio" href="<?= Yii::$app->homeUrl ?>story/update-stories/<?=
                                                    $productPost->encodeParams(
                                                    ['productId' => $productPost->productId, 'productPostId' => $productPost->productPostId, 'productSuppId' => $productSuppId])
                                                    ?>" style="padding: 6px 16px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit My Stories</a>
                                                </div>
                                            <?php } ?>
                                            <div class="col-xs-4">
                                                <a class="btn btn-success btn-radio" onclick="CozxyComparePriceModernBest(0, 'add', '')">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New Price
                                                </a>
                                                <input type="checkbox" id="middle-item" class="hidden">
                                            </div>
                                            <div class="col-xs-4">
                                                <a class="btn btn-warning btn-radio" href="<?= Yii::$app->homeUrl ?>product/<?=
                                                $productPost->encodeParams(['productId' => $productPost->productId, 'productSupplierId' => $productSuppId]);
                                                ?>" style="padding: 6px 16px;"><i class="fa fa-eye" aria-hidden="true"></i> View Product</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?= $this->render('_stars', ['productPost' => $productPost]) ?>
            <?= $this->render('_faverlis', ['productPost' => $productPost]) ?>
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
