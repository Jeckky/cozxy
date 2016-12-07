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
                echo 'update';
                ?>
                <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15, 'readonly' => true]) ?>
            <?php } else { ?>
                <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>
            <?php } ?>
            <?= $form->field($model, 'discountType', ['options' => ['class' => 'row form-group']])->dropDownList($model->getDiscountTypeArray(), ['prompt' => '-- Select Discount Type --']) ?>

            <?//= $form->field($model, 'discountValue', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

            <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <a class="btn wizard-prev-step-btn  btn-lg" href="/suppliers/product-suppliers">Prev</a>
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
                    <a class="btn btn-primary wizard-next-step-btn  btn-lg" href="/suppliers/product-suppliers/image-form?productSuppId=<?= $_GET['productSuppId'] ?>">Skip</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel-heading">
            <span class="panel-title">เทียบลำดับราคา :: Suppliers</span>
        </div>

        <div class="panel-heading">
            <?php
            $data = [
                //"red" => "วันนี้",
                "fastest" => "7 วันล่าสุด",
                "late" => "1 เดือนที่ผ่านมา",
                "slowest" => "3 เดือนที่ผ่านมา",
            ];

            echo kartik\select2\Select2::widget([
                'name' => 'userId',
                // 'value' => ['THA'], // initial value
                'data' => $data,
                'options' => ['placeholder' => 'Select or Search ...', 'id' => 'userSuppliers'], //, 'onchange' => 'this.form.submit()'
                'pluginOptions' => [
                    'tags' => true,
                    'placeholder' => 'Select or Search ...',
                    'loadingText' => 'Loading  ...',
                    'initialize' => true,
                ],
            ]);
            ?>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $rankingPrice,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'productPriceId',
                    //'productSuppId',
                    //'quantity',
                    'price',
                    //'discountType',
                    [
                        'attribute' => 'discountType',
                        'value' => function($model) {
                            return $model->getDiscountTypeText($model->discountType);
                        }
                    ], /*
                      [
                      'attribute' => 'status',
                      'format' => 'html',
                      'value' => function($model) {
                      if ($model->status == 1) {
                      $status = '<span class="label label-success">enable</span>';
                      } else {
                      $status = '<span class="label label-danger">disable</span>';
                      }
                      return $status;
                      }
                      ], */
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