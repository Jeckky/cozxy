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
                        ?><br><br>
                    </div>
                    <form id="reviews-form" method="post" novalidate="novalidate">

                        <!--Left Column-->
                        <div class="col-lg-8 col-md-8 col-sm-8">

                            <div class="form-group">
                                <label for="co-company-name">หัวข้อ</label>
                                <input type="text" class="form-control" id="co-company-name" name="co-company-name" placeholder="Company name">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="order-notes">รายละเอียด</label>
                                <textarea class="form-control" name="order-notes" id="order-notes" rows="4" placeholder="Order notes"></textarea>
                            </div>
                            <a href="/reviews/save" class="btn btn-black btn-sm" role="button" id="write-reviews">Save a review</a>
                            <br><br><br>
                        </div>

                    </form>

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

