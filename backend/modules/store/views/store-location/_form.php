<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\Store;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\StoreLocation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-location-form">

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

        <?= $form->field($model, 'storeId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Store::find()->all(), 'storeId', 'title'), ['prompt' => '-- Select Store --']) ?>

        <?= $form->field($model, 'provinceId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(\common\models\dbworld\States::find()->where("countryId = 'THA'")->all(), 'stateId', 'stateName'), ['prompt' => '-- Select Store --']) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
