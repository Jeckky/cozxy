<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Price Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<div class="product-price-suppliers-index">
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <h3>
        Title :  <?php echo isset($productSupp->title) ? $productSupp->title : ''; ?>
    </h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?> : ราคาขายสินค้า</div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'fa fa-angle-left\'></i><i class=\'fa fa-angle-left\'></i> Back To Product Suppliers', ['/suppliers/product-suppliers'], ['class' => 'btn btn-warning btn-xs']) ?>
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Price Suppliers', ['create?productSuppId=' . $_GET["productSuppId"]], ['class' => 'btn btn-success btn-xs']) ?>
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
                    //'productPriceId',
                    //'productSuppId',
                    //'quantity',
                    'price',
                    //'discountType',
                    [
                        'attribute' => 'discountType',
                        'value' => function($model) {
                            return $model->getDiscountTypeText($model->discountType);
                        }
                    ],
                    //'discountValue',
                    // 'description:ntext',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    //'status',
                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => function($model) {
                            if ($model->status == 1) {
                                $status = '<span class="label label-success">enable</span>';
                            } else {
                                $status = '<span class="label label-danger">disable</span>';
                            }
                            return $status;
                        }
                    ],
                    [
                        'attribute' => 'createDateTime',
                        'format' => 'raw',
                        'value' => function($model) {
                            if ($model->createDateTime == '0000-00-00 00:00:00') {
                                return '';
                            } else {
                                return $this->context->dateThai($model->createDateTime, 1, TRUE);
                            }
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url . '&productSuppId=' . $_GET['productSuppId'], [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil"></i>', $url . '&productSuppId=' . $_GET['productSuppId'], [
                                    'title' => Yii::t('yii', 'update'),
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fa fa-trash-o"></i>', $url . '&productSuppId=' . $_GET['productSuppId'], [
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
