<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'รายงานสินค้าที่ต้องส่งล่วงหน้า 7 วัน';
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><h4><?= $this->title ?></h4></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php
                $form = ActiveForm::begin([
                    'method' => 'GET',
                    'options' => [
                        'class' => 'hide'
                    ]
                ]);
                ?>
                <div class="col-lg-3">
                    <?=
                    DatePicker::widget(['name' => 'fromDate',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['placeholder' => 'From Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'language' => 'en',
                        ],
                        'value' => isset($_GET['fromDate']) ? $_GET['fromDate'] : NULL
                    ])
                    ?>
                </div>
                <div class="col-lg-3">
                    <?=
                    DatePicker::widget(['name' => 'toDate',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['placeholder' => 'To Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'language' => 'en',
                        ],
                        'value' => isset($_GET['toDate']) ? $_GET['toDate'] : NULL
                    ])
                    ?>
                </div>
                <div class="col-lg-2">
                    <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true">  ค้นหา</i>', ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <br>
            <?php
            $form = ActiveForm::begin([
                'method' => 'POST',
                'options' => [
                    'id' => 'sp-form'
                ]
            ]);
            ?>
            <?php if (isset($message)): ?>
                <h4 style="color:red"><?= $message ?></h4>
            <?php endif; ?>
            <table class="table table-list-order" style="width: 70%">
                <thead>
                    <tr style="background-color: #ccffcc;text-align: center;font-weight: bold;vertical-align: central;">
                        <td>ลำดับ</td>
                        <td>Supplier</td>
                        <td>สินค้า</td>
                        <td>จำนวน</td>
                        <td>วันจะส่ง</td>
                        <td>วันคงเหลือที่จะส่ง</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $total = 0;
                    if (isset($model) && count($model) > 0):
                        foreach ($model as $pView):
                            if (!isset($pView->storeProductId)) {
                                ?>
                                <tr style="text-align: center;" class="<?= ($pView->remainDay <= 3) ? " danger" : (($pView->remainDay <= 5) ? " warning" : "") ?>">
                                    <td><?= $i . " " . $pView->storeProductId ?></td>
                                    <td>
                                        <?=
                                        Html::dropDownList("supplier[$pView->orderItemId][$pView->productId][$pView->sumQuantity]", NULL, yii\helpers\ArrayHelper::map(common\models\costfit\SupplierProduct::getAllSupplierWhereProductId($pView->productId), function($model) {
                                            return $model->supplierId;
                                        }, function($model) {
                                            return $model->supplier->name . " เวลาจัดส่ง " . $model->leaseTime . " วัน จำนวนมากสุด " . $model->maxQuantity . " ชิ้น";
                                        }), ['prompt' => '-- เลือก Supplier --', 'class' => 'form-control'])
                                        ?>
                                    </td>
                                    <td style="text-align: left"><?= $pView->product->title ?></td>
                                    <td><?= $pView->sumQuantity ?></td>
                                    <td><?= $this->context->dateThai($pView->sendDateTime, 1) ?></td>
                                    <td><?= $pView->remainDay ?> วัน</td>

                                </tr>
                                <?php
//                        $total+=$order->summary;
                                $i++;
                            }
                        endforeach;
                    else:
                        ?>
                        <tr style="border: 1px gray solid;text-align: center">
                            <td colspan="5">ไม่มีรายการ</td>
                        </tr>
                    <?php
                    endif;
                    ?>
<!--                    <tr>
<td colspan="4" style="text-align: right;"><b>TOTAL </b></td>
<td style="text-align: right;"><b><?//= number_format($total, 2) ?></b></td>
<td></td>
</tr>-->
                    <tr>
                        <td></td>
                        <td colspan="5"><?= Html::submitButton("สั่งซื้อ", ['class' => 'btn btn-success']) ?>
                            <span style="color:red">***กรุณาเลือก Supplier ต้านบนเพื่อ เปิด PO สั่งซื้อ</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>