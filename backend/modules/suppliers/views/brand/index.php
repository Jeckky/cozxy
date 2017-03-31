<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="brand-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Brand', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'brandId',
                    'title',
                    //'description:ntext',
                    [
                        'attribute' => 'description',
                        'format' => 'html',
                        'value' => function($model) {
                            return $model->description;
                        },
                        'contentOptions' => ['style' => 'width:600px;  min-width:300px;  '],
                    ],
                    //'image',
                    [
                        'attribute' => 'image',
                        'format' => 'html',
                        'value' => function($model) {

                            if (isset($model->image)) {
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . Yii::getAlias('@web') . $model->image)) {
                                    $imgBrand = Html::img(Yii::getAlias('@web') . $model->image, ['style' => 'width:164px;height:120px', 'class' => 'img-responsive']);
                                } else {
                                    $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:164px;height:120px', 'class' => 'img-responsive']);
                                }
                            } else {
                                $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:164px;height:120px', 'class' => 'img-responsive']);
                            }
                            return $imgBrand;
                        }
                    ],
                    //'status',
                    // 'parentId',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                $userType = common\models\costfit\Brand::find()->where('userId = ' . Yii::$app->user->identity->userId)->one();
                                if (isset($userType)) {
                                    //echo $userType->userId . ' Vs ' . Yii::$app->user->identity->userId . '<br>';
                                    if ($userType->userId == $model->userId) {
                                        return Html::a('<i class="fa fa-eye"></i>', $url, [
                                            'title' => Yii::t('yii', 'view'),
                                        ]);
                                    } else {
                                        //return Html::a('<i class="fa fa-eye"></i>', '#', [
                                        //'title' => Yii::t('yii', 'view'),
                                        //]);
                                    }
                                } else {
                                    return Html::a('<i class="fa fa-eye"></i>', '#', [
                                        'title' => Yii::t('yii', 'view'),
                                    ]);
                                }
                            },
                            'update' => function ($url, $model) {
                                $userType = common\models\costfit\Brand::find()->where('userId = ' . Yii::$app->user->identity->userId)->one();
                                if (isset($userType)) {
                                    if ($userType->userId == $model->userId) {
                                        return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                            'title' => Yii::t('yii', 'update'),
                                        ]);
                                    } else {
                                        //return Html::a('<i class="fa fa-pencil"></i>', '#', [
                                        //'title' => Yii::t('yii', 'update'),
                                        //]);
                                    }
                                } else {
                                    return Html::a('<i class="fa fa-pencil"></i>', '#', [
                                        'title' => Yii::t('yii', 'update'),
                                    ]);
                                }
                            },
                            'delete' => function ($url, $model) {
                                $userType = common\models\costfit\Brand::find()->where('userId = ' . Yii::$app->user->identity->userId)->one();
                                if (isset($userType)) {
                                    if ($userType->userId == $model->userId) {
                                        return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                            'title' => Yii::t('yii', 'Delete'),
                                            'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                            'data-method' => 'post',
                                        ]);
                                    } else {
                                        // return Html::a('<i class="fa fa-trash-o"></i>', '#', [
                                        //  'title' => Yii::t('yii', 'Delete'),
                                        //   'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                        //  'data-method' => 'post',
                                        // ]);
                                    }
                                } else {
                                    return Html::a('<i class="fa fa-trash-o"></i>', '#', [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                        'data-method' => 'post',
                                    ]);
                                }
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
