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

        <?= $form->field($model, 'ePaymentAccessKey', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?= $form->field($model, 'ePaymentSecretKey', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?= $form->field($model, 'ePaymentProfileId', ['options' => ['class' => 'row form-group']])->textInput() ?>
        <?//= $form->field($model, 'ePaymentProfileId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(EPaymentProfile::find()->all(), 'ePaymentProfileId', 'title'), ['prompt' => '-- Select EPaymentProfile --']) ?>

        <?= $form->field($model, 'type', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
