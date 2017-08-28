<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\PaymentMethod;
use common\models\costfit\Bank;
use common\models\costfit\EPaymentMerchant;
use common\models\costfit\EPaymentOrg;
use common\models\costfit\EPaymentProfile;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\EPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epayment-form">

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

        <?= $form->field($model, 'paymentMethodId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(PaymentMethod::find()->all(), 'paymentMethodId', 'title'), ['prompt' => '-- Select PaymentMethod --', 'disabled' => 'disabled']) ?>

        <?= $form->field($model, 'bankId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Bank::find()->all(), 'bankId', 'title'), ['prompt' => '-- Select Bank --']) ?>

        <?= $form->field($model, 'ePaymentTel', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 30]) ?>

<?= $form->field($model, 'ePaymentMerchantId', ['options' => ['class' => 'row form-group']])->textInput() ?>
        <?//= $form->field($model, 'ePaymentMerchantId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(EPaymentMerchant::find()->all(), 'ePaymentMerchantId', 'title'), ['prompt' => '-- Select EPaymentMerchant --']) ?>

<?= $form->field($model, 'ePaymentOrgId', ['options' => ['class' => 'row form-group']])->textInput() ?>
        <?//= $form->field($model, 'ePaymentOrgId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(EPaymentOrg::find()->all(), 'ePaymentOrgId', 'title'), ['prompt' => '-- Select EPaymentOrg --']) ?>

<?= $form->field($model, 'ePaymentUrl', ['options' => ['class' => 'row form-group']])->textInput() ?>
        <?//= $form->field($model, 'ePaymentUrl', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?php
        echo $form->field($model, 'ePaymentAccessKey')->widget(CKEditor::className(), [
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
        <?php
        echo $form->field($model, 'ePaymentSecretKey')->widget(CKEditor::className(), [
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
<?= $form->field($model, 'ePaymentProfileId', ['options' => ['class' => 'row form-group']])->textInput() ?>
        <?//= $form->field($model, 'ePaymentProfileId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(EPaymentProfile::find()->all(), 'ePaymentProfileId', 'title'), ['prompt' => '-- Select EPaymentProfile --']) ?>

        <?//= $form->field($model, 'type', ['options' => ['class' => 'row form-group']])->textInput() ?>

<?= $form->field($model, 'type', ['options' => ['class' => 'row form-group']])->dropDownList($model->getTypeArray($model->type), ['prompt' => '-- Select Type --']) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>

</div>
