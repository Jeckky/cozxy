<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use leandrogehlen\treegrid\TreeGrid;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตั้งค่า การใช้งานของ กลุ่ม';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="user-groups-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create User Groups', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            TreeGrid::widget([
                'dataProvider' => $dataProvider,
                'keyColumnName' => 'user_group_Id',
                'parentColumnName' => 'parent_id',
                'parentRootValue' => '0', //first parentId value
                'pluginOptions' => [
                //'initialState' => 'collapsed',
                ],
                'columns' => [
                    [
                        'attribute' => 'ชื่อกลุ่ม',
                        'format' => 'raw',
                        'value' => function($data) {
                            return $data->name;
                        },
                    ],
                    [
                        'attribute' => 'สมาชิกที่เปิดใช้งาน',
                        'format' => 'raw',
                        'value' => function($data) {
                            return '<a class="badge " href=""> 0</a>';
                        },
                    ],
                    [
                        'attribute' => 'สมาชิกที่ถูกระงับ',
                        'format' => 'raw',
                        'value' => function($data) {
                            return '<a class="badge " href=""> 0</a>';
                        },
                    ],
                    //'user_group_Id',
                    //'name',
                    //'parent_id',
                    //'status',
                    // 'createDateTime',
                    // 'name',
                    //'user_group_Id',
                    //'parent_id',
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
            <?//=
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
            'user_group_Id',
            'name',
            'parent_id',
            'status',
            'createDateTime',
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
            ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
