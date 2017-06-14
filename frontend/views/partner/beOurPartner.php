<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'Partner Membership Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    body{
        background-image: url("/images/be-our-partner/become-partner.jpg") ;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    }
    .be-our-partner{
        /* for IE */
        filter:alpha(opacity=60);
        /* CSS3 standard */
        opacity:0.9;
        color: #000000;
    }
    .my-form{
        color: #000;
    }

    label {
        display: inline-block;
        padding-top: 20px;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;
    }
</style>
<div class="container login-box be-our-partner">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs my-form">MY FORM :: PARTNER REGISTER</p>
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
                <div class="col-md-12">
                    <div class="form-group" style="border-bottom: 1px #000 solid;">
                        <label for="PartnerInformation">
                            <strong><i class="fa fa-address-book bg-yellow1" aria-hidden="true"></i> Information</strong>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputCompnay">Compnay Name</label>
                        <?php echo $form->field($model, 'company')->textInput(['class' => 'fullwidth', 'placeholder' => 'Compnay Name'])->label(FALSE); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputBusiness">Business Registration No </label>
                        <?php echo $form->field($modelUser, 'brn')->textInput(['class' => 'fullwidth', 'placeholder' => 'Business Registration No'])->label(FALSE); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputTax">Tax </label>
                        <?php echo $form->field($model, 'tax')->textInput(['class' => 'fullwidth', 'placeholder' => 'Tax'])->label(FALSE); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputMobile">Mobile Number</label>
                        <?php echo $form->field($model, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'Mobile Number'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputDay">Day</label>
                        <?=
                        Html::dropDownList('User[day]', NULL, $birthdate['dates'], ['prompt' => '---Select day---', 'class' => 'fullwidth productOption'
                            , 'options' =>
                            [
                                $historyBirthDate['day'] => ['selected' => true]//['Selected' => 'selected']
                            ]
                        ])
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputMonth">Month</label>
                        <?=
                        Html::dropDownList('User[month]', NULL, $birthdate['month'], ['prompt' => '---Select month---', 'class' => 'fullwidth productOption'
                            , 'options' =>
                            [
                                $historyBirthDate['month'] => ['selected' => true]//['Selected' => 'selected']
                            ]
                        ])
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputYear">Year</label>
                        <?=
                        Html::dropDownList('User[years]', NULL, $birthdate['years'], ['prompt' => '---Select year---', 'class' => 'fullwidth productOption'
                            , 'options' =>
                            [
                                $historyBirthDate['year'] => ['selected' => true]//['Selected' => 'selected']
                            ]
                        ])
                        ?>
                    </div>
                </div>
                <!--
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Store Name </label>
                <?php //echo $form->field($model, 'tax')->textInput(['class' => 'fullwidth', 'placeholder' => 'TAX'])->label(FALSE); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Store Url</label>
                <?php //echo $form->field($model, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'Mobile Number'])->label(false); ?>
                    </div>
                </div>
                -->

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail">Email</label>
                        <?php echo $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'Email'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <?= $form->field($modelUser, 'password')->passwordInput(['class' => 'fullwidth', 'placeholder' => 'PASSWORD'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputConfirm">Confirm Password</label>
                        <?= $form->field($modelUser, 'confirmPassword')->passwordInput(['class' => 'fullwidth', 'placeholder' => 'CONFIRM PASSWORD'])->label(false); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" style="border-bottom: 1px #000 solid; ">
                        <label for="PartnerInformation">
                            <strong><i class="fa fa-address-book bg-yellow1" aria-hidden="true"></i> Business Details</strong>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputFirstName">First Name</label>
                        <?= $form->field($model, 'firstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRSTNAME'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputLastName">Last Name</label>
                        <?= $form->field($model, 'lastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LASTNAME'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputCompanyAddress">Company address</label>
                        <?= $form->field($model, 'address')->textarea(['class' => 'fullwidth', 'placeholder' => 'ADDRESS', 'rows' => '6'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputCountries">Countries</label>
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputProvince">Province</label>
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
                        <label for="exampleInputCity">City</label>
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
                        <label for="exampleInputDistrict">District</label>
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
                        <label for="exampleInputZipcode">Zipcode</label>
                        <?php
                        echo Html::hiddenInput('input-type-14', $model->districtId, ['id' => 'input-type-14']);
                        echo Html::hiddenInput('input-type-42', $model->districtId, ['id' => 'input-type-42']);
                        echo Html::hiddenInput('input-type-44', $hash, ['id' => 'input-type-44']);
                        echo $form->field($model, 'zipcode')->widget(DepDrop::classname(), [
                            //'data' => [12 => 'Savings A/C 2'],
                            'options' => ['placeholder' => 'Select ...'],
                            'type' => DepDrop::TYPE_SELECT2,
                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions' => [
                                'depends' => ['address-districtid'],
                                //'initialize' => true,
                                //'initDepends' => ['address-countryid'],
                                'url' => Url::to(['child-zipcode-address']),
                                'loadingText' => 'Loading zipcode ...',
                                'params' => ['input-type-14', 'input-type-42', 'input-type-42']
                            ]
                        ])->label(FALSE);
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" style="border-bottom: 1px #000 solid; ">
                        <label for="PartnerInformation">
                            <strong><i class="fa fa-address-book bg-yellow1" aria-hidden="true"></i> Bank Account</strong>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Bank</label>
                        <?php echo $form->field($model, 'company')->textInput(['class' => 'fullwidth', 'placeholder' => 'Bank'])->label(FALSE); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Account Holder name</label>
                        <?php echo $form->field($modelUser, 'brn')->textInput(['class' => 'fullwidth', 'placeholder' => 'Account Holder name'])->label(FALSE); ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Account No </label>
                        <?php echo $form->field($model, 'tax')->textInput(['class' => 'fullwidth', 'placeholder' => 'Account No'])->label(FALSE); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Branch Name </label>
                        <?php echo $form->field($model, 'tax')->textInput(['class' => 'fullwidth', 'placeholder' => 'Branch Name'])->label(FALSE); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" style="border-bottom: 1px #000 solid; ">
                        <label for="PartnerInformation">
                            <strong><i class="fa fa-address-book bg-yellow1" aria-hidden="true"></i> Required Documents</strong>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">status</label>
                        <?= $form->field($modelFile, 'status', ['radioTemplate' => '<label class="gender-head">{label}</label><label class="signup-radio">{input}</label>'])->inline()->radioList([1 => 'I will send via mail', 0 => 'Upload file'], ['separator' => '', 'tabindex' => 3])->label(FALSE); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> A copy of Representative’s Thai National ID or Passport</label>
                        <input type="file" name="file[]" multiple id="file"/>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">A copy of Business Registration Certificate</label>
                        <input type="file" name="file[]" multiple id="file"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> A copy of VAT Registration (Optional)</label>
                        <input type="file" name="file[]" multiple id="file"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Other Document / License (Optional)</label>
                        <input type="file" name="file[]" multiple id="file"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 text-right">
                    <a href="#" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">RESET</a>
                    &nbsp;
                    <input type="submit" value="SAVE"  class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <div class="size18 size14-xs">&nbsp;</div>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>
