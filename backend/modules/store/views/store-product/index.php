<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Products';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="store-product-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Store Product', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
                        'attribute' => 'storeId',
                        'value' => function($model) {
                            return isset($model->store) ? $model->store->title : NULL;
                        }
                    ],
                    [
                        'attribute' => 'productId',
                        'value' => function($model) {
                            return isset($model->product) ? $model->product->title : NULL;
                        }
                    ],
                    'paletNo',
                    'quantity',
                    [
                        'attribute' => 'price',
                        'value' => function($model) {
                            return number_format($model->price);
                        }
                    ],
                    [
                        'attribute' => 'total',
                        'value' => function($model) {
                            return number_format($model->total);
                        }
                    ],
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
//                            'product' => function($url, $model) {
//                                return Html::a('<br><u>Product</u>', ['/product/manage', 'storeProductId' => $model->storeProductId], [
//                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
//                            },
//                            'storeProductGroup' => function($url, $model) {
//                                return Html::a('<br><u>StoreProductGroup</u>', ['/storeProductGroup/manage', 'storeProductId' => $model->storeProductId], [
//                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
//                            },
//                            'store' => function($url, $model) {
//                                return Html::a('<br><u>Store</u>', ['/store/manage', 'storeProductId' => $model->storeProductId], [
//                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
//                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
