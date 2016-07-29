<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\productSupplier */

$this->title = 'Update Product Supplier: ' . $model->productSupplierId;
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productSupplierId, 'url' => ['view', 'id' => $model->productSupplierId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-supplier-update">



    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title),
        'supplier' => $supplier,
        'productName' => $productName
    ])
    ?>

</div>
