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
            <?=
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

        </div>
    </div>
</div>
