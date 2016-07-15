<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
// https://github.com/kartik-v/yii2-widget-depdrop //
?>

<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h4>Default shipping address</h4>
    <?php
    $form = ActiveForm::begin([
                'id' => 'default-shipping-address',
                'options' => ['class' => 'space-bottom']
    ]);
    ?>
    <?php echo $form->field($model, 'company'); ?>
    <?php echo $form->field($model, 'address')->textarea(); ?>

    <?php
    // Parent
    echo $form->field($model, 'countryId')->dropDownList(
            yii\helpers\ArrayHelper::map(\common\models\dbworld\Countries::find()->all(), 'countryId', 'countryName'), ['prompt' => 'Select country']
            , ['id' => 'address-countryid'])->label('Country');
    // Child # 1
    echo $form->field($model, 'provinceId')->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'options' => ['id' => 'province-id', 'class' => 'form-control'],
        'pluginOptions' => [
            'depends' => ['address-countryid'],
            'placeholder' => 'Select...',
            'url' => yii\helpers\Url::to(['child-states']),
        ]
    ]);
    // Child # 2
    echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'depends' => ['amphur-id', 'province-id'],
            'placeholder' => 'Select...',
            'url' => yii\helpers\Url::to(['child-amphur'])
        ]
    ]);
    // Child # 3
    echo $form->field($model, 'districtId')->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'depends' => ['district-id', 'amphur-id'],
            'placeholder' => 'Select...',
            'url' => yii\helpers\Url::to(['child-district'])
        ]
    ]);
    ?>
    <?php echo $form->field($model, 'tax'); ?>
    <?php echo $form->field($model, 'zipcode'); ?>
    <?php echo $form->field($model, 'tel'); ?>
    <?php echo $form->field($model, 'isDefault')->radioList([0 => 'Yes', 1 => 'No'], ['itemOptions' => ['class' => 'radio']])->label('isDefault address') ?>
    <?php echo Html::submitButton('Save shipping address', ['class' => 'btn btn-primary', 'name' => 'btn-shipping-address']) ?>
    <?php ActiveForm::end(); ?>
</div>

