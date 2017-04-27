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
            <?php //echo $this->render('@app/views/products/product_catalog_item', ['productPostViewMem' => $productPostViewMem, 'productPost' => $productPost, 'model' => $model, 'productSupplierId' => $productSupplierId, 'getPrductsSupplirs' => $getPrductsSupplirs, 'supplierPrice' => $supplierPrice]); ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" style="border-top: 1px #e6e6e6 solid; padding: 10px; text-align: center; border-bottom: 1px #e6e6e6 solid;">
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
                'action' => '/reviews/create-review',
                'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
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
                            'id' => 'reviews-rate', 'class' => 'reviews-rate-see'
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

                        echo Html::hiddenInput('productPostId', $productPostId);
                        echo Html::hiddenInput('productSupplierId', $productSupplierId);
                        echo Html::hiddenInput('productId', $model->productId);
                        ?>
                        <button class="btn btn-black btn-xs " role="button" id="write-reviews">Write a review</button>
                    <?php } else { ?>
                        <a href="#" class="btn btn-black btn-xs" role="button" id="write-reviews">Member Only</a>
                    <?php } ?>
                </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" style="border-top: 1px #e6e6e6 solid; padding: 10px; text-align: center; border-left: 1px #e6e6e6 solid; border-bottom: 1px #e6e6e6 solid;">
            <?php
            $form = ActiveForm::begin([
                'action' => '/reviews/create-post',
                'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-9">{input}</div>',
                    'labelOptions' => [
                        'class' => 'col-sm-3 control-label'
                    ]
                ]
            ]);
            ?>
            <div class="col-md-12" style="margin-top: 10px; ">
                <h5>Write a post</h5>
            </div>
            <div class="col-md-12"  style="margin-top: 47px; ">
                <?php
                if (\Yii::$app->user->id != '') {
                    //echo $form->field($model, 'productPostId')->hiddenInput(['value' => $productPostId])->label(false);
                    //echo $form->field($model, 'productSupplierId')->hiddenInput(['value' => $productSupplierId])->label(false);
                    //echo $form->field($model, 'productId')->hiddenInput(['value' => $model->productId])->label(false);
                    echo Html::hiddenInput('productPostId', $_GET['productPostId']);
                    echo Html::hiddenInput('productSupplierId', $_GET['productSupplierId']);
                    echo Html::hiddenInput('productId', $_GET['productId']);
                    ?>
                    <button class="btn btn-black btn-xs" role="button" id="write-reviews">Submit Post</button>
                <?php } else { ?>
                    <a href="#" class="btn btn-black btn-xs" role="button" id="write-reviews">Member Only</a>
                <?php } ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
            //if (\Yii::$app->user->id != '') {
            ?>
            <div class="Reviews" style="margin-left: 10px;">
                <div class="post">
                    <?php
                    $productPostList = \common\models\costfit\ProductPost::find()->where('productPostId =' . $_GET['productPostId'])->one();
                    ?>
                </div>
                <div class="Reviews" style="margin-left: 10px;">
                    <br>
                    <h5 style="text-decoration: underline; font-size:14px;">ค่าเฉลี่ยของคะแนนที่ได้จากลูกค้า :
                        <small style="color: #0000ff">( Post : <?php echo $productPostList->title; ?> )</small>
                    </h5>
                    <div class="post">
                        <?php
                        $post = common\models\costfit\ProductPostRating::find()->where('productPostId=' . $_GET['productPostId'])->count();
                        // /see-review?productPostId=218&productSupplierId=218&productId=145
                        if ($post > 0) {
                            $number = 1;
                            $rating_score = \common\helpers\Reviews::RatingInProduct($_GET['productSupplierId'], $_GET['productPostId']);
                            $rating_member = \common\helpers\Reviews::RatingInMember($_GET['productSupplierId'], $_GET['productPostId']);
                            //echo $rating_score . '::';
                            //echo $rating_member;
                            if ($rating_score == 0 && $rating_member == 0) {
                                $results_rating = 0;
                            } else {
                                $results_rating = $rating_score / $rating_member;
                            }
                            ?>
                            <div style="padding: 5px;">
                                <div class="col-md-12">
                                    <?php
                                    echo \yii2mod\rating\StarRating::widget([
                                        'name' => "input_name_" . $_GET['productSupplierId'],
                                        'value' => $results_rating,
                                        'options' => [
                                            // Your additional tag options
                                            'id' => 'reviews-rate-' . $_GET['productSupplierId'], 'class' => 'reviews-rate-see',
                                        ],
                                        'clientOptions' => [
                                        // Your client options
                                        ],
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo '<div class="col-md-12" style="font-size: 12px;color:#e26a00; padding: 5px;"><span style="font-size: 14px; color:#000;">' . number_format($results_rating, 3) . '</span> จาก 5 คะแนน </div>';
                                    echo '<div class="col-md-12" style="font-size: 12px;color:#e26a00;padding: 5px;">' . number_format($rating_score) . '  คะแนนของPostนี้จาก ' . $post . ' รีวิว</div>';
                                    ?>
                                    <br>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                            <hr>
                            <?php
                        }
                        $rating = common\models\costfit\ProductPostRating::find()->where('productPostId=' . $_GET['productPostId'])->all();
                        foreach ($rating as $postxRating) {
                            $member = \common\models\costfit\User::find()->where('userId=' . $postxRating->userId)->one();
                            ?>
                            <div class="col-md-12 post" style="text-align: left;">

                                <footer>
                                    <div class="share">
                                        <a href="#"> <i class="fa fa-user"></i> <?php echo $member->firstname; ?></a>
                                        <a href="#"> <i class="fa fa-calendar"></i> <?php echo $postxRating->createDateTime; ?></a>
                                    </div>
                                    <blockquote>
                                        <?php
                                        //echo $rating['score'];
                                        echo \yii2mod\rating\StarRating::widget([
                                            'name' => "input_name_" . $postxRating['score'],
                                            'value' => $postxRating['score'],
                                            'options' => [
                                                // Your additional tag options
                                                'id' => 'rating-score-' . $postxRating['score'], 'class' => 'rating-score',
                                            ],
                                            'clientOptions' => [
                                            // Your client options
                                            ],
                                        ]);
                                        ?>
                                        <?php
                                        echo '( <span style="font-size: 12px;color:#e26a00;">' . number_format($postxRating['score'], 3) . ' จาก 5 คะแนน</span> )';
                                        ?>
                                    </blockquote>
                                </footer>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php //}   ?>
        </div>
    </div>
</section>

<?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
<!--Catalog Grid-->

