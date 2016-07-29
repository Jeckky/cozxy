<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="order-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Order', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
                    'orderNo',
                    'invoiceNo',
                    [
                        'attribute' => 'userId',
                        'value' => function($model) {
                            return isset($model->user) ? $model->user->firstname . " " . $model->user->lastname : NULL;
                        }
                    ],
//                    'token:ntext',
                    // 'totalExVat',
                    // 'vat',
                    // 'total',
                    // 'discount',
                    // 'grandTotal',
                    // 'shippingRate',
                    'summary',
                    [
                        'attribute' => 'countItem',
                        'value' => function($model) {
                            return count($model->orderItems) . " รายการ";
                        }
                    ],
                    // 'sendDate',
                    // 'billingCompany',
                    // 'billingTax',
                    // 'billingAddress:ntext',
                    // 'billingCountryId',
                    // 'billingProvinceId',
                    // 'billingAmphurId',
                    // 'billingZipcode',
                    // 'billingTel',
                    // 'shippingCompany',
                    // 'shippingTax',
                    // 'shippingAddress:ntext',
                    // 'shippingCountryId',
                    // 'shippingProvinceId',
                    // 'shippingAmphurId',
                    // 'shippingZipcode',
                    // 'shippingTel',
                    // 'paymentType',
                    // 'couponId',
                    // 'checkStep',
                    // 'note:ntext',
//                    'paymentDateTime',
                    [
                        'attribute' => 'paymentType',
                        'value' => function($model) {
                            return ($model->paymentType == 1) ? 'โอนผ่านธนาคาร' : 'จ่ายผ่านบัตรเครดิต';
                        }
                    ],
                    [
                        'attribute' => 'paymentDateTime',
                        'value' => function($model) {
                            return (isset($model->paymentDateTime) && !empty($model->paymentDateTime)) ? $this->context->dateThai($model->paymentDateTime, 2, true) : NULL;
                        }
                    ],
//                    'status',
                    [
                        'attribute' => 'status',
                        'value' => function($model) {
                            return $model->getStatusText($model->status);
                        }
                    ],
                    // 'createDateTime',
                    [
                        'attribute' => 'updateDateTime',
                        'value' => function($model) {
                            return (isset($model->updateDateTime) && !empty($model->updateDateTime)) ? $this->context->dateThai($model->updateDateTime, 2, true) : NULL;
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {items}',
                        'buttons' => [
                            'items' => function($url, $model) {
                                return Html::a('<br><u>Items</u>', ['/order/order-item', 'orderId' => $model->orderId], [
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
