<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\User;
use common\models\costfit\ProductGroup;
use common\models\costfit\Brand;
use common\models\costfit\Category;
use yii\redactor\widgets\Redactor;

//use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductSuppliers */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .dropzone {
        position: relative;
        min-height: 284px;
        border: 3px dashed #ddd;
        border-radius: 3px;
        vertical-align: middle;
        width: 100%;
        cursor: pointer;
        padding: 0 15px 15px 0;
        -webkit-transition: all .2s;
        transition: all .2s;
    }
</style>
<div class="product-suppliers-form">
    <!-- Light info -->
    <div class="panel panel-info" style="margin-bottom: 0px;">
        <div class="panel-heading">
            <span class="panel-title">ค้นหา - Products จากระบบ</span>
            <div class="panel-heading-controls">
                <div class="panel-heading-icon"><i class="fa fa-inbox"></i></div>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-sm-3 text-right"><label class="control-label">ค้นหาจาก : Products System</label></div>
            <div class="col-sm-9 productIdSystemDiv">
                <?php
                //echo '<label class="control-label">Provinces</label>';
                echo kartik\select2\Select2::widget([
                    'name' => 'Products[countryId] ',
                    // 'value' => ['THA'], // initial value
                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Product::find()->all(), 'productId', 'title'),
                    'options' => ['placeholder' => 'Select Products System ...', 'id' => 'productIdSystem', 'onchange' => 'suppliers(this.value)'],
                    'pluginOptions' => [
                        'tags' => true,
                        'placeholder' => 'Select...',
                        'loadingText' => 'Loading Products System ...',
                        'initialize' => true,
                    ],
                ]);
                ?>
            </div>
        </div>
    </div> <!-- / .panel -->
    <?php
    $form = ActiveForm::begin([
        //'action' => '&xxx=11&cccc55',
        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-3 control-label  '
            ]
        ]
    ]);
    ?>

    <div class="panel-heading">
        <span class="panel-title">ค้นหาจาก Products System หรือ New <?= $title ?></span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>

        <div class="form-group col-sm-12 text-center">
            <duv class="status-system-hidden"></duv>
        </div>
        <?//= $form->field($model, 'productGroupId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ProductGroup::find()->all(), 'productGroupId', 'title'), ['prompt' => '-- Select ProductGroup --']) ?>
        <?php
        echo $form->field($model, 'productGroupId')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\ProductGroup::find()->where('userId=' . Yii::$app->user->identity->userId)->all(), 'productGroupId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Product group --',
            //'params' => ['input-type-1', 'input-type-2']
            ],
            'options' => [
                'placeholder' => 'SelectSelect Product group ...',
                'id' => 'productGroupId',
                'class' => 'required'
            ],
        ]); //->label('Category');
        ?>
        <?php
        //echo Html::hiddenInput('input-type-1', $model->categoryId, ['id' => 'input-type-1']);
        //echo Html::hiddenInput('input-type-2', $model->categoryId, ['id' => 'input-type-2']);
        echo $form->field($model, 'categoryId')->widget(kartik\select2\Select2::classname(), [
//            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
            'data' => Category::findCategoryArrayWithMultiLevelBackend(),
            'pluginOptions' => [
                'loadingText' => '-- Select Category System --',
            //'params' => ['input-type-1', 'input-type-2']
            ],
            'options' => [
                'placeholder' => 'Select Category System ...',
                'id' => 'categoryId',
                'class' => 'required'
            ],
        ]); //->label('Category');
        echo $form->field($model, 'brandId')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Brand::find()->all(), 'brandId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Brand --',
            ],
            'options' => [
                'placeholder' => 'Select Brand ...',
                'id' => 'brandId',
                'class' => 'required'
            ],
        ]); //->label('Brand');
        ?>
        <?//= $form->field($model, 'categoryId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Category::find()->all(), 'categoryId', 'title'), ['prompt' => '-- Select Category --']) ?>

        <?= $form->field($model, 'suppCode', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'merchantCode', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'isbn', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?//= $form->field($model, 'code', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'optionName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'shortDescription', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

        <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

        <?= $form->field($model, 'specification', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

        <?= $form->field($model, 'width', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15, 'value' => isset($model->width) ? $model->width : '0']) ?>

        <?= $form->field($model, 'height', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15, 'value' => isset($model->height) ? $model->height : '0']) ?>

        <?= $form->field($model, 'depth', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15, 'value' => isset($model->depth) ? $model->depth : '0']) ?>

        <?= $form->field($model, 'weight', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15, 'value' => isset($model->weight) ? $model->weight : '0']) ?>

        <?//= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'quantity', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15, 'value' => isset($model->quantity) ? $model->quantity : '0']) ?>

        <?php
        echo $form->field($model, 'unit')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Unit::find()->all(), 'unitId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Unit --',
            ],
            'options' => [
                'placeholder' => 'Select Unit ...',
                'id' => 'unitId',
                'class' => 'required'
            ],
        ]); //->label('Unit');
        /* echo $form->field($model, 'smallUnit')->widget(kartik\select2\Select2::classname(), [
          'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Unit::find()->all(), 'unitId', 'title'),
          'pluginOptions' => [
          'loadingText' => '-- Select Small Unit --',
          ],
          'options' => [
          'placeholder' => 'Select Small Unit ...',
          'id' => 'smallUnit',
          'class' => 'required'
          ],
          ]); //->label('Small Unit');
         * */
        ?>
        <?php
        echo $form->field($model, 'warrantyType')->widget(kartik\select2\Select2::classname(), [
//            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\WarrantyType::find()->all(), 'warrantyTypeId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Warranty Type --',
            //'params' => ['input-type-1', 'input-type-2']
            ],
            'options' => [
                'placeholder' => 'Select Warranty Type ...',
                'id' => 'WarrantyType',
                'class' => 'required'
            ],
        ]); //->label('Category');
        echo $form->field($model, 'warrantyPeriod')->widget(kartik\select2\Select2::classname(), [
//            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\WarrantyPeriod::find()->all(), 'warrantyPeriodId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Category System --',
            //'params' => ['input-type-1', 'input-type-2']
            ],
            'options' => [
                'placeholder' => 'Select Warranty Period ...',
                'id' => 'WarrantyPeriod',
                'class' => 'required'
            ],
        ]); //->label('Category');
        ?>
        <?= $form->field($model, 'tags', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 255]) ?>
        <?= $form->field($model, 'url', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 255])->label('url รูปเว็ปเจ้าของแบรนด์') ?>

        <br>
        <div class="form-group col-sm-12 text-center">
            <duv class="product-system-hidden">
                <input type="hidden" name="productIds" id="productIds" value="">
                <input type="hidden" name="approve" id="approve" value="new">
            </duv>
        </div>
        <div class="form-group col-sm-12 text-right">
            <input type="hidden" name="CategoryId" id="CategoryId" value="<?php echo isset($_GET['CategoryId']) ? $_GET['CategoryId'] : NULL ?>">
            <input type="hidden" name="BrandId" id="BrandId" value="<?php echo isset($_GET['BrandId']) ? $_GET['BrandId'] : NULL ?>">
            <?= Html::submitButton($model->isNewRecord ? 'Next step' : 'Update', [ 'class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php $this->registerJs("
           init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#productsuppliers-shortdescription').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
                $('#productsuppliers-description').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    } 
                });
                $('#productsuppliers-specification').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            }

        });

", \yii\web\View::POS_END); ?>

</div>
