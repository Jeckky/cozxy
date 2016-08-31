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
                    <h5>Shipping to adress</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="line-height: 20px;">
                                    <?php
                                    echo isset($order->attributes['shippingCompany']) ? 'บริษัท' . $order->attributes['shippingCompany'] : 'คุณ' . $order->user->firstname . " " . $order->user->lastname . '<br>';
                                    echo isset($order->attributes['shippingAddress']) ? $order->attributes['shippingAddress'] : '';
                                    echo '<br>';
                                    $District = \common\models\dbWorld\District::find()->where("districtId = '" . $order->attributes['shippingDistrictId'] . "' ")->one();
                                    echo isset($District->attributes['localName']) ? $District->attributes['localName'] : '';
                                    echo '&nbsp;';
                                    $Cities = \common\models\dbWorld\Cities::find()->where("cityId = '" . $order->attributes['shippingAmphurId'] . "' ")->one();
                                    echo isset($Cities->attributes['localName']) ? $Cities->attributes['localName'] : '';
                                    echo '&nbsp;';
                                    $States = \common\models\dbWorld\States::find()->where("stateId = '" . $order->attributes['shippingProvinceId'] . "' ")->one();
                                    echo isset($States->attributes['localName']) ? $States->attributes['localName'] : '';
                                    echo '&nbsp;';
                                    $Countries = \common\models\dbWorld\Countries::find()->where("countryId = '" . $order->attributes['shippingCountryId'] . "' ")->one();
                                    echo isset($Countries->attributes['localName']) ? 'ประเทศ' . $Countries->attributes['localName'] : 'ประเทศ' . 'ไม่ระบุ';
                                    echo '<br> รหัสไปรษณีย์';
                                    echo isset($order->attributes['shippingZipcode']) ? $order->attributes['shippingZipcode'] : '';
                                    echo '<br> โทร ';
                                    echo isset($order->attributes['shippingTel']) ? $order->attributes['shippingTel'] : '';
                                    echo '<br>';
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
                                    $District = \common\models\dbWorld\District::find()->where("districtId = '" . $order->attributes['billingDistrictId'] . "' ")->one();
                                    echo isset($District->attributes['localName']) ? $District->attributes['localName'] : '';
                                    echo '&nbsp;';
                                    $Cities = \common\models\dbWorld\Cities::find()->where("cityId = '" . $order->attributes['billingAmphurId'] . "' ")->one();
                                    echo isset($Cities->attributes['localName']) ? $Cities->attributes['localName'] : '';
                                    echo '&nbsp;';
                                    $States = \common\models\dbWorld\States::find()->where("stateId = '" . $order->attributes['billingProvinceId'] . "' ")->one();
                                    echo isset($States->attributes['localName']) ? $States->attributes['localName'] : '';
                                    echo '&nbsp;';
                                    $Countries = \common\models\dbWorld\Countries::find()->where("countryId = '" . $order->attributes['billingCountryId'] . "' ")->one();
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
                    <?php if (Yii::$app->controller->id == 'profile'):
                        ?>
                        <a href="<?php echo Yii::$app->homeUrl; ?>payment/print-purchase-order/<?php echo $orderIdParams; ?>/<?php echo $order->orderNo; ?>" class="btn btn-primary btn-xs" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i> พิมพ์</a>
                        <!--<a href="<?php echo Yii::$app->homeUrl; ?>payment/print-pay-in/<?php echo $orderIdParams; ?>/<?php echo $order->orderNo; ?>" class="btn btn-primary btn-xs">
                            <i class="fa fa-print" aria-hidden="true"></i> พิมพ์ใบ Pay-in</a>
                        <a href="<?php echo Yii::$app->homeUrl; ?>profile/transfer-confirm/<?php echo $orderIdParams; ?>" class="btn btn-primary btn-xs" target="_blank">
                            <i class="fa fa-check" aria-hidden="true"></i> แจ้งชำระเงิน</a>
                        -->
                        <a href="<?php echo Yii::$app->homeUrl; ?>checkout/confirm-checkout/<?php echo $orderIdParams; ?>" class="btn btn-primary btn-xs" target="_blank">
                            <i class="fa fa-dollar" aria-hidden="true"></i> ชำระอีกครั้ง</a>
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
                <table class="table table-list-order table-hover" style="padding: 10px;" >
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
                                    <td style="font-size: 12px;"><?php echo isset($value->product->units) ? $value->product->units->title : "-"; ?></td>
                                    <td style="font-size: 12px;"><?php echo $value->price; ?></td>
                                    <td style="font-size: 12px;"><?php echo $value->quantity ?></td>
                                    <td style="font-size: 12px;width: 15%;" ><?php echo $value->total; ?></td>
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
                            <td class="bg-purchase-order"><?php echo $order->summary; ?></td>
                        </tr>
                        <!--
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลด/Discount(3.00%) :</td>
                            <td class="bg-purchase-order"> - </td>
                        </tr>
                        -->
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


