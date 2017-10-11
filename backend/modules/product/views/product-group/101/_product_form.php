<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
?>
<?php
$form = ActiveForm::begin([
            'id' => 'product-form',
            'enableClientValidation' => FALSE,
            'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-9">{input}</div>',
                'labelOptions' => [
                    'class' => 'col-sm-3 control-label'
                ]
            ]
        ]);
?>
<div class="product-group-form">



    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">Product <?= $model->title; ?> Edit</h3></span>
        </div>
        <div class="panel-body">

            <?= $form->errorSummary($model) ?>

            <?//= $form->field($model, 'productGroupTemplateId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(common\models\costfit\ProductGroupTemplate::find()->all(), 'productGroupTemplateId', 'title'), ['prompt' => '-- Select Option Template --']) ?>

            <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]); ?>

            <div class="row form-group field-product-title required has-success">
                <label class="col-sm-3 control-label" for="product-title">Option</label>
                <div class="col-sm-9">
                    <?php
                    $options = \common\models\costfit\ProductGroupOptionValue::find()->where("productId =" . $model->productId . " AND productSuppId IS NULL")->all();
                    $optionStr = "";
                    foreach ($options as $option) {
                        $optionStr.= $option->productGroupOption->name . "-" . $option->value . "<br>";
                    }
                    echo $optionStr;
                    ?>
                </div>
            </div>

            <?php
            //echo Html::hiddenInput('input-type-1', $model->categoryId, ['id' => 'input-type-1']);
            //echo Html::hiddenInput('input-type-2', $model->categoryId, ['id' => 'input-type-2']);
            echo $form->field($model, 'categoryId')->widget(kartik\select2\Select2::classname(), [
//            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
                'data' => common\models\costfit\search\Category::findCategoryArrayWithMultiLevelBackend(),
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

            <?= $form->field($model, 'isbn', ['options' => ['class' => 'row form-group']])->textInput(); ?>

            <?php
            echo $form->field($model, 'shortDescription')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                    'contentsLangDirection' => 'th',
                    'height' => 400,
                    'filebrowserBrowseUrl' => 'browse-images',
                    'filebrowserUploadUrl' => 'upload-images',
                    //'extraPlugins' => ['imageuploader', 'image2'],
                    'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
                ],
            ]);
            ?>


            <?php
            echo $form->field($model, 'description')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                    'contentsLangDirection' => 'th',
                    'height' => 400,
                    'filebrowserBrowseUrl' => 'browse-images',
                    'filebrowserUploadUrl' => 'upload-images',
                    //'extraPlugins' => ['imageuploader', 'image2'],
                    'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
                ],
            ]);
            ?>


            <?php
            echo $form->field($model, 'specification')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                    'contentsLangDirection' => 'th',
                    'height' => 400,
                    'filebrowserBrowseUrl' => 'browse-images',
                    'filebrowserUploadUrl' => 'upload-images',
                    //'extraPlugins' => ['imageuploader', 'image2'],
                    'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
                ],
            ]);
            ?>

            <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15])->label("Market Price"); ?>

            <!--            <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading"  >
                                        <span class="panel-title"><h3 >Product Supplier</h3></span>
                                    </div>
                                    <div class="panel-body">
                                        <?//= $form->field($prodSupp, 'quantity', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15])->label("Stock"); ?>
                                        <?//= $form->field($prodPriceSupp, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15])->label("Selling Price"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>-->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    echo $this->render("_image_grid", ['id' => $model->productId]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <?php
                    echo $this->render("_image_form", ["id" => $model->productId]);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>

            <div id="actionBtn" style="position:fixed;bottom:5px;right:20px;margin:0;padding:5px 3px;background-color: rgba(224,224,224,0.8);text-align: center;border: 3px green solid">
                <a class="pull-right" style="margin:0;color:red" onclick="$('#actionBtn').hide()" ><i class="glyphicon glyphicon-remove"></i></a>
                <h3 style=""><?= $model->isNewRecord ? 'Create' : 'Update' ?> My Product ?</h3>
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php $this->registerJs("
         /*  init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#product-description').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    },toolbar: [
                        ['fontsize', ['fontsize']]
                      ],
                    fontNames: ['Maledpan', 'Tahoma', 'Arial Unicode MS', 'MS Gothic', 'Helvetica', 'sans-serif'],
                      fontNamesIgnoreCheck: ['Maledpan', 'Tahoma']
                });
                $('#product-specification').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    },toolbar: [
                        ['fontsize', ['fontsize']]
                      ],
                    fontNames: ['Maledpan', 'Tahoma', 'Arial Unicode MS', 'MS Gothic', 'Helvetica', 'sans-serif'],
                      fontNamesIgnoreCheck: ['Maledpan', 'Tahoma']
                });
            }

        });*/

", \yii\web\View::POS_END); ?>