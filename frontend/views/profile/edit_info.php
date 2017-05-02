<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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
    <div class="form-group field-user-birthDate">
        <label class="control-label col-md-12 " style="padding-left: 0px;">Birthdate</label>
        <div class="day col-md-4 col-xs-12">
            <?=
            Html::dropDownList('User[day]', NULL, $birthdate['dates'], ['prompt' => '---Select day---', 'class' => 'form-control'
                , 'options' =>
                [
                    $historyBirthDate['day'] => ['selected' => true]//['Selected' => 'selected']
                ]
            ])
            ?>
            <?//= $form->field($model, 'birthDate')->dropdownListc, ['prompt' => '---Select dates---'])->label('Dates') ?>
        </div>
        <div class="month col-md-4 col-xs-12">
            <?=
            Html::dropDownList('User[month]', NULL, $birthdate['month'], ['prompt' => '---Select month---', 'class' => 'form-control'
                , 'options' =>
                [
                    $historyBirthDate['month'] => ['selected' => true]//['Selected' => 'selected']
                ]
            ])
            ?>
            <?//= $form->field($model, 'birthDate')->dropdownList($birthdate['month'], ['prompt' => '---Select month---'])->label('Month') ?>
        </div>
        <div class="year col-md-4 col-xs-12">
            <?=
            Html::dropDownList('User[years]', NULL, $birthdate['years'], ['prompt' => '---Select years---', 'class' => 'form-control'
                , 'options' =>
                [
                    $historyBirthDate['year'] => ['selected' => true]//['Selected' => 'selected']
                ]
            ])
            ?>
            <?//= $form->field($model, 'birthDate')->dropdownList($birthdate['years'], ['prompt' => '---Select years---'])->label('Years') ?>
        </div>
        <br><br><br>
    </div>
    <?= $form->field($model, 'tel') ?>
    <?= Html::submitButton('Update Contact Information ', ['class' => 'btn btn-primary', 'name' => 'contact-info ']) ?>
    <?php ActiveForm::end(); ?>
</div>


