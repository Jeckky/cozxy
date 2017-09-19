<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\dbworld;
use yii\jui\DatePicker;
use common\models\dbworld\Geography;
use common\models\dbworld\States;
use common\models\dbworld\Countries;

$CitiesCodeNow = '';
if ($this->params['status'] != 'Update') {
    $modelCitiesCode = dbworld\Cities::find()->orderBy('cityId desc')->one();
    $CitiesCodeLast = $modelCitiesCode->code;
    $CitiesCodeNow = $CitiesCodeLast + 1;
}
/* @var $this yii\web\View */
/* @var $model common\models\dbworld\Cities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-form">

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
            echo $form->field($model, 'code', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45, 'value' => $CitiesCodeNow, 'readonly' => 'readonly']);
        } else {
            echo $form->field($model, 'code', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]);
        }
        ?>
        <?= $form->field($model, 'cityName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 50]) ?>

        <?= $form->field($model, 'localName', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'geographyId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Geography::find()->all(), 'geographyId', 'name'), ['prompt' => '-- Select Geography --']) ?>

        <?= $form->field($model, 'stateId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(States::find()->all(), 'stateId', 'stateName'), ['prompt' => '-- Select State --']) ?>

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
