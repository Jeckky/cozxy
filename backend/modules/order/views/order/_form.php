<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\areawow\User;
use common\models\areawow\BillingCountry;
use common\models\areawow\BillingProvince;
use common\models\areawow\BillingAmphur;
use common\models\areawow\ShippingCountry;
use common\models\areawow\ShippingProvince;
use common\models\areawow\ShippingAmphur;
use mihaildev\ckeditor\CKEditor;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

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

        <?= $form->field($model, 'userId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(User::find()->all(), 'userId', 'title'), ['prompt' => '-- Select User --']) ?>

        <?php
        echo $form->field($model, 'token')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                'contentsLangDirection' => 'th',
                'height' => 400,
                //'filebrowserBrowseUrl' => 'browse-images',
                //'filebrowserUploadUrl' => 'upload-images',
                //'extraPlugins' => ['imageuploader', 'image2'],
                'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
            ],
        ]);
        ?>

        <?= $form->field($model, 'orderNo', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <?= $form->field($model, 'invoiceNo', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <?= $form->field($model, 'totalExVat', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'vat', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'total', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'discount', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'grandTotal', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'shippingRate', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'summary', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'sendDate', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?= $form->field($model, 'billingCompany', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'billingTax', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <?php
        echo $form->field($model, 'billingAddress')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                'contentsLangDirection' => 'th',
                'height' => 400,
                //'filebrowserBrowseUrl' => 'browse-images',
                //'filebrowserUploadUrl' => 'upload-images',
                //'extraPlugins' => ['imageuploader', 'image2'],
                'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
            ],
        ]);
        ?>

        <?= $form->field($model, 'billingCountryId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(BillingCountry::find()->all(), 'billingCountryId', 'title'), ['prompt' => '-- Select BillingCountry --']) ?>

        <?= $form->field($model, 'billingProvinceId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(BillingProvince::find()->all(), 'billingProvinceId', 'title'), ['prompt' => '-- Select BillingProvince --']) ?>

        <?= $form->field($model, 'billingAmphurId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(BillingAmphur::find()->all(), 'billingAmphurId', 'title'), ['prompt' => '-- Select BillingAmphur --']) ?>

        <?= $form->field($model, 'billingZipcode', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 10]) ?>

        <?= $form->field($model, 'billingTel', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <?= $form->field($model, 'shippingCompany', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'shippingTax', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>


        <?php
        echo $form->field($model, 'shippingAddress')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                'contentsLangDirection' => 'th',
                'height' => 400,
                //'filebrowserBrowseUrl' => 'browse-images',
                //'filebrowserUploadUrl' => 'upload-images',
                //'extraPlugins' => ['imageuploader', 'image2'],
                'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
            ],
        ]);
        ?>

        <?= $form->field($model, 'shippingCountryId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ShippingCountry::find()->all(), 'shippingCountryId', 'title'), ['prompt' => '-- Select ShippingCountry --']) ?>

        <?= $form->field($model, 'shippingProvinceId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ShippingProvince::find()->all(), 'shippingProvinceId', 'title'), ['prompt' => '-- Select ShippingProvince --']) ?>

        <?= $form->field($model, 'shippingAmphurId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ShippingAmphur::find()->all(), 'shippingAmphurId', 'title'), ['prompt' => '-- Select ShippingAmphur --']) ?>

        <?= $form->field($model, 'shippingZipcode', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 10]) ?>

        <?= $form->field($model, 'shippingTel', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <?= $form->field($model, 'paymentType', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?= $form->field($model, 'couponId', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?= $form->field($model, 'checkStep', ['options' => ['class' => 'row form-group']])->textInput() ?>


        <?php
        echo $form->field($model, 'note')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                'contentsLangDirection' => 'th',
                'height' => 400,
                //'filebrowserBrowseUrl' => 'browse-images',
                //'filebrowserUploadUrl' => 'upload-images',
                //'extraPlugins' => ['imageuploader', 'image2'],
                'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
            ],
        ]);
        ?>

        <?= $form->field($model, 'paymentDateTime', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
