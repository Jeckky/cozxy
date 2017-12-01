<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\costfit\ProductGroupTemplateOption;

/* @var $this yii\web\View */
/* @var $searchModel common\models\costfit\ProductGroupTemplateOptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Group Template Options';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-group-template-option-index">

    <?php
// echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Group Template Option', ['create?productGroupTemplateId=' . $_GET["productGroupTemplateId"]], ['class' => 'btn btn-success btn-xs']) ?>
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
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
//                    'productGroupTemplateOptionId',
                    [
                        'attribute' => 'productGroupTemplateId',
                        'value' => function($model) {
                            return $model->productGroupTemplate->title;
                        }
                    ],
                    'title',
                    'description:ntext',
                    'status',
                    ['attribute' => 'ordering',
                        'format' => 'raw',
                        'value' => function($model) {
                            //throw new \yii\base\Exception(print_r($model, true));
                            $total = ProductGroupTemplateOption::countOption($model->productGroupTemplateId);
                            $minut = '<a href="javascript:orderingTemplateOption(' . $model->productGroupTemplateOptionId . ',' . $total . ',0' . ')" class="btn btn-warning" style="font-size: 14pt;">-</a>&nbsp;&nbsp;&nbsp;';
                            $ordering = '<span id="orderingTemplate' . $model->productGroupTemplateOptionId . '" style="font-size: 14pt;">' . $model->ordering . '</span> &nbsp;&nbsp;&nbsp;';

                            $plus = ' <a href = "javascript:orderingTemplateOption(' . $model->productGroupTemplateOptionId . ',' . $total . ',1' . ')" class = "btn btn-success"style = "font-size: 14pt;">+</a>';
                            return $minut . $ordering . $plus;
                        }
                    ],
                    // 'createDateTime',
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
                                    'update' => function ($url, $model, $showED) {
                                if ($showED == 1) {
                                    return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                                'title' => Yii::t('yii', 'update'),
                                    ]);
                                }
                            },
                                    'delete' => function ($url, $model, $showED) {
                                if ($showED == 1) {
                                    return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                                'title' => Yii::t('yii', 'Delete'),
                                                'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                                'data-method' => 'post',
                                    ]);
                                }
                            },]
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
            <?php Pjax::end(); ?>
</div>
