<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\productShippingPrice */

$this->title = 'Update Product Shipping Price: ' . $productName;
$this->params['breadcrumbs'][] = ['label' => 'Product Shipping Prices', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->producetShippingPriceId, 'url' => ['view', 'id' => $model->producetShippingPriceId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-shipping-price-update">



    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => $this->title,
        'shippingType' => $shippingType,
        'discountType' => $discountType,
        'productName' => $productName
    ])
    ?>

</div>
