<?php

use yii\helpers\Html;
use common\models\costfit\User;
use common\models\costfit\ProductSuppliers;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$j = 1;
//throw new \yii\base\Exception(print_r($supplierId, true));
foreach ($storeProductGroupId as $id):
    $i = 1;
    $storeProductGroup = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId=" . $id)->one();
    $supplier = User::supplierDetail($storeProductGroup->supplierId);
    ?>
    <?php
    $showText = '';
    if ($supplier != '') {
        if (($supplier->firstname != null)) {
            $showText = $supplier->firstname . " " . $supplier->lastname;
        } else {
            $showText = $supplier->company;
        }
    } else {
        $showText = 'ไม่มีข้อมูล Supplier';
    }
    ?>
    <br><br><br><br>
    <div style="width: 100%;font-size: 10px;margin-top: 2px;">
        <div style="width: 50%;height: 90px;border:solid 0.5px #000000;-webkit-border-radius:10px;
             -moz-border-radius:10px;
             border-radius:10px;padding-left: 10px;">
            ชื่อผู้ขาย/Vendor Name : <b><?= $showText ?></b><br>
            ที่อยู่ / Address : <b><?= $supplier != '' ? User::supplierAddressText($supplier->addressId) : 'ไม่มีข้อมูลที่อยู่ Supplier' ?></b>
        </div>
        <div style="width: 45%;height: 90px;border:solid 0.5px #000000;-webkit-border-radius:10px;
             -moz-border-radius:10px;
             border-radius:10px;padding-left: 10px;margin-left: 360px;margin-top: -90px;">
             <?php $po = \common\models\costfit\StoreProductGroup::genPoNo(); ?>
            เลขที่ใบสั่งซื้อ / PO No : <?= $storeProductGroup->poNo ?><br>
            วันที่ / Date : <b><?= $this->context->dateThai($storeProductGroup->createDateTime, 1) ?></b><br>
            <br>
            ระยะเวลาที่ชำระเงิน/ Credit Term : <b>30 วันนับจากวันวางบิล</b>
        </div>
    </div>
    <div style="width: 100%;font-size: 10px; margin-top: 2px;">
        <div style="width: 50%;height: 50px;border:solid 0.5px #000000;-webkit-border-radius:10px;
             -moz-border-radius:10px;
             border-radius:10px;padding-left: 10px;">
            ที่จัดส่งสินค้า :<b>บริษัท คอทซี่ ดอทคอม จำกัด</b><br>
            กำหนดส่ง : <b>.......................</b><br>
        </div>
        <div style="width: 45%; height: 50px;border:solid 0.5px #000000;-webkit-border-radius:10px;
             -moz-border-radius:10px;
             border-radius:10px;padding-left: 10px;margin-left: 360px;margin-top: -50px;">
            สถานที่วางบิล ::<b>บริษัท คอทซี่ ดอทคอม จำกัด</b><br>
        </div>
    </div>
    <div style="width: 100%;font-size: 10px; margin-top: 2px;margin-bottom: 3px;">
        <div style="width: 50%;border:solid 0.5px #000000;-webkit-border-radius:10px;
             -moz-border-radius:10px;
             border-radius:10px;padding-left: 10px;text-align: center;">
            <b>ส่งของถามรายการที่ไม่ขีดฆ่า X และระบุจำนวน</b>
        </div>
        <div style="width: 45%;border:solid 0.5px #000000;-webkit-border-radius:10px;
             -moz-border-radius:10px;
             border-radius:10px;padding-left: 10px;margin-left: 360px;margin-top: -22px;text-align: center;">
            <b>ระบุเลขที่ใบสั่งทุกครั้งในใบส่งของ</b>
        </div>
    </div>
    <table class="table_border" cellpadding="2" cellspacing="0">

        <thead>
            <tr style="background-color: #cccccc;">
                <th><center>ลำดับที่.</center></th>
    <th><center>รหัส</center></th>
    <th><center>รหัสสินค้า</center></th>
    <th><center>รหัสสินค้าผู้ขาย</center></th>
    <th><center>รายละเอียดสินค้า</center></th>
    <th><center>จำนวน</center></th>
    <th><center>หน่วย</center></th>
    <th><center>ราคา/หน่วย</center></th>
    <th><center>มูลค่า</center></th>
    </tr>
    </thead>
    <thead>
        <tr style="background-color: #f1f0f0;">
            <th><center>No.</center></th>
    <th><center>Code</center></th>
    <th><center>Product code</center></th>
    <th><center>Merchant code</center></th>
    <th><center>Description</center></th>
    <th><center>Quantity</center></th>
    <th><center>Unit</center></th>
    <th><center>Price</center></th>
    <th><center>Amount</center></th>
    </tr>
    </thead>
    <tbody>
        <?php
        //throw new \yii\base\Exception(print_r($orders, true));
        $items = \common\models\costfit\StoreProduct::allProductInPo($id); //group Product
        $allTotal = 0;
        if ($items != '' && !empty($items)) {
            foreach ($items as $item):
                echo '<tr>';
                echo '<td><center>' . $i . '</center></td>';
                $productSupp = ProductSuppliers::productSupplierName($item->productSuppId);
                echo '<td><center>' . $productSupp->code . '</center></td>';
                echo '<td><center>' . $productSupp->suppCode . '</center></td>';
                echo '<td><center>' . $productSupp->merchantCode . '</center></td>';
                echo '<td> ' . $productSupp->title . '</td>';
                // $total = \common\models\costfit\OrderItem::totalSupplierItem($suppId, $item, $orders);
                echo '<td><center>' . $item->quantity . '</center></td>';
                $unit = \common\models\costfit\Unit::unitName($item->productSuppId);
                echo '<td><center>' . $unit . '</center></td>';
                $price = $item->marginPrice;
                echo '<td style="text-align: right;">' . $price . '</td>';
                echo '<td style="text-align: right;">' . number_format($price * $item->quantity, 2) . '</td>';
                echo '</tr>';
                $i++;
                $amount = $price * $item->quantity;
                $allTotal += $amount;
            endforeach;
        }else {
            echo '<tr>';
            echo '<td colspan="7">ไม่มีข้อมูล</td>';
            echo '</tr>';
        }
        $vat = $allTotal * 0.07;
        ?>
        <tr>
            <td colspan="4" rowspan="3">"ทางบริษัทฯจะรับวางบิล เมื่อได้ส่งของครบตามใบสั่งซื้อ หรือมีการยกเลิกรายการเท่านั้น<br>
                พร้อมทั้งให้แนบใบสั่งซื้อทุกครั้งที่มีการวางบิล และถ้าหากมีรายการเปลี่ยนแปลงนอกเหนือจากนี้<br> กรุณาติดต่อแผนกจัดซื้อ"
            </td>
            <td colspan="2" style="background-color: #cccccc;"><b>รวม / Sub Total</b></td>
            <td style="text-align: right;" colspan="3"><?= number_format($allTotal, 2) ?></td>
        </tr>
        <tr>
            <td colspan="2" style="background-color: #cccccc;"><b>ภาษีมูลค่าเพิ่ม / Vat (%)</b></td>

            <td style="text-align: right;" colspan="3"><?= number_format($vat, 2) ?></td>
        </tr>
        <tr>
            <td colspan="2" style="background-color: #cccccc;"><b>ราคารวมทั้งสิ้น / (Total)</b></td>
            <td style="text-align: right;" colspan="3"><?= number_format($vat + $allTotal, 2) ?></td>
        </tr>
    </tbody>
    </table>
    <!--    <div style="width: 100%;height: 80px; border:solid 0.5px #000000;border-radius:10px; padding-left: 20px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;font-size: 10px;">
            Description:
        </div>
        <div style="width: 100%;height: 120px; border:solid 0.5px #000000;border-radius:10px; padding-left: 20px;border-top-right-radius: 0px;border-top-left-radius: 0px;font-size: 10px;">
            ผู้มีอำนาจลงนาม
            <table class="table_noborder" cellpadding="0" cellspacing="0" style="margin-left: -20px;margin-top: 60px;font-size: 10px;">
                <tr>
                    <td><center>......................................</center></td>
                <td><center>......................................</center></td>
                <td><center>......................................</center></td>
                <td><center>......................................</center></td>
                </tr>
                <tr>
                    <td><center>กรรมการผู้จัดการอนุมัติ</center></td>
                <td><center>ผู้จัดการฝ่าย</center></td>
                <td><center>งบประมาณบัญชี</center></td>
                <td><center>เจ้าหน้าที่จัดซื้อ</center></td>
                </tr>
            </table>
        </div>-->
    <?php if ($j < count($storeProductGroupId)) {
        ?>
        <pagebreak />
        <?php
    }
    $j++;
endforeach;
?>
<!--    <br><br><br><br><br>
    <table class="table table_bordered" width="100%"  cellpadding="3" cellspacing="0">
        <tr>
            <td colspan="4"><h4>Order No : <?//= $order->orderNo ?></h4></td>
            <td style="text-align: right; vertical-align: text-top;"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?//= $order->orderNo ?>"></td>
        </tr>
        <thead>
            <tr>
                <th><center>No.</center></th>
    <th><center>Item</center></th>
    <th><center>Quantity</center></th>
    <th><center>Unit</center></th>
    <th><center>Send Date</center></th>
    </tr>
    </thead>
    <tbody>-->
<?php
//        $items = \common\models\costfit\Order::orderItems($order->orderId);
//        foreach ($items as $item):
//            echo '<tr>';
//            echo '<td><center>' . $i . '</center></td>';
//            echo '<td><center>' . common\models\costfit\Product::findProductName($item->productId) . '</center></td>';
//            echo '<td style="text-align: right;">' . $item->quantity . '</td>';
//            echo '<td><center>' . common\models\costfit\Product::findUnit($item->productId) . '</center></td>';
//            echo '<td><center>' . substr($item->sendDateTime, 0, 10) . '</center></td>';
//            echo '</tr>';
//            $i++;
//        endforeach;
?>
<!--</tbody>
</table>-->
<?php
// throw new \yii\base\Exception(count($orders));
//    if ($j < count($orders)) {
//
?>
    <!--<pagebreak />-->
<?php
//    }
//    $j++;
//}
?>

