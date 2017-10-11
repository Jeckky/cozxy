<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\ProductSuppliers */

$this->title = 'Update Product Suppliers: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->productSuppId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-suppliers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
