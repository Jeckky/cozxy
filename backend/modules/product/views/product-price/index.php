<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Prices';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-price-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Price', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'productId',
                        'value' => function($model) {
                            return isset($model->product) ? $model->product->title : NULL;
                        }
                    ],
                    'quantity',
                    'price',
                    [
                        'attribute' => 'discountType',
                        'value' => function($model) {
                            return $model->getDiscountTypeText($model->discountType);
                        }
                    ],
                    'discountValue',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">Product Shipping Price</div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?=
                        Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Shipping Price', ['product-shipping-price/create?id=' . $id], ['class' => 'btn btn-success btn-xs'])
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProviderPrice,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'productId',
                        'value' => function($model) {
                            return isset($model->product) ? $model->product->title : NULL;
                        }
                    ],
                    ['attribute' => 'shippingTypeId',
                        'value' => function($model) {
                            return $model->shippingType->title;
                        }
                    ],
                    'discount',
                    'type',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function($url, $model, $id) {
                                return Html::a("<span class='glyphicon glyphicon-pencil'></span>", ['/product/product-shipping-price/update', 'id' => $id], [
                                            'title' => Yii::t('app', 'Edit'),]);
                            },
                                    'delete' => function($url, $model, $id) {
                                return Html::a("<span class='glyphicon glyphicon-trash'></span>", ['/product/product-shipping-price/delete', 'id' => $id], [
                                            'title' => Yii::t('app', 'Delete'),]);
                            },]
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
            <?php Pjax::end(); ?>
</div>
