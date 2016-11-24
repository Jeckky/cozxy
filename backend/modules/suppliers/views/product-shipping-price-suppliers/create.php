<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductShippingPriceSuppliers */

$this->title = 'Create Product Shipping Price Suppliers';
$this->params['breadcrumbs'][] = ['label' => 'Product Shipping Price Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-shipping-price-suppliers-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
