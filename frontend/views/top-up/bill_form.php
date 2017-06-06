<?php

use Picqer\Barcode\BarcodeGenerator;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
for ($i = 1; $i < 3; $i++):
    ?>

    <div style="padding-top: 1cm;padding-left: 0.5cm;padding-right: 0.5cm;border: #000 solid 1px;color: #000;">
        <div style="font-size: 8pt;">
            <b>Bill payment/ Pay-in Slip (แบบฟอร์มสำหรับการชำระเงิน)</b>
        </div>
        <div style="font-size: 8pt;text-align: right;margin-top: -25px;">
            <?= $i == 1 ? 'ส่วนที่ 1 สำหรับธนาคาร' : 'ส่วนที่ 2 สำหรับลูกค้า' ?>
        </div>
        <div style="text-align: left;">
            <b  style="font-size: 8pt;">Deposit for Cozxy Dot Com Co., Ltd / Tax Identification Number <?= $taxId ?></b><br>
            <b  style="font-size: 7pt;">เพื่อนำเข้าบัญชี บริษัท คอซซี่ดอทคอม จำกัด/เลขที่ประจำตัวผู้เสียภาษีอากร <?= $taxId ?></b><br>
            <span style="font-size: 7pt;">5 Ram intra Sou 5 Yeak4, Anusawari, Khet Bangken, Bangkok 10220 Tel. 02-101-0689</span>
            <div class="checkbox" style="margin-bottom: 1px;font-size: 7pt;">
                <input type="checkbox">
                <img src="<?= $baseUrl . '/images/Bank/5LlgcfoBI7.png' ?>" style="float: left;width: 20px;height: 20px;" />
                ธนาคารกรุงศรีอยุธยา จำกัด(มหาชน)(CompCode : 90525 ชื่อบัญชี บริษัท คอซซี่ดอทคอม)
            </div>
            <div class="checkbox" style="margin-bottom: 1px;font-size: 7pt;">
                <input type="checkbox">
                <img src="<?= $baseUrl . '/images/Bank/BBL.png' ?>" style="float: left;width: 20px;height: 20px;">
                ธนาคารกรุงเทพ (CompCode : 27900 ชื่อบัญชี บริษัท คอซซี่ดอทคอม)
            </div>
            <div class="checkbox" style="margin-bottom: 1px;font-size: 7pt;">
                <input type="checkbox">
                <img src="<?= $baseUrl . '/images/Bank/TMB.png' ?>" style="float: left;width: 20px;height: 20px;">
                ธนาคารทหารไทย จำกัด(มหาชน)(CompCode : 2710 ชื่อบัญชี บริษัท คอซซี่ดอทคอม)
            </div>
            <div class="checkbox" style="margin-bottom: 1px;font-size: 7pt;">
                <input type="checkbox">
                <img src="<?= $baseUrl . '/images/Bank/scb.png' ?>" style="float: left;width: 20px;height: 20px;">
                ธนาคารไทยพาณิชย์ (เลขที่บัญชีกระแสรายวัน  076-3-03904-7 Bill Payment)
            </div>
            <div class="checkbox" style="margin-bottom: 1px;font-size: 7pt;">
                <input type="checkbox">
                <img src="<?= $baseUrl . '/images/Bank/kbang.png' ?>" style="float: left;width: 20px;height: 20px;">
                ธนาคารกสิกรไทย (เลขที่บัญชี  0198405094 ชื่อบัญชี บริษัท คอซซี่ดอทคอม)
            </div>
        </div>
        <div style="width:180px;border: #000 solid 0.5px;margin-left: 440px;margin-top: -140px;padding: 5px;font-size: 7pt;">
            Branch:___________Date:___________<br>
            Customer name : <b><?= $customerName ?></b><br>
            Number(Ref.1) : <b><?= $topUpNo ?></b><br>
            Telephone(Ref.2) :<b>0655366262</b>
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
        <div style="margin-top: 0px;">
            <img src="<?= $baseUrl . '/images/ContentGroup/zWnWm6Z1PY.png' ?>" style="float: left;width: 70px;height: 50px;" />
        </div>
        <div style="height: 80px;padding: 10px;text-align: right;font-size: 7pt;margin-top: -40px;">
            ชื่อผู้นำฝาก/Desposit by_______________________โทร/Tel_____________________เจ้าหน้าที่ธนาคาร_________________________
            <div style="margin-top: 0.6cm; font-size: 7pt;margin-bottom: 0.5cm">
                <?php
                $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barCode, $generator::TYPE_CODE_128)) . '" style="width:300px;height:1cm;">';
                ?>
                <center> <?= $data ?></center>
            </div>
        </div>
    </div>
    <?php if ($i == 1) { ?>
        <div style="margin-bottom: 1.8cm;margin-top: 0.3cm;">
            กรุณาตัดตามรอยประ  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        </div>
    <?php }
    ?>
<?php endfor; ?>