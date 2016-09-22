<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Picking Point Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picking-point-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
    <?//= Html::a('Create Picking Point Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6"><?= $this->title ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <?= Html::a('<i class=\'fa fa-angle-left\'></i><i class=\'fa fa-angle-left\'></i> Back To Picking Point', ['picking/index', '' => ''], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Picking Point Items', ['create?pickingId=' . $_GET["pickingId"]], ['class' => 'btn btn-success btn-xs']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'pickingItemsId',
                'pickingId',
                'name',
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view} {update} {delete} {items} ',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fa fa-eye"></i>', $url . '&pickingId=' . $model->pickingId, [
                                        'title' => Yii::t('yii', 'view'),
                            ]);
                        },
                                'update' => function ($url, $model) {
                            return Html::a('<i class="fa fa-pencil"></i>', $url . '&pickingId=' . $model->pickingId, [
                                        'title' => Yii::t('yii', 'update'),
                            ]);
                        },
                                'delete' => function ($url, $model) {
                            return Html::a('<i class="fa fa-trash-o"></i>', $url . '&pickingId=' . $model->pickingId, [
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
