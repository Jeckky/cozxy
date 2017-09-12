<?php

use common\models\costfit\Signature;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<br>
<div style="float: left;width: 28%;height: 120px; border:solid 0.5px #000000;border-radius:10px; padding-left: 20px;border-top-right-radius: 10px;border-top-left-radius: 10px;font-size: 10px;padding-bottom: 15px;margin-left: 15px;">
    สินค้าถูกต้องครบถ้วนสมบูรณ์
    <table class="table_noborder" cellpadding="0" cellspacing="0" style="margin-left: -20px;margin-top: 50px;font-size: 10px;">
        <tr>
            <td style="width: 50%;"><center><img src="<?= $baseUrl . '/' . Signature::checker() ?>" style="width: 120px;height: 35px;"></center></td>
        </tr>
        <tr>
            <td><center><br>ผู้ตรวจสินค้า / CHECKED BY</center></td>
        </tr>
    </table>

</div>
<div style="float: left;width: 28%;height: 120px; border:solid 0.5px #000000;border-radius:10px; padding-left: 20px;border-top-right-radius: 10px;border-top-left-radius: 10px;font-size: 10px;padding-bottom: 15px;margin-left: 15px;">
    ได้รับเงินถูกต้องแล้วด้วยความขอบคุณ
    <table class="table_noborder" cellpadding="0" cellspacing="0" style="margin-left: -20px;margin-top: 50px;font-size: 10px;">
        <tr>
            <td style="width: 50%;"><center><img src="<?= $baseUrl . '/' . Signature::financialSignature() ?>" style="width: 120px;height: 35px;"></center></td>
        </tr>
        <tr>
            <td><center><br>ผู้รับเงิน / RECEIVED BY</center></td>
        </tr>
    </table>

</div>
<div style="float: left;width: 28%;height: 120px; border:solid 0.5px #000000;border-radius:10px; padding-left: 20px;border-top-right-radius: 10px;border-top-left-radius: 10px;font-size: 10px;padding-bottom: 15px;margin-left: 15px;">
    ในนาม บจก. คอซซี่ดอทคอม
    <table class="table_noborder" cellpadding="0" cellspacing="0" style="margin-left: -20px;margin-top: 50px;font-size: 10px;">
        <tr>
            <td style="width: 50%;"><center><img src="<?= $baseUrl . '/' . Signature::directorSignature() ?>" style="width: 120px;height: 35px;"></center></td>
        </tr>
        <tr>
            <td><center><br>ผู้มีอำนาจลงนาม<br>AUTHORIZE SIGNATURE</center></td>

        </tr>
    </table>

</div>

<?php ?>