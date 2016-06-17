<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-10">{input}</div>',
            'labelOptions'=> [
                'class'=>'col-sm-2 control-label'
            ]
        ]
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">Form</div>
        <div class="panel-body">

			<?= $form->field($model, 'userId')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'tax')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

			<?= $form->field($model, 'countryId')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'provinceId')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'amphurId')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'type')->textInput() ?>

			<?= $form->field($model, 'status',['options'=>['class'=>'row form-group']])->checkbox([], false)->label('status') ?>

			<?= $form->field($model, 'createDateTime')->textInput() ?>

			<?= $form->field($model, 'updateDateTime')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
