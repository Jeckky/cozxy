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

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
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
            <tr style="height: 100px;">
                <td style="text-align: center; vertical-align: middle;">
                    <img src="<?= Yii::$app->homeUrl ?>images/logo/cozxy.png" alt="cozxy.com" style="width: 110px;height: 65px;">
                </td>
                <td style="padding: 5px; vertical-align: text-top; text-align: center;">
                    <h2>
                        บริษัท คอซซี่ดอทคอม จำกัด
                    </h2>
                    เลขที่ 5 ซอยรามอินทรา 5 แยก 4 แขวงอนุสาวรีย์ กรุงเทพฯ 10220<br>
                    โทร 02-101-0689 เลขประจำตัวผู้เสียภาษี   0105553036789 <br>
                </td>
                <td style="vertical-align:middle;">
                    <img src="https://chart.googleapis.com/chart?chs=140x140&cht=qr&chl=<?= $bagNo ?>">
                </td>
            </tr>
        </table>
        <table width="747"  cellpadding="3" cellspacing="0" style="font-size: 10pt;">
            <tr>
                <td style="width: 33%;text-align: center;"><h2> </h2></td>
                <td style="width: 34%;text-align: center;"><h2>ใบกำกับภาษี</h2></td>
                <td style="width: 33%;border: #000 thin solid;padding: 15px;">
                    <b>เลขที่</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BL&nbsp;<?= $date . "-" . $taxNo ?><br><br>
                    <b>วันที่</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $fullDate ?>
                </td>
            </tr>
        </table>
        <table width="750"  cellpadding="3" style="margin-top: 3px;font-size: 10pt;">
            <tr>
                <td style="width: 50%;border: #000 solid thin;padding-left: 10px;">
                    <?php
                    $customer = Address::CompanyByOderId($orderId);
                    ?>
                    <b>รหัสลูกค้า</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $customer->tax != null ? $customer->tax : '' ?><br>
                    <b>นามผู้ซื้อ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= Order::findReciever($orderId) ?><br>
                    <b>ที่อยู่</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= User::userAddressText($customer->addressId, false) ?><br><br>
                    <b>โทร</b>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $customer->tel ?>
                    <b>&nbsp;&nbsp;&nbsp;โทรสาร&nbsp;&nbsp;&nbsp;<?= $customer->fax ?></b>
                </td>
                <td style="border: #000 solid thin;padding-left: 10px;">
                    <b>เลขประจำตัวผู้เสียภาษี</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0105553036789 <b>&nbsp;&nbsp;&nbsp;&nbsp;สาขา&nbsp;&nbsp;&nbsp;&nbsp;</b>00000<br>
                    <b>เลขที่ใบกำกับ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BL&nbsp;<?= $date . "-" . $taxNo ?><br>
                    <b>สถานที่ส่งของ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= PickingPoint::findPickingPoitItem($orderId) ?><br><br>
                    <b>ชื่อผู้ติดต่อ</b>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
        </table>
        <table class="table table_bordered" width="747"  cellpadding="2" cellspacing="0" style="border: 0.5px #000 solid;margin-top: 3px;font-size: 10pt;">
            <tr style="height: 40px;">
                <th style="border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>รหัสสินค้า</center></th>
        <th style="border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>รายการ</center></th>
    <th style="border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>จำนวน</center></th>
<th style="border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>หน่วย</center></th>
<th style="border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>ราคา/หน่วย</center></th>
<th style="border-right: #000 solid thin;border-bottom: #000 solid thin;"><center>ส่วนลด</center></th>
<th style="border-bottom: #000 solid thin;border-bottom: #000 solid thin;"><center>จำนวนเงิน</center></th>
</tr>

<tbody>
    <?php
    $i = 1;
    $empty = 20;
    $orderItems = OrderItemPacking::findItemInBag($bagNo);
    $total = 0;
    if (isset($orderItems) && !empty($orderItems)) {
        foreach ($orderItems as $orderItem):
            $item = Product::findProducts($orderItem->orderItemId);
            if (isset($item) && !empty($item)) {
                echo '<tr style="height: 25px;">';
                echo '<td style="border-right: #000 solid thin;"><center>' . $item->code . '</center></td>';
                echo '<td style="border-right: #000 solid thin;"><center>' . $item->title . '</center></td>';
                echo '<td style="border-right: #000 solid thin;"><center>' . $orderItem->quantity . '</center></td>';
                echo '<td style="border-right: #000 solid thin;"><center>' . Unit::unitName($item->productSuppId) . '</center></td>';
                echo '<td style="border-right: #000 solid thin;"><center>' . number_format(ProductSuppliers::productPrice($item->productSuppId), 2) . '</center></td>';
                echo '<td style="border-right: #000 solid thin;"><center></center></td>';
                echo '<td style="text-align:right">' . number_format($orderItem->quantity * ProductSuppliers::productPrice($item->productSuppId), 2) . '</td>';
                echo '</tr>';
                $total += ProductSuppliers::productPrice($item->productSuppId);
                for ($empty = 0; $empty < 10 - count($orderItem); $empty++)://print ช่องว่าง
                    echo '<tr style="height: 25px;">';
                    echo '<td style="border-right: #000 solid thin;"></td>';
                    echo '<td style="border-right: #000 solid thin;"></td>';
                    echo '<td style="border-right: #000 solid thin;"></td>';
                    echo '<td style="border-right: #000 solid thin;"></td>';
                    echo '<td style="border-right: #000 solid thin;"></td>';
                    echo '<td style="border-right: #000 solid thin;"></td>';
                    echo '<td><center></center></td>';
                    echo '</tr>';
                endfor;
                $i++;
            } else {
                echo '<tr><td colspan="4"><center>ไม่มีรายการสินค้า</center></td></tr>';
            }
        endforeach;
    } else {
        echo '<tr><td colspan="3"><center>ไม่มีรายการสินค้า</center></td></tr>';
    }
    ?>
    <tr>
        <td rowspan="3" colspan="4" style="text-align: left;border-top:#000 solid thin;border-right: #000 solid thin; "><b>หมายเหตุ</b></td>
        <td colspan="2" style="border-right: #000 solid thin;border-top: #000 solid thin;"><b>&nbsp;&nbsp;รวมเงิน</b></td>
        <td style="border-top: #000 solid thin; text-align: right;"><?= number_format(($total - ($total * 0.07)), 2) ?></td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td colspan="2" style="border-right: #000 solid thin;border-top:#000 solid thin;"><b>&nbsp;&nbsp;ภาษีมูลค่าเพิ่ม 7%</b></td>
        <td style="border-top:#000 solid thin;text-align: right;"><?= number_format($total * 0.07, 2) ?></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;border-top:#000 solid thin;border-right: #000 solid thin; ">(<?= IntToBath::changeToBath(number_format($total, 2)) ?>)</td>
        <td colspan = "2"style = "border-right: #000 solid thin;border-top:#000 solid thin;"><b>&nbsp;&nbsp;รวมทั้งสิ้น</b></td>
        <td style = "border-top:#000 solid thin;text-align: right;"><?= number_format($total, 2)
    ?></td>
    </tr>
    <tr style="height: 30px;">
        <td colspan="7" style="text-align: left;border-top:#000 solid thin;">
            สินค้าตามใบส่งของนี้ แม้จะได้ส่งมอบแก่ผู้ซื้อแล้วยังคงเป็นทรัพย์สินของผู้ขาย จนกว่าผู้ซื้อได้ชำระเงินเสร็จเรียบร้อยแล้ว
        </td>
    </tr>
</tbody>
</table>
<table width="747"  cellpadding="3" cellspacing="0" style="font-size: 10pt;border: #000 solid thin;margin-top: 1px;">
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
    $img = common\models\costfit\Signature::financialSignature();
    ?><center>
    <img src="<?= Yii::$app->homeUrl . $img ?>" style="width:50px;height: 50px;"><br>
    ----------------------------------------<br><br>
    ผู้มีอำนาจลงนาม<br>
    วันที่_____/_____/_____
</center>
</td>
<td style="width: 33%;text-align: left;">
    ผู้จ่ายของ&nbsp;&nbsp;&nbsp;&nbsp;-----------------------------------<br><br>
    ผู้ตรวจสอบ&nbsp;&nbsp;-----------------------------------<br><br>
    ผู้ส่งของ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----------------------------------<br><br>
</td>
</tr>
</table>
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