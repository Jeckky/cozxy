<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= Html::encode($this->title) ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('Create Role', ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?//=
            GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
            'class' => 'table-light'
            ],
            'filterModel' => $searchModel,
            'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            /*
            'type',
            'description:ntext',
            'rule_name',
            'data:ntext',
            // 'created_at',
            // 'updated_at',
            */
            [
            'options' => [
            'width' => '80px',
            ],
            'class' => 'yii\grid\ActionColumn'
            ],
            ],
            ]);
            ?>
            <?=
            GridView::widget([
                'tableOptions' => ['class' => 'table table-hover'],
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'rowOptions' => function($model) {
                    if ($model->name != 'Admin' && $model->name != 'Administrator High' && $model->name != 'Super Admin') {
                        //return ['class' => 'danger'];
                    } else {
                        return ['class' => 'warning'];
                    }
                },
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light '
                ],
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => function($model) {
                            if ($model->description == 1) {
                                return '<div class="text-success">Show</div>';
                            } else if ($model->description == 2) {
                                return '<div class="text-danger">Hidden</div>';
                            } else {
                                return '-';
                            }
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'update' => function ($url, $model) {
                                if ($model->name != 'Admin' && $model->name != 'Administrator High' && $model->name != 'Super Admin') {
                                    return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                        'title' => Yii::t('yii', 'update'),
                                    ]);
                                } else {

                                }
                            },
                            'delete' => function ($url, $model) {
                                if ($model->name != 'Admin' && $model->name != 'Administrator High' && $model->name != 'Super Admin') {
                                    return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                        'data-method' => 'post',
                                    ]);
                                } else {

                                }
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
