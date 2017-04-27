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
            <?php echo $this->render('product_catalog_item', ['productPostViewMem' => $productPostViewMem, 'productPost' => $productPost, 'model' => $model, 'productSupplierId' => $productSupplierId, 'getPrductsSupplirs' => $getPrductsSupplirs, 'supplierPrice' => $supplierPrice]); ?>
        </div>
        <section class="wishlist">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12" >
                        <?php
                        //echo '555:' . Yii::$app->controller->action->id;
                        if (Yii::$app->controller->action->id == 'see-review') {
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php
                                //if (\Yii::$app->user->id != '') {
                                ?>
                                <div onclick="ViewsShows()"  class="add-new-icon" style="background-color: rgba(255,212,36,.9); padding: 1px;">
                                    <h3 style="text-decoration: underline; margin-left: 2px;">All Post <i class="fa fa-plus-circle" aria-hidden="true" style="zoom: .7"></i></h3>
                                </div>
                                <style>
                                    #brand-carousel-reviews {
                                        padding: 24px 0 48px 0;
                                        border-top: 0px solid #e6e6e6;
                                        border-bottom: 0px solid #e6e6e6;
                                    }
                                    #brand-carousel-reviews  .owl-prev, #brand-carousel-reviews  .owl-next {
                                        color: #000 !important;
                                    }
                                    .test{
                                        overflow-y: scroll;
                                        overflow-x: hidden;
                                        height: 150px;
                                        color: #635d5d;
                                    }
                                </style>
                                <section class="brand-carousel" id="brand-carousel-reviews">
                                    <div class="container">
                                        <div class="inner">
                                            <?php
                                            if (count($productPostViewMem) > 0) {
                                                foreach ($productPostViewMem as $key => $value) {
                                                    $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                                                    $rating_score = \common\helpers\Reviews::RatingInProduct($value->productSuppId, $value->productPostId);
                                                    $rating_member = \common\helpers\Reviews::RatingInMember($value->productSuppId, $value->productPostId);
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
                                                        $userDatabase = $value->userId;
                                                        $userLogin = Yii::$app->user->identity->userId;
                                                        ?>
                                                        <div class="text-center  " id="reviews-rate-show-<?php echo $value['productPostId']; ?>" style=" margin-left: 2px;border: 1px rgba(255,212,36,.9) solid; max-height: 460px; min-height: 160px; padding: 5px;">
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
                                                            <div class="text-left" style="margin-bottom:2px; border-bottom: 1px #e6e6e6 dashed;">
                                                                <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-rating?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>"
                                                                   style="font-size: 13px;"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $value->title; ?></a>
                                                            </div>
                                                            <div class="text-left test" style="margin-bottom:2px; font-size: 12px; height: 120px;">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->shortDescription; ?>
                                                            </div>
                                                            <div style="text-align: right;">
                                                                <a role="button"  onclick="views_click('<?php echo $value->productPostId ?>', '<?php echo $valuex->productSuppId; ?>', '<?php echo $valuex->productId; ?>')"  class="panel-toggle" id="see-reviews" style="font-size: 14px; border-bottom: 0px dashed #292c2e;"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php
                                            if (count($productPost) > 0) {
                                                foreach ($productPost as $key => $value) {
                                                    $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                                                    $rating_score = \common\helpers\Reviews::RatingInProduct($value->productSuppId, $value->productPostId);
                                                    $rating_member = \common\helpers\Reviews::RatingInMember($value->productSuppId, $value->productPostId);
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
                                                        $userDatabase = $value->userId;
                                                        $userLogin = Yii::$app->user->identity->userId;
                                                        ?>
                                                        <div class="text-center  " id="reviews-rate-show-<?php echo $value['productPostId']; ?>" style=" margin-left: 2px;border: 1px #e6e6e6 solid; max-height: 460px; min-height: 160px; padding: 5px;">
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
                                                            <div class="text-left" style="margin-bottom:2px; border-bottom: 1px #e6e6e6 dashed;">
                                                                <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-rating?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>"
                                                                   style="font-size: 13px;"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $value->title; ?></a>
                                                            </div>
                                                            <div class="text-left test" style="margin-bottom:2px; font-size: 12px; height: 120px;">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->shortDescription; ?>
                                                            </div>
                                                            <div style="text-align: right;">
                                                                <a role="button"  onclick="views_click('<?php echo $value->productPostId ?>', '<?php echo $valuex->productSuppId; ?>', '<?php echo $valuex->productId; ?>')"  class="panel-toggle" id="see-reviews" style="font-size: 14px; border-bottom: 0px dashed #292c2e;"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </section>
                                <?php //}  ?>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

    </div>
</section>

<?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
<!--Catalog Grid-->

