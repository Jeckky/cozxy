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

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductSuppliers */
/* @var $form yii\widgets\ActiveForm */
$countryId = rand(0, 9999);
$stateId = rand(0, 9999);
$cityId = rand(0, 9999);
$districtId = rand(0, 9999);
?>

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

        //http://demos.krajee.com/widget-details/select2
        ?>
        <?//= $form->field($model, 'categoryId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Category::find()->all(), 'categoryId', 'title'), ['prompt' => '-- Select Category --']) ?>
        <?php
        //http://demos.krajee.com/widget-details/select2
        ?>
        <?= $form->field($model, 'isbn', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'code', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'optionName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'shortDescription', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?= $form->field($model, 'specification', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?= $form->field($model, 'width', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'height', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'depth', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'weight', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'unit', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 20]) ?>

        <?= $form->field($model, 'smallUnit', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 20]) ?>

        <?= $form->field($model, 'tags', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 255]) ?>
        <div class="row">
            <a id="uidemo-dropzonejs" href="#uidemo-dropzonejs" class="header-1">Dropzone.js</a>
        </div>

        <div class="note note-info uidemo-note">More info and examples at <a href="http://www.dropzonejs.com" target="_blank">http://www.dropzonejs.com</a></div>

        <!-- 49.1. $DROPZONEJS_EXAMPLE =====================================================================

                Example
        -->
        <!-- Javascript -->
        <script>
            init.push(function () {
                $("#dropzonejs-example").dropzone({
                    url: "//dummy.html",
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 0.5, // MB

                    addRemoveLinks: true,
                    dictResponseError: "Can't upload file!",
                    autoProcessQueue: false,
                    thumbnailWidth: 138,
                    previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',
                    resize: function (file) {
                        var info = {srcX: 0, srcY: 0, srcWidth: file.width, srcHeight: file.height},
                        srcRatio = file.width / file.height;
                        if (file.height > this.options.thumbnailHeight || file.width > this.options.thumbnailWidth) {
                            info.trgHeight = this.options.thumbnailHeight;
                            info.trgWidth = info.trgHeight * srcRatio;
                            if (info.trgWidth > this.options.thumbnailWidth) {
                                info.trgWidth = this.options.thumbnailWidth;
                                info.trgHeight = info.trgWidth / srcRatio;
                            }
                        } else {
                            info.trgHeight = file.height;
                            info.trgWidth = file.width;
                        }
                        return info;
                    }
                });
            });
        </script>
        <!-- / Javascript -->

        <div class="row">
            <a id="uidemo-dropzonejs-example" href="#uidemo-dropzonejs-example" class="header-2">Example</a>
            <div class="col-md-12">
                <div id="dropzonejs-example" class="dropzone-box">
                    <div class="dz-default dz-message">
                        <i class="fa fa-cloud-upload"></i>
                        Drop files in here<br><span class="dz-text-small">or click to pick manually</span>
                    </div>
                    <form action="//dummy.html">
                        <div class="fallback">
                            <input name="file" type="file" multiple="" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
