<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\StoreProductOrderItem */

$this->title = 'Update Store Product Order Item: ' . ' ' . $model->storeProductOrderItemId;
$this->params['breadcrumbs'][] = ['label' => 'Store Product Order Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->storeProductOrderItemId, 'url' => ['view', 'id' => $model->storeProductOrderItemId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-product-order-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
