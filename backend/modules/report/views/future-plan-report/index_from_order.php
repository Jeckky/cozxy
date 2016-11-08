<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

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
            <ul class="nav nav-tabs">
                <?php
                $planCount = 0;
                foreach ($model as $pView):
                    if (!isset($pView->storeProductId)) {
                        $planCount+=1;
                    }
                endforeach;
                ?>
                <li class="active"><a data-toggle="tab" href="#home">Future Plan <span class="label label-info"><?= $planCount; ?></span></a></li>
                <li ><a  data-toggle="tab" href="#draft">Draft PO <span class="label label-warning"><?= $drafts->getTotalCount(); ?></span></a></li>
                <li><a data-toggle="tab" href="#purchasing">Purchasing PO <span class="label label-success"><?= $purchasings->getTotalCount(); ?></span></a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3>Future Plan</h3>
                    <!--<p>Some content.</p>-->

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
                                $pName = "";
                                foreach ($model as $pView):
                                    $sp = common\models\costfit\StoreProduct::find()->select("sum(quantity) as sumQuantity")->where("productId = $pView->productId AND DATEDIFF(createDateTime,date(NOW())) <=" . \common\models\costfit\OrderItem::FUTURE_DAY_TO_SHOW . " AND status = 1")->groupBy("productId")->one();
                                    if (isset($sp)) {
                                        $orderQuantity = $pView->stockQuantity + $sp->sumQuantity;
                                    } else {
                                        $orderQuantity = $pView->stockQuantity;
                                    }

                                    if ($orderQuantity < $pView->sumQuantity) {
                                        ?>
                                        <?php
                                        if ($pName != $pView->product->title):
                                            $pName = $pView->product->title;
                                            $i = 1;
                                            ?>
                                            <tr>
                                                <th colspan="6" style="font-size:16px"><?= $pName; ?></th>
                                            </tr>
                                        <?php endif; ?>
                                        <tr style="text-align: center;" class="<?= ($pView->remainDay <= 3) ? " danger" : (($pView->remainDay <= 5) ? " warning" : "") ?>">
                                            <td><?= $i . " " . $pView->storeProductId ?></td>
                                            <td>
                                                <?=
                                                Html::dropDownList("supplier[$pView->orderItemId][$pView->productId][$pView->sumQuantity]", NULL, yii\helpers\ArrayHelper::map(common\models\costfit\SupplierProduct::getAllSupplierWhereProductId($pView->productId), function($model) {
                                                    return $model->supplierId;
                                                }, function($model) {
                                                    return $model->supplier->name . " จำนวนมากสุด " . $model->maxQuantity . " ชิ้น ราคา " . $model->price . " บาท";
                                                }, function($model) {
                                                    return "เวลาจัดส่งสินค้า " . $model->leaseTime . " วัน";
                                                }), [ 'class' => 'form-control'])
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
                <div id="draft" class="tab-pane fade">
                    <h3>Draft</h3>
                    <!--<p>Some content in menu 1.</p>-->
                    <?=
                    GridView::widget([
                        'dataProvider' => $drafts,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'ledId',
//
                            'poNo',
                            [
                                'attribute' => 'summary',
                                'format' => 'html',
                                'value' => function($model) {
                                    return number_format($model->summary, 2);
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'html',
                                'value' => function($model) {
                                    return $model->getStatusText($model->status);
                                }
                            ],
                            [
                                'attribute' => 'createDateTime',
                                'format' => 'html',
                                'value' => function($model) {
                                    return $this->context->dateThai($model->createDateTime, 2);
                                }
                            ],
                            // 'createDateTime',
                            // 'updateDateTime',
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'template' => '{purchasing}',
                                'buttons' => [
                                    'purchasing' => function ($url, $model) {
                                        return Html::a('Purchasing', ['purchasing', 'id' => $model->storeProductGroupId], ['class' => 'btn btn-primary', 'target' => "_blank", 'data-pjax' => 0]);
                                    },
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
                <div id="purchasing" class="tab-pane fade">
                    <h3>Purchasing</h3>
                    <!--<p>Some content in menu 2.</p>-->
                    <?=
                    GridView::widget([
                        'dataProvider' => $purchasings,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'ledId',
//
                            'poNo',
                            [
                                'attribute' => 'summary',
                                'format' => 'html',
                                'value' => function($model) {
                                    return number_format($model->summary, 2);
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'html',
                                'value' => function($model) {
                                    return $model->getStatusText($model->status);
                                }
                            ],
                            [
                                'attribute' => 'createDateTime',
                                'format' => 'html',
                                'value' => function($model) {
                                    return $this->context->dateThai($model->createDateTime, 2);
                                }
                            ],
                            // 'createDateTime',
                            // 'updateDateTime',
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'template' => '{print}',
                                'buttons' => [
                                    'print' => function ($url, $model) {
                                        return Html::a('Print', ['print-po-to-pdf', 'id' => $model->storeProductGroupId], ['class' => 'btn btn-primary', 'target' => "_blank", 'data-pjax' => 0]);
                                    },
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
