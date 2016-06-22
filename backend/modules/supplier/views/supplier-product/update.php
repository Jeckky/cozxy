<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\SupplierProduct */

$this->title = 'Update Supplier Product: ' . ' ' . $model->supplierProductId;
$this->params['breadcrumbs'][] = ['label' => 'Supplier Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->supplierProductId, 'url' => ['view', 'id' => $model->supplierProductId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="supplier-product-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
