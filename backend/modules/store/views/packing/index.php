<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Picking List';
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
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'checkboxOptions' => [
                            'class' => 'input-lg'
                        ]
                    // you may configure additional properties here
                    ],
                    ['class' => 'yii\grid\SerialColumn'],
                    'orderNo',
//                    'invoiceNo',
//                    [
//                        'attribute' => 'userId',
//                        'value' => function($model) {
//                            return isset($model->user) ? $model->user->firstname . " " . $model->user->lastname : NULL;
//                        }
//                    ],
//                    'token:ntext',
                    // 'totalExVat',
                    // 'vat',
                    // 'total',
                    // 'discount',
                    // 'grandTotal',
                    // 'shippingRate',
//                    'summary',
                    [
                        'attribute' => 'countItem',
                        'format' => 'html',
                        'value' => function($model) {
                            $countItemsArray = common\models\costfit\OrderItem::countPickingItemsArray($model->orderId);
                            return $countItemsArray['countItems'] . " รายการ<br>" . $countItemsArray['sumQuantity'] . " ชิ้น";
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
//                    [
//                        'attribute' => 'paymentType',
//                        'value' => function($model) {
//                            return ($model->paymentType == 1) ? 'โอนผ่านธนาคาร' : 'จ่ายผ่านบัตรเครดิต';
//                        }
//                    ],
//                    [
//                        'attribute' => 'paymentDateTime',
//                        'value' => function($model) {
//                            return (isset($model->paymentDateTime) && !empty($model->paymentDateTime)) ? $this->context->dateThai($model->paymentDateTime, 2, true) : NULL;
//                        }
//                    ],
//                    'status',
//                    [
//                        'attribute' => 'status',
//                        'value' => function($model) {
//                            return $model->getStatusText($model->status);
//                        }
//                    ],
                    // 'createDateTime',
//                    [
//                        'attribute' => 'updateDateTime',
//                        'value' => function($model) {
//                            return (isset($model->updateDateTime) && !empty($model->updateDateTime)) ? $this->context->dateThai($model->updateDateTime, 2, true) : NULL;
//                        }
//                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>View', Yii::$app->homeUrl . "order/order/view/" . $model->encodeParams(['id' => $model->orderId]), [
                                    'title' => Yii::t('app', ' View Order No :' . $model->orderId), 'class' => 'btn btn-info']);
                            },
                            'pick' => function($url, $model) {
                                return Html::a('<u><i class="fa fa-check" aria-hidden="true"></i>Pick</u>', ['payment-history', 'orderId' => $model->orderId], [
                                    'title' => Yii::t('app', 'history\'s lists'), 'class' => 'btn btn-warning']);
                            },]
                    ],
                ],
            ]);
            ?>
            <?= Html::a("Pick", NULL, ['class' => 'btn btn-success btn-lg']) ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
