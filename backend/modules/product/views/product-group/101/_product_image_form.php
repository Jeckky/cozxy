<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php
$form = ActiveForm::begin([
    'id' => 'product-form',
    'enableClientValidation' => FALSE,
    'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div>',
        'labelOptions' => [
            'class' => 'col-sm-3 control-label'
        ]
    ]
]);
?>
<div class="product-group-form">



    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">Product <?= $model->title; ?> Edit</h3></span>
        </div>
        <div class="panel-body">

            <?= $form->errorSummary($model) ?>

            <?//= $form->field($model, 'productGroupTemplateId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(common\models\costfit\ProductGroupTemplate::find()->all(), 'productGroupTemplateId', 'title'), ['prompt' => '-- Select Option Template --']) ?>

            <?= $form->field($model, 'ordering', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]); ?>



            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
