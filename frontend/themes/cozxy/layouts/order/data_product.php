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
    //echo '<pre>';
    //print_r($listOrderItems->attributes);
    //exit();
    foreach ($listOrderItems as $value1) {
        /*
         * # แยก Suppliers ไม่ซ้ำกัน
         * จาก table OderItem
         * 10/1/2017
         */
        ?>
        <tr style="background-color:rgb(220, 220, 220) ; border-bottom: 1px #000000 solid; height: 25px;">
            <td style="font-size: 12px;" colspan="7">
                <strong><?php echo isset($value1->user) ? $value1->user->code : '-'; ?></strong>
            </td>
        </tr>
        <?php
        $GetOrderItemMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'])->groupBy('receiveType')->all();
        foreach ($GetOrderItemMasters as $value1) {
            //if ($value1->receiveType == 1) {
            ?>
            <tr style="background-color:#f1f1f1 ; border-bottom: 1px #000000 solid; height: 25px; text-align: left; color: #166db9;">
                <td style="font-size: 12px; " colspan="7">
                    <?php
                    $GetOrder = common\models\costfit\OrderItem::find()->where('orderId=' . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'] . ' and receiveType=' . $value1->receiveType)->groupBy('orderId')->one();
                    if (isset($GetOrder->pickingId)) {
                        $picking_point = common\models\costfit\PickingPoint::find()->where('pickingId=' . $GetOrder->pickingId)->one();
                        if (count($picking_point) > 0) {
                            $picking_pointName = $picking_point->title;
                        } else {
                            $picking_pointName = '';
                        }
                        $Countries = common\models\dbworld\Countries::find()->where("countryId= '" . $picking_point->countryId . "' ")->one();
                        if (count($Countries) > 0) {
                            $CountriesName = $Countries->localName;
                        } else {
                            $CountriesName = '';
                        }
                        $States = common\models\dbworld\States::find()->where("stateId='" . $picking_point->provinceId . "'")->one();
                        if (count($States) > 0) {
                            $StateslocalName = $States->localName;
                        } else {
                            $StateslocalName = '';
                        }
                        $Cities = common\models\dbworld\Cities::find()->where("cityId='" . $picking_point->amphurId . "'")->one();
                        if (count($Cities) > 0) {
                            $CitieslocalName = $Cities->localName;
                        } else {
                            $CitieslocalName = '';
                        }
                        if ($value1->receiveType == 1) {
                            //echo 'Pickup location: ปลายทางที่ <strong><span style="color: #0286c2;">Lockers เย็น</span></strong>';
                            echo 'Pickup location : ' . $picking_pointName;
                            echo ', ' . $CountriesName;
                            echo ', ' . $StateslocalName;
                            echo ', ' . $CitieslocalName;
                        } elseif ($value1->receiveType == 2) {
                            echo 'Pickup location :  <strong><span style="color: #0286c2;">Lockers ร้อน</span></strong>';
                        } elseif ($value1->receiveType == 3) {
                            echo 'Pickup location :  <strong><span style="color: #0286c2;">Booth</span></strong>';
                        }
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
            //$GetOrder = common\models\costfit\OrderItem::find()->where('orderId=' . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'] . ' and receiveType=' . $value1->receiveType)->groupBy('orderId')->one();
            ?>
                                                                                                                                                                                                                                                                                                                        <!--<tr>
                                                                                                                                                                                                                                                                                                                            <td style="font-size: 12px;" colspan="7">
                                                                                                                                                                                                                                                                                                                                <strong>สถานที่รับของ :</strong><br>
            <?php
            /* if (isset($GetOrder->pickingId)) {
              $picking_point = common\models\costfit\PickingPoint::find()->where('pickingId=' . $GetOrder->pickingId)->one();
              $Countries = common\models\dbworld\Countries::find()->where("countryId= '" . $picking_point->countryId . "' ")->one();
              $States = common\models\dbworld\States::find()->where("stateId='" . $picking_point->provinceId . "'")->one();
              $Cities = common\models\dbworld\Cities::find()->where("cityId='" . $picking_point->amphurId . "'")->one();
              echo '<b>Pickup location :</b>' . $picking_point->title;
              echo ', <b>Country :</b>' . $Countries->localName;
              echo ', ' . $States->localName;
              echo ', ' . $Cities->localName;
              } */
            ?>
                                                                                                                                                                                                                                                                                                                            </td>
                                                                                                                                                                                                                                                                                                                        </tr>-->
            <?php
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
