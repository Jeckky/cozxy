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
                'action' => $baseUrl . '/profile/edit-info',
                'options' => ['class' => 'registr-form']
    ]);
    ?>
    <?= $form->field($model, 'firstname') ?>
    <?= $form->field($model, 'lastname') ?>

    <?= Html::submitButton('Update Contact Information', ['class' => 'btn btn-primary', 'name' => 'contact-info']) ?>

    <?php ActiveForm::end(); ?>

</div>
