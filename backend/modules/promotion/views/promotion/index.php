<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promotions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #000;color: #ffcc33;">
        <div class="row">
            <div class="col-md-6" style="font-size: 20pt;"> <?= Html::encode($this->title) ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">

                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="promotion-index">


            <p class="pull-right">
                <?= Html::a('+ Create Promotion', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title',
                    'description:ntext',
                    'promotionCode',
                    ['attribute' => 'Discont',
                        'value' => function($model) {
                            $type = $model->discountType == 1 ? ' % ' : ' Cash ( THB )';
                            return $model->discount . $type;
                        }
                    ],
                    //'maximumDiscount',
                    //'maximum',
                    //'startDate',
                    //'endDate',
                    //'perUser',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
