<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Led Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="led-item-index">

    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #000;color: #ffcc00;font-size: 12pt;">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">

                        <?= $count != 5 ? Html::a('Create Led', ['create?ledId=' . $_GET['id']], ['class' => 'btn btn-success']) : '' ?></div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                    // 'ledItemId',
                    'ledId',
                        ['attribute' => 'color',
                        'format' => 'raw',
                        'value' => function($model) {
                            //throw new Exception($model->color);
                            $show = common\models\costfit\LedItem::allColor($model->color);
//                            if ($model->color == 1) {
//                                $show = '#00cc66';
//                            } else if ($model->color == 2) {
//                                $show = '#F00';
//                            } else if ($model->color == 3) {
//                                $show = '#003eff';
//                            } else if ($model->color == 4) {
//                                $show = '#ff99ff';
//                            } else if ($model->color == 5) {
//                                $show = '#ffff00';
//                            }

                            return '<input type="text" style="background-color:' . $show . '" disabled="true">';
                        }
                    ],
                        ['attribute' => 'sortOrder',
                        'value' => function($model) {
                            return $model->sortOrder;
                        }
                    ],
                    'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{update}{delete}{change}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="btn btn-xs btn-success" style="margin-left: 5px;
            " >Edit</span>', 'led-item/update?id=' . $model->ledItemId);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="btn btn-xs btn-danger" style="margin-left: 5px;
            " >Delete</span>', 'led-item/delete?id=' . $model->ledItemId, ['data-confirm' => 'Are you sure?']);
                            },
                            'change' => function ($url, $model) {
                                if ($model->status == 0) {
                                    return Html::a('<span class="btn btn-xs btn-warning" style="margin-left: 5px;
            " >Turn on</span>', 'led-item/change?id=' . $model->ledItemId . '&&type=on');
                                } else {
                                    return Html::a('<span class="btn btn-xs btn-warning" style="margin-left: 5px;
            " >Turn off</span>', 'led-item/change?id=' . $model->ledItemId . '&&type=off');
                                }
                            },
                        ],
                    ],
                ],
            ]);
            ?>
            <a class="btn pull-right btn-primary" href="<?= Yii::$app->homeUrl ?>led/led"> << BACK</a>
        </div>
    </div>
</div>
