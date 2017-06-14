<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'New Billing Address';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">MY ACCOUNT :: New Billing Address</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>
            <?php
            $form = ActiveForm::begin([
                'id' => 'default-shipping-address',
                'options' => ['class' => 'space-bottom'],
            ]);
            ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Billing type *</label>
                <div class="select-style">
                    <select name="co-organization" id="co-country" class="valid col-md-12" onchange="organization(this)">
                        <option value="personal">Individual </option>
                        <option value="company">Legal Entity (Company)</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Company (option)</label>
                            <?php echo $form->field($model, 'company')->textInput([ 'disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'COMPANY'])->label(FALSE); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tax </label>
                            <?php echo $form->field($model, 'tax')->textInput([ 'disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'TAX'])->label(FALSE); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <?= $form->field($model, 'firstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRSTNAME'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <?= $form->field($model, 'lastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LASTNAME'])->label(false); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <?= $form->field($model, 'address')->textarea(['class' => 'fullwidth', 'placeholder' => 'ADDRESS'])->label(false); ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Countries</label>
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
                        <label for="exampleInputEmail1">Province</label>
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
                        <label for="exampleInputEmail1">City</label>
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
                        <label for="exampleInputEmail1">District</label>
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
                        <label for="exampleInputEmail1">Zipcode</label>
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
            <div class="form-group">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <?php echo $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'Email'])->label(false); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mobile Number</label>
                            <?php echo $form->field($model, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'Mobile Number'])->label(false); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Default address</label>
                    <?php echo $form->field($model, 'isDefault')->radioList([1 => 'Yes', 0 => 'No'], ['itemOptions' => ['class' => 'radio']])->label(false); ?>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <a href="<?= Url::to(['/my-account']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                    &nbsp;
                    <!--<a href="<?//= Url::to(['/checkout/summary']) ?>" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">SAVE</a>-->
                    <input type="submit" value="SAVE"  class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <div class="size18 size14-xs">&nbsp;</div>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>
