<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\UserGroups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-groups-form">

    <?php
    $form = ActiveForm::begin([
        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-3 control-label'
            ]
        ]
    ]);
    ?>

    <div class="panel-heading">
        <span class="panel-title"><?= $title ?></span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'name', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45])->label('ชื่อกลุ่ม') ?>

        <?//= $form->field($model, 'parent_id', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 10]) ?>

        <?php
        echo $form->field($model, 'parent_id')->widget(kartik\select2\Select2::classname(), [
            //'value' => ['0'], // initial value
            'data' => yii\helpers\ArrayHelper::map(\common\models\costfit\UserGroups::find()->all(), 'user_group_Id', 'name'),
            'pluginOptions' => [
                'loadingText' => '-- Select Parent --',
            ],
            'options' => [
                'id' => 'parent_id',
                'class' => 'required',
                'placeholder' => 'ค่าเริ่มต้น',
            //'value' => 2, // value to initialize
            ],
        ])->label('กลุ่มหลัก');
        ?>

        <?php
        // Child level 1
        //echo $form->field($model, 'parent_id')->dropDownList('', ['id' => 'cat-id']);
        ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
