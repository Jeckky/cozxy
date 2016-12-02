<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductSuppliers */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-suppliers-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->productId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->productId], [
                    'class' => 'btn btn-xs btn-outline btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'productSuppId',
                    //'userId',
                    [
                        'attribute' => 'user',
                        'value' => common\models\costfit\ProductSuppliers::getUser($model->userId)
                    ],
                    'productGroupId',
                    //'brandId',
                    //'categoryId',
                    [
                        'attribute' => 'brand',
                        'value' => isset($model->brand) ? $model->brand->title : NULL
                    ],
                    [
                        'attribute' => 'category',
                        'value' => isset($model->category) ? $model->category->title : NULL
                    ],
                    'isbn:ntext',
                    'code',
                    'title',
                    'optionName',
                    'shortDescription:html',
                    'description:html',
                    'specification:html',
                    'width',
                    'height',
                    'depth',
                    'weight',
                    'price',
                    'unit',
                    'smallUnit',
                    'tags',
                    //'status',
                    //'createDateTime',
                    //'updateDateTime',
                    [
                        'attribute' => 'createDateTime',
                        'format' => 'raw',
                        'value' => $this->context->dateThai($model->createDateTime, 1, TRUE)
                    ],
                    [
                        'attribute' => 'updateDateTime',
                        'format' => 'raw',
                        'value' => $this->context->dateThai($model->updateDateTime, 1, TRUE)
                    ],
                ],
            ])
            ?>
        </div>
    </div>

</div>
