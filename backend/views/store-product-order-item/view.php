<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\StoreProductOrderItem */

$this->title = $model->storeProductOrderItemId;
$this->params['breadcrumbs'][] = ['label' => 'Store Product Order Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-product-order-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->storeProductOrderItemId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->storeProductOrderItemId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'storeProductOrderItemId',
            'orderId',
            'productId',
            'storeProductId',
            'quantity',
            'price',
            'total',
            'status',
            'createDateTime',
            'updateDateTime',
        ],
    ]) ?>

</div>
