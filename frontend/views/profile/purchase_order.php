<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
/*
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
 */
//$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $orderId]);
$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $order->orderId]);
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
    <h3><i class="fa fa-file-text" aria-hidden="true"></i> ใบสั่งซื้อเลขที่ <?php echo $order->orderNo; ?></h3>
    <!--Support-->
    <section class="support">
        <div class="row">
            <!--Left Column-->
            <div class="col-lg-12 col-md-12">
                <div class="col-sm-12" style="margin-bottom: 5px; padding-left: 0px; padding-right: 0px;">
                    <div class="col-sm-3 text-right" style="padding-left: 0px; padding-right: 0px;">&nbsp;</div>
                    <div class="col-sm-3 text-right" style="padding-left: 0px; padding-right: 0px;">
                        <a href="<?php echo Yii::$app->homeUrl; ?>payment/print-purchase-order/<?php echo $orderIdParams; ?>/<?php echo $order->orderNo; ?>" class="btn btn-black btn-xs">
                            <i class="fa fa-print" aria-hidden="true"></i> พิมพ์</a>
                    </div>
                    <div class="col-sm-3 text-right" style="padding-left: 0px; padding-right: 0px;">
                        <a href="<?php echo Yii::$app->homeUrl; ?>payment/print-pay-in" class="btn btn-black btn-xs">
                            <i class="fa fa-print" aria-hidden="true"></i> พิมพ์ใบ Pay-in</a>
                    </div>
                    <div class="col-sm-3 text-right" style="padding-left: 0px; padding-right: 0px;">
                        <a href="<?php echo Yii::$app->homeUrl; ?>profile/transfer-confirm/<?php echo $orderIdParams; ?>" class="btn btn-black btn-xs">
                            <i class="fa fa-check" aria-hidden="true"></i> แจ้งชำระเงิน</a>
                    </div>
                </div>
                <table class="table table-list-order" style="padding: 10px;" >
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
                        if (count($order->orderItems) > 0) {
                            $num = 0;
                            foreach ($order->orderItems as $value) {

                                $bg_even_number = '#fff';  // เลขคู่
                                $bg_odd_number = '#f5f5f5';  // เลขคี่
                                if ($num % 2 == 0) {
                                    $bg = $bg_even_number;
                                } else if ($num % 2 == 1) {
                                    $bg = $bg_odd_number;
                                }
                                ?>
                                <tr style="padding: 5px; background-color: <?php echo $bg; ?>;" >
                                    <td style="font-size: 12px;"><?php echo ++$num; ?></td>
                                    <td style="font-size: 12px;"><?php echo ($value->product->code != '') ? $value->product->code : '-'; ?></td>
                                    <td style="font-size: 12px;"><?php echo $value->product->title; ?></td>
                                    <td style="font-size: 12px;"><?php echo ''; ?></td>
                                    <td style="font-size: 12px;"><?php echo $value->price; ?></td>
                                    <td style="font-size: 12px;"><?php echo $value->quantity ?></td>
                                    <td style="font-size: 12px;"><?php echo $value->total; ?></td>
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
                            <td class="bg-purchase-order"><?php echo $order->vat; ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลด/Discount(3.00%) :</td>
                            <td class="bg-purchase-order"> - </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ภาษีมูลค่าเพิ่ม/VAT 7 % :</td>
                            <td class="bg-purchase-order"><?php echo $order->vat; ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าไม่รวมภาษี/Sub Total excluded VAT :</td>
                            <td class="bg-purchase-order"><?php echo $order->totalExVat; ?></td>
                        </tr>
                        <tr >
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าที่ต้องชำระเงินรวมภาษีมูลค่าเพิ่ม/Total excluded VAT :</td>
                            <td class="bg-purchase-order"><?php echo $order->summary; ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </section><!--Support Close-->
</div>


