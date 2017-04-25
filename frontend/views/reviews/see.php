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
        <div class="col-lg-12 col-md-12 col-sm-12" style="border-top: 2px #e6e6e6 solid; padding: 10px; text-align: center;">
            <style type="text/css">
                .reviews-rate-see > img {
                    display: initial;
                    max-width: 100%;
                    height: auto;
                    zoom: 1.5;
                }
            </style>
            <?php
            $form = ActiveForm::begin([
                'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'src' => '/reviews/create-review'],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-9">{input}</div>',
                    'labelOptions' => [
                        'class' => 'col-sm-3 control-label'
                    ]
                ]
            ]);
            ?>
            <div class="Reviews text-center" style="  margin-top: 10px; ">
                <h5>Rate this item</h5>
                <div class="col-md-12">
                    <?php
                    //2.Usage without a model
                    echo \yii2mod\rating\StarRating::widget([
                        'name' => "input_name",
                        'value' => 1,
                        'options' => [
                            // Your additional tag options
                            'id' => 'reviews-rate', 'class' => 'reviews-rate-see',
                        ],
                        'clientOptions' => [
                        // Your client options
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-12 text-center"><br> 
                    <?php
                    if (\Yii::$app->user->id != '') {
                        //echo $form->field($model, 'productPostId')->hiddenInput(['value' => $productPostId])->label(false);
                        //echo $form->field($model, 'productSupplierId')->hiddenInput(['value' => $productSupplierId])->label(false);
                        //echo $form->field($model, 'productId')->hiddenInput(['value' => $model->productId])->label(false);
                        echo Html::hiddenInput('productPostId', $productPostId);
                        echo Html::hiddenInput('productSupplierId', $productSupplierId);
                        echo Html::hiddenInput('productId', $model->productId);
                        ?>
                        <button class="btn btn-black btn-xs" role="button" id="write-reviews">Write a review</button>
                    <?php } else { ?>
                        <a href="#" class="btn btn-black btn-xs" role="button" id="write-reviews">Member Only</a>
                    <?php } ?>
                </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
            if (\Yii::$app->user->id != '') {
                ?>
                <h3 style="text-decoration: underline">My Post :</h3>
                <div class="Reviews" style="margin-left: 10px;">
                    <div class="post">

                        <?php
                        if (count($productPostViewMem) > 0) {
                            $nun = 1;
                            foreach ($productPostViewMem as $key => $value) {

                                $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                                foreach ($productPostList as $valuex) {
                                    $member = \common\models\costfit\User::find()->where('userId=' . $value->userId)->one();
                                    ?>
                                    <p class="p-style3" style="border-bottom: 1px #e6e6e6 dotted;">
                                        <a href="/reviews/see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?= $value->productSuppId ?>&productId=<?= $valuex->productId ?>"  role="button"   style="font-size: 14px;">
                                            <?php echo 'Title : ' . strip_tags($value->title); ?></a>
                                        <br>
                                        <?php echo 'Short Desc : ' . strip_tags($value->shortDescription); ?>
                                    </p>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <a href="/reviews/see-review?productSupplierId=<?= $productSupplierId ?>&productId=<?= $model->productId ?>"  role="button" class="panel-toggle" id="see-reviews" style="font-size: 14px;">See all  reviews <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            <?php } ?>
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
                            <h3 style="text-decoration: underline">Post</h3>
                            <style>
                                #brand-carousel-reviews {
                                    padding: 24px 0 48px 0;
                                    border-top: 0px solid #e6e6e6;
                                    border-bottom: 0px solid #e6e6e6;
                                }
                                #brand-carousel-reviews  .owl-prev, #brand-carousel-reviews  .owl-next {
                                    color: #000 !important;
                                }
                            </style>
                            <section class="brand-carousel" id="brand-carousel-reviews">
                                <div class="container">
                                    <div class="inner">
                                        <?php
                                        if (count($productPost) > 0) {
                                            foreach ($productPost as $key => $value) {
                                                $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                                                $rating_score = \common\helpers\Reviews::RatingInProduct($value->productSuppId);
                                                $rating_member = \common\helpers\Reviews::RatingInMember($value->productSuppId);
                                                //echo $rating_score . '::';
                                                //echo $rating_member;
                                                if ($rating_score == 0 && $rating_member == 0) {
                                                    $results_rating = 0;
                                                } else {
                                                    $results_rating = $rating_score / $rating_member;
                                                }
                                                //echo $value->title;
                                                foreach ($productPostList as $valuex) {
                                                    $member = \common\models\costfit\User::find()->where('userId=' . $value->userId)->one();
                                                    ?>
                                                    <div class="text-center" id="reviews-rate-show-<?php echo $value['productPostId']; ?>" style=" margin-left: 2px;border: 1px #e6e6e6 solid; max-height: 160px; min-height: 160px; padding: 5px;">
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
                                                        //echo '<span style="font-size: 12px;">' . number_format($results_rating, 3) . 'จาก 5 คะแนน </span>';
                                                        ?>
                                                        <p class="text-left" style="margin-bottom:2px;">
                                                            <a href="<?php echo Yii::$app->homeUrl; ?>see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>"
                                                               style="font-size: 14px;"><?php echo $value->title; ?></a>
                                                        </p>
                                                        <p class="text-left" style="margin-bottom:2px;"> <?php echo $value->shortDescription; ?></a>
                                                        </p>
                                                        <p>
                                                            <a role="button" class="panel-toggle" id="see-reviews" style="font-size: 14px;"><i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                                        </p>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </section>
                        <?php } ?>
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

                <?php } ?>

            </div>

        </div>

    </div>
</section><!--Wishlist Close-->

<!--Catalog Grid-->

