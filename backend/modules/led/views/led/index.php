<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="led-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('Create Led', ['create'], ['class' => 'btn btn-success']) ?>                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'ledId',
                    'code',
                    'ip',
                    'slot',
                    'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{led}{update}{delete}',
                        'buttons' => [

                            'led' => function ($url, $model) {

                                return Html::a('<span class="btn btn-xs btn-warning" style="margin-left: 5px;
            " >+LED</span>', 'led-item/index?id=' . $model->ledId);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="btn btn-xs btn-success" style="margin-left: 5px;
            " >Edit</span>', '../led-item/update?id=' . $model->ledId);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="btn btn-xs btn-danger" style="margin-left: 5px;
            " >Delete</span>', '../led-item/delete?id=' . $model->ledId);
                            },
                        ],
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
