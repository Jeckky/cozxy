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
                        <?php // Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Store Product', ['create?storeProductGroupId=' . $_GET["storeProductGroupId"]], ['class' => 'btn btn-success btn-xs']) ?>
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Store Product', ['create?storeProductGroupId=' . $storeProductGroupId], ['class' => 'btn btn-success btn-xs']) ?>
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
                            return isset($model->stores) ? $model->stores->title : NULL;
                        }
                    ],
                    [
                        'attribute' => 'productId',
                        'value' => function($model) {
                            return isset($model->product) ? $model->product->title : NULL;
                        }
                    ],
                    ['attribute' => 'isbn',
                        'value' => function($model) {
                            return isset($model->isbn) ? $model->isbn : NULL;
                        }],
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
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                            'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                                    'update' => function($url, $model, $id) {
                                return Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $id, 'storeProductGroupId' => $model->storeProductGroupId], [
                                            'title' => Yii::t('app', 'Edit'),]);
                            },
                                    'delete' => function($url, $model, $id) {
                                return Html::a('<i class="fa fa-trash-o"></i>', ['delete', 'id' => $id, 'storeProductGroupId' => $model->storeProductGroupId], [
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
