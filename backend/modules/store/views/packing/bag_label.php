<?php

use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\Product;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=TIS-620">
        <title>Print Bag Label</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body align="center">
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
<?php
$content = file_get_contents("https://chart.googleapis.com/chart?chs=140x140&cht=qr&chl=" . $bagNo);
$fp = fopen(Yii::$app->getBasePath() . '\web\images\order-qr\\' . $bagNo . '.bmp', "w+");
fwrite($fp, $content);
fclose($fp);
?>
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
<th><center>จำนวน<img src="<?= Yii::$app->getBasePath() . '\web\images\order-qr\\' . $bagNo . '.bmp' ?>"></center></th>
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
<?php
$i = 1;
$j = 50;
$defultX = 300;
$defultY = 300;
//$printer = "\\\\192.168.100.18\\Ricoh CENTER";
$printer = "PDFCreator";
$handle = printer_open($printer);
printer_start_doc($handle, "My Document");
printer_start_page($handle);
$font = printer_create_font("AngsanaUPC", 250, 70, PRINTER_FW_BOLD, false, false, false, 0);
printer_select_font($handle, $font);
printer_draw_line($handle, $defultX, $defultY, 4600, 300);
printer_draw_line($handle, 300, 300, 300, 1200); //แกน x 1
printer_draw_bmp($handle, Yii::$app->getBasePath() . '\web\images\logo\costfit.bmp', 400, 400, 700, 700);
printer_draw_line($handle, 1200, 300, 1200, 1200); //แกน x2
printer_draw_text($handle, "COZXY.COM", 1800, 400); // x,y
printer_delete_font($font);


$font = printer_create_font("AngsanaUPC", 150, 55, PRINTER_FW_MEDIUM, false, false, false, 0);
printer_select_font($handle, $font);
printer_draw_text($handle, iconv("UTF-8", "tis-620", "ใบส่งสินค้า"), 3800, 700);
printer_draw_line($handle, 3600, 300, 3600, 1200);
printer_draw_line($handle, 4600, 300, 4600, 1200); //แกน x3
printer_draw_line($handle, 300, 1200, 4600, 1200);
printer_delete_font($font);
////////////////////////////////////////////////////////////// END HEADER /////////////////////////////////////////////////

$font = printer_create_font("AngsanaUPC", 150, 50, PRINTER_FW_MEDIUM, false, false, false, 0);
printer_select_font($handle, $font);
printer_draw_line($handle, 300, 1200, 300, 2000);
printer_draw_text($handle, iconv("UTF-8", "tis-620", "ชื่อ - นามสกุลผู้รับ :"), 400, 1400);
printer_draw_text($handle, iconv("UTF-8", "tis-620", Order::findReciever($orderId)), 1450, 1400);
printer_draw_text($handle, iconv("UTF-8", "tis-620", "สถานที่ส่ง :"), 400, 1600);
printer_draw_text($handle, iconv("UTF-8", "tis-620", PickingPoint::findPickingPoitItem($orderId)), 1150, 1600);
printer_draw_line($handle, 3600, 1200, 3600, 2000);
printer_draw_bmp($handle, Yii::$app->getBasePath() . '\web\images\order-qr\\' . $bagNo . '.bmp', 3700, 1250, 800, 800);
printer_draw_line($handle, 4600, 1200, 4600, 2000);
printer_draw_line($handle, 300, 2000, 4600, 2000);
/////////////////////////////////////////////////////////// END USER DETAIL ///////////////////////////////////////////////////

$pen = printer_create_pen(PRINTER_PEN_SOLID, 30, "000000");
printer_select_pen($handle, $pen);
printer_delete_pen($pen);
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);
?>
</body>
</html>