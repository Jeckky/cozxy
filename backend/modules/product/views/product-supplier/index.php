<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-supplier-index">
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6"><?= $this->title ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Supplier', ['create', 'productId' => $_GET["productId"]], ['class' => 'btn btn-success btn-xs']) ?>
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
                [
                    'attribute' => 'productId',
                    'value' => function($model) {
                        return isset($model->products) ? $model->products->title : NULL;
                    }
                ],
                [
                    'attribute' => 'supplierId',
                    'value' => function($model) {
                        return isset($model->suppliers) ? $model->suppliers->name : NULL;
                    }
                ],
                'maxQuantity',
                'leaseTime',
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{delete}{update}',
                ],
            ],
        ]);
        ?>
    </div>
    <?php Pjax::end(); ?>
</div>
