<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\models\costfit\Order;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Order */

$this->title = $model->orderNo;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode('Order No. : ' . $this->title) ?></h1>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">รหัสรับสินค้า</div>
                <div class="panel-body" id="orderPanel">
                    <?php if($model->status != Order::ORDER_STATUS_RECEIVED): ?>
                        <?php $form = ActiveForm::begin(['id' => 'orderForm']); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="รหัสรับสินค้า" id="orderCode" <?= ($model->status != $model::ORDER_STATUS_BOOTH_PACKING) ? 'disabled' : '' ?>>
                        </div>
                        <input type="submit" value="ยืนยันรับสินค้า" class="btn btn-block btn-danger" id="oSubmit" <?= ($model->status != $model::ORDER_STATUS_BOOTH_PACKING) ? 'disabled' : '' ?>>
                        <input type="hidden" value="<?= $model->orderId ?>" id="orderId">
                        <?php ActiveForm::end(); ?>
                    <?php else: ?>
                        <h4>รับสินค้าเรียบร้อยแล้ว</h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel">
                <div class="panel-heading">รายละเอียดใบสั่งซื้อ</div>
                <div class="panel-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'userId',
                                'value' => function ($model) {
                                    $user = $model->user;

                                    return $user->firstname . ' ' . $user->lastname;
                                }
                            ],
                            'orderNo',
                            'invoiceNo',
                            'summary',
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return $model->getStatusText($model->status);
                                }
                            ],
                            //            'pickingId',
                            //            'token:ntext',
                            //            'totalExVat',
                            //            'vat',
                            //            'total',
                            //            'discount',
                            //            'grandTotal',
                            //            'shippingRate',
                            //            'orderId',
                            //            'userId',
                            //            'userCoin',
                            //            'cozxyCoin',
                            //            'sendDate',
                            //            'addressId',
                            //            'isPayNow',
                            //            'billingFirstname',
                            //            'billingLastname',
                            //            'billingCompany',
                            //            'billingTax',
                            //            'billingAddress:ntext',
                            //            'billingCountryId',
                            //            'billingProvinceId',
                            //            'billingAmphurId',
                            //            'billingDistrictId',
                            //            'billingZipcode',
                            //            'billingTel',
                            //            'shippingFirstname',
                            //            'shippingLastname',
                            //            'shippingCompany',
                            //            'shippingTax',
                            //            'shippingAddress:ntext',
                            //            'shippingCountryId',
                            //            'shippingProvinceId',
                            //            'shippingAmphurId',
                            //            'shippingDistrictId',
                            //            'shippingZipcode',
                            //            'shippingTel',
                            //            'paymentType',
                            //            'couponId',
                            //            'checkStep',
                            //            'note:ntext',
                            //            'paymentDateTime',
                            //            'isSlowest',
                            //            'color',
                            //            'pickerId',
                            //            'password',
                            //            'otp',
                            //            'refNo',
                            //            'status',
                            //            'error',
                            //            'createDateTime',
                            //            'updateDateTime',
                            //            'email:email',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading">สแกนบาร์โค้ดสินค้า</div>
                <div class="panel-body">
                    <?php if($model->status != Order::ORDER_STATUS_RECEIVED && $model->status != Order::ORDER_STATUS_BOOTH_PACKING): ?>
                        <?php $form = ActiveForm::begin(['id' => 'barcodeForm']); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="บาร์โค้ดสินค้า" id="pBarcode">
                        </div>
                        <input type="submit" value="ตรวจสอบสินค้า" class="btn btn-block btn-warning" id="pSubmit">
                        <input type="hidden" value="<?= $model->orderId ?>" id="orderId">
                        <?php ActiveForm::end(); ?>
                    <?php elseif($model->status == Order::ORDER_STATUS_BOOTH_PACKING): ?>
                        <h4>หยิบสินค้าใส่ถุงครบแล้ว</h4>
                    <?php else: ?>
                        <h4>รับสินค้าเรียบร้อยแล้ว</h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">รายการสินค้า</div>
                <div class="panel-body" id="productPanel">
                    <?= GridView::widget([
                        'dataProvider' => new \yii\data\ActiveDataProvider([
                            'query' => \common\models\costfit\OrderItem::find()->where(['orderId' => $model->orderId])
                        ]),
                        'rowOptions' => function ($model) {
                            $options = ['id' => 'r' . $model->orderItemId];
                            $options['class'] = ($model->status == 16) ? 'success' : '';

                            return $options;
                        },
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'productId',
                                'value' => function ($model) {
                                    return $model->product->title;
                                }
                            ],
                            'quantity',
                            'total',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view}'
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$this->registerJs("
    $('#pSubmit').click(function(e) {
        e.preventDefault();
        
        $('#barcodeForm').addClass('form-loading');
        
        var barcode = $('#pBarcode').val();
        var orderId = $('#orderId').val();
        
        $.ajax({
            url:'" . Yii::$app->homeUrl . "booth/order/check-barcode',
            data:{barcode:barcode, orderId:orderId},
            dataType:'json',
            method:'POST',
            success:function(data) {
                if(data.result == 1) {
                    alert('รายการสินค้าถูกต้อง สามารถหยิบใส่ถุงได้');
                    $('#r'+data.orderItemId).addClass('success');
                    $('#barcodeForm').removeClass('form-loading');
                    
                    if(data.isPackingComplete == 1) {
                        $('#productPanel').html('<h4>หยิบสินค้าใส่ถุงครบแล้ว</h4>');
                        $('#orderPanel').append('<p class=alert>'+data.msg+'</p>');
                       
                        $('#oSubmit').prop('disabled', false);
                        $('#orderCode').prop('disabled', false);
                    }
                } else {
                    alert('สินค้าไมไ่ด้อยู่ในออเดอร์นี้ หรือหยิบใส่ถุงแล้ว');
                }
            }
        });
    });
    
    $('#orderForm').click(function(e) {
        e.preventDefault();
        
        var orderCode = $('#orderCode').val();
        var orderId = $('#orderId').val();
        
        $.ajax({
            url:'" . Yii::$app->homeUrl . "booth/order/booth-check-order-code',
            data:{orderCode:orderCode, orderId:orderId},
            dataType:'json',
            method:'POST',
            success:function(data) {
                if(data.result == 1) {
                    alert('รหัสยืนยันถูกต้อง สามารถรับสินค้าได้');
                    $('#orderPanel').html('<h4>รับสินค้าเรียบร้อยแล้ว</h4>');
                } else {
                    alert('รหัสไม่ถูกต้อง ไม่สามารถรับสินค้าได้');
                }
            }
        });
    });
");
?>
