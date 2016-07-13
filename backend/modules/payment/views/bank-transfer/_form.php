<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\PaymentMethod;
use common\models\costfit\Bank;
use common\models\costfit\Supplier;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\BankTransfer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-transfer-form">

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

        <?= $form->field($model, 'branch', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 25]) ?>

        <?= $form->field($model, 'accNo', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?= $form->field($model, 'accName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 300]) ?>

        <?= $form->field($model, 'accType', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'compCode', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 5]) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
