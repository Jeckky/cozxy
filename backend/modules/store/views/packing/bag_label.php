<?php

use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\Product;
use common\models\costfit\Unit;
use common\models\costfit\ProductSuppliers;
use common\helpers\IntToBath;
use common\models\costfit\Address;
use common\models\costfit\User;
use common\models\costfit\ContentGroup;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$logo = ContentGroup::find()->where("lower(title)='logoimage'")->one();
?>
<html>
    <head>
        <script language="JavaScript">
            DA = (document.all) ? 1 : 0
            function HandleError()
            {
                alert("\error.");
                return true;
            }
        </script>
        <script language="JavaScript">
//            function NoDialogBox()
//                    //ใช้ปิด window โดยไม่ขึ้น confirm dialog box
//                    {
//                        //window.open('', '_self');
//                        //self.close();
//                    }
            function print_window() {
                window.print();
                setTimeout(function () {
                    window.open('', '_self', '');
                    window.close();
                }, 0);
            }

        </script>
    </head>
    <body onload="print_window();" align="center">
    <body align="center">
        <table width ="747"  cellpadding="2" cellspacing="0" style="border: 0px; text-align: center;margin-top: -5px;font-size: 10pt;">
            <tr style="height:20px;">
                <td style="text-align: right;vertical-align: top;" colspan="3">สาขาที่ออกใบกำกับภาษี : สำนักงานใหญ่</td>
            </tr>
            <tr style="height:20px;">
                <td style="text-align: right;vertical-align: top;" colspan="3"></td>
            </tr>
            <tr style="height: 100px;">
                <td style="text-align: center; vertical-align: middle;">
                    <img src="<?= $baseUrl . $logo->image ?>" alt="cozxy.com" style="width: 110px;height: 65px;">
                </td>
                <td style="padding: 5px; vertical-align: text-top; text-align: center;">
                    <h2>
                        บริษัท คอซซี่ดอทคอม จำกัด
                    </h2>
                    เลขประจำตัวผู้เสียภาษี : 0105553036789<br>
                    เลขที่ 5 ซอยรามอินทรา 5 แยก 4 แขวงอนุสาวรีย์ เขตบางเขน กรุงเทพฯ 10220<br>
                    โทรศัพท์ 02-101-0689, 064-184-7414 <br>
                </td>
                <td style="vertical-align:middle;">
                    ใบเสร็จรับเงิน/ใบกำกับภาษี/ใบส่งของ<br>
                    <span style="font-size: 8pt;"> RECEIPT / TAX INVOICE / DELIVER ORDER</span><br>
                    ต้นฉบับ<br><span style="font-size: 8pt;">ORIGINAL</span><br>
                    <img src="https://chart.googleapis.com/chart?chs=90x90&cht=qr&chl=<?= $bagNo ?>">
                </td>
            </tr>
        </table>
<!--        <table width="747"  cellpadding="3" cellspacing="0" style="font-size: 10pt;">
            <tr>
                <td style="width: 33%;border: #000 thin solid;padding: 15px;">

                    <b>วันที่</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // $fullDate                                                                                        ?>
                </td>
                <td style="width: 27%;text-align: center;"><img src="https://chart.googleapis.com/chart?chs=140x140&cht=qr&chl=<?php // $bagNo                                                                                        ?>"></td>
                <td style="width: 40%;text-align: center;"></td>

            </tr>
        </table>-->
        <table width="750"  cellpadding="3" style="margin-top: 3px;font-size: 10pt;">
            <tr>
                <td style="width: 50%;border: #000 solid thin;padding-left: 10px;">
                    <?php
                    $customer = Address::CompanyByOderId($orderId);
                    ?>
                    <b>ได้รับเงินจาก</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= Order::findReciever($orderId) ?><br>
                    <b>เลขประจำตัวผู้เสียภาษี</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= isset($billingTax) ? $billingTax : '' ?><br>
                    <b>ที่อยู่</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= User::userAddressText($customer->addressId, false) ?><br><br>
                    <b>โทรศัทท์</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $customer->tel ?>
                    <b>&nbsp;&nbsp;&nbsp;โทรสาร&nbsp;&nbsp;&nbsp;<?= $customer->fax ?></b>
                </td>
                <td style="border: #000 solid thin;padding-left: 10px;">
                    <b>เลขที่ใบกำกับ/Tax invoice no.</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BL&nbsp;<?= $date . "-" . $taxNo ?><br>
                    <b>เลขที่ใบสั่งซื้อ/Order no.</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BL&nbsp;<?= $orderNo ?><br>
                    <b>สถานที่ส่งของ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= PickingPoint::findPickingPoitItem($orderId) ?><br>
                    <b>วันที่/Date</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $fullDate ?><br>
                    <b>ชื่อผู้ติดต่อ</b>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
        </table>
        <table class="table table_bordered" width="747"  cellpadding="2" cellspacing="0" style="border: 0.5px #000 solid;margin-top: 3px;font-size: 10pt;">
            <tr style="height: 40px;">
                <th style="border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>รหัสสินค้า</center></th>
        <th style="border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>รายการ</center></th>
    <th style="border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>จำนวน</center></th>
<th style="width:30%;border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>ราคา/หน่วย</center></th>
<th colspan="2"style="border-bottom: #000 solid thin;border-bottom: #000 solid thin;"><center>จำนวนเงิน</center></th>
</tr>

<tbody>
    <?php
    $i = 1;
    $empty = 20;
    $orderItems = OrderItemPacking::findItemInBag($bagNo);
    $total = 0;

    if (isset($orderItems) && count($orderItems) > 0) {
        foreach ($orderItems as $orderItem):
            $item = Product::findProducts($orderItem->orderItemId);
            if (isset($item) && count($item) > 0) {
                echo '<tr style="height: 25px;">';
                echo '<td style="border-right: #000 solid thin;"><center>' . $item->isbn . '</center></td>';
                echo '<td style="border-right: #000 solid thin;"><center>' . $item->title . '</center></td>';
                echo '<td style="border-right: #000 solid thin;"><center>' . $orderItem->quantity . '</center></td>';
                echo '<td style="border-right: #000 solid thin;"><center>' . number_format(ProductSuppliers::productPrice($item->productSuppId), 2) . '</center></td>';
                echo '<td colspan="2" style="text-align:right">' . number_format($orderItem->quantity * ProductSuppliers::productPrice($item->productSuppId), 2) . '</td>';
                echo '</tr>';
                $total += ($orderItem->quantity * ProductSuppliers::productPrice($item->productSuppId));
                $i++;
            } else {
                echo '<tr><td colspan="4"><center>ไม่มีรายการสินค้า</center></td></tr>';
            }
        endforeach;
        for ($empty = 0; $empty < 13 - count($orderItems); $empty++)://print ช่องว่าง
            echo '<tr style="height: 25px;">';
            echo '<td style="border-right: #000 solid thin;"></td>';
            echo '<td style="border-right: #000 solid thin;"></td>';
            echo '<td style="border-right: #000 solid thin;"></td>';
            echo '<td style="border-right: #000 solid thin;"></td>';
            echo '<td colspan="2"><center></center></td>';
            echo '</tr>';
        endfor;
    } else {
        echo '<tr><td colspan="3"><center>ไม่มีรายการสินค้า</center></td></tr>';
    }
    $summary = $total - $extraDiscount;
    ?>
    <tr>
        <td rowspan="4" colspan="2" style="text-align: left;vertical-align: text-top;border-top:#000 solid thin;border-right: #000 solid thin; "><b>หมายเหตุ</b></td>
        <td colspan="2" style="border-right: #000 solid thin;border-top: #000 solid thin;"><b>&nbsp;&nbsp;ส่วนลดพิเศษ / Extra Saving</b></td>
        <td style="border-top: #000 solid thin; text-align: right;"><?= number_format($extraDiscount, 2) ?></td>
    </tr>
    <tr>
        <td colspan="2" style="border-right: #000 solid thin;border-top: #000 solid thin;"><b>&nbsp;&nbsp;ราคาสินค้าไม่รวมภาษี / sub total exclude VAT</b></td>
        <td style="border-top: #000 solid thin; text-align: right;"><?= number_format($summary * (100 / 107), 2) ?></td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td colspan="2"style="border-right: #000 solid thin;border-top:#000 solid thin;"><b>&nbsp;&nbsp;ภาษีมูลค่าเพิ่ม / VAT 7%</b></td>
        <td style="border-top:#000 solid thin;text-align: right;"><?= number_format(($summary - ($summary * (100 / 107))), 2) ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;border-top:#000 solid thin;border-right: #000 solid thin; ">(<?= IntToBath::changeToBath(number_format($total, 2)) ?>)</td>
        <td colspan="2" style = "border-right: #000 solid thin;border-top:#000 solid thin;"><b>&nbsp;&nbsp;ราคาสินค้ารวมภาษีมูลค่าเพิ่ม / Sub total include VAT</b></td>
        <td style = "border-top:#000 solid thin;text-align: right;"><?= number_format($summary, 2)
    ?></td>
    </tr>

</tbody>
</table>
<?= $this->render('signature'); ?>
<br><br><br><br><br><br><br><br><br>
<div style="width: 747px;text-align: right;">

    ใบเสร็จรับเงินฉบับนี้จะสมบูรณ์ก็ต่อเมื่อบริษัทฯ ได้รับเงินเรียบร้อยแล้ว
</div>

<!--<table width="747"  cellpadding="3" cellspacing="0" style="font-size: 10pt;border: #000 solid thin;margin-top: 1px;">
<tr>
    <td style="width: 33%;text-align: left;border-right: #000 solid thin;">ได้รับสินค้าตามรายการข้างบนไว้ถูกต้อง<br>
        ในสภาพเรียบร้อย<br><br><br>
<center>----------------------------------------<br><br>
    ลงนามและประทับตรา<br>
    วันที่_____/_____/_____
</center>
</td>
<td style="width: 33%;text-align: left;border-right: #000 solid thin;">ในนาม   สำนักงานใหญ่<br><br>
<?php
// $img = common\models\costfit\Signature::financialSignature();
?><center>
<img src="<?php // Yii::$app->homeUrl . $img                                           ?>" style="width:50px;height: 50px;"><br>
----------------------------------------<br><br>
ผู้มีอำนาจลงนาม<br>
วันที่&nbsp;&nbsp;&nbsp;<?php // $fullDate                                           ?>
</center>
</td>
<td style="width: 33%;text-align: left;">
ผู้จ่ายของ&nbsp;&nbsp;&nbsp;&nbsp;-----------------------------------<br><br>
ผู้ตรวจสอบ&nbsp;&nbsp;-----------------------------------<br><br>
ผู้ส่งของ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----------------------------------<br><br>
</td>
</tr>
</table>-->
<script language="VBScript">
    Sub
    window_onunload()
    On
    Error
    Resume
    Next
    Set
    WB = nothing
    On
    Error
    Goto
    0
    End
    Sub
    Sub
    Print()
    OLECMDID_PRINT = 6
    OLECMDEXECOPT_DONTPROMPTUSER = 2
    OLECMDEXECOPT_PROMPTUSER = 1
    On
    Error
    Resume
    Next
    If
    DA
    Then
    call
    WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, 1)
    Else
    call
    WB.IOleCommandTarget.Exec(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, "", "", "")
    End
    If
    If
    Err.Number < > 0 Then
            If
    DA
    Then
    Alert("Nothing Printed :" & err.number & " : " & err.description)
    Else
    HandleError()
    End
    If
    End
    If
    On
    Error
    Goto
    0
    End
    Sub
    If
    DA
    Then
    wbvers = "8856F961-340A-11D0-A96B-00C04FD705A2"
    Else
    wbvers = "EAB22AC3-30C1-11CF-A7EB-0000C05BAE0B"
    End
    If
    document.write
    "<object ID="
    "WB"
    " WIDTH=0 HEIGHT=0 CLASSID="
    "CLSID:"
    document.write
    wbvers & ""
    "> </object>"
</script>
</body>
</html>