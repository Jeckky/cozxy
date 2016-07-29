<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\productSupplier */

$this->title = 'Create Product Supplier';
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-supplier-create">



    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title),
        'supplier' => $supplier,
        'productName' => $productName
    ])
    ?>

</div>
