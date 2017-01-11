<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $order->orderId]);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--<hr> 1 -->
<table class="table table_bordered" width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td colspan="4" style="text-align: left; vertical-align: text-top; padding: 5px; font-size: 12px; line-height: 20px;">
            สถานที่รับเอกสาร
        </td>
        <td colspan="3" style="text-align: left; vertical-align: text-top; padding: 5px; font-size: 12px; line-height: 20px;">
            เลขที่ใบสั่งซื้อ PO No. : <?php echo $order->orderNo; ?>
        </td>
    </tr>
    <tr>
        <td  colspan="4" style="text-align: left; vertical-align: text-top; padding: 5px; font-size: 12px; line-height: 20px;">
            <?php
            echo isset($order->billingCompany) ? 'บริษัท' . $order->billingCompany : 'คุณ' . $order->user->firstname . " " . $order->user->lastname;
            ?><br>
            <!--เลขที่ประจำตัวผู้เสียภาษี :  <br>-->
            <?php echo isset($order->billingAddress) ? $order->billingAddress : "-"; ?><br>
            <?php echo isset($order->billingDistrict) ? $order->billingDistrict->localName : "-"; ?>
            <?php echo isset($order->billingCities) ? $order->billingCities->localName : "-"; ?>
            <?php echo isset($order->billingProvince) ? $order->billingProvince->localName : "-"; ?>
            <br>ประเทศ<?php echo isset($order->billingCountry) ? $order->billingCountry->localName : " -"; ?>
            <?php echo $order->billingZipcode; ?>
            <br>โทรศัพท์ :   <?php echo $order->billingTel; ?>
        </td>
        <td  colspan="3" style="text-align: left; vertical-align: text-top; padding: 5px; font-size: 12px; line-height: 20px;">
            <!--เลขที่ใบสั่งซื้อ PO No. : <?php echo $order->orderNo; ?><br>-->
            วันที่สั่งซื้อ : <?php echo $this->context->dateThai($order->createDateTime, 1); ?><br>
            กำหนดชำระเงิน :
            <?php
            echo $this->context->dateThai($order->createDateTime, 1);
            ?>
        </td>
    </tr>
</table>
<!-- 2 <hr>-->
<table class="table_bordered" width="100%" border="0" cellpadding="2" cellspacing="0">
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
        if (count($order) > 0) {
            $listOrderItems = common\models\costfit\OrderItem::find()
            ->select('orderId,productSuppId,supplierId')->where('orderId=' . $order->orderId)->groupBy('supplierId')->all();
            foreach ($listOrderItems as $value1) {
                /*
                 * # แยก Suppliers ไม่ซ้ำกัน
                 * จาก table OderItem
                 * 10/1/2017
                 */
                ?>
                <tr style="background-color:#f9f9f9 ; border-bottom: 1px #000000 solid; height: 25px;">
                    <td style="font-size: 12px;" colspan="7"><?php echo isset($value1->user) ? $value1->user->code : '-'; ?></td>
                </tr>
                <?php
                $GetOrder = common\models\costfit\OrderItem::find()->where('orderId=' . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'])->all();
                $num = 0;
                foreach ($GetOrder as $value) {
                    /*
                     * # แสดงข้อมูล Product ของแต่ละ Suppliers
                     * # เงือนไขของ Product Suppliers
                     */
                    $listOrderItemsShow = common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $value['productSuppId'])->one();
                    ?>
                    <tr style=" border-bottom: 1px #000000 solid;">
                        <td style="font-size: 12px;"><?php echo ++$i; ?></td>
                        <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['code']) ? $listOrderItemsShow['code'] : '-'; ?></td>
                        <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['title']) ? $listOrderItemsShow['title'] : '-'; ?></td>
                        <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['units']) ? $listOrderItemsShow->units->title : '-'; ?></td>
                        <td style="font-size: 12px; text-align: right;"><?php echo isset($value->price) ? number_format($value->price, 2) : '-'; ?></td>
                        <td style="font-size: 12px; text-align: right;"><?php echo isset($value->quantity) ? $value->quantity : '-' ?></td>
                        <td style="font-size: 12px; text-align: right;"><?php echo isset($value->total) ? number_format($value->total, 2) : '-'; ?></td>
                    </tr>
                    <?php
                }
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
            <td class="bg-purchase-order"><?php echo number_format($order->totalExVat, 2); ?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ภาษีมูลค่าเพิ่ม/VAT 7 % :</td>
            <td class="bg-purchase-order"><?php echo number_format($order->vat, 2); ?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้ารวมภาษีมูลค่าเพิ่ม / sub Total Include VAT :</td>
            <td class="bg-purchase-order"><?php echo number_format($order->total, 2); ?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลดพิเศษ / Extra Saving :</td>
            <td class="bg-purchase-order"><?php echo number_format($order->discount, 2); ?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ค่าจัดส่ง / Shipping :</td>
            <td class="bg-purchase-order"><?php echo ($order->shippingRate > 0) ? number_format($order->shippingRate, 2) : "Free"; ?></td>
        </tr>
        <!--
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลด/Discount(3.00%) :</td>
            <td class="bg-purchase-order"> - </td>
        </tr>
        -->
        <tr >
            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าที่ต้องชำระเงินรวมภาษีมูลค่าเพิ่ม/Total Include VAT :</td>
            <td class="bg-purchase-order"><?php echo number_format($order->summary, 2); ?></td>
        </tr>

    </tbody>
</table>


