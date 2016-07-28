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
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Order', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
//                  'orderNo',
                    'invoiceNo',
                    'orderId',
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
                    // 'paymentDateTime',
                    // 'status',
                    // 'createDateTime',
                    'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete} {user}',
                        'buttons' => [
                            'user' => function($url, $model) {
                                return Html::a('<br><u>User</u>', ['/user/manage', 'orderId' => $model->orderId], [
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
