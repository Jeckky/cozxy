<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPriceOtherWeb */

$this->title = $model->productPriceOtherWebId;
$this->params['breadcrumbs'][] = ['label' => 'Product Price Other Webs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-price-other-web-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->productPriceOtherWebId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->productPriceOtherWebId], [
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
            'productPriceOtherWebId',
            'productId',
            'webId',
            'url:url',
            'parameter',
            'status',
            'createDateTime',
            'updateDateTime',
        ],
    ]) ?>

</div>
