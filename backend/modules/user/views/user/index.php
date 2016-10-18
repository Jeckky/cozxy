<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สมาชิก';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="panel-heading" >
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
        <?php
        $form = ActiveForm::begin(['method' => 'GET']);
        ?>
        <div class="row">
            <div class="col-lg-4">
                <input class="form-control" type="text" value="<?= isset($_GET['searchName']) ? $_GET['searchName'] : '' ?>" name="searchName" placeholder="ชื่อ, Email">
            </div>
            <div class="col-lg-2">
                <button class="btn btn-primary">ค้นหา</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <br>

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
                ['attribute' => 'orderHistory',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Html::a('<span class="text-center">Order</span>', 'user/order-history?id=' . $model->userId);
                    }
                ],
                ['attribute' => 'orderSummary',
                    'format' => 'html',
                    'value' => function($model) {
                        return isset($model->OrderSummary) ? '<span class="pull-right">' . $model->OrderSummary . '</span>' : ' ';
                    }
                ],
                // 'token:ntext',
                // 'type',
                // 'auth_key:ntext',
                ['attribute' => 'auth_type',
                    'value' => function($model) {
                        return isset($model->auth_type) ? $model->auth_type : "web";
                    }],
                ['attribute' => 'status',
                    'value' => function($model) {
                        return $model->getStatusText($model->status);
                    }],
                // 'createDateTime',
                // 'updateDateTime',
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{update}{block}{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="btn btn-xs btn-danger" style="margin-left: 5px;
            " >Delete</span>', '../user/delete?id=' . $model->userId, ['data-confirm' => 'Are you sure?']);
                        },
                        'block' => function ($url, $model) {
                            if ($model->status != 99) {
                                return Html::a('<span class="btn btn-xs btn-warning" style="margin-left: 5px;
            " >Block</span>', '../user/block?id=' . $model->userId);
                            } else {
                                return Html::a('<span class="btn btn-xs btn-warning" style="margin-left: 5px;
            " >Unblock</span>', '../user/un-block?id=' . $model->userId);
                            }
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="btn btn-xs btn-success" style="margin-left: 5px;
            " >Edit</span>', 'user/update?id=' . $model->userId);
                        },
                    ],
                ],
            ],
        ]);
        ?>
    </div>
</div>
