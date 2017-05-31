<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
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
            <?php
//        $form = ActiveForm::begin([
//            'method' => 'POST',
//            'id' => 'default-shipping-address',
//            'options' => ['class' => 'subscr-form'],
//        ]);
            ?>
            <div class="form-group">
                <label class="sr-only" for="subscr-name">Search for product</label>
                <input type="text" class="form-control" name="search_hd" id="search_hd" value="<?= isset($_POST['search_hd']) ? $_POST['search_hd'] : ($search_hd) ? $search_hd : '' ?>" placeholder="Search for product" required=""><label for="subscr-name" class="error" style="display: inline-block;">This field is required.</label>
                <button class="subscr-next"><i class="icon-magnifier"></i></button>
                <?php
//                echo kartik\select2\Select2::widget([
//                    'name' => 'search_hd',
//                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\ProductSuppliers::find()
//                    ->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
//                    ->where("product_suppliers.status=1 and product_suppliers.approve='approve'")->asArray()->all(), 'title', 'title'),
//                    'pluginOptions' => [
//                        'loadingText' => 'Search for product ...',
//                    ],
//                    'options' => [
//                        'placeholder' => 'Search for product ...',
//                        'value' => isset($_POST['search_hd']) ? $_POST['search_hd'] : ($search_hd) ? $search_hd : '',
//                        'multiple' => true,
//                    ],
//                ]);
//                echo Html::submitButton("<i class='icon-magnifier'></i>");
                ?>

            </div>
        </form>
        <?php // ActiveForm::end();   ?>

        <h2 class="with-sorting">Showing results for "<?= isset($_POST['search_hd']) ? $_POST['search_hd'] : ($search_hd) ? $search_hd : '' ?>"</h2>
        <form class="sort-form sorting" role="form" autocomplete="off" novalidate="novalidate" method="post" action="<?php echo Yii::$app->homeUrl; ?>search-cost-fit">
            <input type="hidden" value="<?= $search_hd ?>" name="search_hd">
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

                                return $this->render('_product_search', ['model' => $model->product]);
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
                </div>

            </div>
        </div>
    </div>
</section><!--Catalog Grid Close-->
