<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPriceSuppliers */

$this->title = 'Create Product Price Suppliers';
$this->params['breadcrumbs'][] = ['label' => 'Product Price Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-price-suppliers-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title),
        'rankingPrice' => $rankingPrice,
        'status' => 'create'
        , 'productLastDay' => $productLastDay
        , 'productLastWeek' => $productLastWeek
        , 'orderLastMONTH' => $orderLastMONTH
        , 'product14LastWeek' => $product14LastWeek
    ])
    ?>

</div>
