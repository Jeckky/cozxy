<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

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

    // Top most parent

    echo $form->field($model, 'provinceId')->widget(kartik\select2\Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName'),
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'loadingText' => 'Loading states ...',
        ],
        'options' => ['placeholder' => 'Select states ...'],
    ])->label('เลือกจังหวัด');

    // Child level 2
    echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
    echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
    echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
        //'data' => [9 => 'Savings'],
        'options' => ['placeholder' => 'Select ...'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'initialize' => true,
            'depends' => ['pickingpoint-provinceid'],
            'url' => Url::to(['child-amphur-address']),
            'loadingText' => 'Loading amphur ...',
            'params' => ['input-type-11', 'input-type-22']
        ]
    ])->label('เลือกอำเภอ/เขต');

    // Loading picking items ... //
    echo $form->field($model, 'pickingItemsId')->widget(kartik\select2\Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\costfit\PickingPointItems::find()->asArray()->all(), 'pickingItemsId', 'name'),
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'loadingText' => 'Loading picking items ...',
        ],
        'options' => ['placeholder' => 'Select states ...'],
    ])->label('เลือกจุดรับของ');
    ?>
    <?php //echo $form->field($model, 'tax'); ?>
    <?php //echo $form->field($model, 'zipcode'); ?>
    <?php //echo $form->field($model, 'email'); ?>
    <?php //echo $form->field($model, 'tel'); ?>
    <?php echo $form->field($model, 'isDefault')->radioList([1 => 'Yes', 0 => 'No'], ['itemOptions' => ['class' => 'radio']])->label('Default address') ?>
    <?php
    //($model->isDefault = '1') ? 1 : 0;
    ?> 
    <?php echo Html::submitButton(($label != '') ? $label : '', ['class' => 'btn btn-primary', 'name' => 'btn-shipping-address']) ?>
    <?php ActiveForm::end(); ?>
</div>

