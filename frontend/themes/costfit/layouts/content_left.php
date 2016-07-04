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
            <h2 class="with-sorting">Filters left 3 columns</h2>
            <div class="sorting">
                <a href="#">Sort by name</a>
                <a href="#">Sort by price</a>
            </div><!--sorting-->
            <div class="row">
                <!--Filters-->
                <div class="filters-mobile col-lg-3 col-md-3 col-sm-4">
                    <div class="shop-filters">
                        <!--Price Section-->
                        <section class="filter-section">
                            <h3>Filter by price</h3>
                            <form method="get" name="price-filters">
                                <span class="clear" id="clearPrice" >Clear price</span>
                                <div class="price-btns">
                                    <button class="btn btn-black btn-sm" value="below 50$">below 50$</button><br/>
                                    <button class="btn btn-black btn-sm disabled" value="50$-100$">from 50$ to 100$</button><br/>
                                    <button class="btn btn-black btn-sm" value="100$-300$">from 100$ to 300$</button><br/>
                                    <button class="btn btn-black btn-sm" value="300$-1000$">from 300$ to 1000$</button>
                                </div>
                                <div class="price-slider">
                                    <div id="price-range"></div>
                                    <div class="values group">
                                        <!--data-min-val represent minimal price and data-max-val maximum price respectively in pricing slider range; value="" - default values-->
                                        <input class="form-control" name="minVal" id="minVal" type="text" data-min-val="10" value="180">
                                        <span class="labels">$ - </span>
                                        <input class="form-control" name="maxVal" id="maxVal" type="text" data-max-val="2500" value="1400">
                                        <span class="labels">$</span>
                                    </div>
                                    <input class="btn btn-primary btn-sm" type="submit" value="Filter">
                                </div>
                            </form>
                        </section>

                        <!--Colors Section-->
                        <section class="filter-section">
                            <h3>Filter by color</h3>
                            <span class="clear clearChecks">Clear colors</span>
                            <label>
                                <input type="checkbox" name="colors" value="black" id="color_0" checked>
                                Black (12)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="colors" value="white" id="color_1">
                                White (1)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="colors" value="green" id="color_2">
                                Green  (34)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="colors" value="blue" id="color_3">
                                Blue (23)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="colors" value="red" id="color_4">
                                Red (12)</label>
                        </section>

                        <!--Colors Section-->
                        <section class="filter-section">
                            <h3>Filter by size</h3>
                            <span class="clear clearChecks">Clear size</span>
                            <label>
                                <input type="checkbox" name="sizes" value="small" id="size_0" checked>
                                Small (12)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="sizes" value="white" id="size_1">
                                Medium (34)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="sizes" value="green" id="size_2">
                                Large (11)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="sizes" value="blue" id="size_3">
                                Extra large (1)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="sizes" value="red" id="size_4">
                                Superman (0)</label>
                        </section>

                        <!--Categories Section-->
                        <section class="filter-section">
                            <h3>Categories</h3>
                            <ul class="categories">
                                <li class="has-subcategory"><a href="#">Backpacks (123)</a><!--Class "has-subcategory" for dropdown propper work-->
                                    <ul class="subcategory">
                                        <li><a href="#">Backpacks (1)</a></li>
                                        <li><a href="#">Shoulder Bag (45)</a></li>
                                        <li><a href="#">Handbag (34)</a></li>
                                        <li><a href="#">Something (12)</a></li>
                                        <li><a href="#">Wallet (23)</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Belts (34)</a></li>
                                <li><a href="#">Gloves (78)</a></li>
                                <li class="has-subcategory"><a href="#">Something (45)</a>
                                    <ul class="subcategory">
                                        <li><a href="#">Subcategory (1)</a></li>
                                        <li><a href="#">Subcategory (45)</a></li>
                                        <li><a href="#">Subcategory (23)</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Hat bag (23)</a></li>
                            </ul>
                        </section>
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
<?php echo $this->render('_footer'); ?>
<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
