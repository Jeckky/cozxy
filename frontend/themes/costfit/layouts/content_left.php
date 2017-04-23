<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\web\View;
use common\models\ModelMaster;

//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
//$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//$url_search = (explode("search", $_SERVER['REQUEST_URI']));
//$url_parameter = explode("/", $url_search[1]);
//$k = base64_decode(base64_decode($url_parameter[2]));
//throw new \yii\base\Exception(print_r($k, true));
//$params = \common\models\ModelMaster::decodeParams($url_parameter[2]);
//$categoryId = $params['categoryId'];
$categoryId = $this->params['categoryId'];
$title = $this->params['title'];
?>
<?php $this->beginContent('@app/themes/costfit/layouts/main.php'); ?>
<?= $this->render('_modal_login') ?>
<?= $this->render('_header') ?>
<!--Filters Modal-->
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

                        <!--Colors Section
                        <section class="filter-section">
                            <h3>Filter by color</h3>
                        <?php //echo $this->render('@app/views/filter/filterbycolor');               ?>
                        </section>-->

                        <!--Colors Section
                        <section class="filter-section">
                            <h3>Filter by size</h3>
                        <?php //echo $this->render('@app/views/filter/filterbysize');               ?>
                        </section>-->

                        <!--Categories Section
                        <section class="filter-section">
                            <h3>Categories</h3>
                        <?php //echo $this->render('@app/views/categories/categories');               ?>
                        </section>-->
                        <!--Categories Section-->
                        <section class="filter-section">
                            <h3>Brands</h3>
                            <?php echo $this->render('@app/views/categories/brands', ['categoryId' => $categoryId, 'title' => $title, 'brandIds' => isset($this->params['categoryId']) ? $this->params['categoryId'] : NULL]); ?>
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
    <div id="title-product-all" class="col-lg-9 col-md-9 col-sm-8">
        <?php
        if (isset($model->productId)):
            $suppliers = \common\models\costfit\Product::lowestPrice($model->productId);
            if ($suppliers != NULL) {//ถ้ามีใน suppliers แสดงราคาที่ถูกที่สุด(กรณีมีหลายซัพ)
                ?>
                <div id="products-category-searc" class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="tile">
                        <div class="badges">
                            <span class="sale">Sale</span>
                            <?php
                            if (common\models\costfit\Product::isSmartItem($suppliers->productId)):
                                ?>
                                <br><span class="sale" style="background-color: #d2d042 !important;">SMART</span>
                                <?php
                            endif;
                            $price = ProductSuppliers::productPrice($suppliers->productSuppId);
                            // throw new \yii\base\Exception($suppliers->productId);
                            ?>
                        </div>
                        <?php if ($price > 0) { ?><div class="price-label"><?= isset($price) ? number_format($price, 2) : "Not Set"; ?> ฿</div><?php } ?>
                        <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $suppliers->productId, 'productSupplierId' => $suppliers->productSuppId]) ?>" style="/*min-height: 210px; max-height: 210px;*/">
                            <?php
                            $image = ProductSuppliers::productImageSuppliers($suppliers->productSuppId);
                            //throw new \yii\base\Exception($image);
                            if (isset($image) && !empty($image)):
                                $filename = $image;
                                if (file_exists($filename)) {
                                    echo "<img class=\"ms-thumb\" src=\" " . Yii::$app->homeUrl . $image . "  \" alt=\"1\" class=\"img-responsive\"/>";
                                } else {
                                    echo "<img  class=\"ms-thumb\"  src=\"" . $baseUrl . "/images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" class=\"img-responsive\"/>";
                                }
                            else:
                                ?>
                                <img src="<?php echo $baseUrl; ?>/images/ContentGroup/DUHWYsdXVc.png" alt="1" class="img-responsive"/>
                            <?php endif; ?>
                            <span class="tile-overlay"></span>
                        </a>
                        <div class="footer search-category-footer">
                            <div class="" style="max-height: 50px; min-height: 50px;">
                                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $suppliers->encodeParams(['productId' => $suppliers->productId, 'productSupplierId' => $suppliers->productSuppId]) ?>">
                                    <?= substr($suppliers->title, 0, 40);
                                    ?></a>
                            </div>
                            <span><?php //= $model->shortDescription;         ?></span>
                            <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $suppliers->encodeParams(['productId' => $suppliers->productId, 'productSupplierId' => $suppliers->productSuppId]) ?>"><button class="btn btn-primary" id="addItemToCart"><i class="fa fa-search"></i>View</button></a>
                        </div>
                    </div>
                </div>
                <?php
            }
        endif;
        ?>
    </div><!--title-product-all-->
    <?php
    /* $k = base64_decode(base64_decode($hash));
      $params = ModelMaster::decodeParams($hash);
      $whereArray = [];
      $whereArray["category_to_product.categoryId"] = $params['categoryId'];

      $whereArray["product.approve"] = "approve";
      $products = \common\models\costfit\CategoryToProduct::find()
      ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
      ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
      ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
      //->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = category_to_product.productId")
      ->where($whereArray);
      //->andWhere("product.approve != 'new'");
      if (isset($_POST["min"])) {
      $products->andWhere("pps.price >=" . $_POST["min"]);
      }
      if (isset($_POST["max"])) {
      $products->andWhere("pps.price <=" . $_POST["max"]);
      }

      if (isset($params['brandId'])) {
      $idString = $params['brandId'];
      $this->view->params['brandId'] = explode(",", $idString);
      $products->andWhere("product.brandId in ($idString)");
      }
      //echo '<pre>';
      //print_r($products);
      $products = new \yii\data\ActiveDataProvider([
      'query' => $products,
      'pagination' => array('pageSize' => 9),
      ]); */
    ?>
    <?php //echo $this->render('@app/views/search/search', compact('products')); ?>
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
