<?php

use Picqer\Barcode\BarcodeGenerator;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div style="padding: 10px;border: #000 solid 1px;color: #000;">
    <div style="font-size: 8pt;">
        <b>แบบฟอร์มสำหรับชำระเงิน (Bill Payment / Pay-inSlip)</b>
    </div>
    <div style="font-size: 8pt;text-align: right;margin-top: -5px;">

    </div>
    <div style="text-align: left;">
        <b  style="font-size: 8pt;">เพื่อนำเข้าบัญชี บริษัท คอซซี่ดอทคอม จำกัด / เลขประจำตัวผู้เสียภาษี <?= $taxId ?></b><br>
        <span style="font-size: 7pt;">สำนักงานใหญ่ เลขที่ 5 ซอยรามอินทรา 5 แยก 4 แขวงอนุสาวรีย์ เขตบางเขน กรุงเทพมหานคร 10220 โทร. 02-101-0689</span>
        <?php
        if (isset($allBank) && count($allBank) > 0) {
            foreach ($allBank as $bank):
                $banks = \common\models\costfit\Bank::bankArray($bank->bankId);
                ?>
                <div class="checkbox" style="margin-bottom: 1px;font-size: 8pt;">
                    <input type="checkbox">
                    <img src="<?= $baseUrl . $banks->image ?>" style="float: left;width: 20px;height: 20px;" />
                    <?= $banks->title ?>(เลขที่บัญชี : <?= strip_tags($bank->accNo) ?>)
                </div>
                <?php
            endforeach;
        }
        ?>
    </div>
    <div style="width:180px;border: #000 solid 0.5px;margin-left: 480px;margin-top: -110px;padding: 5px;font-size: 7pt;">
        สาขา_____________วันที่____________<br>
        ชื่อลูกค้า : <b><?= $customerName ?></b><br>
        เลขที่สั่งซื้อ(Ref.1) : <b><?= $topUpNo ?></b><br>
        เบอร์โทรศัพท์(Ref.2) :<b><?= $customerTel ?></b>
    </div>
    <div  style="border: #cccccc solid 0.5px;height: 45px;width: 80px;font-size: 7pt;margin-top: 50px;text-align: center;padding-top:20px;">
        เงินสด
    </div>
    <div style="border: #cccccc solid 0.5px;height: 65px;width: 450px;font-size: 7pt;margin-left: 81px;margin-top: -65px;text-align: center;">
        <b> <?= \common\helpers\IntToBath::changeToBath(number_format($amount, 2)) ?></b><hr style="size: 1pt;">
        จำนวนเงินเป็นตัวอักษร
    </div>
    <div  style="border: #cccccc solid 0.5px;width: 200px;height: 65px;font-size: 7pt;margin-left: 532px;margin-top: -65px;text-align: center;">
        <b><?= number_format($amount, 2) ?></b><hr style="size: 1pt;">
        จำนวนเงิน(บาท)
    </div>

</div><br>

