<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h4>Contact Information</h4>

    <!--<form class="space-bottom" role="form" method="post">
        <div class="form-group">
            <label for="cs-email">First Name</label>
            <input type="email" class="form-control" id="cs-email" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="cs-password">Last Name</label>
            <input type="password" class="form-control" id="cs-password" placeholder="Last Name">
        </div>
        <button type="submit" class="btn btn-primary">Update Contact Information</button>
    </form>-->

    <?php $form = ActiveForm::begin(['id' => 'register-form', 'action' => $baseUrl . '/profile/edit-info', 'options' => ['class' => 'registr-form']]); ?>

    <?= $form->field($model, 'firstname') ?>
    <?= $form->field($model, 'lastname') ?>
    <?= Html::submitButton('Update Contact Information', ['class' => 'btn btn-primary', 'name' => 'contact-info']) ?>
    <?php ActiveForm::end(); ?>

</div>
