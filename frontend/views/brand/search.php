<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$categoryId = '';
$brandId = $this->params['brandId'];
$title = $this->params['title'];
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$category = ''; //\common\models\costfit\Category::getRootText($categoryIdBrand);
?>
<style>
    .pagination>.disabled>span{
        border: 0px;
    }
    .page-content {
        padding-top: 60px;
    }
    .catalog-grid .img-height-cozxy .tile-overlay {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        min-height: 100%;
        z-index: 10;
        transition: all .3s;
    }
</style>
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button></div>
            <div class="modal-body">
                <!--Here goes filters dynamically pasted by jQuery-->
            </div>
        </div>
    </div>
</div>
<!--Filters Toggle-->
<div class="filter-toggle" data-toggle="modal" data-target="#filterModal"><i class="fa fa-filter"></i></div>
<div class="page-content">
    <ol class="breadcrumb" style="text-align: left;">
        <li>
            <a href="<?php echo Yii::$app->homeUrl; ?>">Home</a>
        </li>
        <li>
            brand
        </li>
        <li>
            <?php echo $title; ?>
        </li>
    </ol><!--Breadcrumbs Close-->

    <section class="catalog-grid">
        <div class="container">
            <!--<h2 class="with-sorting dark-color">Showing results for</h2>-->
            <!--<div class="sorting">
            <!--                <a href="#">Sort by popularity</a>
                            <a href="#">Sort by price</a>-->
            <!--</div>--><!--sorting-->

            <div class="row">

                <div id="title-product-all" class="col-lg-12 col-md-12 col-sm-12">
                    <h4>&nbsp;&nbsp;&nbsp;RECOMMENDED</h4>
                    <?php
                    Pjax::begin([
                        'id' => 'products'
                    ]);
                    ?>
                    <div class="row products-searchs-brands">

                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $products,
                            'options' => [
                                'id' => 'product-list',
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('_product', ['model' => $model->product]);
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
                            'emptyText' => '',
                        ])
                        ?>

                        <!--    <ul class="pagination">
                                <li class="prev-page"><a class="icon-arrow-left" href="#"></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li class="next-page"><a class="icon-arrow-right" href="#"></a></li>
                            </ul>-->
                    </div>
                    <?php Pjax::end(); ?>
                    <!--Pagination-->
                    <br>

                    <?php
                    Pjax::begin([
                        'id' => 'productsnotsale'
                    ]);
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4>PRODUCT</h4>
                        <br><br>
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'options' => [
                                'id' => 'product-list-not-sale',
                            ],
                            'dataProvider' => $productNotSell,
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('_productNotSell', ['model' => $model]);
                            },
                            'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            'layout' => "{items}{pager}",
                            //    'layout' => "{items}",
                            'pager' => [
                                'prevPageLabel' => '<span class="icon-arrow-left"></span>',
                                'nextPageLabel' => '<span class="icon-arrow-right"></span>',
                                'prevPageCssClass' => 'prev-page',
                                'nextPageCssClass' => 'next-page',
                            ],
                            'emptyText' => '',
                        ])
                        ?>
                    </div>
                    <?php Pjax::end(); ?>

                </div><!--title-product-all-->
            </div><!--row-->
            <!--</div>container-->


        </div>

    </section><!--catalog-grid-->

    <!--Brands Carousel Widget-->

    <!--title-product-all-->

</div>