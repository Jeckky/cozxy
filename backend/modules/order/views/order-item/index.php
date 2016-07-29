<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Items';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="order-item-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Order Item', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
                        'attribute' => 'orderId',
                        'value' => function($model) {
                            return $model->order->orderNo;
                        }
                    ],
                    [
                        'attribute' => 'productId',
                        'value' => function($model) {
                            return $model->product->title;
                        }
                    ],
//                    'productGroupId',
//                    'brandId',
                    // 'categoryId',
                    'quantity',
                    'price',
                    'total',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
//                        'template' => '{view} {update} {delete} {order} {product}',
                        'template' => '',
                        'buttons' => [
                            'order' => function($url, $model) {
                                return Html::a('<br><u>Order</u>', ['/order/manage', 'orderItemId' => $model->orderItemId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                            'product' => function($url, $model) {
                                return Html::a('<br><u>Product</u>', ['/product/manage', 'orderItemId' => $model->orderItemId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
