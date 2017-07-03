<?php

use common\models\costfit\Order;
?>
<tr>
    <td>Order #<?= $model['orderNo'] ?></td>
    <td><?= $model['status'] ?></td>
    <td><?= $model['updateDateTime'] ?></td>
    <td class="text-center">
        <?php
        if ($model['statusNum'] < Order::ORDER_STATUS_E_PAYMENT_SUCCESS || $model['status'] == Order::ORDER_STATUS_E_PAYMENT_PENDING) { // ชำระเงินแล้ว
            echo yii\helpers\Html::a('<i class="fa fa-search"></i>', Yii::$app->homeUrl . "my-account/purchase-order/" . \common\models\ModelMaster::encodeParams(['orderId' => $model['orderId']]), ['class' => 'btn btn-primary btn-xs', 'style' => 'padding: 3px 6px;'], [
                'title' => Yii::t('app', ' '),]);
        } else {
            echo yii\helpers\Html::a('<i class="fa fa-print" aria-hidden="true"></i> Print', Yii::$app->homeUrl . "payment/print-receipt/" . \common\models\ModelMaster::encodeParams(['orderId' => $model['orderId']]) . '/' . $model['orderNo'], ['class' => 'btn btn-black btn-xs', 'target' => '_blank', 'style' => 'padding: 3px 6px;'
                , 'title' => Yii::t('app', ' ')]);
            echo '&nbsp;' . yii\helpers\Html::a('<i class="fa fa-truck" aria-hidden="true"></i> รายละเอียด Tracking', Yii::$app->homeUrl . "my-account/detail-tracking/" . \common\models\ModelMaster::encodeParams(['orderId' => $model['orderId']]) . '/' . $model['orderNo'], ['class' => 'btn btn-black btn-xs', 'target' => '_blank', 'style' => 'padding: 3px 6px;'
                , 'title' => Yii::t('app', ' ')]);
        }
        if ($model['statusNum'] == Order::ORDER_STATUS_RECEIVED) {//รับของแล้ว
            $flag = false;
            $flag = common\helpers\ReturnProduct::returnDate($model['updateDateTime']);
            $isMoreItem = common\helpers\ReturnProduct::isMoreItem($model['orderNo']);
            if ($flag == true) {
                if ($isMoreItem == true) {
                    echo " " . yii\helpers\Html::a('<i class="fa fa-repeat" aria-hidden="true"></i> Return', Yii::$app->homeUrl . "return/returning?orderNo=" . $model['orderNo'], ['class' => 'btn btn-warning  btn-xs', 'style' => 'padding: 3px 6px;'
                        , 'title' => Yii::t('app', 'return')]);
                }
            }
        }
        ?>
    </td>
</tr>
