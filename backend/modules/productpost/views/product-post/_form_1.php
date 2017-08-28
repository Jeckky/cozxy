<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\ProductSupp;
use common\models\costfit\ProductSelf;
use common\models\costfit\Brand;
use common\models\costfit\User;
use yii\helpers\Url;
//use dosamigos\ckeditor\CKEditor;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-post-form">

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

        <?//= $form->field($model, 'productSuppId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(\common\models\costfit\ProductSuppliers::find()->all(), 'productSuppId', 'title'), ['prompt' => '-- Select ProductSupp --']) ?>

        <?//= $form->field($model, 'productSelfId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ProductSelf::find()->all(), 'productSelfId', 'title'), ['prompt' => '-- Select ProductSelf --']) ?>

        <?//= $form->field($model, 'brandId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Brand::find()->all(), 'brandId', 'title'), ['prompt' => '-- Select Brand --']) ?>

        <?//= $form->field($model, 'userId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(User::find()->all(), 'userId', 'title'), ['prompt' => '-- Select User --']) ?>

        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 150]) ?>

        <?//= $form->field($model, 'shortDescription', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

        <?php
//или c ActiveForm

        echo $form->field($model, 'description')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]);
        ?>

        <?//=
        $form->field($model, 'description')->widget(CKEditor::className(), [
        'preset' => 'custom',
        'clientOptions' => [
        'toolbar' => [
        [
        'name' => 'row1',
        'items' => [
        'Source', '-',
        'Bold', 'Italic', 'Underline', 'Strike', '-',
        'Subscript', 'Superscript', 'RemoveFormat', '-',
        'TextColor', 'BGColor', '-',
        'NumberedList', 'BulletedList', '-',
        'Outdent', 'Indent', '-', 'Blockquote', '-',
        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'list', 'indent', 'blocks', 'align', 'bidi', '-',
        'Link', 'Unlink', 'Anchor', '-',
        'ShowBlocks', 'Maximize', 'Styles', 'Size'
        ],
        ],
        [
        'name' => 'row2',
        'items' => [
        'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe', '-',
        'NewPage', 'Print', 'Templates', '-',
        'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-',
        'Undo', 'Redo', '-',
        'Find', 'SelectAll', 'Format', 'Font', 'FontSize',
        ],
        ],
        ],
        ],
        ]);
        ?>
        <?//= $form->field($model, 'shopName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?//= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 20]) ?>

        <?//= $form->field($model, 'country', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?//= $form->field($model, 'currency', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= (isset($model->image) && !empty($model->image)) ? Html::img(Yii::$app->homeUrl . substr($model->image, 1), ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : ''; ?>

        <?= $form->field($model, 'image', ['options' => ['class' => 'row form-group']])->fileInput() ?>

        <?= (isset($model->image) && !empty($model->image)) ? Html::hiddenInput((new ReflectionClass($model))->getShortName() . '[imageOld]', $model->image) : ''; ?>
        <input type="hidden" name="ProductPost[userId]" value="0">
        <input type="hidden" name="ProductPost[productSelfId]" value="0">
        <?//= $form->field($model, 'isPublic', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
