<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6"><h4><?= $this->title ?></h4></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">

<!--        <p>
            <?//= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        </p>-->
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'userId',
                //'username',
                //'password_hash:ntext',
                ['attribute' => 'firstname',
                    'value' => function($model) {
                        return isset($model->fullName) ? $model->fullName : '';
                    }
                ],
                //'password',
                // 'lastname',
                'email:email',
                // 'token:ntext',
                // 'type',
                // 'auth_key:ntext',
                'auth_type',
                'status',
                // 'createDateTime',
                // 'updateDateTime',
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{update}{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="btn btn-xs btn-danger" style="margin-left: 5px;
            " >Delete</span>', 'user/delete?id=' . $model->userId);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="btn btn-xs btn-warning" style="margin-left: 5px;
            " >Edit</span>', 'user/update?id=' . $model->userId);
                        },
                    ],
                ],
            ],
        ]);
        ?>
    </div>
</div>
