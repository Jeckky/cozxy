<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php $this->beginContent('@app/themes/costfit/layouts/main.php'); ?>
<?= $this->render('_modal_login') ?>
<?= $this->render('_header') ?>
<div class="page-content">

    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>
        <li>Shop - filters left 3 cols</li>
    </ol><!--Breadcrumbs Close-->

    <section class="catalog-grid">
        <div class="container">
            <h2 class="with-sorting">Show results for</h2>
            <div class="sorting">
                <a href="#">Sort by name</a>
                <a href="#">Sort by price</a>
            </div><!--sorting-->

            <div class="row">
                <!--Filters-->
                <div class="filters-mobile col-lg-3 col-md-3 col-sm-4">
                    <div class="shop-filters">
                        <!--Category Section-->
                        <section class="filter-section" id="cate">
                            <h3><a href="#">Electricals & Electronics</a></h3>
                            <div class="cont-info-widget">
                                <ul>
                                    <li>&nbsp;&nbsp;Eletrical Household</li>
                                    <li>&nbsp;&nbsp;Television & Home Entertainment</li>
                                    <li>&nbsp;&nbsp;Kitchen Appliance</li>
                                    <li>&nbsp;&nbsp;Mobile & tablet</li>
                                    <li>&nbsp;&nbsp;Computer & Office Electronic</li>
                                </ul>
                            </div>
                            <div class="sorting" style="margin:0 0 0 0; font-size: 12px;">
                                <a href="#cate" style="color: #03a9f4;">LESS</a>
                            </div><!--sorting-->
                        </section>

                        <!--Price Section-->
                        <section class="filter-section">
                            <h3>Filter by price</h3>
                            <?php echo $this->render('@app/views/filter/filterbyprice'); ?>

                        </section>

                        <!--Colors Section
                        <section class="filter-section">
                            <h3>Filter by color</h3>
                        <?php //echo $this->render('@app/views/filter/filterbycolor'); ?>
                        </section>-->

                        <!--Colors Section
                        <section class="filter-section">
                            <h3>Filter by size</h3>
                        <?php //echo $this->render('@app/views/filter/filterbysize'); ?>
                        </section>-->

                        <!--Categories Section
                        <section class="filter-section">
                            <h3>Categories</h3>
                        <?php //echo $this->render('@app/views/categories/categories'); ?>
                        </section>-->
                    </div>
                </div><!--Filters-->
                <div id="title-product-all" class="col-lg-9 col-md-9 col-sm-8">
                    <?php echo $content; ?>
                </div><!--title-product-all-->
            </div><!--row-->
            <!--</div>container-->
        </div>
    </section><!--catalog-grid-->

    <!--Brands Carousel Widget-->
    <?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
</div>
<?php
$logoImage = common\models\costfit\ContentGroup::find()->where("lower(title)='logoImage'")->one();
$news = common\models\costfit\ContentGroup::find()->where("lower(title)='NEWS'")->one();
$footerContact = common\models\costfit\ContentGroup::find()->where("lower(title)='contactFooter'")->one();
echo $this->render('_footer', compact('logoImage', 'news', 'footerContact'));
?>
<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
