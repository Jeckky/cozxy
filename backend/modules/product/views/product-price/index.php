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


    <?php Pjax::begin(['id' => 'g1']); ?>
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
    <?php Pjax::begin(['id' => 'g2']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">Product Price Other Website</div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?=
                        Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Price other website', ['product-price-other-web/create?id=' . $id], ['class' => 'btn btn-warning btn-xs'])
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProviderWeb,
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
                            return isset($model->productId) ? $model->products->title : '';
                        }
                    ],
                    [
                        'attribute' => 'website',
                        'value' => function($model) {
                            //throw new \yii\base\Exception(print_r($model, true));
                            return isset($model->webId) ? $model->webName->title : NULL;
                        }
                    ],
                    ['attribute' => 'url',
                        'format' => 'raw',
                        'value' => function($model) {
                            return isset($model->linkName) ? $model->linkName : NULL;
                        }
                    ],
                    ['attribute' => 'price',
                        'value' => function($model) {
                            //throw new \yii\base\Exception(print_r($model, true));
                            return isset($model->updatePrices->price) ? $model->updatePrices->price : NULL;
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{update}{delete}',
                        'buttons' => [
                            'update' => function($url, $model, $id) {
                                return Html::a("<span class='glyphicon glyphicon-pencil'></span>", ['/product/product-price-other-web/update', 'id' => $id], [
                                            'title' => Yii::t('app', 'Edit'),]);
                            },
                                    'delete' => function($url, $model, $id) {
                                return Html::a("<span class='glyphicon glyphicon-trash'></span>", ['/product/product-price-other-web/delete', 'id' => $id], [
                                            'title' => Yii::t('app', 'Delete'), 'data-confirm' => 'Are you sure to delete']);
                            },]
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
            <?php Pjax::end(); ?>
            <?php Pjax::begin(['id' => 'g3']); ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">Product Shipping Price</div>
                        <div class="col-md-6">
                            <div class="btn-group pull-right">
                                <?=
                                Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Shipping Price', ['product-shipping-price/create?id=' . $id], ['class' => 'btn btn-primary btn-xs'])
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
                            ['attribute' => 'type',
                                'value' => function($model) {
                                    return $model->types;
                                }
                            ],
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
                                                    'title' => Yii::t('app', 'Delete'), 'data-confirm' => 'Are you sure to delete']);
                                    },]
                                    ],
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                    <?php Pjax::end(); ?>
</div>
