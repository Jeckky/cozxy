<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style type="text/css">
    /* #reviews-rate > img{
        width: 50px;
    }*/
    #reviews-rate > img {
        display: initial;
        max-width: 100%;
        height: auto;

    }
</style>
<!--Wishlist-->
<section class="wishlist">
    <div class="container">
        <div class="row">

            <!--Items List-->
            <div class="col-lg-9 col-md-9">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3>Customer Reviews</h3>
                    <div class="Reviews" style="margin-left: 10px;">
                        <h5>Rate this item</h5>
                        <?php
                        echo \yii2mod\rating\StarRating::widget([
                            'name' => "input_name",
                            'value' => 5,
                            'options' => [
                                // Your additional tag options
                                'id' => 'reviews-rate',
                            ],
                            'clientOptions' => [
                            // Your client options
                            ],
                        ]);
                        ?>
                        <br>
                        <a href="/reviews/create-review?ref=" class="btn btn-black btn-sm" role="button" id="write-reviews">Write a review</a>
                        <br><br><br>
                    </div>
                </div>
            </div>

            <!--Sidebar-->
            <div class="col-lg-3 col-md-3" style="margin-bottom: 20px;">
                <br><br><br>
            </div>
        </div>
    </div>
</section><!--Wishlist Close-->

<!--Catalog Grid-->

