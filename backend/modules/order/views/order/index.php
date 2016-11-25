<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

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
                        'format' => 'raw',
                        'value' => function($model) {
                            if ($model->status >= 5) {
                                return $model->createStatus($model->orderId);
                            } else {
                                return $model->getStatusText($model->status);
                            }
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
                        'template' => '{view}{history}',
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', Yii::$app->homeUrl . "order/order/view/" . $model->encodeParams(['id' => $model->orderId]), [
                                            'title' => Yii::t('app', ' View Order No :' . $model->orderId),]);
                            },
                            'history' => function($url, $model) {
                                $paymentHistory = \common\models\costfit\OrderPaymentHistory::find()->where("orderId=" . $model->orderId)->one();
                                if (isset($paymentHistory)) {
                                    return Html::a('<br><u>Payment History</u>', ['payment-history', 'orderId' => $model->orderId], [
                                                'title' => Yii::t('app', 'history\'s lists'),]);
                                }
                            },]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>

    <?php
    if (isset($status) && !empty($status)) {
        $a = $orderId;
    } else {
        $a = '';
    }

//Modal::begin([
//    'header' => '<h2>' . $a . '</h2>',
//    'headerOptions' => ['id' => 'modalHeader'],
//    'id' => 'cityModal',
//    'size' => 'modal-lg',
//    'clientOptions' => ['backdrop' => 'static', 'tabindex' => '-1']
//]);
    ?>
    <!--<div id="modalContent">
        test
    </div>-->
    <?php
//Modal::end();
    ?>
</div>
<div class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <!--<div id="uidemo-modals-alerts-info" class="modal modal-alert modal-info fade">-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h4>รายละเอียด</h4>
                <div class="pull-right" data-dismiss="modal" style="margin-top: -50px;cursor: pointer;"><h3>X</h3></div>
            </div>
            <div class="modal-body col-md-12 text-left" style="font-size: 12px; white-space: wrap;">
                <div class="item col-md-12 text-left"></div>
            </div>
            <!--            <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
                        </div>-->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>