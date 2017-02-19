<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h4>Contact Information</h4>
    <?php
    $form = ActiveForm::begin([
        'id' => 'register-form',
        'options' => ['class' => 'registr-form checkout ']
    ]);
    ?>
    <?= $form->field($model, 'firstname') ?>
    <?= $form->field($model, 'lastname') ?>
    <?= $form->field($model, 'gender', ['radioTemplate' => '<label class="gender-head">{label}</label><label class="signup-radio">{input}</label>'])->radioList($model->findAllGenderArray(), ['separator' => '', 'tabindex' => 3]); ?>
    <?//= $form->field($model, 'birthDate')->dropdownList(['1' => 'aaa', '2' => 'bbb'], ['prompt' => '---Select Data---']) ?>

    <?=
    $form->field($model, 'birthDate')->widget(DatePicker::classname(), [
        // 'name' => 'User[birthDate]',
        'value' => function ($model, $index, $widget) {
            return Yii::$app->formatter->asDate($model->birthDate);
        },
        'size' => 'sm',
        'language' => 'th',
        'type' => DatePicker::TYPE_INPUT,
        'readonly' => true,
        'options' => [
            'placeholder' => 'Search date ...',
            'class' => 'input-sm col-sm-6',
        ],
        'pluginOptions' => [

            //'startDate' => date("d M Y", strtotime("0 day", strtotime(date('d M Y')))),
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        //'format' => 'dd-mm-yyyy',
        ],
    ]);
    ?>
    <?= $form->field($model, 'tel') ?>
    <?= Html::submitButton('Update Contact Information', ['class' => 'btn btn-primary', 'name' => 'contact-info']) ?>
    <?php ActiveForm::end(); ?>
</div>


