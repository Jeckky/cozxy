<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use leandrogehlen\treegrid\TreeGrid;
?>
<h1>product ของ <?= $user->attributes['email'] ?></h1>

<div class="panel-body">
    <?=
    TreeGrid::widget([
        'dataProvider' => $dataProvider,
        'keyColumnName' => 'productId',
        'parentColumnName' => 'parentId',
        'parentRootValue' => NULL, //first parentId value
        'pluginOptions' => [
        //'initialState' => 'collapsed',
        ],
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($data, $index, $num) {
                    if ($data->parentId == NULL) {
                        return '<span class="text-danger"><strong>' . $data->title . '&nbsp;(' . $data->productId . ')</strong></span>';
                    } else {
                        return '- ' . $data->title . '&nbsp;(' . $data->productId . ')';
                    }
                },
            ],
            [
                'attribute' => 'price',
                'format' => 'raw',
                'value' => function($data, $index, $num) {
                    if ($data->parentId == NULL) {
                        return '<span class="text-danger">' . number_format($data->price, 2) . ' (market price)</span>';
                    } else {
                        //$price = common\helpers\Suppliers::GetProductPrice($data->productId);
                        $GetProductSuppliers = \common\models\costfit\ProductSuppliers::find()
                                ->where("product_suppliers.productId=" . $data->productId . ' and product_suppliers.result  > 0  ')
                                ->one();
                        if (isset($GetProductSuppliers['productSuppId'])) {
                            $GetPriceSuppliers = common\models\costfit\ProductPriceSuppliers::find()
                                    ->where("productSuppId=" . $GetProductSuppliers['productSuppId'] . ' and product_price_suppliers.status = 1')
                                    ->one();
                            return number_format($GetPriceSuppliers['price'], 2);
                        } else {
                            return '-';
                        }
                    }
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}  ',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'title' => Yii::t('yii', 'view'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                    'title' => Yii::t('yii', 'update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
                        ]);
                    },
                ]
            ],
        ]
    ]);
    ?>
</div>