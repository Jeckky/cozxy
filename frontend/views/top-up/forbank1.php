<?php

use Picqer\Barcode\BarcodeGenerator;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div style="margin: 10px;padding: 10px;border: #000 solid 2px;color: #000;">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8 text-left"  style="font-size: 14pt;">
            <b>แบบฟอร์มสำหรับชำระเงิน (Bill Payment / Pay-inSlip)</b>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 text-right"  style="font-size: 12pt;">

        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8 text-left">
            <b  style="font-size: 12pt;">เพื่อนำเข้าบัญชี บริษัท คอซซี่ดอทคอม จำกัด / เลขประจำตัวผู้เสียภาษี <?= $taxId ?></b><br>
            <span style="font-size: 11pt;">สำนักงานใหญ่ เลขที่ 5 ซอยรามอินทรา 5 แยก 4 แขวงอนุสาวรีย์ เขตบางเขน กรุงเทพมหานคร 10220 โทร. 02-101-0689</span>
            <?php
            if (isset($allBank) && count($allBank) > 0) {
                foreach ($allBank as $bank):
                    $banks = \common\models\costfit\Bank::bankArray($bank->bankId);
                    ?>
                    <div class="checkbox" style="margin-bottom: 1px;">
                        <input type="checkbox" disabled="true">
                        <img src="<?= $baseUrl . $banks->image ?>" style="float: left;width: 20px;height: 20px;" />
                        <?= $banks->title ?>(เลขที่บัญชี : <?= strip_tags($bank->accNo) ?>)
                    </div>
                    <?php
                endforeach;
            }
            ?>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 pull-right text-left" style="border: #000 solid 2px;margin-right: 15px;padding: 5px;">
            สาขา_______________วันที่_______________<br>
            ชื่อลูกค้า : <b><?= $customerName ?></b><br>
            เลขที่(Ref.1) : <b><?= $topUpNo ?></b><br>
            เบอร์โทรศัพท์(Ref.2) :<b><?= $customerTel ?></b>
        </div>
    </div>

    <div class="row text-center" style="margin: 15px;">
        <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2" style="padding-top: 10px;border: #cccccc solid 1px;height: 60px;">
            เงินสด
        </div>
        <div class="col-lg-7 col-md-7 col-xs-7 col-sm-7" style="border: #cccccc solid 1px;height: 60px;">
            <b> <?= \common\helpers\IntToBath::changeToBath(number_format($amount, 2)) ?></b><hr style="border-bottom: #000 dotted 1px;margin-top: 5px;margin-bottom: 5px;">
            จำนวนเงินเป็นตัวอักษร
        </div>
        <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3" style="border: #cccccc solid 1px;height: 60px;">
            <b><?= number_format($amount, 2) ?></b><hr style="border-bottom: #000 dotted 1px;margin-top: 5px;margin-bottom: 5px;">
            จำนวนเงิน(บาท)
        </div>
    </div>
    <!--    <div class="row text-center" style="margin: 15px;">
            <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                <img src="<?= $baseUrl . '/images/logo/cozxy.png' ?>" style="float: left;width: 100px;height: 80px;" />
            </div>
            <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10 text-right" style="height: 80px;padding: 10px;">
                ชื่อผู้นำฝาก/Desposit by_______________________โทร/Tel_____________________เจ้าหน้าที่ธนาคาร_________________________
                <div class="pull-right"style="margin-top: 10px; font-size: 10pt;">
    <?php /*
      $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
      echo $generator->getBarcode($barCode, $generator::TYPE_CODE_128);
     */ ?>
                    <center> <?php // $data    ?></center>
                </div>
            </div>

        </div>-->
</div>
