<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $order->orderId]);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<table class="table table_bordered" width="100%"  cellpadding="2" cellspacing="0">
    <tr>
        <td colspan="2" style="text-align: left; vertical-align: text-top;"><br><br>
            <img src="<?php echo $baseUrl; ?>/images/logo/costfit.png" alt="Cost Fit" width="93" height="48" broder ="0">
        </td>
        <td colspan="3" style="padding: 5px; vertical-align: text-top; text-align: center;">
            <h2>
                บริษัท เอเทค เอ็นเตอร์ไพรส์ จำกัด
            </h2>
            <br> เลขประจำตัวผู้เสียภาษี : 0105546109903 <br>
            สำนักงานใหญ่ เลขที่ 1 ซ.ลาดพร้าว 19 ถ.ลาดพร้าว <br>แขวงจอมพล เขตจตุจักร จังหวัดกรุงเทพมหานคร 10900
        </td>
        <td colspan="2" style="vertical-align: text-top; text-align: right; "><br><br>
            ใบเสร็จ/ใบกำกับภาษี
        </td>
    </tr>
</table>

<hr> 1 -->
<table class="table table_bordered" width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td  colspan="4" style="text-align: left; vertical-align: text-top; padding: 5px; font-size: 12px; line-height: 20px;">
            ได้รับเงินจาก : คุณ<?php echo $order->user->firstname; ?> <?php echo $order->user->lastname; ?><br>
            เลขที่ประจำตัวผู้เสียภาษี : <br>
            <?php echo isset($order->billingAddress) ? $order->billingAddress : "-"; ?><br>
            <?php echo isset($order->billingDistrict) ? $order->billingDistrict->localName : "-"; ?>
            <?php echo isset($order->billingCities) ? $order->billingCities->localName : "-"; ?>
            <?php echo isset($order->billingProvince) ? $order->billingProvince->localName : "-"; ?>
            <br>ประเทศ<?php echo isset($order->billingCountry) ? $order->billingCountry->localName : " -"; ?>
            <?php echo $order->billingZipcode; ?>
            <br>โทรศัพท์ :   <?php echo $order->billingTel; ?>
        </td>
        <td  colspan="3" style="text-align: left; vertical-align: text-top; padding: 5px; font-size: 12px; line-height: 20px;">
            ต้นฉบับ<br>
            เลขที่ใบสั่งซื้อ PO No. : <?php echo $order->orderNo; ?><br>
            เลขที่ใบเสร็จรับเงิน : IV<br>
            ชำระเงิน :
            <?php
            echo $this->context->dateThai($order->createDateTime, 1);
            ?>
        </td>
    </tr>
</table>
<!-- 2 <hr>-->
<table class="table_bordered" width="100%" border="0" cellpadding="4" cellspacing="0">
    <thead>
        <tr style="background-color: #f5f5f5; ">
            <th style="font-size: 12px;">ลำดับ</th>
            <th style="font-size: 12px;">รหัสสินค้า</th>
            <th style="font-size: 12px;">รายการ</th>
            <th style="font-size: 12px;">หน่วย</th>
            <th style="font-size: 12px;text-align: right;width: 18%;">ราคา/หน่วย(บาท)</th>
            <th style="font-size: 12px;text-align: right;">จำนวน</th>
            <th style="font-size: 12px;text-align: right;width: 23%;">มูลค่าสินค้า(บาท)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        if (count($order->orderItems) > 0) {
            $num = 0;
            foreach ($order->orderItems as $value) {
                $bg_even_number = '#fff';
                $bg_odd_number = '#f5f5f5';
                if ($num % 2 == 0) {
                    $bg = $bg_even_number; // เลขคู่
                } else if ($num % 2 == 1) {
                    $bg = $bg_odd_number; // เลขคี่
                }
                ?>
                <tr style="background-color: <?php echo $bg; ?>; border-bottom: 1px #000000 solid;">
                    <td style="font-size: 12px;"><?php echo ++$num; ?></td>
                    <td style="font-size: 12px;"><?php echo isset($value->product->code) ? $value->product->code : '-'; ?></td>
                    <td style="font-size: 12px;"><?php echo isset($value->product->title) ? $value->product->title : ''; ?></td>
                    <td style="font-size: 12px;"><?php echo isset($value->product->units) ? $value->product->units->title : ''; ?></td>
                    <td style="font-size: 12px; text-align: right;"><?php echo isset($value->price) ? $value->price : ''; ?></td>
                    <td style="font-size: 12px; text-align: right;"><?php echo isset($value->quantity) ? $value->quantity : '' ?></td>
                    <td style="font-size: 12px; text-align: right;"><?php echo isset($value->total) ? $value->total : ''; ?></td>
                </tr>
                <?php
                $i = $i++;
            }
        } else {
            ?>
            <tr>
                <td colspan="7" class="text-center">ไม่พบข้อมูล</td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="6">&nbsp;</td>
            <td >&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าไม่รวมภาษี/Sub Total exclude VAT :</td>
            <td class="bg-purchase-order"><?php echo $order->totalExVat; ?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ภาษีมูลค่าเพิ่ม/VAT 7 % :</td>
            <td class="bg-purchase-order"><?php echo $order->vat; ?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้ารวมภาษีมูลค่าเพิ่ม / sub Total Include VAT :</td>
            <td class="bg-purchase-order"><?php echo $order->total; ?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลด/Discount(3.00%) :</td>
            <td class="bg-purchase-order"> - </td>
        </tr>


        <tr >
            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าที่ต้องชำระเงินรวมภาษีมูลค่าเพิ่ม/Total Include VAT :</td>
            <td class="bg-purchase-order"><?php echo $order->summary; ?></td>
        </tr>

    </tbody>
</table>


