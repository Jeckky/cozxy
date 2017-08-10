<?php

use yii\helpers\Html;
use common\models\costfit\User;
use common\models\costfit\ProductSuppliers;
?>
<br><br>
<div style="width: 100%;font-size: 10px;margin-top: 2px;margin-bottom: 10px;">
    <div style="width: 70%;height: 90px;border:solid 0.5px #000000;padding-left: 10px;padding-top: 3px;">
        Customer Name: <b><?= $customerName ?></b><br>
        Address : <b><?= $address ?></b><br>
        Tax Identification Number : <b></b>
    </div>
    <div style="width: 30%;height: 90px;border:solid 0.5px #000000;padding-left: 10px;margin-left: 500px;margin-top: -93px;padding-top: 3px;">

        เลขที่ / No : <b><?= $topUpNo ?></b>
        <br>
        วันที่ / Date : <b><?= $date ?></b><br>

    </div>
</div>
<table class="table_bordered" width="100%"  cellpadding="2" cellspacing="0">
    <tr>
        <td style="text-align: center;font-size: 8pt;width: 10%">#<br>Item</td>
        <td style="text-align: center;font-size: 8pt;width: 50%">รายการ<br>Description</td>
        <td style="text-align: center;font-size: 8pt;">จำนวน<br>Value</td>
        <td style="text-align: center;font-size: 8pt;width: 10%">หน่วย<br>Unit</td>
        <td style="text-align: center;font-size: 8pt;">จำนวนเงิน<br>Amount</td>
    </tr>
    <tr>
        <td style="text-align: center;vertical-align: text-top;padding-top: 10px;font-size: 7pt;height: 300px;">1</td>
        <td style="text-align: left;vertical-align: text-top;padding-top: 10px;font-size: 7pt;padding-left: 10px;">Buy point</td>
        <td style="text-align: center;vertical-align: text-top;padding-top: 10px;font-size: 7pt;"><?= $point ?></td>
        <td style="text-align: center;vertical-align: text-top;padding-top: 10px;font-size: 7pt;">1</td>
        <td style="text-align: right;vertical-align: text-top;padding-top: 10px;font-size: 7pt;padding-right: 5px;"><?= number_format($amount, 2) ?></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size: 7pt;padding-top: 10px;padding-left: 10px;padding-bottom: 10px;">
            รายการรับชำระเงิน
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?= $method == 1 ? 'checked="true"' : '' ?>> Bill Payment
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?= $method == 2 ? 'checked="true"' : '' ?>> Credit Card<br><br>

        </td>
        <td colspan="2" style="font-size: 8pt;text-align: center;background-color: #cccccc;vertical-align: middle;"><b>รวมเงิน/Total</b></td>
        <td style="font-size: 7pt;text-align: right;padding-right: 5px;padding-top: 10px;"><?= number_format($amount, 2) ?></td>
    </tr>
    <tr>
        <td style="font-size: 8pt;text-align: center;height: 30px;">ตัวอักษร</td>
        <td colspan="4" style="font-size: 8pt;text-align: center;border-color: #000000;">( <?= $textBath ?> )</td>
    </tr>
</table>