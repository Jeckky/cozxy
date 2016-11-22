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
            <div class="col-sm-3 text-right"><label class="control-label">Products System</label></div>
            <div class="col-sm-9">
                <?php
                //echo '<label class="control-label">Provinces</label>';
                echo kartik\select2\Select2::widget([
                    'name' => 'Address[countryId]',
                    // 'value' => ['THA'], // initial value
                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Product::find()->all(), 'productId', 'title'),
                    'options' => ['placeholder' => 'Select Products System ...', 'id' => 'productIdSystem'],
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
        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-3 control-label'
            ]
        ]
    ]);
    ?>


    <div class="panel-heading">
        <span class="panel-title"><?= $title ?></span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>

        <?//= $form->field($model, 'userId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(User::find()->all(), 'userId', 'title'), ['prompt' => '-- Select User --']) ?>

        <?//= $form->field($model, 'productGroupId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ProductGroup::find()->all(), 'productGroupId', 'title'), ['prompt' => '-- Select ProductGroup --']) ?>

        <?//= $form->field($model, 'brandId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Brand::find()->all(), 'brandId', 'title'), ['prompt' => '-- Select Brand --']) ?>
        <?php
        echo $form->field($model, 'categoryId')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Category System --',
            ],
            'options' => [
                'placeholder' => 'Select Category System ...',
                'id' => 'categoryId',
                'class' => 'required'
            ],
        ])->label('Category');
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
        ])->label('Brand');
        ?>
        <?//= $form->field($model, 'categoryId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Category::find()->all(), 'categoryId', 'title'), ['prompt' => '-- Select Category --']) ?>

        <?= $form->field($model, 'isbn', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'code', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'optionName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?//= $form->field($model, 'shortDescription', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?//= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?//= $form->field($model, 'specification', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?= $form->field($model, 'width', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'height', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'depth', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'weight', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'unit', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 20]) ?>

        <?= $form->field($model, 'smallUnit', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 20]) ?>

        <?= $form->field($model, 'tags', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 255]) ?>

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
        ])->label('Brand');
        echo $form->field($model, 'smallUnit')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Unit::find()->all(), 'unitId', 'title'),
            'pluginOptions' => [
                'loadingText' => '-- Select Small Unit --',
            ],
            'options' => [
                'placeholder' => 'Select Small Unit ...',
                'id' => 'smallUnit',
                'class' => 'required'
            ],
        ])->label('Brand');
        ?>

        <div class="note note-info uidemo-note">
            <h4>
                อัพโหลดรูปภาพ..
            </h4>
        </div>
        <!-- 49.1. $DROPZONEJS_EXAMPLE =====================================================================

                Example
        -->
        <div class="row">
            <div class="col-md-12">
                <?php
                echo \kato\DropZone::widget([
                    'options' => [
                        'url' => \yii\helpers\Url::to(['upload']),
                        'paramName' => 'image',
                        'maxFilesize' => '200',
                        'clickable' => true,
                        'addRemoveLinks' => true,
                        'enqueueForUpload' => true,
                        'dictDefaultMessage' => "<h1><i class='fa fa-cloud-upload'></i><br>Drop files in here<h1><br><span class='dz-text-small'>or click to pick manually</span>",
                    ],
                    'clientEvents' => [
                        'sending' => "function(file, xhr, formData) {
                                            //console.log(file);
                                    }",
                        'complete' => "function(file){console.log(file)}",
                        'removedfile' => "function(file){alert(file.name + ' is removed')}"
                    ],
                ]);
                ?>

            </div>
        </div>
        <!--
        <div class="row">
            <a id="uidemo-dropzonejs-example" href="#uidemo-dropzonejs-example" class="header-2">Example</a>
            <div class="col-md-12">
                <div id="dropzonejs-example" class="dropzone-box">
                    <div class="dz-default dz-message">
                        <i class="fa fa-cloud-upload"></i>
                        Drop files in here<br><span class="dz-text-small">or click to pick manually</span>
                    </div>
                    <form action="upload-image">
                        <div class="fallback">
                            <input name="file" type="file" multiple="" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        -->
        <br><br><br>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
