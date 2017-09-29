<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'New Billing Address';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    hr{
        margin-top: 0px;
    }
    .form-billing-my-account{
        padding: 30px;
    }
    .form-billing-my-account-top{
        margin-top: -35px;
    }
    .radioNewCozxy .radio-inline{
        margin-left: 50px;
    }

</style>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">ADD NEW BILLING ADDRESS</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>
            <?php
            $form = ActiveForm::begin([
                'id' => 'default-shipping-address',
                'options' => ['class' => 'space-bottom'],
            ]);
            ?>
            <div class="form-billing-my-account">
                <div class="form-group form-billing-my-account-top">
                    <label for=""><?php echo strtoupper('Billing type *') ?></label>
                    <div class="select-style">
                        <select name="co-organization" id="co-country" class="valid col-md-12" onchange="organization(this)">
                            <option value="personal">Individual </option>
                            <!--<option value="company">Legal Entity (Company)</option>-->
                        </select>
                    </div>
                    <!--
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Company (option)</label>
                            <?//php echo $form->field($model, 'company')->textInput([ 'disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'COMPANY'])->label(FALSE); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tax </label>
                            <?//php echo $form->field($model, 'tax')->textInput([ 'disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'TAX'])->label(FALSE); ?>
                            </div>
                        </div>
                    </div>-->
                    <br><br>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><?php echo strtoupper('First Name') ?></label>
                            <?= $form->field($model, 'firstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRST NAME'])->label(false); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><?php echo strtoupper('Last Name') ?></label>
                            <?= $form->field($model, 'lastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LAST NAME'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><?php echo strtoupper('Mobile Phone Number*') ?></label>
                            <?php echo $form->field($model, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'MOBILE PHONE NUMBER'])->label(false); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><?php echo strtoupper('E-mail Address') ?></label>
                            <?php echo $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'E-MAIL ADDRESS'])->label(false); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo strtoupper('Address') ?>
                <hr>
            </div>

            <div class="row form-billing-my-account">
                <div class="col-md-6 form-billing-my-account-top">
                    <div class="form-group">
                        <label for=""><?php echo strtoupper('Countries') ?></label>
                        <?php
                        echo $form->field($model, 'countryId')->widget(kartik\select2\Select2::classname(), [
                            //'options' => ['id' => 'address-countryid'],
                            'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'localName'),
                            'pluginOptions' => [
                                'placeholder' => 'Select...',
                                'loadingText' => 'Loading country ...',
                            ],
                            'options' => ['placeholder' => 'Select country ...'],
                        ])->label(FALSE);
                        ?>
                    </div>
                </div>
                <div class="col-md-6 form-billing-my-account-top">
                    <div class="form-group">
                        <label for=""><?php echo strtoupper('Province') ?></label>
                        <?php
                        echo Html::hiddenInput('input-type-1', $model->provinceId, ['id' => 'input-type-1']);
                        echo Html::hiddenInput('input-type-2', $model->provinceId, ['id' => 'input-type-2']);
                        echo Html::hiddenInput('input-type-3', 'edit', ['id' => 'input-type-3']);
                        echo $form->field($model, 'provinceId')->widget(DepDrop::classname(), [
                            'data' => [$model->provinceId => $model->provinceId],
                            'options' => ['placeholder' => 'Select ...'],
                            //'options' => ['id' => 'address-provinceidxxx'],
                            'type' => DepDrop::TYPE_SELECT2,
                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions' => [
                                'initialize' => true,
                                'depends' => ['address-countryid'],
                                'url' => Url::to(['child-states-address']),
                                'loadingText' => 'Loading province ...',
                                'params' => ['input-type-1', 'input-type-2', 'input-type-3']
                            ]
                        ])->label(FALSE);
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""><?php echo strtoupper('City') ?></label>
                        <?php
                        echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
                        echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
                        echo Html::hiddenInput('input-type-33', $hash, ['id' => 'input-type-33']);
                        echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                            //'data' => [9 => 'Savings'],
                            'options' => ['placeholder' => 'Select ...'],
                            'type' => DepDrop::TYPE_SELECT2,
                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions' => [
                                'initialize' => true,
                                'depends' => ['address-provinceid'],
                                'url' => Url::to(['child-amphur-address']),
                                'loadingText' => 'Loading amphur ...',
                                'params' => ['input-type-11', 'input-type-22', 'input-type-33']
                            ]
                        ])->label(FALSE);
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""><?php echo strtoupper('District') ?></label>
                        <?php
                        echo Html::hiddenInput('input-type-13', $model->districtId, ['id' => 'input-type-13']);
                        echo Html::hiddenInput('input-type-33', $model->districtId, ['id' => 'input-type-33']);
                        echo Html::hiddenInput('input-type-34', $hash, ['id' => 'input-type-34']);
                        echo $form->field($model, 'districtId')->widget(DepDrop::classname(), [
                            //'data' => [9 => 'Savings'],
                            'options' => ['placeholder' => 'Select ...'],
                            'type' => DepDrop::TYPE_SELECT2,
                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions' => [
                                'initialize' => true,
                                'depends' => ['address-amphurid'],
                                'url' => Url::to(['child-district-address']),
                                'loadingText' => 'Loading district ...',
                                'params' => ['input-type-13', 'input-type-33', 'input-type-34']
                            ]
                        ])->label(FALSE);
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""><?php echo strtoupper('Zipcode') ?></label>
                        <?php
                        echo Html::hiddenInput('input-type-14', $model->zipcode, ['id' => 'input-type-14']);
                        echo Html::hiddenInput('input-type-42', $model->zipcode, ['id' => 'input-type-42']);
                        echo Html::hiddenInput('input-type-44', $hash, ['id' => 'input-type-44']);
                        echo $form->field($model, 'zipcode')->widget(DepDrop::classname(), [
                            //'data' => [12 => 'Savings A/C 2'],
                            'options' => ['placeholder' => 'Select ...'],
                            'type' => DepDrop::TYPE_SELECT2,
                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions' => [
                                'depends' => ['address-districtid'],
                                'initialize' => true,
//                                'initDepends' => ['address-countryid'],
                                'url' => Url::to(['child-zipcode-address']),
                                'loadingText' => 'Loading zipcode ...',
                                'params' => ['input-type-14', 'input-type-42', 'input-type-42']
                            ]
                        ])->label(FALSE);
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for=""><?php echo strtoupper('Address') ?></label>
                    <?= $form->field($model, 'address')->textarea(['class' => 'fullwidth', 'placeholder' => 'ADDRESS'])->label(false); ?>
                </div>
            </div>

            <div class="form-group" style="margin-top: -30px;">
                <?php echo strtoupper('Default address') ?>
                <hr>
            </div>
            <div class="form-billing-my-account">
                <div class="form-group form-billing-my-account-top">
                    <?php echo $form->field($model, 'isDefault')->inline(true)->radioList([1 => 'YES', 0 => 'NO'], [ 'class' => 'radioNewCozxy', ['itemOptions' => ['class' => 'radioNewCozxy']]])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 text-center">
                    <a href="<?= Url::to(['/my-account', 'act' => 'account-detail']) ?>" class="b btn-black">CANCEL</a>
                    &nbsp;
                    <!--<a href="<?//= Url::to(['/checkout/summary']) ?>" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">SAVE</a>-->
                    <input type="submit" value="SAVE"  class="b btn-yellow">
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <div class="size18 size14-xs">&nbsp;</div>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>
