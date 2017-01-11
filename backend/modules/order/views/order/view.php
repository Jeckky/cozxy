<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Order */

$this->title = $model->orderId;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="order-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->orderId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->orderId], [
                    'class' => 'btn btn-xs btn-outline btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'orderId',
                    'userId',
                    'token:ntext',
                    'orderNo',
                    'invoiceNo',
                    'totalExVat',
                    'vat',
                    'total',
                    'discount',
                    'grandTotal',
                    'shippingRate',
                    'summary',
                    'sendDate',
                    'billingCompany',
                    'billingTax',
                    'billingAddress:ntext',
                    'billingCountryId',
                    'billingProvinceId',
                    'billingAmphurId',
                    'billingZipcode',
                    'billingTel',
                    'shippingCompany',
                    'shippingTax',
                    'shippingAddress:ntext',
                    'shippingCountryId',
                    'shippingProvinceId',
                    'shippingAmphurId',
                    'shippingZipcode',
                    'shippingTel',
                    'paymentType',
                    'couponId',
                    'checkStep',
                    'note:ntext',
                    'paymentDateTime',
                    'status',
                    'createDateTime',
                    'updateDateTime',
                ],
            ])
            ?>
        </div>
    </div>

</div>
