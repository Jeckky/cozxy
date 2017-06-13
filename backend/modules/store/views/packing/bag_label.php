<?php

use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\Product;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<html>
    <head>

    </head>
    <!--<body onload="print_window();" align="center">-->
    <body align="center">
        <table width ="750"  cellpadding="2" cellspacing="0" style="border: 0px; text-align: center;">
            <tr style="height: 50px;">
                <td style="text-align: right;vertical-align: top;" colspan="3">สาขาที่ออกใบกำกับภาษี : สำนักงานใหญ่</td>
            </tr>
            <tr style="height: 160px;">
                <td style="text-align: center; vertical-align: middle;">
                    <img src="<?= Yii::$app->homeUrl ?>images/logo/cozxy.png" alt="cozxy.com" style="width: 110px;height: 65px;">
                </td>
                <td style="padding: 5px; vertical-align: text-top; text-align: center;">
                    <h2>
                        บริษัท คอซซี่ดอทคอม จำกัด
                    </h2>
                    เลขที่ 5 ซอยรามอินทรา 5 แยก 4 แขวงอนุสาวรีย์ กรุงเทพฯ 10220<br>
                    เลขประจำตัวผู้เสียภาษี : 0105546109903 <br>
                </td>
                <td style="vertical-align:middle;">
                    <img src="https://chart.googleapis.com/chart?chs=140x140&cht=qr&chl=<?= $bagNo ?>">
                </td>
            </tr>
        </table>
        <table width="750"  cellpadding="3" cellspacing="0" style="margin-top: -10px;">
            <tr>
                <td style="width: 33%;text-align: center;"><h2> </h2></td>
                <td style="width: 34%;text-align: center;"><h2>ใบกำกับภาษี</h2></td>
                <td style="width: 33%;border: #000 thin solid;padding: 15;">
                    เลขที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BL 1706-00001<br><br>
                    วันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;06/06/2017
                </td>
            </tr>
        </table>
        <table width="750"  cellpadding="3" cellspacing="1" style="margin-top: 3px;">
            <tr>
                <td style="width: 50%;border: #000 solid thin;">
                    <h4>ชื่อ - นามสกุล ผู้รับ : <?= Order::findReciever($orderId) ?></h4>
                    <h4>ชื่อ - นามสกุล ผู้รับ : <?= Order::findReciever($orderId) ?></h4>
                    <h4>ชื่อ - นามสกุล ผู้รับ : <?= Order::findReciever($orderId) ?></h4>
                </td>
                <td style="border: #000 solid thin;">
                    <h4>สถานที่ส่ง : <?= PickingPoint::findPickingPoitItem($orderId) ?></h4>
                    <h4>สถานที่ส่ง : <?= PickingPoint::findPickingPoitItem($orderId) ?></h4>
                    <h4>สถานที่ส่ง : <?= PickingPoint::findPickingPoitItem($orderId) ?></h4>
                </td>
            </tr>
        </table>
        <table class="table table_bordered" width="750"  cellpadding="2" cellspacing="0" style="border: 0.5px slategray solid;">

            <thead>
                <tr style="height: 50px;">
                    <th><center>รหัสสินค้า</center></th>
        <th><center>รายการ</center></th>
    <th><center>จำนวน</center></th>
<th><center>หน่วย</center></th>
<th><center>ราคา/หน่วย</center></th>
<th><center>ส่วนลด</center></th>
<th><center>จำนวนเงิน</center></th>
</tr>
</thead>

<tbody>
    <?php
    $i = 1;
    $orderItems = OrderItemPacking::findItemInBag($bagNo);
    if (isset($orderItems) && !empty($orderItems)) {
        foreach ($orderItems as $orderItem):
            $item = Product::findProducts($orderItem->orderItemId);
            if (isset($item) && !empty($item)) {
                echo '<tr style="height: 50px;">';
                echo '<td><center>' . $i . '</center></td>';
                echo '<td><center>' . $item->code . '</center></td>';
                echo '<td><center>' . $item->title . '</center></td>';
                echo '<td><center>' . $orderItem->quantity . '</center></td>';
                echo '</tr>';
                $i++;
            } else {
                echo '<tr><td colspan="4"><center>ไม่มีรายการสินค้า</center></td></tr>';
            }
        endforeach;
    } else {
        echo '<tr><td colspan="3"><center>ไม่มีรายการสินค้า</center></td></tr>';
    }
    ?>
</tbody>
</table>


</body>
</html>