<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use common\helpers\GetBrowser;

$yourbrowser = GetBrowser::Browser();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
// https://github.com/kartik-v/yii2-widget-depdrop //
?>
<style type="text/css">
    .selection{
        display: block;
        width: 100%;
        /*height: 46px;*/
        padding: 6px 12px;
        font-size: 1em;
        font-weight: 300;
        line-height: 1.42857143;
        color: #292c2e;
        background: transparent;
        border: 1px solid #03a9f4;
        border-radius: 0;
        box-shadow: none;

    }
    .select2-container--krajee .select2-selection{
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        background-color: #fff;
        /* border: 1px solid #ccc;*/
        border-radius: 4px;
        color: #555555;
        font-size: 14px;
        outline: 0;
        border: none;
        border-color: transparent;
    }
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        /*height: 28px;*/
        user-select: none;
        -webkit-user-select: none;
    }
    .select2-container--krajee .select2-selection {
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        background-color: #fff;
        border: 0px solid rgba(204, 204, 204, 0);
        border-radius: 0px;
        color: #555555;
        font-size: 14px;
        outline: 0;
    }
    .select2-container--krajee .select2-selection--single .select2-selection__arrow {
        border: none;
        /* border-left: 1px solid #aaa; */
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        position: absolute;
        height: 32px;
        top: 6px;
        right: -2px;
        width: 20px;
    }
    .select2-container--krajee.select2-container--disabled .select2-selection, .select2-container--krajee.select2-container--disabled .select2-selection--multiple .select2-selection__choice {
        background-color: #f5f5f5;
    }
    .select2-container--krajee .select2-selection--single .select2-selection__rendered {
        color: #000;
        padding: 0;
    }
    .select2-container--krajee .select2-selection--single .select2-selection__placeholder {
        color: #000;
    }
    .select2-container--krajee .select2-dropdown {
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        border-color: #66afe9;
        overflow-x: hidden;
        margin-top: -1px;
        padding: 15px;
    }
</style>
<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h4> <?php echo ($label != '') ? $label : ''; ?> </h4>
    <br>
    <?php
    $form = ActiveForm::begin([
        'id' => 'default-shipping-address',
        'options' => ['class' => 'space-bottom'],
    ]);
    ?>
    <?php echo $form->field($model, 'firstname'); ?>
    <?php echo $form->field($model, 'lastname'); ?>
    <?php echo $form->field($model, 'company'); ?>
    <?php echo $form->field($model, 'tax'); ?>
    <?php echo $form->field($model, 'address')->textarea(); ?>
    <?php
    // Top most parent

    echo $form->field($model, 'countryId')->widget(kartik\select2\Select2::classname(), [
        //'options' => ['id' => 'address-countryid'],
        'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'),
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'loadingText' => 'Loading country ...',
        ],
        'options' => ['placeholder' => 'Select country ...'],
    ])->label('Country');

    // Child level 1
    // Additional input fields passed as params to the child dropdown's pluginOptions
    echo Html::hiddenInput('input-type-1', $model->provinceId, ['id' => 'input-type-1']);
    echo Html::hiddenInput('input-type-2', $model->provinceId, ['id' => 'input-type-2']);
    echo Html::hiddenInput('input-type-3', $hash, ['id' => 'input-type-3']);
    //echo $hash;
    if ($hash != 'add') {
        if ($yourbrowser != 'Safari') {
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
            ])->label('States');
        } else {
            echo $form->field($model, 'provinceId')->widget(DepDrop::classname(), [
                'data' => [$model->provinceId => $model->provinceId],
                'options' => ['placeholder' => 'Select ...'],
                //'options' => ['id' => 'address-provinceidxxx'],
                //'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'initialize' => true,
                    'depends' => ['address-countryid'],
                    'url' => Url::to(['child-states-address']),
                    'loadingText' => 'Loading province ...',
                    'params' => ['input-type-1', 'input-type-2', 'input-type-3']
                ]
            ])->label('States');
        }
// Child level 2
        echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
        echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
        echo Html::hiddenInput('input-type-33', $hash, ['id' => 'input-type-33']);
        if ($yourbrowser != 'Safari') {
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
            ])->label('Cities');
        } else {
            echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                //'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...'],
                // 'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'initialize' => true,
                    'depends' => ['address-provinceid'],
                    'url' => Url::to(['child-amphur-address']),
                    'loadingText' => 'Loading amphur ...',
                    'params' => ['input-type-11', 'input-type-22', 'input-type-33']
                ]
            ])->label('Cities');
        }
// Child level 3
        echo Html::hiddenInput('input-type-13', $model->districtId, ['id' => 'input-type-13']);
        echo Html::hiddenInput('input-type-23', $model->districtId, ['id' => 'input-type-23']);
        echo Html::hiddenInput('input-type-34', $hash, ['id' => 'input-type-34']);
        if ($yourbrowser != 'Safari') {
            echo $form->field($model, 'districtId')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['address-amphurid'],
                    'initialize' => true,
                    //'initDepends' => ['address-countryid'],
                    'url' => Url::to(['child-district-address']),
                    'loadingText' => 'Loading district ...',
                    'params' => ['input-type-13', 'input-type-23', 'input-type-34']
                ]
            ])->label('District');
        } else {
            echo $form->field($model, 'districtId')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...'],
                //'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['address-amphurid'],
                    'initialize' => true,
                    //'initDepends' => ['address-countryid'],
                    'url' => Url::to(['child-district-address']),
                    'loadingText' => 'Loading district ...',
                    'params' => ['input-type-13', 'input-type-23', 'input-type-34']
                ]
            ])->label('District');
        }
    } else {

        if ($yourbrowser != 'Safari') {
            echo $form->field($model, 'provinceId')->widget(DepDrop::classname(), [
                'data' => [$model->provinceId => $model->provinceId],
                'options' => ['placeholder' => 'Select ...'],
                //'options' => ['id' => 'address-provinceidxxx'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    //'initialize' => true,
                    'depends' => ['address-countryid'],
                    'url' => Url::to(['child-states-address']),
                    'loadingText' => 'Loading province ...',
                    'params' => ['input-type-1', 'input-type-2', 'input-type-3']
                ]
            ])->label('States');
        } else {
            echo $form->field($model, 'provinceId')->widget(DepDrop::classname(), [
                'data' => [$model->provinceId => $model->provinceId],
                'options' => ['placeholder' => 'Select ...'],
                //'options' => ['id' => 'address-provinceidxxx'],
                //'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    //'initialize' => true,
                    'depends' => ['address-countryid'],
                    'url' => Url::to(['child-states-address']),
                    'loadingText' => 'Loading province ...',
                    'params' => ['input-type-1', 'input-type-2', 'input-type-3']
                ]
            ])->label('States');
        }
// Child level 2
        echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
        echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
        echo Html::hiddenInput('input-type-33', $hash, ['id' => 'input-type-33']);
        if ($yourbrowser != 'Safari') {
            echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                //'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    // 'initialize' => true,
                    'depends' => ['address-provinceid'],
                    'url' => Url::to(['child-amphur-address']),
                    'loadingText' => 'Loading amphur ...',
                    'params' => ['input-type-11', 'input-type-22', 'input-type-33']
                ]
            ])->label('Cities');
        } else {
            echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                //'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...'],
                //'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    // 'initialize' => true,
                    'depends' => ['address-provinceid'],
                    'url' => Url::to(['child-amphur-address']),
                    'loadingText' => 'Loading amphur ...',
                    'params' => ['input-type-11', 'input-type-22', 'input-type-33']
                ]
            ])->label('Cities');
        }


// Child level 3
        echo Html::hiddenInput('input-type-13', $model->districtId, ['id' => 'input-type-13']);
        echo Html::hiddenInput('input-type-23', $model->districtId, ['id' => 'input-type-23']);
        echo Html::hiddenInput('input-type-34', $hash, ['id' => 'input-type-34']);
        if ($yourbrowser != 'Safari') {
            echo $form->field($model, 'districtId')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['address-amphurid'],
                    //'initialize' => true,
                    //'initDepends' => ['address-countryid'],
                    'url' => Url::to(['child-district-address']),
                    'loadingText' => 'Loading district ...',
                    'params' => ['input-type-13', 'input-type-23', 'input-type-34']
                ]
            ])->label('District');
        } else {
            echo $form->field($model, 'districtId')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...'],
                //'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['address-amphurid'],
                    //'initialize' => true,
                    //'initDepends' => ['address-countryid'],
                    'url' => Url::to(['child-district-address']),
                    'loadingText' => 'Loading district ...',
                    'params' => ['input-type-13', 'input-type-23', 'input-type-34']
                ]
            ])->label('District');
        }
    }
    ?>

    <?php echo $form->field($model, 'zipcode'); ?>
    <?php echo $form->field($model, 'email'); ?>
    <?php echo $form->field($model, 'tel'); ?>
    <?php echo $form->field($model, 'isDefault')->radioList([1 => 'Yes', 0 => 'No'], ['itemOptions' => ['class' => 'radio']])->label('Default address') ?>
    <?php
    //($model->isDefault = '1') ? 1 : 0;
    ?>

    <?php echo Html::submitButton(($label != '') ? $label : '', ['class' => 'btn btn-primary', 'name' => 'btn-shipping-address']) ?>
    <?php ActiveForm::end(); ?>
</div>

