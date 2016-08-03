<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

//use common\models\ModelMaster;

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
        color:#292c2e;
    }
    .table>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 1px solid #ddd;
    }
    th {
        font-weight: 600;
    }
    .bg-purchase-order{
        background-color: #f5f5f5;
    }

</style>

<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h3><i class="fa fa-file-text" aria-hidden="true"></i> ใบสั่งซื้อเลขที่ <?php echo $orderNo; ?></h3>
    <!--Support-->
    <section class="support">
        <div class="row">
            <!--Left Column-->
            <div class="col-lg-12 col-md-12">
                <div class="col-sm-12" style="margin-bottom: 5px; padding-left: 0px; padding-right: 0px;">
                    <div class="col-sm-3 text-right" style="padding-left: 0px; padding-right: 0px;">&nbsp;</div>
                    <div class="col-sm-3 text-right" style="padding-left: 0px; padding-right: 0px;">
                        <a href="<?php echo Yii::$app->homeUrl; ?>payment/print/purchase-order/" class="btn btn-black btn-xs">
                            <i class="fa fa-print" aria-hidden="true"></i> พิมพ์</a>
                    </div>
                    <div class="col-sm-3 text-right" style="padding-left: 0px; padding-right: 0px;">
                        <a href="<?php echo Yii::$app->homeUrl; ?>payment/print/pay-in" class="btn btn-black btn-xs">
                            <i class="fa fa-print" aria-hidden="true"></i> พิมพ์ใบ Pay-in</a>
                    </div>
                    <div class="col-sm-3 text-right" style="padding-left: 0px; padding-right: 0px;">
                        <a href="<?php echo Yii::$app->homeUrl; ?>profile/transfer-confirm/<?php echo ''; ?>" class="btn btn-black btn-xs">
                            <i class="fa fa-check" aria-hidden="true"></i> แจ้งชำระเงิน</a>
                    </div>
                </div>
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
                                    <td style="width: 35%;"><?php echo $value[$i]->title; ?></td>
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
                            <td colspan="6" class="text-right">ราคาสินค้ารวมภาษีมูลค่าเพิ่ม / sub Total Included VAT :</td>
                            <td class="bg-purchase-order"><?php echo $vat; ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">ส่วนลด/Discount(3.00%) :</td>
                            <td class="bg-purchase-order"> - </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">ภาษีมูลค่าเพิ่ม/VAT 7 % :</td>
                            <td class="bg-purchase-order"><?php echo $vat; ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">ราคาสินค้าไม่รวมภาษี/Sub Total excluded VAT :</td>
                            <td class="bg-purchase-order"><?php echo $totalExVat; ?></td>
                        </tr>
                        <tr >
                            <td colspan="6" class="text-right">ราคาสินค้าที่ต้องชำระเงินรวมภาษีมูลค่าเพิ่ม/Total excluded VAT :</td>
                            <td class="bg-purchase-order"><?php echo $total; ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </section><!--Support Close-->
</div>


