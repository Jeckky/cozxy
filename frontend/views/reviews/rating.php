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
            <?php echo $this->render('product_catalog_item_rating', ['productPostViewMem' => $productPostViewMem, 'productPost' => $productPost, 'model' => $model, 'productSupplierId' => $productSupplierId]); ?>
        </div>
        <section class="wishlist">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </section>
        <div class="col-lg-12 col-md-12 col-sm-12" style="border-top: 2px #e6e6e6 solid; padding: 10px; text-align: center; ">
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
                'action' => Yii::$app->homeUrl . '/reviews/create-review',
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
                <h5>Rate this story</h5>

                <div class="col-md-12">
                    <?php
                    if (\Yii::$app->user->id != '') {
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
                    }
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
                        <button class="btn btn-black btn-xs " role="button" id="write-reviews">rate !!</button>
                    <?php } else { ?>
                        <a href="#" class="btn btn-black btn-xs" role="button" id="write-reviews">Member Only</a>
                    <?php } ?>
                    <?php
                    if (\Yii::$app->user->id != '') {
                        ?>
                        <a href="<?= Yii::$app->homeUrl ?>reviews/create-post?productSupplierId=<?= $productSupplierId ?>&productId=<?= $model->productId ?>" class="btn btn-success btn-xs" role="button" id="write-reviews" style="margin-top: 10px;">Create your story</a>
                    <?php } ?>
                </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: rgba(255,212,36,.9);">&nbsp;</div>
    </div>
</section>

<?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
<!--Catalog Grid-->

