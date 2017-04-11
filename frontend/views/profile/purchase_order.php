<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $order->orderId]);

//echo '<pre>';
//print_r($order->attributes);
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
            <div class="col-lg-12 col-md-12 ">
                <div class="col-lg-6 col-md-6 ">
                    <h5>วันที่จัดส่งสินค้า<!--Picking Point--></h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="col-sm-12" style="color: #000; font-size: 13px;">
                                        <div class="col-sm-12">
                                            <?php
                                            $GetOrderItemShipping = \common\models\costfit\OrderItem::find()->where("orderId='" . $order->orderId . "' ")->groupBy(['sendDate'])->sum('sendDate');
                                            //2017-04-03  วันที่จัดส่งสินค้า ภายในวันที่ Dates Month Years
                                            if ($GetOrderItemShipping == 1) {  // 2 วัน
                                                $shipping = 2;
                                                $date = date("Y-m-d"); //"04-15-2013";
                                                $date1 = str_replace('-', '/', $date);
                                                $tomorrow = date('Y-m-d', strtotime($date1 . "+1 days"));
                                                $date2 = str_replace('-', '/', $tomorrow);
                                                $tomorrow_start = date('Y-m-d', strtotime($date2 . "+2 days"));
                                                $tomorrow_end = date('Y-m-d', strtotime($date2 . "+5 days"));
                                                echo 'วันที่จัดส่งสินค้า ภายในวันที่ ' . $this->context->dateThai($tomorrow, 1) . ' - ' . $this->context->dateThai($tomorrow_end, 1);
                                            } else if ($GetOrderItemShipping == 3) { // 5 วัน
                                                $shipping = 5;
                                            }
                                            ?>
                                        </div>
                                        <div class="col-sm-12"><strong>หมายเหตุ</strong> หากมีการเปลียนวันจะแจ้งให้ทราบทาง Email และ SMS ในลำดับต่อไป</div>
                                    </div>
                                    <?php /*
                                      if ($order->attributes['pickingId'] != '') {

                                      $Cities = \common\models\dbworld\Cities::find()->where("cityId = '" . $order->pickingpoint->amphurId . "' ")->one();
                                      echo isset($Cities->attributes['localName']) ? $Cities->attributes['localName'] : '';
                                      echo ' & nbsp;
                                      ';
                                      $States = \common\models\dbworld\States::find()->where("stateId = '" . $order->pickingpoint->provinceId . "' ")->one();
                                      echo isset($States->attributes['localName']) ? $States->attributes['localName'] : '';
                                      echo ' & nbsp;
                                      ';
                                      $Countries = \common\models\dbworld\Countries::find()->where("countryId = '" . $order->pickingpoint->countryId . "' ")->one();
                                      echo isset($Countries->attributes['localName']) ? 'ประเทศ' . $Countries->attributes['localName'] : 'ประเทศ' . 'ไม่ระบุ';
                                      echo "<br>";
                                      echo isset($order->pickingpoint->title) ? 'จุดรับสินค้า : ' . $order->pickingpoint->title : '';
                                      } else {
                                      echo 'ไม่พบข้อมูล';
                                      } */
                                    ?>
                                </td>
                        </tbody>
                    </table>
                </div>
                <div class = "col-lg-6 col-md-6 " style="border-left: 1px #f5f5f5 solid;">
                    <h5>Billing to a different adress</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="line-height: 20px;">
                                    <?php
                                    echo isset($order->attributes['billingCompany']) ? 'บริษัท' . $order->attributes['billingCompany'] . '<br>' : 'คุณ' . $order->user->firstname . " " . $order->user->lastname . '<br>';
                                    echo isset($order->attributes['billingAddress']) ? $order->attributes['billingAddress'] : '';
                                    echo '<br>';
                                    $District = \common\models\dbworld\District::find()->where("districtId = '" . $order->attributes['billingDistrictId'] . "' ")->one();
                                    echo isset($District->attributes['localName']) ? $District->attributes['localName'] : '';
                                    echo '&nbsp;';
                                    $Cities = \common\models\dbworld\Cities::find()->where("cityId = '" . $order->attributes['billingAmphurId'] . "' ")->one();
                                    echo isset($Cities->attributes['localName']) ? $Cities->attributes['localName'] : '';
                                    echo '&nbsp;';
                                    $States = \common\models\dbworld\States::find()->where("stateId = '" . $order->attributes['billingProvinceId'] . "' ")->one();
                                    echo isset($States->attributes['localName']) ? $States->attributes['localName'] : '';
                                    echo '&nbsp;';
                                    $Countries = \common\models\dbworld\Countries::find()->where("countryId = '" . $order->attributes['billingCountryId'] . "' ")->one();
                                    echo isset($Countries->attributes['localName']) ? 'ประเทศ' . $Countries->attributes['localName'] : 'ประเทศ' . 'ไม่ระบุ';
                                    echo '<br> รหัสไปรษณีย์ ';
                                    echo isset($order->attributes['billingZipcode']) ? $order->attributes['billingZipcode'] : '';
                                    echo '<br> โทร';
                                    echo $order->attributes['billingTel'] . '<br>';
                                    ?>
                                </td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class = "col-lg-12 col-md-12 ">
                <div class = "col-sm-12 pull-right" style = "margin-bottom: 5px; padding-left: 0px; padding-right: 0px;">
                    <?php if (Yii::$app->controller->id == 'profile'): ?>
                        <a href="<?php echo Yii::$app->homeUrl; ?>payment/print-purchase-order/<?php echo $orderIdParams; ?>/<?php echo $order->orderNo; ?>" class="btn btn-primary btn-xs" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i> พิมพ์</a>
                        <!--<a href="<?php echo Yii::$app->homeUrl; ?>payment/print-pay-in/<?php echo $orderIdParams; ?>/<?php echo $order->orderNo; ?>" class="btn btn-primary btn-xs">
                            <i class="fa fa-print" aria-hidden="true"></i> พิมพ์ใบ Pay-in</a>
                        <a href="<?php echo Yii::$app->homeUrl; ?>profile/transfer-confirm/<?php echo $orderIdParams; ?>" class="btn btn-primary btn-xs" target="_blank">
                            <i class="fa fa-check" aria-hidden="true"></i> แจ้งชำระเงิน</a>
                        -->
                        <?php if ($order->status != \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_PENDING): ?>
                            <a href="<?php echo Yii::$app->homeUrl; ?>checkout/confirm-checkout/<?php echo $orderIdParams; ?>" class="btn btn-primary btn-xs" target="_blank">
                                <i class="fa fa-dollar" aria-hidden="true"></i> ชำระอีกครั้ง</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if (Yii::$app->controller->id != 'checkout'): ?>
                            <a href="<?php echo Yii::$app->homeUrl; ?>order/order/print-purchase-order/<?php echo $orderIdParams; ?>/<?php echo $order->orderNo; ?>" class="btn btn-primary btn-xs" target="_blank">
                                <i class="fa fa-print" aria-hidden="true"></i> พิมพ์</a>
                                <!--  <a href="<?php echo Yii::$app->homeUrl; ?>payment/print-pay-in" class="btn btn-primary btn-xs" target="_blank">
                                <i class="fa fa-print" aria-hidden="true"></i> พิมพ์ใบ Pay-in</a>
                            <a href="<?php echo Yii::$app->homeUrl; ?>profile/transfer-confirm/<?php echo $orderIdParams; ?>" class="btn btn-primary btn-xs" target="_blank">
                                <i class="fa fa-check" aria-hidden="true"></i> แจ้งชำระเงิน</a>-->
                        <?php endif; ?>
                    <?php endif; ?>
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
                        <?php echo $this->render('@frontend/views/payment/data_product', compact('order')); ?>
                        <tr>
                            <td colspan="6">&nbsp;</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าไม่รวมภาษี/Sub Total excluded VAT :</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($order->totalExVat, 2); ?></td>
                        </tr>

                        <!--
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลด/Discount(3.00%) :</td>
                            <td class="bg-purchase-order"> - </td>
                        </tr>
                        -->
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ภาษีมูลค่าเพิ่ม/VAT 7 % :</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($order->vat, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้ารวมภาษีมูลค่าเพิ่ม / sub Total Included VAT :</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($order->total, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลดพิเศษ / Extra Saving :</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($order->discount, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ค่าจัดส่ง / Shipping :</td>
                            <td class="bg-purchase-order text-right"><?php echo ($order->shippingRate > 0) ? number_format($order->shippingRate, 2) : "Free"; ?></td>
                        </tr>
                        <tr >
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าที่ต้องชำระเงินรวมภาษีมูลค่าเพิ่ม/Total excluded VAT :</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($order->summary, 2); ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </section><!--Support Close-->

    <br><br><br>
</div>



