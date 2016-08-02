<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPriceOtherWeb */

$this->title = 'Update Product Price Other Web: ' . $model->productPriceOtherWebId;
$this->params['breadcrumbs'][] = ['label' => 'Product Price Other Webs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productPriceOtherWebId, 'url' => ['view', 'id' => $model->productPriceOtherWebId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-price-other-web-update">



    <?=
    $this->render('_form', [
        'model' => $model,
        'productName' => $productName,
        'website' => $website,
        'title' => $this->title
    ])
    ?>

</div>
