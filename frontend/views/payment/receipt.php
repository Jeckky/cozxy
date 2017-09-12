<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $order->orderId]);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

if (isset($billingCompany) && !empty($billingCompany)) {
    $billingUse = 'บริษัท' . $order->billingCompany . 'tax :' . $order->billingTax;
} else {
    $billingUse = 'คุณ' . $order->user->firstname . " " . $order->user->lastname;
}
?>
<!DOCTYPE html>
<html>
    <!--    <head>
            <title>Page Title</title>

        </head>-->
    <br>
    <body  onload="window.print()">
        <!--<hr> 1 -->
        <table class="table table_bordered" width="100%" cellpadding="2" cellspacing="0" style="margin-top: -2px;">
            <tr>
                <td  colspan="4" style="text-align: left; vertical-align: text-top; padding: 5px; font-size: 12px; line-height: 20px;border-color: #000;">
                    ได้รับเงินจาก : <?php echo $billingUse; ?>
                    <?php //echo $order->user->firstname;    ?> <?php //echo $order->user->lastname;    ?><br>
                    <!--เลขที่ประจำตัวผู้เสียภาษี :  <br>-->
                    <?php echo isset($order->billingAddress) ? $order->billingAddress : "-"; ?><br>
                    <?php echo isset($order->billingDistrict) ? $order->billingDistrict->localName : "-"; ?>
                    <?php echo isset($order->billingCities) ? $order->billingCities->localName : "-"; ?>
                    <?php echo isset($order->billingProvince) ? $order->billingProvince->localName : "-"; ?>
                    <br>ประเทศ<?php echo isset($order->billingCountry) ? $order->billingCountry->localName : " -"; ?>
                    <?php echo $order->billingZipcode; ?>
                    <br>โทรศัพท์ :   <?php echo $order->billingTel; ?>
                </td>
                <td  colspan="3" style="text-align: left; vertical-align: text-top; padding: 5px; font-size: 12px; line-height: 20px;border-color: #000;">
                    เลขที่ใบสั่งซื้อ Order No. : <?php echo $order->orderNo; ?><br>
                    เลขที่ใบเสร็จรับเงิน : <?php echo $order->invoiceNo; ?><br>
                    วันที่ออกใบกำกับภาษี :
                    <?php
                    echo isset($order->paymentDateTime) ? $this->context->dateThai($order->paymentDateTime, 1) : '-';
                    ?>
                </td>
            </tr>
        </table>
        <!-- 2 <hr>-->
        <table class="table_bordered" width="100%" border="0" cellpadding="4" cellspacing="0">
            <thead>
                <tr style="background-color: #f5f5f5; ">
                    <th style="font-size: 12px;width: 10%;">ลำดับ</th>
                    <th style="font-size: 12px;width: 15%;">รหัสสินค้า</th>
                    <th style="font-size: 12px;width: 25%;">รายการสินค้า</th>
                    <th style="font-size: 12px;text-align: right;width: 10%;">จำนวน</th>
                    <th style="font-size: 12px;text-align: right;width: 20%;">ราคา/หน่วย(บาท)</th>
                    <th style="font-size: 12px;text-align: right;width: 20%;">จำนวนเงิน(บาท)</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $this->render('@frontend/views/payment/data_product', compact('order')); ?>
                <tr>
                    <td colspan="5">&nbsp;</td>
                    <td >&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right" class="foorter-purchase-order">ส่วนลดพิเศษ / Extra Saving :</td>
                    <td class="bg-purchase-order"><?php echo number_format($order->discount, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right" class="foorter-purchase-order">ราคาสินค้าไม่รวมภาษี/Sub Total exclude VAT :</td>
                    <td class="bg-purchase-order"><?php echo number_format($order->totalExVat, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right" class="foorter-purchase-order">ภาษีมูลค่าเพิ่ม/VAT 7 % :</td>
                    <td class="bg-purchase-order"><?php echo number_format($order->vat, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right" class="foorter-purchase-order">ราคาสินค้ารวมภาษีมูลค่าเพิ่ม / sub Total Include VAT :</td>
                    <td class="bg-purchase-order"><?php echo number_format($order->total, 2); ?></td>
                </tr>
                <!--Comment by sak-->
                <!--                <tr>
                                    <td colspan="5" class="text-right" class="foorter-purchase-order">ค่าจัดส่ง / Shipping :</td>
                                    <td class="bg-purchase-order"><?php //echo ($order->shippingRate > 0) ? number_format($order->shippingRate, 2) : "Free";                     ?></td>
                                </tr>-->
                <!--
                <tr>
                    <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลด/Discount(3.00%) :</td>
                    <td class="bg-purchase-order"> - </td>
                </tr>
                  <tr >
                    <td colspan="5" class="text-right" class="foorter-purchase-order">ราคาสินค้าที่ต้องวันที่ออกใบกำกับภาษีรวมภาษีมูลค่าเพิ่ม/Total Include VAT :</td>
                    <td class="bg-purchase-order"><?php //echo number_format($order->summary, 2);                    ?></td>
                </tr>-->

            </tbody>
        </table>
        <?= $this->render('@frontend/views/payment/signature'); ?>
        <br>

    </body>
</html>
<div style="margin-left: 250px;">ใบเสร็จรับเงินฉบับนี้จะสมบูรณ์ก็ต่อเมื่อบริษัทฯ ได้รับเงินคืนเรียบร้อยแล้ว</div>