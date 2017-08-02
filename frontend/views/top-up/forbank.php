<?php

use Picqer\Barcode\BarcodeGenerator;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

for ($i = 1; $i < 3; $i++):
    ?>

    <div style="padding-top: 1cm;padding-left: 0.5cm;padding-right: 0.5cm;border: #000 solid 1px;color: #000;">
        <div style="font-size: 15pt;">
            <b>Bill payment/ Pay-in Slip (แบบฟอร์มสำหรับการชำระเงิน)</b>
        </div>
        <div style="font-size: 13pt;text-align: right;margin-top: -25px;">
            <?= $i == 1 ? 'ส่วนที่ 1 สำหรับธนาคาร' : 'ส่วนที่ 2 สำหรับลูกค้า' ?>
        </div>
        <div style="text-align: left;">
            <b  style="font-size: 15pt;">Deposit for Cozxy Dot Com Co., Ltd / Tax Identification Number <?= $taxId ?></b><br>
            <b  style="font-size: 14pt;">เพื่อนำเข้าบัญชี บริษัท คอซซี่ดอทคอม จำกัด/เลขที่ประจำตัวผู้เสียภาษีอากร <?= $taxId ?></b><br>
            <span style="font-size: 14pt;">5 Ram intra Sou 5 Yeak4, Anusawari, Khet Bangken, Bangkok 10220 Tel. 02-101-0689</span>
            <?php
            if (isset($allBank) && count($allBank) > 0) {
                foreach ($allBank as $bank):
                    ?>
                    <div class="checkbox" style="margin-bottom: 1px;font-size: 12pt;margin-left: 20px;">
                        <input type="checkbox" disabled="true">
                        <img src="<?= $baseUrl . $bank->image ?>" style="width: 20px;height: 20px;" />
                        <?= $bank->title ?>&nbsp; (<?= $bank->description ?>)
                    </div>
                    <?php
                endforeach;
            }
            ?>
        </div>
        <div style="width:30%;border: #000 solid 0.5px;margin-left: 440px;margin-top: -140px;padding: 5px;font-size: 13pt;" class="pull-right">
            Branch:___________Date:___________<br>
            Customer name : <b><?= $customerName ?></b><br>
            Number(Ref.1) : <b><?= $topUpNo ?></b><br>
            Telephone(Ref.2) :<b>0655366262</b>
        </div>
        <div class="row" style="margin-top: 10px;">

            <div  style="border: #cccccc solid 0.5px;height: 80px;width: 20%;font-size: 12pt;text-align: center;padding-top:20px;" class="col-lg-3">
                เงินสด
            </div>
            <div style="border: #cccccc solid 0.5px;height: 80px;width: 55%;font-size: 12pt;text-align: center;" class="col-lg-6">
                <b> <?= \common\helpers\IntToBath::changeToBath(number_format($amount, 2)) ?></b><hr style="size: 1pt;margin-bottom: 3px;margin-top: 13px;">
                จำนวนเงินเป็นตัวอักษร
            </div>
            <div  style="border: #cccccc solid 0.5px;width: 25%;height: 80px;font-size: 12pt;text-align: center;" class="col-lg-3">
                <b><?= number_format($amount, 2) ?></b><hr style="size: 1pt;margin-bottom: 3px;margin-top: 13px;">
                จำนวนเงิน(บาท)
            </div>
        </div>
        <div style="margin-top: 0px;">
            <img src="<?= $baseUrl . '/images/ContentGroup/zWnWm6Z1PY.png' ?>" style="width: 70px;height: 50px;" />
        </div>
        <div style="padding: 10px;text-align: right;font-size: 13pt;margin-top: -20px;">
            ชื่อผู้นำฝาก/Desposit by_______________________โทร/Tel_____________________เจ้าหน้าที่ธนาคาร_________________________
            <div style="margin-top: 0.6cm; font-size: 12pt;margin-bottom: 10px">
                <?php
                $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barCode, $generator::TYPE_CODE_128)) . '" style="width:300px;height:1cm;">';
                ?><br>
                <span style="text-align: right;"> <?= $data ?></span>
            </div>
        </div>
    </div>
    <?php if ($i == 1) { ?>
        <div style="margin-bottom: 1.8cm;margin-top:20px;font-size: 20px;">
            กรุณาตัดตามรอยประ  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        </div>
    <?php }
    ?>
<?php endfor; ?>