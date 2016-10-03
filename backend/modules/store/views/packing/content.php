<?php

use yii\helpers\Html;
use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\Product;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?><?php
//$id = Order::findOrderId($orderId);
?>
<br><br><br><br><br>
<table class="table table_bordered" width="100%"  cellpadding="3" cellspacing="0" style="border: 0px;">
    <tr>
        <td><h3><?= $bagNo ?></h3></td><td style="text-align: right;"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?= $bagNo ?>"></td>
    </tr>
    <tr>
        <td colspan="2"><h4>ชื่อ - นามสกุล ผู้รับ : <?= Order::findReciever($orderId) ?></h4></td>
    </tr><tr>
        <td colspan="2"><h4>สถานที่ส่ง : <?= PickingPoint::findPickingPoitItem($orderId) ?></h4></td>
    </tr>
</table>

<table class="table table_bordered" width="100%"  cellpadding="3" cellspacing="0">
    <tr>
        <td colspan="3"><center><b>สินค้า</b></center></td>
</tr>
<tr>

    <td><center>No.</center></td>
<td><center>สินค้า</center></td>
<td><center>จำนวน</center></td>
</tr>
<tbody>
    <?php
    $i = 1;
    $orderItems = OrderItemPacking::findItemInBag($bagNo);
//    throw new Exception(print_r($orderItems, true));
    if (isset($orderItems) && !empty($orderItems)) {
        foreach ($orderItems as $orderItem):
            $item = Product::findProducts($orderItem->orderItemId);
            //throw new Exception(print_r($item, true));
            if (isset($item) && !empty($item)) {
                //throw new Exception($item->code);
                echo '<tr>';
                echo '<td><center>' . $i . '</center></td>';
                echo '<td><center>' . $item->code . '</center></td>';
                echo '<td><center>' . $orderItem->quantity . '</center></td>';
                echo '</tr>';
                $i++;
            } else {
                echo '<tr><td colspan="3"><center>ไม่มีรายการสินค้า1</center></td></tr>';
            }
        endforeach;
    } else {
        echo '<tr><td colspan="3"><center>ไม่มีรายการสินค้า2</center></td></tr>';
    }
    ?>
</tbody>
</table>

