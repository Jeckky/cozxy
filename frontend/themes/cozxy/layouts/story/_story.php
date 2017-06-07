<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
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

            <div class="panel panel-default" id="1234">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="page-header">Compare Price</h1>

                            <div class="row">
                                <div class="col-md-2 text-center">
                                    Price Filter
                                </div>
                                <!--                                <div class="col-md-3">
                                                                    <select name="" id="" class="fullwidth">
                                                                        <option value="">Filter 1</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select name="" id="" class="fullwidth">
                                                                        <option value="">Filter 1</option>
                                                                    </select>
                                                                </div>-->
                                <?php
                                $form = ActiveForm::begin(['method' => 'GET',
                                    'id' => 'currency',
                                ]);
                                ?>

                                <div class="col-md-3" style="margin-top: -20px;">
                                    <?=
                                    $form->field($model, 'currencyId')->dropDownList($currency, ['prompt' => 'select Currency',
                                        'class' => 'fullwidth',
                                        'name' => 'currencyId',
                                    ])->label('')
                                    ?>
                                    <input type="hidden" id="productId" value="<?= $productPost->productId ?>">
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>

                            <div class="size20">&nbsp;</div>

                            <div class="row" id="compare">
                                <div class="col-md-10 col-md-offset-1" id="showData">
                                    <?php \yii\widgets\Pjax::begin(); ?>
                                    <?=
                                    GridView::widget([
                                        'dataProvider' => $comparePrice,
                                        'rowOptions' => function($model, $key, $index, $grid) {

                                        },
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            //'ledId',
                                            [
                                                'attribute' => 'Country',
                                                'format' => 'html',
                                                'value' => function($model) {
                                                    return $model->country;
                                                }
                                            ],
                                            [
                                                'attribute' => 'place',
                                                'value' => function($model) {
                                                    return $model->shopName;
                                                }
                                            ],
                                            [
                                                'attribute' => 'price',
                                                'value' => function($model) {
                                                    $acronym = common\models\costfit\Currency::acronym($model->currency);
                                                    return $acronym . " " . number_format($model->price, 2);
                                                }
                                            ],
                                            [
                                                'attribute' => 'Local Price',
                                                'value' => function($model) {
                                                    $localPrice = common\models\costfit\Currency::ToThb($model->currency, $model->price);
                                                    return "THB " . number_format($localPrice, 2);
                                                }
                                            ],
                                        ],
                                    ]);
                                    ?>
                                    <?php \yii\widgets\Pjax::end(); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>


        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?= $this->render('_stars', ['productPost' => $productPost]) ?>
            <?= $this->render('_authors') ?>
            <?= $this->render('_about_this_story', ['productPost' => $productPost]) ?>

            <?= $this->render('_popular_stories', ['productSuppId' => $productSuppId, 'popularStories' => $popularStories, 'popularStoriesNoneStar' => $popularStoriesNoneStar, 'url' => $urlSeeAll]) ?>
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