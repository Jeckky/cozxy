<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\RouteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Routes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= Html::encode($this->title) ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('Create Route', ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Generate Route', ['generate'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'type',
                    'alias',
                    'name',
                    [
                        'attribute' => 'status',
                        'filter' => [0 => 'off', 1 => 'on'],
                        'format' => 'raw',
                        'options' => [
                            'width' => '80px',
                        ],
                        'value' => function ($data) {
                            if ($data->status == 1)
                                return "<span class='label label-primary'>" . 'On' . "</span>";
                            else
                                return "<span class='label label-danger'>" . 'Off' . "</span>";
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>

        </div>
    </div>
</div>
