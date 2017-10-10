<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\ProductSuppliers */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-suppliers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->productSuppId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->productSuppId], [
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
            'productSuppId',
            'userId',
            'brandId',
            'categoryId',
            'isbn:ntext',
            'code',
            'suppCode',
            'merchantCode',
            'title',
            'optionName',
            'shortDescription:ntext',
            'description:ntext',
            'specification:ntext',
            'width',
            'height',
            'depth',
            'weight',
            'unit',
            'smallUnit',
            'tags',
            'status',
            'createDateTime',
            'updateDateTime',
            'quantity',
            'result',
            'approve',
            'productId',
            'approveCreateBy',
            'approvecreateDateTime',
            'receiveType',
            'url:url',
            'warrantyType',
            'warrantyPeriod',
        ],
    ]) ?>

</div>
