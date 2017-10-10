<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\ProductSuppliers */

$this->title = 'Create Product Suppliers';
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-suppliers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
