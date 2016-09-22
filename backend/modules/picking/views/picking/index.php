<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Picking Points';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picking-point-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6"><?= $this->title ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Picking Point', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                </div>
            </div>
        </div>
    </div>
   <!--<p>
    <?//= Html::a('Create Picking Point', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'pickingId',
                'code',
                'title',
                'description',
                //'countryId',
                [ // รวมคอลัมน์
                    'label' => 'Country',
                    'format' => 'html',
                    'value' => function($model, $key, $index, $column) {
                        return 'ประเทศ' . $model->countries->localName;
                    }
                ],
                //'provinceId',
                [ // รวมคอลัมน์
                    'label' => 'Province',
                    'format' => 'html',
                    'value' => function($model, $key, $index, $column) {
                        return $model->states->localName;
                    }
                ],
                //'amphurId',
                [ // รวมคอลัมน์
                    'label' => 'Amphur',
                    'format' => 'html',
                    'value' => function($model, $key, $index, $column) {
                        return $model->cities->localName;
                    }
                ],
                // 'status',
                // 'type',
                // 'createDateTime',
                // 'updateDateTime',
                /* ['class' => 'yii\grid\ActionColumn'], */
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view} {update} {delete} {items}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fa fa-eye"></i>', $url, [
                                        'title' => Yii::t('yii', 'view'),
                            ]);
                        },
                                'update' => function ($url, $model) {
                            return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                        'title' => Yii::t('yii', 'update'),
                            ]);
                        },
                                'delete' => function ($url, $model) {
                            return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                        'data-method' => 'post',
                            ]);
                        },
                                'items' => function($url, $model) {
                            return Html::a('<i class="fa fa-sign-in"></i> ', Yii::$app->homeUrl . "picking/picking-point-items/index?pickingId=" . $model->pickingId, [
                                        'title' => Yii::t('app', 'picking point items'),]);
                        },
                            ],
                        ],
                    ],
                ]);
                ?>
    </div>

</div>
