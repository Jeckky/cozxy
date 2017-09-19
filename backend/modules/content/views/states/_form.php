<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\dbworld;
use yii\jui\DatePicker;
use common\models\dbworld\Geography;
use common\models\dbworld\Countries;

$StatesCodeNow = '';
if ($this->params['status'] != 'Update') {
    $modelStatesCode = dbworld\States::find()->orderBy('stateId desc')->one();
    $StatesCodeLast = $modelStatesCode->code;
    $StatesCodeNow = $StatesCodeLast + 1;
}
/* @var $this yii\web\View */
/* @var $model common\models\dbworld\States */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="states-form">

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

        <?php
        if ($this->params['status'] != 'Update') {
            echo $form->field($model, 'code', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45, 'value' => $StatesCodeNow, 'readonly' => 'readonly']);
        } else {
            echo $form->field($model, 'code', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]);
        }
        ?>
        <?= $form->field($model, 'stateName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 50]) ?>

        <?= $form->field($model, 'localName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'geographyId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Geography::find()->all(), 'geographyId', 'name'), ['prompt' => '-- Select Geography --']) ?>

        <?= $form->field($model, 'countryId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Countries::find()->all(), 'countryId', 'countryName'), ['prompt' => '-- Select Country --']) ?>

        <?= $form->field($model, 'latitude', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?= $form->field($model, 'longitude', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
