<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$categoryId = $this->params['categoryId'];
$title = $this->params['title'];
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style>
    .pagination>.disabled>span{
        border: 0px;
    }
    .page-content {
        padding-top: 60px;
    }
    .tile-overlay-cozxy{
        height: 263px;
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
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>
    </ol><!--Breadcrumbs Close-->

    <section class="catalog-grid">
        <div class="container">
            <h2 class="with-sorting dark-color">Showing results for</h2>
            <div class="sorting">
                <a href="#">Sort by popularity</a>
                <a href="#">Sort by price</a>
            </div><!--sorting-->

            <div class="row">
                <!--Filters-->
                <div class="filters-mobile col-lg-3 col-md-3 col-sm-4">
                    <div class="shop-filters">
                        <!--Category Section-->

                        <section class="filter-section" id="cate">
                            <?php
                            foreach ($this->context->main_category($categoryId) as $value) {
                                ?>
                                <h3><a href="#"><?php echo $value->title; ?></a></h3>
                                <div class="cont-info-widget">
                                    <ul>
                                        <?php
                                        foreach ($this->context->sub_category($value->parentId) as $item) {
                                            if ($value->categoryId != $item->categoryId) {
                                                ?>
                                                <li>&nbsp;&nbsp;<a href="<?php echo Yii::$app->homeUrl; ?>search/<?= $item->createTitle() ?>/<?= $item->encodeParams(['categoryId' => $item->categoryId]) ?>"><?php echo $item->title; ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php } ?>
                            <div class="sorting">
                                <a href="#cate">LESS</a>
                            </div><!--sorting-->
                        </section>

                        <!--Price Section-->
                        <section class="filter-section">
                            <h3>Filter by price</h3>
                            <?php echo $this->render('@app/views/filter/filterbyprice', ['categoryId' => $categoryId, 'title' => $title]); ?>
                        </section>

                        <!--Categories Section-->
                        <section class="filter-section">
                            <h3>Brands</h3>
                            <?php echo $this->render('@app/views/categories/brands', ['categoryId' => $categoryId, 'title' => $title, 'brandIds' => isset($this->params['categoryId']) ? $this->params['categoryId'] : NULL]); ?>
                        </section>
                    </div>
                </div><!--Filters-->
                <div id="title-product-all" class="col-lg-9 col-md-9 col-sm-8">
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
                    <br><br><br>


                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?php
                        //echo $this->render('@app/themes/costfit/layouts/_brand_carousel');
                        ?>
                        <!--Brands Carousel Widget-->
                        <section class="brand-carousel">
                            <div class="container-search">
                                <h2>Brands in our shop</h2>
                                <div class="inner">
                                    <?php
                                    /*
                                      $brands = common\models\costfit\Brand::find()->all();
                                      foreach ($brands as $brand) {
                                      //throw new yii\base\Exception(Yii::$app->basePath . "/web" . $brand->image);
                                      if (file_exists(Yii::$app->basePath . "/web" . $brand->image) && !empty($brand->image)) {
                                      $image = $brand->image;
                                      } else {
                                      $image = Yii::$app->homeUrl . "images/no-image.jpg";
                                      }
                                      ?>
                                      <a class="item" href="#"><img src="<?php echo $image; ?>" alt="" title="ขนาด : 164x120" width="164" height="120" class="img-responsive"/></a>
                                      <?php
                                      } */
                                    ?>
                                    <?php echo $this->render('@app/views/categories/brands_product_suppliers', ['categoryId' => $categoryId, 'title' => $title, 'brandIds' => isset($this->params['categoryId']) ? $this->params['categoryId'] : NULL]); ?>

                                </div>
                            </div>
                        </section><!--Brands Carousel Close-->
                    </div>
                    <?php
                    Pjax::begin([
                        'id' => 'productsnotsale'
                    ]);
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12">

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