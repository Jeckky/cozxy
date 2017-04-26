<?php

use Picqer\Barcode\BarcodeGenerator;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
for ($i = 1; $i < 3; $i++):
    ?>

    <div style="padding: 10px;border: #000 solid 1px;color: #000;">
        <div style="font-size: 8pt;">
            <b>แบบฟอร์มสำหรับชำระเงิน (Bill Payment / Pay-inSlip)</b>
        </div>
        <div style="font-size: 8pt;text-align: right;margin-top: -25px;">
            <?= $i == 1 ? 'ส่วนที่ 1 สำหรับธนาคาร' : 'ส่วนที่ 2 สำหรับลูกค้า' ?>
        </div>
        <div style="text-align: left;">
            <b  style="font-size: 8pt;">เพื่อนำเข้าบัญชี บริษัท คอซซี่ดอทคอม จำกัด / เลขประจำตัวผู้เสียภาษี <?= $taxId ?></b><br>
            <span style="font-size: 7pt;">สำนักงานใหญ่ เลขที่ 5 ซอยรามอินทรา 5 แยก 4 แขวงอนุสาวรีย์ เขตบางเขน กรุงเทพมหานคร 10220 โทร. 02-101-0689</span>
            <div class="checkbox" style="margin-bottom: 1px;font-size: 8pt;">
                <input type="checkbox">
                <img src="<?= $baseUrl . '/images/Bank/5LlgcfoBI7.png' ?>" style="float: left;width: 20px;height: 20px;" />
                ธนาคารกรุงศรีอยุธยา จำกัด(มหาชน)(CompCode : 90851 ชื่อบัญชี บริษัท คอซซี่ดอทคอม)
            </div>
            <div class="checkbox" style="margin-bottom: 1px;font-size: 8pt;">
                <input type="checkbox">
                <img src="<?= $baseUrl . '/images/Bank/BBL.png' ?>" style="float: left;width: 20px;height: 20px;">
                ธนาคารกรุงเทพ (CompCode : 27900 ชื่อบัญชี บริษัท คอซซี่ดอทคอม)
            </div>
            <div class="checkbox" style="margin-bottom: 1px;font-size: 8pt;">
                <input type="checkbox">
                <img src="<?= $baseUrl . '/images/Bank/TMB.png' ?>" style="float: left;width: 20px;height: 20px;">
                ธนาคารทหารไทย จำกัด(มหาชน)(CompCode : 35292 ชื่อบัญชี บริษัท คอซซี่ดอทคอม)
            </div>
            <div class="checkbox" style="margin-bottom: 1px;font-size: 8pt;">
                <input type="checkbox">
                <img src="<?= $baseUrl . '/images/Bank/scb.png' ?>" style="float: left;width: 20px;height: 20px;">
                ธนาคารไทยพาณิชย์ (เลขที่บัญชี  123456789 ชื่อบัญชี บริษัท คอซซี่ดอทคอม)
            </div>
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
            <b> <?= \common\helpers\IntToBath::changeToBath(number_format($amount, 2)) ?></b><hr style="size: 3pt;">
            จำนวนเงินเป็นตัวอักษร
        </div>
        <div  style="border: #cccccc solid 0.5px;width: 200px;height: 65px;font-size: 7pt;margin-left: 532px;margin-top: -65px;text-align: center;">
            <b><?= number_format($amount, 2) ?></b><hr style="size: 3pt;">
            จำนวนเงิน(บาท)
        </div>
        <div style="margin-top: 20px;">
            <img src="<?= $baseUrl . '/images/logo/cozxy.png' ?>" style="float: left;width: 80px;height: 50px;" />
        </div>
        <div style="height: 80px;padding: 10px;text-align: right;font-size: 7pt;margin-top: -40px;">
            ชื่อผู้นำฝาก/Desposit by_______________________โทร/Tel_____________________เจ้าหน้าที่ธนาคาร_________________________
            <div style="margin-top: 30px; font-size: 7pt;">
                <?php
                $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barCode, $generator::TYPE_CODE_128)) . '" style="width:300px;">';
                ?>
                <center> <?= $data ?></center>
            </div>
        </div>
    </div><br>
    <?php if ($i == 1) { ?>
        <img src = "<?= $baseUrl . '/images/Bank/payin-cut.png' ?>" style = "width:100%;height: 15px;margin-bottom: 70px;margin-top: -10px;" /><br>
    <?php }
    ?>
<?php endfor; ?>