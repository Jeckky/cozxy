<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$i = 0;
if (count($order) > 0) {
    $GetOrderItemMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId)->groupBy('receiveType')->all();
    foreach ($GetOrderItemMasters as $value) {
        //echo 'receiveType : ' . ;
        if ($value->receiveType == 1) {
            //echo 'Lockers';
            ?>
            <tr style="background-color:#f9f9f9 ; border-bottom: 1px #000000 solid; height: 25px;">
                <td style="font-size: 12px;" colspan="7">สถานที่รับของ : ปลายทางที่ล็อคเกอร์</td>
            </tr>
            <?php
            $listOrderItems = common\models\costfit\OrderItem::find()
            ->select('orderId,productSuppId,supplierId')->where('orderId=' . $order->orderId . ' and receiveType = 1')->groupBy('supplierId')->all();
            foreach ($listOrderItems as $value1) {
                /*
                 * # แยก Suppliers ไม่ซ้ำกัน
                 * จาก table OderItem
                 * 10/1/2017
                 */
                ?>
                <tr style="background-color:#f9f9f9 ; border-bottom: 1px #000000 solid; height: 25px;">
                    <td style="font-size: 12px;" colspan="7"><?php echo isset($value1->user) ? $value1->user->code : '-'; ?></td>
                </tr>
                <?php
                $GetOrder = common\models\costfit\OrderItem::find()->where('orderId=' . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'] . ' and receiveType = 1')->all();
                $num = 0;
                foreach ($GetOrder as $value) {
                    /*
                     * # แสดงข้อมูล Product ของแต่ละ Suppliers
                     * # เงือนไขของ Product Suppliers
                     */
                    $listOrderItemsShow = common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $value['productSuppId'])->one();
                    ?>
                    <tr style=" border-bottom: 1px #000000 solid;">
                        <td style="font-size: 12px;"><?php echo ++$i; ?></td>
                        <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['code']) ? $listOrderItemsShow['code'] : '-'; ?></td>
                        <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['title']) ? $listOrderItemsShow['title'] : '-'; ?></td>
                        <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['unit']) ? $listOrderItemsShow->units->title : '-'; ?></td>
                        <td style="font-size: 12px; text-align: right;"><?php echo isset($value->price) ? number_format($value->price, 2) : '-'; ?></td>
                        <td style="font-size: 12px; text-align: right;"><?php echo isset($value->quantity) ? $value->quantity : '-' ?></td>
                        <td style="font-size: 12px; text-align: right;"><?php echo isset($value->total) ? number_format($value->total, 2) : '-'; ?></td>
                    </tr>
                    <?php
                }
            }
        } elseif ($value->receiveType == 2) {
            //echo 'Booth';
            ?>
            <tr style="background-color:#f9f9f9 ; border-bottom: 1px #000000 solid; height: 25px;">
                <td style="font-size: 12px;" colspan="7">สถานที่รับของ : ปลายทางที่บูธ</td>
            </tr>
            <?php
            $listOrderItems = common\models\costfit\OrderItem::find()
            ->select('orderId,productSuppId,supplierId')->where('orderId=' . $order->orderId . ' and receiveType = 2')->groupBy('supplierId')->all();
            foreach ($listOrderItems as $value1) {
                /*
                 * # แยก Suppliers ไม่ซ้ำกัน
                 * จาก table OderItem
                 * 10/1/2017
                 */
                ?>
                <tr style="background-color:#f9f9f9 ; border-bottom: 1px #000000 solid; height: 25px;">
                    <td style="font-size: 12px;" colspan="7"><?php echo isset($value1->user) ? $value1->user->code : '-'; ?></td>
                </tr>
                <?php
                $GetOrder = common\models\costfit\OrderItem::find()->where('orderId=' . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'] . ' and receiveType = 1')->all();
                $num = 0;
                foreach ($GetOrder as $value) {
                    /*
                     * # แสดงข้อมูล Product ของแต่ละ Suppliers
                     * # เงือนไขของ Product Suppliers
                     */
                    $listOrderItemsShow = common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $value['productSuppId'])->one();
                    ?>
                    <tr style=" border-bottom: 1px #000000 solid;">
                        <td style="font-size: 12px;"><?php echo ++$i; ?></td>
                        <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['code']) ? $listOrderItemsShow['code'] : '-'; ?></td>
                        <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['title']) ? $listOrderItemsShow['title'] : '-'; ?></td>
                        <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['unit']) ? $listOrderItemsShow->units->title : '-'; ?></td>
                        <td style="font-size: 12px; text-align: right;"><?php echo isset($value->price) ? number_format($value->price, 2) : '-'; ?></td>
                        <td style="font-size: 12px; text-align: right;"><?php echo isset($value->quantity) ? $value->quantity : '-' ?></td>
                        <td style="font-size: 12px; text-align: right;"><?php echo isset($value->total) ? number_format($value->total, 2) : '-'; ?></td>
                    </tr>
                    <?php
                }
            }
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
