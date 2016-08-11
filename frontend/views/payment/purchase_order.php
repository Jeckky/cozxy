<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

if (is_array($Order)) {
    $orderNo = $Order['orderNo'];
    $orderId = $Order['orderId'];
    $vat = $Order['vat'];
    $totalExVat = $Order['totalExVat'];
    $total = $Order['total'];
} else {
    $orderNo = '-';
    $vat = '-';
    $totalExVat = '-';
    $total = '-';
}

$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $orderId]);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<table class="table">
    <tr>
        <th colspan="2" style="text-align: left; vertical-align: text-top;"><br><br>
            <img src="<?php echo $baseUrl; ?>/images/logo/costfit.png" alt="Cost Fit" width="93" height="48" broder ="0">
        </th>
        <th colspan="3" style="padding: 5px; vertical-align: text-top;">
            <h2>
                บริษัท Cost.fit จำกัด
            </h2>
            <br> เลขประจำตัวผู้เสียภาษี : 0105552077368 <br>
            สำนักงานใหญ่ เลขที่ 1 ซ.ลาดพร้าว 19 ถ.ลาดพร้าว แขวงจอมพล <br>เขตจตุจักร จังหวัดกรุงเทพมหานคร 10900
        </th>
        <th colspan="2" style="vertical-align: text-top; text-align: right;"><br><br>
            ใบสั่งซื้อสินค้า/ใบแจ้งหนี้
        </th>
    </tr>
</table>
<hr>
<!-- 1 -->
<table class="table">
    <tr>
        <th colspan="4" style="text-align: left; vertical-align: text-top;">
            ได้รับเงินจาก : คุณธนินัช บางเมือง <br>
            เลขที่ประจำตัวผู้เสียภาษี : 3101300014028<br>
            164/21 ซอยลาดพร้าว 1 แขวงจอมพล เขตจตุจักร
            <br>จังหวัดกรุงเทพมหานคร 10900
            <br>โทรศัพท์ : 081-6250777
        </th>
        <th colspan="3" style="vertical-align: text-top; text-align: left;">
            ต้นฉบับ<br>
            เลขที่ใบสั่งซื้อ PO No. : <?php echo $orderNo; ?><br>
            วันที่สั่งซื้อ : 5 กุมภาพันธ์ 2559 <br>
            กำหนดชำระเงิน : 8 กุมภาพันธ์ 2559
        </th>
    </tr>
</table>
<hr>
<!-- 2 -->
<table class="table" style="padding: 10px;">
    <thead>
        <tr style="background-color: #f5f5f5;">
            <th style="font-size: 13px;">ลำดับ</th>
            <th style="font-size: 13px;">รหัสสินค้า</th>
            <th style="font-size: 13px;">รายการ</th>
            <th style="font-size: 13px;">หน่วย</th>
            <th style="font-size: 13px;">ราคา/หน่วย</th>
            <th style="font-size: 13px;">จำนวน</th>
            <th style="font-size: 13px;">มูลค่าสินค้ารวมภาษี</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        if (is_array($product_itme)) {
            $num = 0;
            foreach ($product_itme as $key => $value) {
                ?>
                <tr style="padding: 5px;">
                    <td style="font-size: 12px;"><?php echo ++$num; ?></td>
                    <td style="font-size: 12px;"><?php echo ($value[$i]->code != '') ? $value[$i]->code : '-'; ?></td>
                    <td style="font-size: 12px;"><?php echo $value[$i]->title; ?></td>
                    <td style="font-size: 12px;"><?php echo ''; ?></td>
                    <td style="font-size: 12px;"><?php echo $OrderItemList[$key]['price']; ?></td>
                    <td style="font-size: 12px;"><?php echo $OrderItemList[$key]['quantity'] ?></td>
                    <td style="font-size: 12px;"><?php echo ($OrderItemList[$key]['price'] * $OrderItemList[$key]['quantity']); ?></td>
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
            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้ารวมภาษีมูลค่าเพิ่ม / sub Total Included VAT :</td>
            <td class="bg-purchase-order"><?php echo $vat; ?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลด/Discount(3.00%) :</td>
            <td class="bg-purchase-order"> - </td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ภาษีมูลค่าเพิ่ม/VAT 7 % :</td>
            <td class="bg-purchase-order"><?php echo $vat; ?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าไม่รวมภาษี/Sub Total excluded VAT :</td>
            <td class="bg-purchase-order"><?php echo $totalExVat; ?></td>
        </tr>
        <tr >
            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าที่ต้องชำระเงินรวมภาษีมูลค่าเพิ่ม/Total excluded VAT :</td>
            <td class="bg-purchase-order"><?php echo $total; ?></td>
        </tr>

    </tbody>
</table>


