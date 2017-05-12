<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\costfit\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configuration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topup-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
        </div>
        <div class="panel-body">

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                        'attribute' => 'Title',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $model->title;
                        }
                    ],
                        [
                        'attribute' => 'Description',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $model->description;
                        }
                    ],
                        [
                        'attribute' => 'Value',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $model->value;
                        }
                    ],
                        [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function($model) {
                            $text = '';
                            if ($model->status == 1) {
                                $text = 'Enable';
                            }
                            if ($model->status == 0) {
                                $text = 'disable';
                            }
                            return $text;
                        }
                    ],
                        [
                        'attribute' => 'Action',
                        'format' => 'raw',
                        'value' => function($model) {
                            return '<a href="' . Yii::$app->homeUrl . 'user/user/update-config?id=' . $model->configurationId . '"style="cursor: pointer;"><span style="font-size:20pt;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>Update</a>';
                            /* return Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', [Yii::$app->homeUrl . 'order/order/reprint-po?storeProductGroupId=' . $model->configurationId], [
                              'target' => '_blank',
                              ]
                              ); */
                        }
                    ],
                // 'updateDateTime',
                //  ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>