<?php

use yii\helpers\Html;
use common\models\costfit\User;
use common\models\costfit\ProductSuppliers;
?>
<br><br>
<div style="width: 100%;font-size: 10px;margin-top: 2px;margin-bottom: 10px;">
    <div style="width: 70%;height: 90px;border:solid 0.5px #000000;padding-left: 10px;padding-top: 3px;">
        ชื่อลูกค้า/ Customers : <b></b><br>
        ที่อยู่ / Address : <b></b><br>
        เลขประจำตัวผู้เสียภาษีอากร : <b></b>
    </div>
    <div style="width: 30%;height: 90px;border:solid 0.5px #000000;padding-left: 10px;margin-left: 500px;margin-top: -93px;padding-top: 3px;">

        เลขที่ / No : <br>
        วันที่ / Date : <b></b><br>

    </div>
</div>
<table class="table_bordered" width="100%"  cellpadding="2" cellspacing="0">
    <tr >
        <td style="text-align: center;font-size: 8pt;">ลำดับที่<br>Item</td>
        <td style="text-align: center;font-size: 8pt;">รายการ<br>Description</td>
        <td style="text-align: center;font-size: 8pt;">จำนวน<br>Value</td>
        <td style="text-align: center;font-size: 8pt;">หน่วย<br>Unit</td>
        <td style="text-align: center;font-size: 8pt;">จำนวนเงิน<br>Amount</td>
    </tr>
</table>