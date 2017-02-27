<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\costfit\ProductSuppliers;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->homeUrl; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "sub Title" ?></a></li>
    <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></a></li>
</ol><!--Breadcrumbs Close-->

<!--Support-->
<!--Catalog Grid -->

<section class="catalog-grid">
    <div class="container">
        <form class="subscr-form" role="form" autocomplete="off" novalidate="novalidate" method="post" action="<?php echo Yii::$app->homeUrl; ?>search-cost-fit">
            <div class="form-group">
                <label class="sr-only" for="subscr-name">Search for produc</label>
                <input type="text" class="form-control" name="search_hd" id="search_hd" value="<?= isset($_POST['search_hd']) ? $_POST['search_hd'] : ($search_hd) ? $search_hd : '' ?>" placeholder="Search for product" required=""><label for="subscr-name" class="error" style="display: inline-block;">This field is required.</label>
                <button class="subscr-next"><i class="icon-magnifier"></i></button>
            </div>
        </form>

        <h2 class="with-sorting">Showing results for "<?= isset($_POST['search_hd']) ? $_POST['search_hd'] : ($search_hd) ? $search_hd : '' ?>"</h2>
        <form class="sort-form sorting" role="form" autocomplete="off" novalidate="novalidate" method="post" action="<?php echo Yii::$app->homeUrl; ?>search-cost-fit">
            <?php if (isset($_POST['search_hd'])) { ?>
                <input type="hidden" value="<?= $_POST['search_hd'] ?>" name="search_hd">
            <?php } else { ?>
                <input type="hidden" value="<?= $search_hd ?>" name="search_hd">
            <?php } ?>
            <input type="hidden" value="ASC" name="sortName" id="sortName">
            <input type="hidden" value="ASC" name="sortPrice" id="sortPrice">
            <a href="#" onclick="<?= ($sortName == "ASC") ? "$('#sortName').val('DESC');" : "$('#sortName').val('ASC');" ?>$('.sort-form').submit()" <?= ($sortName == "ASC") ? " " : " class='sorted'" ?>>Sort by name</a>
            <a href="#" onclick="<?= ($sortPrice == "ASC") ? "$('#sortPrice').val('DESC');" : "$('#sortPrice').val('ASC');" ?>$('.sort-form').submit()" <?= ($sortPrice == "ASC") ? " " : " class='sorted'" ?>>Sort by price</a>
        </form>
        <div class="row">
            <!--Tiles-->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <?php
                    foreach ($products as $item) {
                        $price = ProductSuppliers::productPrice($item->productSuppId);
                        $image = ProductSuppliers::productImageSuppliers($item->productSuppId);
                        ?>
                        <!--Tile-->
                        <div id="products-category-search" class="col-lg-3 col-md-3 col-sm-6">
                            <div class="tile">
                                <div class="search-category-badges-price">
                                    <div class="badges">
                                        <span class="sale">Sale</span>
                                    </div>
                                    <div class="price-label"><?= $price ?> ฿</div>
                                </div>
                                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $item->productId, 'productSupplierId' => $item->productSuppId]) ?>" style="min-height: 210px; max-height: 210px;">
                                    <?php if ($image != ''): ?>
                                        <img src="<?php echo Yii::$app->homeUrl . $image; ?>" alt="1"/>
                                    <?php endif; ?>
                                    <span class="tile-overlay"></span>
                                </a>
                                <div class="footer search-category-footer">
                                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $item->productId, 'productSupplierId' => $item->productSuppId]) ?>"><?= $item->title; ?></a>
                                    <!--<span>by Pirate3d</span>-->
                                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $item->productId, 'productSupplierId' => $item->productSuppId]) ?>">View <?= $item->productSuppId ?></a>
                                    <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $item->productId, 'productSupplierId' => $item->productSuppId]) ?>"><button class="btn btn-primary">View</button></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!--Pagination
                <div class="col-md-12 text-center">
                    <button type="button" id="see-more-search-cost-fit" data-loading-text="Loading..." class="btn btn-black" autocomplete="off">
                        See More
                    </button>
                </div>-->
                <!--<ul class="pagination">
                    <li class="prev-page"><a class="icon-arrow-left" href="#"></a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li class="next-page"><a class="icon-arrow-right" href="#"></a></li>
                </ul>-->
            </div>
        </div>
    </div>
</section><!--Catalog Grid Close-->
