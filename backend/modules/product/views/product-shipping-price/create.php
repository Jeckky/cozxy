<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\productShippingPrice */

$this->title = 'Create Product Shipping Price';
$this->params['breadcrumbs'][] = ['label' => 'Product Shipping Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-shipping-price-create">

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
