<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>


<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <!--Support-->
    <section class="support">
        <div class="row">
            <div class = "col-sm-12 pull-right" style="margin-bottom: 5px">
                <?php if (Yii::$app->controller->action->id != 'print-po-to-pdf'): ?>
                    <a href="<?php echo Yii::$app->homeUrl; ?>report/future-plan-report/print-po-to-pdf?id=<?php echo $model->storeProductGroupId; ?>" class="btn btn-primary btn-xs" target="_blank">
                        <i class="fa fa-print" aria-hidden="true"></i> พิมพ์</a>
                <?php endif; ?>
            </div>
        </div>
        <table class="table" style="width:100%;<?= (Yii::$app->controller->action->id == 'print-po-to-pdf') ? "font-size:9px;" : "" ?>">
            <tr>
                <td style="width:50%">
                    <table class="table" style="width:100%">
                        <tbody>
                            <tr>
                                <th style="line-height: 15px;text-align: left;font-weight: bold;border: 0px">
                                    ชื่อผู้ขาย / Vendor Name: <span style="font-weight: normal"><?= $model->supplier->name; ?></span>
                                </th>
                            </tr>
                            <tr>
                                <th style="line-height: 15px;text-align: left;font-weight: bold;border: 0px">
                                    ที่อยู่ / Address:
                                </th>
                            </tr>
                            <tr>
                                <td style="line-height: 15px;text-align: left">
                                    <?= $model->supplier->address; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width:50%">
                    <table class="table" style="width:100%">
                        <tbody>
                            <tr>
                                <th style="line-height: 15px;text-align: left;font-weight: bold;border: 0px">
                                    เลขที่ใบสั่งซื้อ /PO No. : <span style="font-weight: normal"><?php echo $model->poNo; ?></span>
                                </th>
                            </tr>
                            <tr>
                                <th style="line-height: 15px;text-align: left;font-weight: bold;border: 0px">
                                    วันที่ / Date : <span style="font-weight: normal"><?= $this->context->dateThai($model->createDateTime, 2); ?></span>
                                </th>
                            </tr>
                            <tr>
                                <th style="line-height: 15px;text-align: left;font-weight: bold;border: 0px">
                                    ใบขอซื้อเลขที่ / FR. No. :
                                </th>
                            </tr>
                            <tr>
                                <th style="line-height: 15px;text-align: left;font-weight: bold;border: 0px">
                                    ระหว่างเวลาชำระเงิน / Credit Term:
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class = "col-lg-12 col-md-12 ">
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
                        $itemPerPage = 20;
                        $page = 1;
                        $i = 0;
                        if (count($model->storeProducts) > 0) {
                            $num = 0;
                            $storeProducts = common\models\costfit\StoreProduct::find()->select("*,SUM(quantity) as sumQuantity")->where("storeProductGroupId=" . $model->storeProductGroupId)->groupBy("productId")->all();
                            foreach ($storeProducts as $value) {
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
                                    <td style="font-size: 12px;text-align: right"><?php echo number_format($value->price, 2); ?></td>
                                    <td style="font-size: 12px;text-align: right"><?php echo $value->sumQuantity ?></td>
                                    <td style="font-size: 12px;width: 15%;text-align: right" ><?php echo number_format($value->price * $value->sumQuantity, 2); ?></td>
                                </tr>
                                <?php
                                $i = $i++;
                                ?>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" class="text-center">ไม่พบข้อมูล</td>
                            </tr>
                            <?php
                        }
                        ?>
                        <?php
                        if ($i <= $itemPerPage):
                            for ($j = $i; $j <= $itemPerPage; $j++):
                                $bg_even_number = '#fff';  // เลขคู่
                                $bg_odd_number = '#f5f5f5';  // เลขคี่
                                if ($j % 2 == 0) {
                                    $bg = $bg_even_number;
                                } else if ($j % 2 == 1) {
                                    $bg = $bg_odd_number;
                                }
                                ?>
                                <tr style="padding: 5px; background-color: <?php echo $bg; ?>;" >
                                    <td style="font-size: 12px;">&nbsp;</td>
                                    <td style="font-size: 12px;"></td>
                                    <td style="font-size: 12px;"></td>
                                    <td style="font-size: 12px;"></td>
                                    <td style="font-size: 12px;"></td>
                                    <td style="font-size: 12px;"></td>
                                    <td style="font-size: 12px;width: 15%;text-align: right" ></td>
                                </tr>

                                <?php
                            endfor;
                            ?>
                            <?php
                        endif;
                        ?>
<!--                        <tr>
<td colspan="6">&nbsp;</td>
<td >&nbsp;</td>
</tr>-->
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าไม่รวมภาษี/Sub Total excluded VAT :</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($model->summary * 0.93, 2); ?></td>
                        </tr>
                        </tr>

                        <!--
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลด/Discount(3.00%) :</td>
                            <td class="bg-purchase-order"> - </td>
                        </tr>
                        -->
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ภาษีมูลค่าเพิ่ม/VAT 7 % :</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($model->summary * 0.07, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">รวมทั้งสิ้น / Total :</td>
                            <td class="bg-purchase-order text-right"><?php echo number_format($model->summary, 2); ?></td>
                        </tr>
    <!--                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ส่วนลดพิเศษ / Extra Saving :</td>
                            <td class="bg-purchase-order text-right"><?php // echo number_format($model->discount, 2);                                                                                                                                                                      ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ค่าจัดส่ง / Shipping :</td>
                            <td class="bg-purchase-order text-right"><?php // echo ($model->shippingRate > 0) ? number_format($model->shippingRate, 2) : "Free";                                                                                                                                                                      ?></td>
                        </tr>
                        <tr >
                            <td colspan="6" class="text-right" class="foorter-purchase-order">ราคาสินค้าที่ต้องชำระเงินรวมภาษีมูลค่าเพิ่ม/Total excluded VAT :</td>
                            <td class="bg-purchase-order text-right"><?php // echo number_format($model->summary, 2);                                                                                                                                                                      ?></td>
                        </tr>-->

                    </tbody>
                </table>
            </div>
        </div>
    </section><!--Support Close-->
</div>


