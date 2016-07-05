<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coupon Owners';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="coupon-owner-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Coupon Owner', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?//=
            //            GridView::widget([
            //                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
            //                'dataProvider' => $dataProvider,
            //                'pager' => [
            //                    'options' => ['class' => 'pagination pagination-xs']
            //                ],
            //                'options' => [
            //                    'class' => 'table-light'
            //                ],
            //                'columns' => [
            //                    ['class' => 'yii\grid\SerialColumn'],
            //                    'couponOwnerId',
            //                    'name',
            //                    'description:ntext',
            //                    'image',
            //                    'status',
            //                    // 'createDateTime',
            //                    // 'updateDateTime',
            //                    ['class' => 'yii\grid\ActionColumn',
            //                        'header' => 'Actions',
            //                        'template' => '{view} {update} {delete}',
            //                        'buttons' => []
            //                    ],
            //                ],
            //            ]);
            ?>

            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_owner', ['model' => $model]);
                },
                'summaryOptions' => ['class' => 'sort-by-section clearfix'],
//            'layout'=>"{summary}{pager}{items}"
                'layout' => "{items}"
            ])
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
