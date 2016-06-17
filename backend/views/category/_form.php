<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

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

			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

			<?= $form->field($model, 'parentId')->textInput() ?>

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
