<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Image Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-image-suppliers-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Image Suppliers', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
                    [
                        'attribute' => 'sortOrder',
                        'format' => 'raw',
                        'value' => function($model) {
                            return "<form id='form$model->id' name='form$model->productImageId' action='" . Yii::$app->homeUrl . "suppliers/product-image-suppliers/change-sort-order?id=$model->id' method='POST'>"
                            . Html::dropDownList("sortOrder" . $model->productImageId, $model->ordering, [0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20, 21 => 21, 22 => 22, 23 => 23, 24 => 24, 25 => 25, 26 => 26, 27 => 27, 28 => 28, 29 => 29, 30 => 30])
                            . Html::hiddenInput('className' . $model->productImageId, $model::ClassName())
                            . Html::hiddenInput('pkName' . $model->productImageId, $model->tableSchema->primaryKey[0])
                            . Html::hiddenInput('action' . $model->productImageId, $this->context->action->id)
                            . Html::hiddenInput('followId' . $model->productImageId, $model->projectId)
                            . Html::hiddenInput('followIdName' . $model->productImageId, "projectId")
                            . Html::submitButton("<i class='glyphicon glyphicon-check'></i>", ['class' => 'btn btn-success btn-xs'])
                            . "</form>";
                        }
                    ],
                    'productImageId',
                    'productSuppId',
                    'title',
                    'description:ntext',
                    'original_name',
                    // 'image',
                    // 'imageThumbnail1',
                    // 'imageThumbnail2',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
                        'buttons' => []
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
