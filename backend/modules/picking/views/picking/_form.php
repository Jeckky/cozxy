<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picking-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'countryId')->textInput(['maxlength' => true]) ?>
    <?php
    echo $form->field($model, 'provinceId')->widget(kartik\select2\Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName'),
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'loadingText' => 'Loading states ...',
        ],
        'options' => ['placeholder' => 'Select states ...'],
    ])->label('เลือกจังหวัด');
    ?>

    <?= $form->field($model, 'provinceId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amphurId')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'status')->textInput() ?>

    <?//= $form->field($model, 'type')->textInput() ?>

    <?//= $form->field($model, 'createDateTime')->textInput() ?>

    <?//= $form->field($model, 'updateDateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
