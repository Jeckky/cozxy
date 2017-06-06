<tr>
    <td>Order #<?= $model['orderNo'] ?></td>
    <td><?= $model['status'] ?></td>
    <td><?= $model['updateDateTime'] ?></td>
    <td class="text-center">
        <?php
        if ($model['statusNum'] < \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS || $model['status'] == \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_PENDING) { // ชำระเงินแล้ว
            echo yii\helpers\Html::a('<i class="fa fa-search"></i>', Yii::$app->homeUrl . "profile/purchase-order/" . \common\models\ModelMaster::encodeParams(['orderId' => $model['orderId']]), ['class' => 'btn btn-primary btn-xs'], [
                'title' => Yii::t('app', ' '),]);
        } else {
            echo yii\helpers\Html::a('<i class="fa fa-print" aria-hidden="true"></i> See more', Yii::$app->homeUrl . "payment/print-receipt/" . \common\models\ModelMaster::encodeParams(['orderId' => $model['orderId']]) . '/' . $model['orderNo'], ['class' => 'btn btn-black btn-xs', 'target' => '_blank'
                , 'title' => Yii::t('app', ' ')]);
        }
        ?>
    </td>
</tr>