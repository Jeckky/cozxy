<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Price Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<div class="product-price-suppliers-index">
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <h3>
        Title :  <?php echo isset($productSupp->title) ? $productSupp->title : ''; ?>
    </h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?> : ราคาขายสินค้า</div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'fa fa-angle-left\'></i><i class=\'fa fa-angle-left\'></i> Back To Product Suppliers', ['/suppliers/product-suppliers'], ['class' => 'btn btn-warning btn-xs']) ?>
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Price Suppliers', ['create?productSuppId=' . $_GET["productSuppId"]], ['class' => 'btn btn-success btn-xs']) ?>
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
                    //'productPriceId',
                    //'productSuppId',
                    'quantity',
                    'price',
                    //'discountType',
                    [
                        'attribute' => 'discountType',
                        'value' => function($model) {
                            return $model->getDiscountTypeText($model->discountType);
                        }
                    ],
                    'discountValue',
                    // 'description:ntext',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url . '&productSuppId=' . $_GET['productSuppId'], [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil"></i>', $url . '&productSuppId=' . $_GET['productSuppId'], [
                                    'title' => Yii::t('yii', 'update'),
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fa fa-trash-o"></i>', $url . '&productSuppId=' . $_GET['productSuppId'], [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
                                ]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">Product Shipping Price Suppliers : ราคาค่าจัดส่งสินค้า</div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'fa fa-angle-left\'></i><i class=\'fa fa-angle-left\'></i> Back To Product Suppliers', ['/suppliers/product-suppliers'], ['class' => 'btn btn-warning btn-xs']) ?>
                        <?= Html::a('<i class = \'glyphicon glyphicon-plus\'></i> Create Product Shipping Price Suppliers', ['product-shipping-price-suppliers/create?productSuppId=' . $_GET["productSuppId"]], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider1,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'productShippingPriceId',
                    //'productSuppId',
                    /* [
                      'attribute' => 'productSuppId',
                      'value' => function($model) {
                      return isset($model->productsupp) ? $model->productsupp->title : NULL;
                      }
                      ], */
                    //'shippingTypeId',
                    ['attribute' => 'shippingTypeId',
                        'value' => function($model) {
                            return $model->shippingType->title;
                        }
                    ],
                    //'date',
                    'discount',
                    //'type',
                    ['attribute' => 'type',
                        'value' => function($model) {
                            return $model->getDiscountTypeText($model->type);
                        }
                    ],
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', Yii::$app->homeUrl . 'suppliers/product-shipping-price-suppliers/view?id=' . $model->productShippingPriceId . '&productSuppId=' . $_GET['productSuppId'], [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil"></i>', Yii::$app->homeUrl . 'suppliers/product-shipping-price-suppliers/update?id=' . $model->productShippingPriceId . '&productSuppId=' . $_GET['productSuppId'], [
                                    'title' => Yii::t('yii', 'update'),
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fa fa-trash-o"></i>', Yii::$app->homeUrl . 'suppliers/product-shipping-price-suppliers/delete?id=' . $model->productShippingPriceId . '&productSuppId=' . $_GET['productSuppId'], [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
                                ]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
