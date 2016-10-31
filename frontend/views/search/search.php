<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style>
    .pagination>.disabled>span{
        border: 0px;
    }
</style>
<div class="row products-searchs-brands">
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $products,
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
<!--Pagination-->
<br><br><br>