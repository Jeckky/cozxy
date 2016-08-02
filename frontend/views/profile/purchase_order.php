<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
if (is_array($Order)) {
    $orderNo = $Order['orderNo'];
    $vat = $Order['vat'];
    $totalExVat = $Order['totalExVat'];
    $total = $Order['total'];
} else {
    $orderNo = '-';
    $vat = '-';
    $totalExVat = '-';
    $total = '-';
}
?>
<style>
    .table{
        font-size: 13px;
        white-space:pre-line;
    }
    .table>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 1px solid #ddd;
    }
    th {
        font-weight: 700;
    }
</style>
<h3>รายการใบสั่งซื้อเลขที่ <?php echo $orderNo; ?></h3>

<!--Support-->
<section class="support">
    <div class="row">
        <!--Left Column-->
        <div class="col-lg-12 col-md-12">
            <table class="table" style="border: 1px #f5f5f5 solid;">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รหัสสินค้า</th>
                        <th>รายการ</th>
                        <th>หน่วย</th>
                        <th>ราคา/หน่วย</th>
                        <th>จำนวน</th>
                        <th>มูลค่าสินค้ารวมภาษี</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if (is_array($product_itme)) {
                        foreach ($product_itme as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo ++$key; ?></td>
                                <td><?php echo $value[$i]->code; ?></td>
                                <td><?php echo $value[$i]->title; ?></td>
                                <td><?php echo ''; ?></td>
                                <td><?php echo $value[$i]->price; ?></td>
                                <td><?php echo $OrderItemList['quantity'] ?></td>
                                <td><?php echo ($value[$i]->price * $OrderItemList['quantity']); ?></td>
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
                        <td colspan="6" class="text-right">ราคาสินค้ารวมภาษีมูลค่าเพิ่ม / sub Total Included VAT :</td>
                        <td><?php echo $vat; ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">ส่วนลด/Discount(3.00%) :</td>
                        <td> - </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">ภาษีมูลค่าเพิ่ม/VAT 7 % :</td>
                        <td><?php echo $vat; ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">ราคาสินค้าไม่รวมภาษี/Sub Total excluded VAT :</td>
                        <td><?php echo $totalExVat; ?></td>
                    </tr>
                    <tr >
                        <td colspan="6" class="text-right">ราคาสินค้าที่ต้องชำระเงินรวมภาษีมูลค่าเพิ่ม/Total excluded VAT :</td>
                        <td><?php echo $total; ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</section><!--Support Close-->

