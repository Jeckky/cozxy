<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use leandrogehlen\treegrid\TreeGrid;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตั้งค่า การใช้งานของ Menu Backend';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="menu-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Menu', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            TreeGrid::widget([
                'dataProvider' => $dataProvider,
                'keyColumnName' => 'menuId',
                'parentColumnName' => 'parent_id',
                'parentRootValue' => '0', //first parentId value
                'pluginOptions' => [
                //'initialState' => 'collapsed',
                ],
                'columns' => [
                    'name',
                    'link',
                    [
                        'attribute' => 'เลือกกลุ่มที่เข้าใช้งาน',
                        'format' => 'raw',
                        'value' => function($data) {
                            $getUserGroup = common\models\costfit\UserGroups::checkUserGroup($data->user_group_Id);
                            return $getUserGroup['name'];
                        },
                    ],
                    'menuId',
                    //'parent'
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
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
