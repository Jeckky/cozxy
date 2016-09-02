<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="row products-searchs-brands">
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
<br><br><br>