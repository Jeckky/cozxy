<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stores';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="store-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Store', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
                        'attribute' => 'regionId',
                        'value' => function($model) {
                            return $model->region->title;
                        }
                    ],
                    'title',
                    'description:ntext',
                    'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete} {product} {location} {row}',
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
                                    'location' => function($url, $model) {
                                return Html::a('<br><u>Location</u>', ['/store/store-location', 'storeId' => $model->storeId], [
                                            'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                                    'product' => function($url, $model) {
                                return Html::a('<br><u>Product</u>', ['/store/store-product', 'storeId' => $model->storeId], [
                                            'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                                    'row' => function($url, $model) {
                                return Html::a('<br><u>Row</u>', ['/store/store-slot', 'storeId' => $model->storeId], [
                                            'title' => Yii::t('app', 'Change today\'s lists'),]);
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
