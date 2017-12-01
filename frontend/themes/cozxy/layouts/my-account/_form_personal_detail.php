<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

//echo '<pre>';
//print_r($model->attributes);
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">MY ACCOUNT :: Edit Personal Detail</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>
            <?php
            $form = ActiveForm::begin([
                        'id' => 'default-shipping-address',
                        'options' => ['class' => 'space-bottom'],
            ]);
            ?>
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
                    <?php if (isset($model->attributes['email'])) { ?>
                        <?= $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'EMAIL ADDRESS', 'disabled' => true])->label(false); ?>
                    <?php } else { ?>
                        <?= $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'EMAIL ADDRESS'])->label(false); ?>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <p>Mobile phone</p>
                    <?= $form->field($model, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'MOBILE PHONE'])->label(false); ?>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <p>Birthday</p>
                    <div class="form-group col-md-4   field-signupform-dd required <?= isset($ddError) ? $ddError : '' ?>" style="padding-left: 0px;">
                        <?php
// without model
                        echo Select2::widget([
                            'name' => 'User[dd]',
                            'value' => $historyBirthDate['day'], // value to initialize
                            'data' => $birthdate['dates']
                        ]);
                        ?>
                        <p class="help-block help-block-error"><?= isset($dd) ? $dd : '' ?></p>
                    </div>

                    <div class="form-group col-md-4  field-signupform-dd required <?= isset($mmError) ? $mmError : '' ?>">
                        <?php
// without model
                        echo Select2::widget([
                            'name' => 'User[mm]',
                            'value' => $historyBirthDate['month'], // value to initialize
                            'data' => $birthdate['month']
                        ]);
                        ?>
                        <p class="help-block help-block-error"><?= isset($mm) ? $mm : '' ?></p>
                    </div>

                    <div class="form-group col-md-4 field-signupform-dd required <?= isset($yyyyError) ? $yyyyError : '' ?>">
                        <?php
// without model
                        echo Select2::widget([
                            'name' => 'User[yyyy]',
                            'value' => $historyBirthDate['year'], // value to initialize
                            'data' => $birthdate['years']
                        ]);
                        ?>
                        <p class="help-block help-block-error"><?= isset($yyyy) ? $yyyy : '' ?></p>
                    </div>
                    <!--
                    <input type="number" name="User[dd]" min="1" max="31" placeholder="31" style="width: 26%" value="<?//php echo (int) $historyBirthDate['day']; ?>">
                    <input type="number" name="User[mm]" min="1" max="12" placeholder="12" style="width: 26%" value="<?//php echo (int) $historyBirthDate['month']; ?>">
                    <input type="number" name="User[yyyy]" min="1800" max="2020" placeholder="1999" style="width: 40%" value="<?//php echo $historyBirthDate['year']; ?>">
                    -->
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
