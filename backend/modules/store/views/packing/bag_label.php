<?php

use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\Product;

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
//                        window.open('', '_self');
//                        self.close();
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
        <!--<body onLoad="window.print();NoDialogBox();">-->
        <table width ="750"  cellpadding="2" cellspacing="0" style="border: 0px; text-align: center;">
            <tr style="height: 160px;">
                <td colspan="2" style="text-align: left; vertical-align: text-top;border: 0.5px slategray solid;border-right: 0px;">
                    <img src="<?php echo $baseUrl; ?>/images/logo/costfit.png" alt="Cost Fit" width="93" height="48">
                </td>
                <td colspan="3" style="padding: 5px; vertical-align: text-top; text-align: center;border: 0.5px slategray solid;border-right: 0px;">
                    <h2>
                        บริษัท เอเทค เอ็นเตอร์ไพรส์ จำกัด
                    </h2>
                    เลขประจำตัวผู้เสียภาษี : 0105546109903 <br>
                    สำนักงานใหญ่ เลขที่ 1 ซ.ลาดพร้าว 19 ถ.ลาดพร้าว <br>แขวงจอมพล เขตจตุจักร จังหวัดกรุงเทพมหานคร 10900
                </td>
                <td colspan="2" style="vertical-align: text-top; text-align: right; border: 0.5px slategray solid;">
            <?php //echo $title;         ?><br><br><center> ใบส่งสินค้า</center>
        </td>
    </tr>
</table>
<table width="750"  cellpadding="3" cellspacing="0" style="border: 0.5px slategray solid;border-bottom: 0px;border-top: 0px;">
    <tr>
        <td><h3></h3></td><td style="text-align: right;" rowspan="3"><img src="https://chart.googleapis.com/chart?chs=140x140&cht=qr&chl=<?= $bagNo ?>"></td>
    </tr>
    <tr>
        <td colspan="2"><h4>ชื่อ - นามสกุล ผู้รับ : <?= Order::findReciever($orderId) ?></h4></td>
    </tr><tr>
        <td colspan="2"><h4>สถานที่ส่ง : <?= PickingPoint::findPickingPoitItem($orderId) ?></h4></td>
    </tr>
</table>
<table class="table table_bordered" width="750"  cellpadding="2" cellspacing="0" style="border: 0.5px slategray solid;">
    <tr style="height: 50px;">
        <td colspan="3" style="border-bottom: 0.5px slategray solid;"><center><b>สินค้า</b></center></td>
</tr>
<tr style="height: 50px;">

    <th ><center>No.</center></th>
<th><center>สินค้า</center></th>
<th><center>จำนวน</center></th>
</tr>
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
