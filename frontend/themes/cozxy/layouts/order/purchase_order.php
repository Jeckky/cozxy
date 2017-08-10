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
    <!--<h3><i class="fa fa-file-text" aria-hidden="true"></i> Order No# <?// echo $order->orderNo; ?></h3>-->
    <!--Support-->
    <section class="support">
        <div class="row">
            <!--Left Column-->
            <div class="col-lg-12 col-md-12 ">
                <div class="col-lg-6 col-md-6 ">
                    <!--<h5>Send DatePicking Point</h5>-->
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
                                        <div class="col-sm-12"><strong>Note:</strong> You will be notified via Email and SMS for any changes in delivery schedule.</div>
                                    </div>
                                </td>
                        </tbody>
                    </table>
                </div>
                <div class = "col-lg-6 col-md-6 " style="border-left: 1px #f5f5f5 solid;">
                    <h5>Billing address</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="line-height: 20px;">
                                    <?php
                                    if (isset($addressIdsummary)) {
                                        $address = common\models\costfit\Address::find()->where('addressId=' . $addressIdsummary)->one();
                                        echo isset($address['company']) ? '' . $address['company'] . '<br>' : '&nbsp;' . $address['firstname'] . " " . $address['lastname'] . '<br>';
                                        echo isset($address['address']) ? ',' . $address['address'] : '';
                                        echo '<br>';
                                        $District = \common\models\dbworld\District::find()->where("districtId = '" . $address['districtId'] . "' ")->one();
                                        echo isset($District->attributes['localName']) ? ',' . $District->attributes['localName'] : '';
                                        //echo '&nbsp;,';
                                        $Cities = \common\models\dbworld\Cities::find()->where("cityId = '" . $address['amphurId'] . "' ")->one();
                                        echo isset($Cities->attributes['localName']) ? ',' . $Cities->attributes['localName'] : '';
                                        //echo '&nbsp;,';
                                        $States = \common\models\dbworld\States::find()->where("stateId = '" . $address['provinceId'] . "' ")->one();
                                        echo isset($States->attributes['localName']) ? ',' . $States->attributes['localName'] : '';
                                        //echo '&nbsp;,';
                                        $Countries = \common\models\dbworld\Countries::find()->where("countryId = '" . $address['countryId'] . "' ")->one();
                                        echo isset($Countries->attributes['localName']) ? ',' . $Countries->attributes['localName'] : '' . '-';
                                        echo '<br>  ';
                                        $zipCode = \common\models\dbworld\Zipcodes::find()->where("zipcodeId = '" . $address['zipcode'] . "' ")->one();
                                        echo isset($zipCode) ? ',' . $zipCode->zipcode : '';
                                        echo '<br> Tel ';
                                        echo $address['tel'] . '<br>';
                                    } else {
                                        echo isset($order->attributes['billingCompany']) ? '' . $order->attributes['billingCompany'] . '<br>' : '&nbsp;' . $order->user->firstname . " " . $order->user->lastname . '<br>';
                                        echo isset($order->attributes['billingAddress']) ? ',' . $order->attributes['billingAddress'] : '';
                                        echo '<br>';
                                        $District = \common\models\dbworld\District::find()->where("districtId = '" . $order->attributes['billingDistrictId'] . "' ")->one();
                                        echo isset($District->attributes['localName']) ? ',' . $District->attributes['localName'] : '';
                                        //echo '&nbsp;';
                                        $Cities = \common\models\dbworld\Cities::find()->where("cityId = '" . $order->attributes['billingAmphurId'] . "' ")->one();
                                        echo isset($Cities->attributes['localName']) ? ',' . $Cities->attributes['localName'] : '';
                                        //echo '&nbsp;';
                                        $States = \common\models\dbworld\States::find()->where("stateId = '" . $order->attributes['billingProvinceId'] . "' ")->one();
                                        echo isset($States->attributes['localName']) ? ',' . $States->attributes['localName'] : '';
                                        //echo '&nbsp;';
                                        $Countries = \common\models\dbworld\Countries::find()->where("countryId = '" . $order->attributes['billingCountryId'] . "' ")->one();
                                        echo isset($Countries->attributes['localName']) ? ',' . $Countries->attributes['localName'] : '' . '';
                                        echo '<br>';
                                        $zipCode = \common\models\dbworld\Zipcodes::find()->where("zipcodeId = '" . $order->attributes['billingZipcode'] . "' ")->one();
                                        echo isset($zipCode) ? ',' . $zipCode->zipcode : '';
                                        echo '<br> Tel ';
                                        echo $order->attributes['billingTel'] . '<br>';
                                    }
                                    ?>
                                </td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class = "col-lg-12 col-md-12 ">

                <table class="table table-list-order" style="padding: 10px;" >
                    <thead>
                        <tr style="background-color: #f5f5f5;">
                            <th style="font-size: 13px;">#</th>
                            <th style="font-size: 13px;">Product code</th>
                            <th style="font-size: 13px;">Items</th>
                            <th style="font-size: 13px;">Unit</th>
                            <th style="font-size: 13px;">Price/Unit</th>
                            <th style="font-size: 13px;">Quantity</th>
                            <th style="font-size: 13px;">Total include tax</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=
                        $this->render('@app/themes/cozxy/layouts/order/data_product', [
                            'order' => $order
                        ]);
                        ?>
                        <tr>
                            <td colspan="6">&nbsp;</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">Total Before VAT:</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($order->totalExVat, 2); ?></td>
                        </tr>

                        <!--
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลด/Discount(3.00%) :</td>
                            <td class="bg-purchase-order"> - </td>
                        </tr>
                        -->
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">VAT 7%: </td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($order->vat, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">Discount Coupons:</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($order->total, 2); ?></td>
                        </tr>
                        <!--<tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลดพิเศษ / Extra Saving :</td>
                            <td class="bg-purchase-order text-right"><//?php echo number_format($order->discount, 2); ?></td>
                        </tr>-->
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">Shipping:</td>
                            <td class="bg-purchase-order text-right"><?php echo ($order->shippingRate > 0) ? number_format($order->shippingRate, 2) : "Free"; ?></td>
                        </tr>
                        <tr >
                            <td colspan="6" class="text-right" class="foorter-purchase-order">Order Total:</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($order->summary, 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>



