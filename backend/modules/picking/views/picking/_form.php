<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
//use kartik\select2\Select2;
//use kartik\depdrop\DepDrop;
//use kartik\depdrop\DepDrop;
//use kartik\depdrop\DepDropAction;
//use kartik\depdrop\DepDropAsset;
//use kartik\widgets\DepDrop;
//use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picking-point-form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><h4><?= $this->title ?></h4></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin();
            ?>

            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?//= $form->field($model, 'countryId')->textInput(['maxlength' => true]) ?>
            <?php
            $catList = yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName');
            echo $form->field($model, 'provinceId')->dropDownList($catList, ['id' => 'cat-id']);

            // Child level 2
            echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                'options' => ['id' => 'subcat-id'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'initialize' => true,
                    'depends' => ['cat-id'],
                    'placeholder' => 'Select...',
                    'url' => Url::to(['child-amphur-address'])
                ]
            ]);
            ?>

            <?//= $form->field($model, 'provinceId')->textInput(['maxlength' => true]) ?>

            <?//= $form->field($model, 'amphurId')->textInput(['maxlength' => true]) ?>

            <?//= $form->field($model, 'status')->textInput() ?>

            <?//= $form->field($model, 'type')->textInput() ?>

            <?//= $form->field($model, 'createDateTime')->textInput() ?>

            <?//= $form->field($model, 'updateDateTime')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a('Back', ['index', 'pickingId' => $model->pickingId], ['class' => 'btn btn-warning']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
