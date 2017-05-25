<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Groups Wizard Create';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-group-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>



    <div class="panel panel-default" >
        <div class="panel-heading" style="background-color: #000;vertical-align: middle;">
            <div class="row">
                <div class="col-md-6">
                    <span class="panel-title"><h3 style="color:#ffcc00;vertical-align: middle;"><?= $this->title ?></h3></span>
                </div>
                <div class="col-md-6" style="vertical-align: bottom;">
                    <div class="btn-group pull-right" >
                        <?=
                        Html::a('Create Product Group', ['create-wizard'], ['class' => 'btn btn-success',
                            'style' => 'height:35px;color:#FFF;'])
                        ?>
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
//                    'productGroupId',
                    'title',
                    'description:ntext',
                    ['attribute' => 'Create Date Time',
                        'value' => function ($model) {
                            return $this->context->dateThai($model->createDateTime, 1);
                        }
                    ],
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
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
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
