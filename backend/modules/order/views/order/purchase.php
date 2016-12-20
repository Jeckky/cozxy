<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Order */
?>
<div class="panel-heading" style="background-color: #ccffcc;">
    <span class="panel-title"><h3>รายการ Orders ที่ยังไม่สร้าง PO</h3></span>
</div>
<div class="panel-body">
    <table class="table" >
        <tr style="height: 50px;background-color: #F0FFFF;">
            <th style="vertical-align: middle;text-align: center;width: 10%;">ลำดับที่</th>
            <th style="vertical-align: middle;text-align: center;width: 30%;">PO NO.</th>
            <th style="vertical-align: middle;text-align: center;width: 15%;">จำนวนรายการ</th>
            <th style="vertical-align: middle;text-align: center;width: 30%;">สถานะ</th>
        </tr>

        <?php
        if (isset($model) && !empty($model)) {
            $i = 1;
            $a = 0;
            $orderId = [];
            foreach ($model as $order):
                ?>
                <tr>
                    <td style="vertical-align: middle;text-align: center;width: 5%;"><?= $i ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 30%;"><?= $order->invoiceNo ?></td>
                    <td style="vertical-align: middle;text-align: center;width: 15%;"><?= common\models\costfit\Order::countOrderItem($order->orderId) ?> รายการ</td>
                    <td style="vertical-align: middle;text-align: center;width: 15%;"><?= $order->getStatusText($order->status) ?></td>
                </tr>
                <?php
                $orderId[$a] = $order->orderId;
                $a++;
                $i++;
            endforeach;
            ?>

            <?php
        } else {
            ?>
            <tr><td colspan="4"> ไม่มีข้อมูล</td></tr>
        <?php }
        ?>
    </table>
    <?php
    if (isset($model) && !empty($model)) {
        echo '<div class="pull-right">' . Html::a('<i class="fa fa-check-square-o" aria-hidden="true"></i> สร้างใบ PO', ['create-po',
            'orderId' => $orderId
                ], ['class' => 'btn btn-lg btn-success']) . '</div>';
    }
    ?>
</div>