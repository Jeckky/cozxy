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
?>
<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin-top: 20px;">
    <h3><i class="fa fa-file-text" aria-hidden="true"></i> ใบสั่งซื้อเลขที่ <?php echo $orderNo; ?></h3>
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
                            $num = 0;
                            foreach ($product_itme as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo ++$num; ?></td>
                                    <td><?php echo ($value[$i]->code != '') ? $value[$i]->code : '-'; ?></td>
                                    <td style="width: 30%;"><?php echo $value[$i]->title; ?></td>
                                    <td><?php echo ''; ?></td>
                                    <td><?php echo $OrderItemList[$key]['price']; ?></td>
                                    <td><?php echo $OrderItemList[$key]['quantity'] ?></td>
                                    <td><?php echo ($OrderItemList[$key]['price'] * $OrderItemList[$key]['quantity']); ?></td>
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
            </div>
        </div>
    </section><!--Support Close-->
</div>


