<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Order */

$this->title = $model->orderId;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->orderId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->orderId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'orderId',
            'userId',
            'token:ntext',
            'orderNo',
            'invoiceNo',
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
            'status',
            'createDateTime',
            'updateDateTime',
        ],
    ]) ?>

</div>
