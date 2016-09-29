<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Locations';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="store-location-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Store Location', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
                        'attribute' => 'provinceId',
                        'value' => function($model) {
                            return isset($model->state) ? $model->state->stateName : NULL;
                        }
                    ],
                    'status',
                    'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete} {store}',
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
                                    'store' => function($url, $model) {
                                return Html::a('<br><u>Store</u>', ['/store/manage', 'storeLocationId' => $model->storeLocationId], [
                                            'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },]
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
            <?php Pjax::end(); ?>
</div>
