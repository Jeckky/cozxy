<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
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
    <?=
            $form->field($model, 'countryId')
            ->dropDownList(
                    yii\helpers\ArrayHelper::map(\common\models\dbworld\Countries::find()->all(), 'countryId', 'countryName'), ['prompt' => 'Select country']
            )->label('Country')
    ?>
    <?=
            $form->field($model, 'provinceId')
            ->dropDownList(
                    yii\helpers\ArrayHelper::map(\common\models\dbworld\States::find()->all(), 'stateId', 'stateName'), ['prompt' => 'Select province']
            )->label('Province')
    ?>
    <?=
            $form->field($model, 'amphurId')
            ->dropDownList(
                    yii\helpers\ArrayHelper::map(\common\models\dbworld\Cities::find()->all(), 'cityId', 'cityName'), ['prompt' => 'Select amphur']
            )->label('Amphur')
    ?>
    <?php echo $form->field($model, 'tax'); ?>
    <?php echo $form->field($model, 'zipcode'); ?>
    <?php echo $form->field($model, 'tel'); ?>
    <?php echo $form->field($model, 'isDefault')->radioList([0 => 'Yes', 1 => 'No'], ['itemOptions' => ['class' => 'radio']])->label('isDefault address') ?>
    <?php echo Html::submitButton('Save shipping address', ['class' => 'btn btn-primary', 'name' => 'btn-shipping-address']) ?>
    <?php ActiveForm::end(); ?>
</div>
