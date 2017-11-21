<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">MY ACCOUNT :: Edit Personal Detail</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>
            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>
            <div class="row">
                <div class="col-md-6">
                    <p>First Name</p>
                    <?= $form->field($model, 'firstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRSTNAME'])->label(false); ?>
                </div>
                <div class="col-md-6">
                    <p>Last Name</p>
                    <?= $form->field($model, 'lastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LASTNAME'])->label(false); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>Email</p>
                    <?= $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'EMAIL ADDRESS', 'disabled' => true])->label(false); ?>
                </div>
                <div class="col-md-6">
                    <p>Mobile phone</p>
                    <?= $form->field($model, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'MOBILE PHONE'])->label(false); ?>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <p>Birthday</p>

                </div>
                <div class="col-md-6">
                    <p>Gender</p>
                    <?= $form->field($model, 'gender', ['radioTemplate' => '<label class="gender-head">{label}</label><label class="signup-radio">{input}</label>'])->inline()->radioList([1 => 'Male', 0 => 'Female'], ['separator' => '', 'tabindex' => 3])->label(false); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <a href="<?= Url::to(['/my-account', 'act' => 'account-detail']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                    &nbsp;
                    <input type="submit" value="SAVE"  class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">
                    <!--<a href="<?//= Url::to(['/checkout/summary']) ?>" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">SAVE</a>-->
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="size18 size14-xs">&nbsp;</div>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>
