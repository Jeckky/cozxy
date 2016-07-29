<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\productShippingPrice */

$this->title = $model->producetShippingPriceId;
$this->params['breadcrumbs'][] = ['label' => 'Product Shipping Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-shipping-price-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->producetShippingPriceId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->producetShippingPriceId], [
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
            'producetShippingPriceId',
            'productId',
            'shippingTypeId',
            'discount',
            'type',
            'status',
            'createDateTime',
            'updateDateTime',
        ],
    ]) ?>

</div>
