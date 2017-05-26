<?php

use yii\helpers\Html;
use common\models\costfit\User;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Signature;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//throw new \yii\base\Exception(print_r($supplierId, true));
$supplier = User::supplierDetail($storeProductGroup->supplierId);
?>
<br><br><br><br>
<div style="width: 100%;font-size: 10px;">
    <div style="width: 50%;height: 90px;border:solid 0.5px #000000;-webkit-border-radius:10px;
         -moz-border-radius:10px;
         border-radius:10px;padding-left: 10px;">
        ชื่อผู้ขาย/Vendor Name : <b><?= $supplier != '' ? $supplier->firstname . " " . $supplier->lastname : '' ?></b><br>
        ที่อยู่ / Address : <b><?= $supplier != '' ? User::supplierAddressText($supplier->addressId) : '' ?></b>
    </div>
    <div style="width: 45%;height: 90px;border:solid 0.5px #000000;-webkit-border-radius:10px;
         -moz-border-radius:10px;
         border-radius:10px;padding-left: 10px;margin-left: 360px;margin-top: -90px;">
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
<table class="table" cellpadding="2" cellspacing="-2">

    <thead>
        <tr style="background-color: #cccccc;">
            <th style="font-size: 8pt;border-left: #000000 thin ridge;border-top: #000000 thin ridge;"><center>ที่</center></th>
<th style="font-size: 8pt;border-top: #000000 thin ridge;"><center>รหัส</center></th>
<th style="font-size: 8pt;border-top: #000000 thin ridge;"><center>รหัสสินค้า</center></th>
<th style="font-size: 8pt;border-top: #000000 thin ridge;"><center>รหัสสินค้าผู้ขาย</center></th>
<th style="font-size: 8pt;border-top: #000000 thin ridge;"><center>รายละเอียดสินค้า</center></th>
<th style="font-size: 8pt;border-top: #000000 thin ridge;"><center>จำนวน</center></th>
<th style="font-size: 8pt;border-top: #000000 thin ridge;"><center>หน่วย</center></th>
<th style="font-size: 8pt;border-top: #000000 thin ridge;"><center>ราคา/หน่วย</center></th>
<th style="font-size: 8pt;border-top: #000000 thin ridge;border-right: #000000 thin ridge;width:13%;"><center>มูลค่า</center></th>
</tr>
</thead>
<thead>
    <tr style="background-color: #f1f0f0;">
        <th style="font-size: 7pt;border-left: #000000 thin ridge;"><center>#</center></th>
<th style="font-size: 7pt;"><center>Code</center></th>
<th style="font-size: 7pt;"><center>Product code</center></th>
<th style="font-size: 7pt;"><center>Merchant code</center></th>
<th style="font-size: 7pt;"><center>Description</center></th>
<th style="font-size: 7pt;"><center>Quantity</center></th>
<th style="font-size: 7pt;"><center>Unit</center></th>
<th style="font-size: 7pt;"><center>Price</center></th>
<th style="font-size: 7pt;border-right: #000000 thin ridge;"><center>Amount</center></th>
</tr>
</thead>
<tbody>
    <?php
    //throw new \yii\base\Exception(print_r($orders, true));
    $items = \common\models\costfit\StoreProduct::allProductInPo($storeProductGroup->storeProductGroupId); //group Product
    $allTotal = 0;
    $i = 1;
    $empty = 20;
    if ($items != '' && !empty($items)) {
        foreach ($items as $item):
            echo '<tr>';
            echo '<td style="font-size: 8pt;height:30px;border-left: #000000 thin ridge;"><center>' . $i . '</center></td>';
            $productSupp = ProductSuppliers::productSupplierName($item->productSuppId);
            echo '<td style="font-size: 8pt;"><center>' . $productSupp->code . '</center></td>';
            echo '<td style="font-size: 8pt;"><center>' . $productSupp->suppCode . '</center></td>';
            echo '<td style="font-size: 8pt;"><center>' . $productSupp->merchantCode . '</center></td>';
            echo '<td style="font-size: 6pt;"> ' . $productSupp->title . '</td>';
            // $total = \common\models\costfit\OrderItem::totalSupplierItem($suppId, $item, $orders);
            echo '<td style="font-size: 8pt;"><center>' . $item->quantity . '</center></td>';
            $unit = \common\models\costfit\Unit::unitName($item->productSuppId);
            echo '<td style="font-size: 8pt;"><center>' . $unit . '</center></td>';
            $price = $item->marginPrice;
            echo '<td style="text-align: right;font-size: 8pt;">' . number_format($price, 2) . '</td>';
            echo '<td style="text-align: right;font-size: 8pt;border-right: #000000 thin ridge;">' . number_format($price * $item->quantity, 2) . '</td>';
            echo '</tr>';
            $i++;
            $amount = $price * $item->quantity;
            $allTotal += $amount;
        endforeach;
        for ($empty = 0; $empty < 20 - count($items); $empty++)://print ช่องว่าง
            echo '<tr>';
            echo '<td colspan="9" style="border-left: #000000 thin ridge;border-right: #000000 thin ridge;">&nbsp;&nbsp;&nbsp;</td>';
            echo '</tr>';
        endfor;
    }else {
        echo '<tr>';
        echo '<td colspan="9"style="height:30px;">ไม่มีข้อมูล</td>';
        echo '</tr>';
    }
    $vat = $allTotal * 0.07;
    ?>
    <tr>
        <td colspan="4" rowspan="3"  style="font-size: 7pt;border:#000000 thin solid;">"ทางบริษัทฯจะรับวางบิล เมื่อได้ส่งของครบตามใบสั่งซื้อ หรือมีการยกเลิกรายการเท่านั้น<br>
            พร้อมทั้งให้แนบใบสั่งซื้อทุกครั้งที่มีการวางบิล และถ้าหากมีรายการเปลี่ยนแปลงนอกเหนือจากนี้<br> กรุณาติดต่อแผนกจัดซื้อ"
        </td>
        <td colspan="2" style="background-color: #cccccc;font-size: 7pt;height: 25px;border-top:#000000 thin solid;border-right:#000000 thin solid;"><b>&nbsp;&nbsp;รวม / Sub Total</b></td>
        <td style="text-align: right;font-size: 8pt;border-top:#000000 thin solid;border-right:#000000 thin solid;"colspan="3"><?= number_format($allTotal, 2) ?></td>
    </tr>
    <tr>
        <td colspan="2" style="background-color: #cccccc;font-size: 7pt;height: 25px;border-top:#000000 thin solid;border-right:#000000 thin solid;"><b>&nbsp;&nbsp;ภาษีมูลค่าเพิ่ม / Vat (%)</b></td>

        <td style="text-align: right;font-size: 8pt;border-top:#000000 thin solid;border-right:#000000 thin solid;"colspan="3"><?= number_format($vat, 2) ?></td>
    </tr>
    <tr>
        <td colspan="2" style="background-color: #cccccc;font-size: 7pt;height: 25px;border-top:#000000 thin solid;border-right:#000000 thin solid;border-bottom:#000000 thin solid;"><b>&nbsp;&nbsp;ราคารวมทั้งสิ้น / (Total)</b></td>
        <td style="text-align: right;font-size: 8pt;border-top:#000000 thin solid;border-right:#000000 thin solid;border-bottom:#000000 thin solid;" colspan="3"><?= number_format($vat + $allTotal, 2) ?></td>
    </tr>
</tbody>
</table><br>
<div style="width: 100%;height: 120px; border:solid 0.5px #000000;border-radius:10px; padding-left: 20px;border-top-right-radius: 10px;border-top-left-radius: 10px;font-size: 10px;padding-bottom: 15px;">
    ผู้มีอำนาจลงนาม
    <table class="table_noborder" cellpadding="0" cellspacing="0" style="margin-left: -20px;margin-top: 50px;font-size: 10px;">
        <tr>
            <td style="width: 50%;"><center><img src="<?= $baseUrl . '/' . Signature::directorSignature() ?>" style="width: 120px;height: 35px;"></center></td>
        <td><center><img src="<?= $baseUrl . '/' . Signature::approveSignature(Yii::$app->user->id) ?>" style="width: 120px;height: 35px;"></center></td>
        </tr>
        <tr>
            <td><center><br>( กรรมการผู้จัดการอนุมัติ )</center></td>
        <td><center><br>( ผู้อนุมัติการสั่งซื้อ )</center></td>
        </tr>
    </table>
</div>
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

