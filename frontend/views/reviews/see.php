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
            <?php echo $this->render('product_catalog_item', [ 'productPost' => $productPost, 'model' => $model, 'productSupplierId' => $productSupplierId, 'getPrductsSupplirs' => $getPrductsSupplirs, 'supplierPrice' => $supplierPrice]); ?>
        </div>
        <section class="wishlist">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12" >
                        <?php
                        //echo '555:' . Yii::$app->controller->action->id;
                        if (Yii::$app->controller->action->id == 'see-review') {
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                                <?php
                                //if (\Yii::$app->user->id != '') {
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: rgba(255,212,36,.9); margin-bottom: 5px;">
                                    <div onclick="ViewsShows()"  class="add-new-icon col-md-6 " style="padding: 1px;">
                                        <h3 style="text-decoration: underline; margin-left: 2px;">All Post </h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <?php
                                        if (\Yii::$app->user->id != '') {
                                            ?>
                                            <a href="<?= Yii::$app->homeUrl ?>reviews/create-post?productSupplierId=<?= $productSupplierId ?>&productId=<?= $model->productId ?>" class="btn btn-black btn-xs" role="button" id="write-reviews" style="margin-top: 10px;">Create a story</a>
                                        <?php } ?>
                                    </div>
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
                                <section class="brand-carouselx" id="brand-carousel-reviews">
                                    <div class="container-reviews">
                                        <div class="inner-reviews">

                                            <?php
                                            echo \yii\widgets\ListView::widget([
                                                'dataProvider' => $productPost,
                                                'options' => [
                                                    'id' => 'story-list',
                                                ],
                                                'itemView' => function ($model, $key, $index, $widget) {
                                                    return $this->render('_story', ['model' => $model]);
                                                },
                                                'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                                                'layout' => "{items}{pager}",
                                                //    'layout' => "{items}",
                                                'pager' => [
                                                    //            'firstPageLabel' => 'first',
                                                    //            'lastPageLabel' => 'last',
                                                    'prevPageLabel' => '<span class="icon-arrow-left"></span>',
                                                    'nextPageLabel' => '<span class="icon-arrow-right"></span>',
                                                    //            'maxButtonCount' => 3,
                                                    // Customzing options for pager container tag
                                                    //            'options' => [
                                                    //                'tag' => 'div',
                                                    //                'class' => 'pager-wrapper',
                                                    //                'id' => 'pager-container',
                                                    //            ],
                                                    // Customzing CSS class for pager link
                                                    //            'linkOptions' => ['class' => 'mylink'],
                                                    //            'activePageCssClass' => 'active',
                                                    //            'disabledPageCssClass' => 'mydisable',
                                                    // Customzing CSS class for navigating link
                                                    'prevPageCssClass' => 'prev-page',
                                                    'nextPageCssClass' => 'next-page',
                                                //            'firstPageCssClass' => 'myfirst',
                                                //            'lastPageCssClass' => 'mylast',
                                                ],
                                            ])
                                            ?>
                                        </div>
                                    </div>
                                </section>
                                <?php //}   ?>
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

