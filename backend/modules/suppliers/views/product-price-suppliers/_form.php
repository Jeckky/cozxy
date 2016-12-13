<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use yii\grid\GridView;
use common\models\costfit\ProductSuppliers;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPriceSuppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-price-suppliers-form">

    <?php
    $form = ActiveForm::begin([
        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-3 control-label'
            ]
        ]
    ]);
    ?>
    <div class="  col-sm-6">
        <div class="panel-heading">
            <span class="panel-title"><?= $title ?></span>
        </div>

        <div class="panel-body">
            <?= $form->errorSummary($model) ?>

            <?//= $form->field($model, 'productSuppId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ProductSuppliers::find()->all(), 'productSuppId', 'title'), ['prompt' => '-- Select Product --']) ?>
            <?php
            /*
              echo $form->field($model, 'productSuppId')->widget(kartik\select2\Select2::classname(), [
              'data' => yii\helpers\ArrayHelper::map(common\models\costfit\ProductSuppliers::find()->all(), 'productSuppId', 'title'),
              'pluginOptions' => [
              'loadingText' => '-- Select Product Suppliers --',
              ],
              'options' => [
              'placeholder' => 'Select Product Suppliers ...',
              'id' => 'unitId',
              'class' => 'required'
              ],
              ])->label('Product Suppliers'); */
            echo $form->field($model, 'productSuppId')->hiddenInput(['value' => $_GET['productSuppId']])->label(false);
            ?>
            <?//= $form->field($model, 'quantity', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 5]) ?>
            <?php
            if ($status == 'update') {
                //echo 'update';
                ?>
                <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15, 'readonly' => true]) ?>
            <?php } else { ?>
                <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15, 'onkeypress' => 'suppliersCreatePrice(this.value,' . $_GET['productSuppId'] . ')', 'onkeyup' => 'suppliersCreatePrice(this.value,' . $_GET['productSuppId'] . ')']) ?>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 suppliersCreatePrice note note-info hidden" style="margin-bottom: 10px; font-size: 20px; "></div>
                </div>
            <?php } ?>
            <?= $form->field($model, 'discountType', ['options' => ['class' => 'row form-group']])->dropDownList($model->getDiscountTypeArray(), ['prompt' => '-- Select Discount Type --']) ?>

            <?//= $form->field($model, 'discountValue', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

            <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <a class="btn wizard-prev-step-btn  btn-lg" href="/suppliers/product-suppliers">Prev</a>
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-success btn-lg']) ?>
                    <a class="btn btn-primary wizard-next-step-btn  btn-lg" href="/suppliers/product-suppliers/image-form?productSuppId=<?= $_GET['productSuppId'] ?>">Skip to upload images</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel-heading">
            <span class="panel-title">ลำดับราคา :: Suppliers</span>
        </div>

        <div class="panel-heading">
            เงื่อนไขเขียนโปรแกรม <br><br>
            1. ก่อนหน้าเค้ากี่ชิ้น <br>
            2. ลำดับปัจจุบันเค้า <br>
            3. ลำดับราคาปัจจุบัน :: ขายต่อวัน ถ้า 7 วันไม่มี ไปเฉลีย 14 ถ้า 14 ไม่มีไปเฉลีย 1 เดือน
            <br>** อยู่ในประเภทเดียวกัน Product เดียวกัน <br><br>
        </div>
        <div class="panel-body">

            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $rankingPrice,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'rowOptions' => function ($model, $index, $widget, $grid) {

                    if ($model->userId == Yii::$app->user->identity->userId) {
                        return ['class' => 'success'];
                    }
                },
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'priceSuppliers',
                        'value' => function($model) {
                            return $model->priceSuppliers . ' บาท';
                        }
                    ],
                    [
                        'attribute' => 'quantity',
                        'value' => function($model) {
                            return $model->quantity . ' ชิ้น';
                        }
                    ],
                    [
                        'attribute' => 'จำนวนที่ขายได้',
                        'value' => function($model) {
                            $order = common\models\costfit\OrderItem::find()
                            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
                            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
                            ->where('order_item.productId=' . $model->productSuppId . ' and order.status >= 5')->count('order_item.productId');
                            return $order . ' ชิ้น';
                        }
                    ],
                    [
                        'attribute' => 'จำนวนสินค้าคงเหลือ',
                        'value' => function($model) {
                            $order = common\models\costfit\OrderItem::find()
                            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
                            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
                            ->where('order_item.productId=' . $model->productSuppId . ' and order.status >= 5')->count('order_item.productId');
                            return $model->quantity - $order . ' ชิ้น';
                        }
                    ],
                    [
                        'attribute' => 'createDateTime',
                        'format' => 'raw',
                        'value' => function($model) {
                            if ($model->createDateTime == '0000-00-00 00:00:00') {
                                return '';
                            } else {
                                return $this->context->dateThai($model->createDateTime, 1, TRUE);
                            }
                        }
                    ],
                ],
            ]);
            ?>
        </div>
        <div class="panel-heading">
            รายการที่ขายได้
        </div>
        <div class="panel-body">
            <?php
            if ($productLastDay->conutProduct != 0) {
                echo ' จำนวนสินค้าที่ขายได้ล่าสุด <br>&nbsp;&nbsp;-<code>' . $productLastDay->conutProduct . ' ชิ้น ,' . $productLastDay->summaryPrice . ' บาท</code> ,'
                . 'เฉลี่ยจำนวนชิ้นที่ขาย ' . number_format($productLastDay->avgNum, 2) . ' ชิ้น/วัน</code><br><br>';
            } else {
                if ($productLastWeek->conutProduct != 0) {
                    echo 'จำนวนสินค้าที่ขายได้ภายใน 7 วัน <br>&nbsp;&nbsp;-<code>' . $productLastWeek->conutProduct . ' ชิ้น ,' . $productLastWeek->summaryPrice . ' บาท ,'
                    . 'เฉลี่ยจำนวนชิ้นที่ขาย ' . number_format($productLastWeek->avgNum, 2) . ' ชิ้น/วัน</code><br><br>';
                } else {
                    if ($product14LastWeek->conutProduct != 0) {
                        echo 'จำนวนสินค้าที่ขายได้ภายใน 14 วัน <br>&nbsp;&nbsp;-<code>' . $product14LastWeek->conutProduct . ' ชิ้น ,' . $product14LastWeek->summaryPrice . ' บาท ,'
                        . 'เฉลี่ยจำนวนชิ้นที่ขาย ' . number_format($product14LastWeek->avgNum, 2) . ' ชิ้น/วัน</code><br><br>';
                    } else {
                        if ($orderLastMONTH->conutProduct != 0) {
                            echo 'จำนวนสินค้าที่ขายได้ภายใน 1 เดือน <br>&nbsp;&nbsp;-<code>' . $orderLastMONTH->conutProduct . ' ชิ้น ,' . $orderLastMONTH->summaryPrice . ' บาท ,'
                            . 'เฉลี่ยจำนวนชิ้นที่ขาย ' . number_format($orderLastMONTH->avgNum, 2) . ' ชิ้น/วัน</code><br><br>';
                        } else {
                            echo '<code>ไม่พบข้อมูล</code>';
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs("
           init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#productpricesuppliers-description').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            }
        });

", \yii\web\View::POS_END); ?>