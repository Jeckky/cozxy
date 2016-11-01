<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\Menu;
use common\models\costfit\Level;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Menu */
/* @var $form yii\widgets\ActiveForm */
//use kartik\widgets\DepDrop;
//use kartik\widgets\Select2;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
?>
<script src="/cost.fit-frontend/assets/243cd55c/js/libs/jquery-1.11.1.min.js"></script>
<div class="menu-form">

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

        <?= $form->field($model, 'name', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 50]) ?>

        <?= $form->field($model, 'link', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>


        <?= $form->field($model, 'parent', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Menu::find()->all(), 'menuId', 'name'), ['prompt' => '-- Select Parent --']) ?>

        <?php
        echo $form->field($model, 'parent')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(Menu::find()->all(), 'menuId', 'name'),
            'pluginOptions' => [
                'loadingText' => '-- Select Parent --',
            ],
            'options' => [
                'id' => 'parent',
                'class' => 'required'
            ],
        ])->label('Parent');

        //http://demos.krajee.com/widget-details/select2
        //$data = yii\helpers\ArrayHelper::map(\common\models\costfit\Menu::find()->all(), 'menuId', 'name');
        echo $form->field($model, 'levelId')->widget(Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(\common\models\costfit\Level::find()->asArray()->all(), 'levelId', 'name'),
            'pluginOptions' => [
                'loadingText' => 'Loading level ...',
            ],
            'options' => [
                //'placeholder' => 'Select level ...',
                'id' => 'level',
                'class' => 'required',
                'multiple' => true
            ],
        ])->label('Level');
        ?>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
