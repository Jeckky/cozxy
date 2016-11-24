<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductShippingPriceSuppliers */

$this->title = 'Update Product Shipping Price Suppliers: ' . ' ' . $model->productShippingPriceId;
$this->params['breadcrumbs'][] = ['label' => 'Product Shipping Price Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productShippingPriceId, 'url' => ['view', 'id' => $model->productShippingPriceId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-shipping-price-suppliers-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
