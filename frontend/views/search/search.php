<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="row">
    <!-- ตัวอย่างตรีม
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="tile">
            <div class="badges">
                <span class="sale">Sale</span>
            </div>
            <div class="price-label">715,00 $</div>
            <a href="#">
                <img src="<?//php echo $directoryAsset; ?>/img/catalog/1.png" alt="1">
                <span class="tile-overlay"></span>
            </a>
            <div class="footer">
                <a href="#">The Buccaneer</a>
                <span>by Pirate3d</span>
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>-->
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $products,
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_product', ['model' => $model->product]);
        },
        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
//            'layout'=>"{summary}{pager}{items}"
        'layout' => "{items}",
//        'pager' => [
//            'firstPageLabel' => 'first',
//            'lastPageLabel' => 'last',
//            'prevPageLabel' => 'previous',
//            'nextPageLabel' => 'next',
//            'maxButtonCount' => 3,
//            // Customzing options for pager container tag
//            'options' => [
//                'tag' => 'div',
//                'class' => 'pager-wrapper',
//                'id' => 'pager-container',
//            ],
//            // Customzing CSS class for pager link
//            'linkOptions' => ['class' => 'mylink'],
//            'activePageCssClass' => 'active',
////            'disabledPageCssClass' => 'mydisable',
//            // Customzing CSS class for navigating link
//            'prevPageCssClass' => 'icon-arrow-left',
//            'nextPageCssClass' => 'icon-arrow-right',
//            'firstPageCssClass' => 'myfirst',
//            'lastPageCssClass' => 'mylast',
//        ],
    ])
    ?>

</div>
<!--Pagination-->
<br><br><br><!--
<ul class="pagination col-md-12">
    <li class="prev-page"><a class="icon-arrow-left" href="#"></a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li class="next-page"><a class="icon-arrow-right" href="#"></a></li>
</ul>-->


