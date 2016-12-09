<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPriceSuppliers */

$this->title = 'Update Product Price Suppliers: ' . ' ' . $model->productPriceId;
$this->params['breadcrumbs'][] = ['label' => 'Product Price Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productPriceId, 'url' => ['view', 'id' => $model->productPriceId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-price-suppliers-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title),
        'rankingPrice' => $rankingPrice,
        'status' => 'update'
        , 'productLastDay' => $productLastDay
        , 'productLastWeek' => $productLastWeek
        , 'orderLastMONTH' => $orderLastMONTH
        , 'product14LastWeek' => $product14LastWeek
    ])
    ?>

</div>
