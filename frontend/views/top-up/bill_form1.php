<?php

use Picqer\Barcode\BarcodeGenerator;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div style="padding: 10px;border: #000 solid 1px;color: #000;">
    <div style="font-size: 8pt;">
        <b>Bill payment/ Pay-in Slip (แบบฟอร์มสำหรับการชำระเงิน)</b>
    </div>
    <div style="font-size: 8pt;text-align: right;margin-top: -5px;">

    </div>
    <div style="text-align: left;">
        <b  style="font-size: 8pt;">Deposit for Cozxy Dot Com Co., Ltd / Tax Identification Number <?= $taxId ?></b><br>
        <b  style="font-size: 7pt;">เพื่อนำเข้าบัญชี บริษัท คอซซี่ดอทคอม จำกัด/เลขที่ประจำตัวผู้เสียภาษีอากร <?= $taxId ?></b><br>
        <span style="font-size: 8pt;">5 Ram intra Sou 5 Yeak4, Anusawari, Khet Bangken, Bangkok 10220 Tel. 02-101-0689</span>
        <?php
        if (isset($allBank) && count($allBank) > 0) {
            foreach ($allBank as $bank):
                $banks = \common\models\costfit\Bank::bankArray($bank->bankId);
                ?>
                <div class="checkbox" style="margin-bottom: 1px;font-size: 8pt;">
                    <input type="checkbox">
                    <img src="<?= $baseUrl . $banks->image ?>" style="float: left;width: 20px;height: 20px;" />
                    <?= $banks->title ?>(Account number : <?= strip_tags($bank->accNo) ?>)
                </div>
                <?php
            endforeach;
        }
        ?>
    </div>
    <div style="width:180px;border: #000 solid 0.5px;margin-left: 480px;margin-top: -110px;padding: 5px;font-size: 7pt;">
        Branch:__________Date:________<br>
        Customer name : <b><?= $customerName ?></b><br>
        Number(Ref.1) : <b><?= $topUpNo ?></b><br>
        Telephone(Ref.2) :<b><?= $customerTel ?></b>
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

