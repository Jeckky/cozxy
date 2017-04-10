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
                    <div class="col-lg-12 col-md-12 col-sm-12">
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
                            </div>

                            <div class="col-md-6 text-left">
                                <a href="/reviews/create-review?productSupplierId=<?= $productSupplierId ?>&productId=<?= $model->productId ?>" class="btn btn-black btn-xs" role="button" id="write-reviews">Write a review</a>
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

                    </style>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 style="text-decoration: underline">Other Post</h3>
                        <div class="Reviews" style="margin-left: 10px;">
                            <div class="post">
                                <section class="brand-carousel-reviews">
                                    <?php
                                    if (count($productPost) > 0) {
                                        foreach ($productPost as $key => $value) {
                                            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                                            foreach ($productPostList as $valuex) {
                                                $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('productImageId', 'desc')->limit(5)->one();
                                                ?>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo \yii2mod\rating\StarRating::widget([
                                                        'name' => "input_name",
                                                        'value' => 3,
                                                        'options' => [
                                                            // Your additional tag options
                                                            'id' => 'reviews-rate',
                                                        ],
                                                        'clientOptions' => [
                                                        // Your client options
                                                        ],
                                                    ]);
                                                    ?>
                                                </div>
                                                <div class="col-md-9 text-left">
                                                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $valuex->productId, 'productSupplierId' => $valuex->productSuppId]) ?>"><?php echo $valuex->title; ?></a>
                                                </div>

                                                <div class="col-sm-12 text-center" style="margin-top: 10px;">
                                                    <a class="item" href="#">
                                                        <?php
                                                        if (isset($productImages->imageThumbnail2) && !empty($productImages->imageThumbnail2)) {
                                                            if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail2)) {
                                                                echo "<img class=\"ms-thumb\" src=\"/" . $productImages->imageThumbnail2 . "\" alt=\"1\" class=\"img-responsive img-thumbnail\"/>";
                                                            } else {
                                                                echo "<img  class=\"ms-thumb\"  src=\"" . "images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" width=\"137\" height=\"130\" class=\"img-responsive img-thumbnail\"/>";
                                                            }
                                                        } else {
                                                            ?>
                                                            <img class="ms-thumb" src="<?php echo "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1" width="137" height="130" class="img-responsive img-thumbnail"/>
                                                        <?php } ?> </a>
                                                    <?php
                                                    $post = common\models\costfit\ProductPost::find()->where('productSuppId=' . $value['productSuppId'])->all();
                                                    $number = 1;
                                                    foreach ($post as $postx) {
                                                        $member = \common\models\costfit\User::find()->where('userId=' . $postx->userId)->one();
                                                        ?>
                                                        <div class="col-md-12 post" style="text-align: left;">
                                                            <footer>
                                                                <div class="share">
                                                                    <a href="#"> <i class="fa fa-user"></i> <?php echo $member->firstname; ?><?php echo $member->userId; ?></a>
                                                                    <a href="#"> <i class="fa fa-calendar"></i> <?php echo $postx->createDateTime; ?></a>
                                                                </div>
                                                                <p class="p-style3">comments <?php echo $number++; ?>. <?php echo $postx->description; ?></p>
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

