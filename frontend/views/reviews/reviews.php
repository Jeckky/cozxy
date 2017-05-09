<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;

//use kartik\;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$createDateTime = $this->context->dateThai(Yii::$app->user->identity->createDateTime, 1);
?>

<div class="row cs-page">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <h4 class="profile-title-head">
                <span class="profile-title-head">My Stories</span>
            </h4>
            <hr>
            <br>
        </div>

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <!--Review Product-->

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
                .reviews-rate > img {
                    display: initial;
                    max-width: 100%;
                    height: auto;
                }
            </style>
            <div class="row">
                <?php
                if (count($productPost) > 0) {
                    foreach ($productPost as $key => $value) {
                        echo ' <div class="col-md-6">';
                        echo ' <div class="col-md-12" style="border: 1px solid rgba(178, 178, 178, 0.06) ;margin-bottom: 3px;">';
                        //$rating_score = 0;
                        $member = \common\models\costfit\User::find()->where('userId=' . $value->userId)->one();
                        $rating_score = \common\helpers\Reviews::RatingInProduct($value->productSuppId, $value->productPostId);
                        $rating_member = \common\helpers\Reviews::RatingInMember($value->productSuppId, $value->productPostId);
                        $rating_count = \common\models\costfit\ProductPost::find()->where('productSuppId=' . $value->productSuppId)->count('productSuppId');
                        //echo $rating_score . '::';
                        //echo $rating_member;
                        if ($rating_score == 0 && $rating_member == 0) {
                            $results_rating = 0;
                        } else {
                            $results_rating = $rating_score / $rating_member;
                        }

                        $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                        foreach ($productPostList as $valuex) {
                            $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('ordering asc')->limit(1)->all();
                            $productViews = common\models\costfit\ProductPageViews::find()->where('productSuppId=' . $value->productSuppId)->count();
                            ?>
                            <div class="col-md-12 text-center" style="padding-left: 0px; padding-right: 0px; height: 60px;"><br>
                                <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>" style="font-size: 14px; margin-top: 5px;">
                                    <h4>
                                        <?php
                                        //echo strlen($valuex->title) . '<br>';
                                        if (strlen($valuex->title) >= 35) {
                                            echo substr($valuex->title, 0, 35);
                                        } else if (strlen($valuex->title) < 35) {
                                            echo substr(ltrim(rtrim($valuex->title)), 0, 35) . '<br>';
                                        }
                                        ?>
                                    </h4>
                                </a>
                            </div>
                            <div class="col-md-12" style="padding: 5px; ">
                                <div class="col-md-12 text-center">
                                    <?php
                                    //echo 'This has been rated: ' . $results_rating . '/ 5  ';
                                    /* echo \yii2mod\rating\StarRating::widget([
                                      'name' => "input_name_" . $value['productPostId'],
                                      'value' => $results_rating,
                                      'options' => [
                                      // Your additional tag options
                                      'id' => 'reviews-rate-' . $value['productPostId'], 'class' => 'reviews-rate',
                                      ],
                                      'clientOptions' => [
                                      // Your client options
                                      ],
                                      ]); */
                                    ?>
                                </div>
                                <div class="col-md-12 text-center" style=" border-bottom: 0px #e6e6e6 dotted; border-bottom: 1px #bbb dotted;">
                                    <?php
                                    echo '<span style="font-size: 12px; color:#3c3434;">This has been rated: ' . number_format($results_rating, 3) . '/5</span>';
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 col-md-12 text-center" style="margin-top: 10px; padding: 5px;height: 390px;">
                                <?php
                                foreach ($productImages as $valueImages) {
                                    if (isset($valueImages['imageThumbnail1']) && !empty($valueImages['imageThumbnail1'])) {
                                        if (file_exists(Yii::$app->basePath . "/web/" . $valueImages['imageThumbnail1'])) {
                                            //echo "<div class=\"col-sm-3\"><img id=\"myImg-" . $valueImages['productImageId'] . "\" onClick=\"reviews_click(" . $valueImages['productImageId'] . ',' . "xx" . ")\"   src=\"/" . $valueImages['imageThumbnail2'] . "\" alt=\"1\" class=\"img-responsive img-thumbnail myImg\"/></div>";
                                            ?>
                                            <div class="col-sm-12 col-lg-12 col-md-12 text-center">
                                                <center>
                                                    <img id="myImg-<?php echo $valueImages['productImageId']; ?>" onclick="reviews_click(<?php echo $valuex->productSuppId; ?>,<?php echo $valueImages['productImageId']; ?>, '<?php echo $valueImages['image']; ?>', '<?php echo $valuex->title; ?>')" src="<?php echo $valueImages['imageThumbnail1']; ?>" alt="1" class="img-responsive  myImg">
                                                </center>
                                            </div>
                                            <?php
                                        } else {
                                            echo "<div class=\"col-sm-12 col-lg-12 col-md-12  text-center\">"
                                            . " <center> <img  class=\"ms-thumb\"  src=\"" . "images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" width=\"137\" height=\"130\" class=\"img-responsive  \"/>"
                                            . " </center></div>";
                                        }
                                    } else {
                                        ?>
                                        <div class="col-sm-12 col-lg-12 col-md-12 text-center">
                                            <center>
                                                <img class="ms-thumb" src="<?php echo "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1" width="137" height="130" class="img-responsive img-thumbnail"/>
                                            </center>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                //}
                                ?>
                            </div>

                            <?php
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                    <?php
                }
                //echo '<hr>';
                ?>


            </div>

        </div>
    </div><!-- Zone left -->

</div>

