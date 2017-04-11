<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style>
    .wishlist-message {
        width: 100%;
        max-width: 1140px;
        max-height: 0;
        overflow: hidden;
        margin: 12px auto 0 auto;
        padding: 0 25px;
        background: #292c2e;
        color: #fff;
        border-radius: 0;
        opacity: 0;
        transition: all .3s
    }

    .wishlist-message.visible {
        max-height: 800px;
        padding: 12px 25px;
        opacity: 1
    }

    .wishlist-message p,
    .wishlist-message i {
        display: block;
        float: left;
        line-height: 1.3;
        margin-top: 9px;
        margin-bottom: 10px;
        color: #fff
    }

    .wishlist-message i {
        margin-right: 20px
    }

    .wishlist-message a {
        display: block;
        float: right
    }

    .wishlist-message:after {
        visibility: hidden;
        display: block;
        content: "";
        clear: both;
        height: 0
    }
</style>
<!--Wishlist-->

<section class="catalog-single">
    <div class="container" >
        <div class="row" id="productItem">
            <?php echo $this->render('@app/views/products/product_catalog_item', ['productPostViewMem' => $productPostViewMem, 'productPost' => $productPost, 'model' => $model, 'productSupplierId' => $productSupplierId, 'getPrductsSupplirs' => $getPrductsSupplirs, 'supplierPrice' => $supplierPrice]); ?>
        </div>
    </div>
</section>

<section class="wishlist">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12" >

                <?php
                if (Yii::$app->controller->action->id == 'see-review') {
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?php
                        if (\Yii::$app->user->id != '') {
                            ?>
                            <h3 style="text-decoration: underline">Post New</h3>
                            <div class="Reviews" style="margin-left: 10px;">
                                <div class="post">
                                    <?php
                                    //$post = common\models\costfit\ProductPost::find()->where('productSuppId=' . $value['productSuppId'])->all();
                                    $number = 1;
                                    $rating_score = \common\helpers\Reviews::RatingInProduct($_GET['productSupplierId']);
                                    $rating_member = \common\helpers\Reviews::RatingInMember($_GET['productSupplierId']);
                                    //echo $rating_score . '::';
                                    //echo $rating_member;
                                    if ($rating_score == 0 && $rating_member == 0) {
                                        $results_rating = 0;
                                    } else {
                                        $results_rating = $rating_score / $rating_member;
                                    }
                                    ?>
                                    <div class="col-md-3">
                                        <?php
                                        echo \yii2mod\rating\StarRating::widget([
                                            'name' => "input_name_" . $_GET['productSupplierId'],
                                            'value' => $results_rating,
                                            'options' => [
                                                // Your additional tag options
                                                'id' => 'reviews-rate-' . $_GET['productSupplierId'], 'class' => 'reviews-rate',
                                            ],
                                            'clientOptions' => [
                                            // Your client options
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-9">
                                        <?php
                                        echo '( <span style="font-size: 12px;color:#e26a00;">' . number_format($results_rating, 3) . ' จาก 5 คะแนน</span> )';
                                        ?>
                                    </div>
                                    <?php
                                    foreach ($productPostViewMem as $postxRating) {

                                        $member = \common\models\costfit\User::find()->where('userId=' . $postxRating->userId)->one();
                                        $rating = common\models\costfit\ProductPostRating::find()->where('productPostId=' . $postxRating['productPostId'] . ' and userId = ' . $postxRating->userId)->one();
                                        ?>
                                        <div class="col-md-12 post" style="text-align: left;">
                                            <footer>
                                                <div class="share">
                                                    <a href="#"> <i class="fa fa-user"></i> <?php echo $member->firstname; ?></a>
                                                    <a href="#"> <i class="fa fa-calendar"></i> <?php echo $postxRating->createDateTime; ?></a>
                                                </div>
                                                <blockquote>
                                                    <p>
                                                        <?php
                                                        echo \yii2mod\rating\StarRating::widget([
                                                            'name' => "input_name_" . $rating['score'],
                                                            'value' => $rating['score'],
                                                            'options' => [
                                                                // Your additional tag options
                                                                'id' => 'rating-score-' . $rating['score'], 'class' => 'rating-score',
                                                            ],
                                                            'clientOptions' => [
                                                            // Your client options
                                                            ],
                                                        ]);
                                                        ?>
                                                    </p>
                                                    <p class="p-style3"><?php echo $postxRating->description; ?></p>
                                                    <!--<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>-->
                                                </blockquote>
                                            </footer>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12" style="border-top: 2px #e6e6e6 solid;">
                        <h3 style="text-decoration: underline">Customer Reviews</h3>
                        <div class="Reviews" style="margin-left: 10px;">
                            <h5>Rate this item</h5>
                            <div class="col-md-3">
                                <?php
                                /* 1.Usage with ActiveForm and model
                                  echo $form->field($model, 'attribute')->widget(\yii2mod\rating\StarRating::className(), [
                                  'options' => [
                                  // Your additional tag options
                                  ],
                                  'clientOptions' => [
                                  // Your client options
                                  ]
                                  ]);
                                 */
                                //2.Usage without a model
                                echo \yii2mod\rating\StarRating::widget([
                                    'name' => "input_name",
                                    'value' => 1,
                                    'options' => [
                                        // Your additional tag options
                                        'id' => 'reviews-rate', 'class' => 'reviews-rate',
                                    ],
                                    'clientOptions' => [
                                    // Your client options
                                    ],
                                ]);
                                ?>
                            </div>

                            <div class="col-md-6 text-left">
                                <?php if (\Yii::$app->user->id != '') { ?>
                                    <a href="/reviews/create-review?productSupplierId=<?= $productSupplierId ?>&productId=<?= $model->productId ?>" class="btn btn-black btn-xs" role="button" id="write-reviews">Write a review</a>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-black btn-xs" role="button" id="write-reviews">Member Only</a>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                    <style>
                        .brand-carousel-reviews {
                            padding: 24px 0 48px 0;
                            border-top: 0px solid #e6e6e6;
                            border-bottom: 0px solid #e6e6e6;
                        }
                        .post footer .meta {
                            display: inline-flex;
                            text-align: left;
                        }
                        .share > a{
                            font-size: 12px;
                        }
                        .p-style3{
                            font-size: 14px;
                            text-align: left;
                        }
                        blockquote {
                            font-size: 14px;
                        }
                        .rating-score > img {
                            display: initial;
                            max-width: 100%;
                            height: auto;

                        }
                    </style>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 style="text-decoration: underline">Other Post</h3>
                        <div class="Reviews" style="margin-left: 10px;">
                            <div class="post">
                                <section class="brand-carousel-reviews">
                                    <?php
                                    if (count($productPost) > 0) {
                                        foreach ($productPost as $key => $value) {
                                            //$rating_score = 0;
                                            $member = \common\models\costfit\User::find()->where('userId=' . $value->userId)->one();
                                            $rating_score = \common\helpers\Reviews::RatingInProduct($value->productSuppId);
                                            $rating_member = \common\helpers\Reviews::RatingInMember($value->productSuppId);
                                            //echo $rating_score . '::';
                                            //echo $rating_member;
                                            if ($rating_score == 0 && $rating_member == 0) {
                                                $results_rating = 0;
                                            } else {
                                                $results_rating = $rating_score / $rating_member;
                                            }

                                            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                                            foreach ($productPostList as $valuex) {
                                                $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('productImageId desc')->limit(4)->all();
                                                ?>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo \yii2mod\rating\StarRating::widget([
                                                        'name' => "input_name_" . $value['productPostId'],
                                                        'value' => $results_rating,
                                                        'options' => [
                                                            // Your additional tag options
                                                            'id' => 'reviews-rate-' . $value['productPostId'], 'class' => 'reviews-rate',
                                                        ],
                                                        'clientOptions' => [
                                                        // Your client options
                                                        ],
                                                    ]);
                                                    echo '<span style="font-size: 12px;color:#e26a00;">' . number_format($results_rating, 3) . ' จาก 5 คะแนน</span>';
                                                    ?>
                                                </div>
                                                <div class="col-md-9 text-left" >
                                                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $valuex->productId, 'productSupplierId' => $valuex->productSuppId]) ?>" style="font-weight:bold; "><?php echo $valuex->title; ?></a>
                                                </div>
                                                <div class="col-sm-12 text-center" style="margin-top: 10px; border-bottom: 1px #e6e6e6 dotted;">
                                                    <?php
                                                    foreach ($productImages as $valueImages) {
                                                        if (isset($valueImages['imageThumbnail2']) && !empty($valueImages['imageThumbnail2'])) {
                                                            if (file_exists(Yii::$app->basePath . "/web/" . $valueImages['imageThumbnail2'])) {
                                                                echo "<div class=\"col-sm-3\"><img class=\"ms-thumb\" src=\"/" . $valueImages['imageThumbnail2'] . "\" alt=\"1\" class=\"img-responsive img-thumbnail\"/></div>";
                                                            } else {
                                                                echo "<div class=\"col-sm-3\"><img  class=\"ms-thumb\"  src=\"" . "images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" width=\"137\" height=\"130\" class=\"img-responsive img-thumbnail\"/></div>";
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="col-sm-3">
                                                                <img class="ms-thumb" src="<?php echo "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1" width="137" height="130" class="img-responsive img-thumbnail"/>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    $post = common\models\costfit\ProductPost::find()->where('productSuppId=' . $value['productSuppId'])->all();
                                                    $number = 1;
                                                    foreach ($post as $postxRating) {
                                                        $member = \common\models\costfit\User::find()->where('userId=' . $postxRating->userId)->one();
                                                        $rating = common\models\costfit\ProductPostRating::find()->where('productPostId=' . $postxRating['productPostId'] . ' and userId = ' . $postxRating->userId)->one();
                                                        ?>
                                                        <div class="col-md-12 post" style="text-align: left;">
                                                            <footer>
                                                                <div class="share">
                                                                    <a href="#"> <i class="fa fa-user"></i> <?php echo $member->firstname; ?></a>
                                                                    <a href="#"> <i class="fa fa-calendar"></i> <?php echo $postxRating->createDateTime; ?></a>
                                                                </div>
                                                                <blockquote>
                                                                    <p>
                                                                        <?php
                                                                        echo \yii2mod\rating\StarRating::widget([
                                                                            'name' => "input_name_" . $rating['score'],
                                                                            'value' => $rating['score'],
                                                                            'options' => [
                                                                                // Your additional tag options
                                                                                'id' => 'rating-score-' . $rating['score'], 'class' => 'rating-score',
                                                                            ],
                                                                            'clientOptions' => [
                                                                            // Your client options
                                                                            ],
                                                                        ]);
                                                                        ?>
                                                                    </p>
                                                                    <p class="p-style3"><?php echo $postxRating->description; ?></p>
                                                                    <!--<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>-->
                                                                </blockquote>
                                                            </footer>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <hr>
                                        <?php
                                    }
                                    ?>
                                </section>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>

    </div>
</section><!--Wishlist Close-->

<!--Catalog Grid-->

