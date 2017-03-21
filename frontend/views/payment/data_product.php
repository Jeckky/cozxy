<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$i = 0;
if (count($order) > 0) {
    $listOrderItems = common\models\costfit\OrderItem::find()
    ->select('orderId,productSuppId,supplierId,receiveType')->where('orderId=' . $order->orderId)->groupBy('supplierId')->all();
    foreach ($listOrderItems as $value1) {
        /*
         * # แยก Suppliers ไม่ซ้ำกัน
         * จาก table OderItem
         * 10/1/2017
         */
        ?>
        <tr style="background-color:rgb(220, 220, 220) ; border-bottom: 1px #000000 solid; height: 25px;">
            <td style="font-size: 12px;" colspan="7"><strong><?php echo isset($value1->user) ? $value1->user->code : '-'; ?></strong></td>
        </tr>
        <?php
        $GetOrderItemMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'])->groupBy('receiveType')->all();
        foreach ($GetOrderItemMasters as $value1) {
            //if ($value1->receiveType == 1) {
            ?>
            <tr style="background-color:#f1f1f1 ; border-bottom: 1px #000000 solid; height: 25px; text-align: left; color: #166db9;">
                <td style="font-size: 12px; " colspan="7"><?php
                    if ($value1->receiveType == 1) {
                        echo '<span style="color: #f6a828;">สถานที่รับของ : ปลายทางที่ <strong>Lockers เย็น</strong></span>';
                    } elseif ($value1->receiveType == 2) {
                        echo '<span style="color: #0000CC;">สถานที่รับของ : ปลายทางที่ <strong>Lockers ร้อน</strong></span>';
                    } elseif ($value1->receiveType == 3) {
                        echo '<span style="color: #000000;">สถานที่รับของ : ปลายทางที่ <strong>Booth</strong></span>';
                    }
                    ?></td>
            </tr>
            <?php
            $GetOrder = common\models\costfit\OrderItem::find()->where('orderId=' . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'] . ' and receiveType=' . $value1->receiveType)->all();
            $num = 0;
            foreach ($GetOrder as $value) {
                /*
                 * # แสดงข้อมูล Product ของแต่ละ Suppliers
                 * # เงือนไขของ Product Suppliers
                 */
                $listOrderItemsShow = common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $value['productSuppId'] . ' and receiveType=' . $value1->receiveType)->one();
                ?>
                <tr style=" border-bottom: 1px #000000 solid;">
                    <td style="font-size: 12px;"><?php echo ++$i; ?></td>
                    <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['code']) ? $listOrderItemsShow['code'] : '-'; ?></td>
                    <td style="font-size: 12px; width: 40%;"><?php echo isset($listOrderItemsShow['title']) ? $listOrderItemsShow['title'] : '-'; ?></td>
                    <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['unit']) ? $listOrderItemsShow->units->title : '-'; ?></td>
                    <td style="font-size: 12px; text-align: right;"><?php echo isset($value->price) ? number_format($value->price, 2) : '-'; ?></td>
                    <td style="font-size: 12px; text-align: right;"><?php echo isset($value->quantity) ? $value->quantity : '-' ?></td>
                    <td style="font-size: 12px; text-align: right;"><?php echo isset($value->total) ? number_format($value->total, 2) : '-'; ?></td>
                </tr>
                <?php
            }
            //} /* $value1->receiveType == 1 : Lockers */
        }
    }
} else {
    ?>
    <tr>
        <td colspan="7" class="text-center">ไม่พบข้อมูล</td>
    </tr>
    <?php
}
?>
