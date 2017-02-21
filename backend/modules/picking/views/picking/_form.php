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
            $form = ActiveForm::begin([
                'options' => ['class' => 'panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-9">{input}</div>',
                    'labelOptions' => [
                        'class' => 'col-sm-3 control-label'
                    ]
                ]
            ]);
            ?>

            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true])->textArea(['rows' => '6']) ?>

            <?//= $form->field($model, 'countryId')->textInput(['maxlength' => true]) ?>

            <?php
            //$catList = yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName');
            //echo $form->field($model, 'provinceId')->dropDownList($catList, ['id' => 'cat-id']);
            ?>

            <?php
            // Child level 2
            /*
              echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
              'options' => ['id' => 'subcat-id'],
              'select2Options' => ['pluginOptions' => ['allowClear' => true]],
              'pluginOptions' => [
              'initialize' => true,
              'depends' => ['cat-id'],
              'placeholder' => 'Select...',
              'url' => Url::to(['child-amphur-address'])
              ]
              ]); */
            ?>

            <?php
            // echo '<pre>';
            //print_r(yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'));
            // Top most parent
            echo $form->field($model, 'countryId')->widget(kartik\select2\Select2::classname(), [
                'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->where("countryId='THA'")->asArray()->all(), 'countryId', 'localName'),
                'pluginOptions' => [
                    // 'placeholder' => 'Select...',
                    'loadingText' => 'Loading country ...',
                //'data' => ['THA' => 'ไทย'],
                //'initialize' => true,
                ],
                'options' => [
                    //'placeholder' => 'Select country ...',
                    'id' => 'countryId',
                    'class' => 'required'
                ],
            ])->label('ประเทศ');
            ?>
            <?php
            // Child level 1
            //echo Html::hiddenInput('model_id1', '2526', ['id' => 'model_id1']);
            echo Html::hiddenInput('input-type-1', $model->provinceId, ['id' => 'input-type-1']);
            echo Html::hiddenInput('input-type-2', $model->provinceId, ['id' => 'input-type-2']);
            //echo Html::hiddenInput('input-type-3', $hash, ['id' => 'input-type-3']);
            echo $form->field($model, 'provinceId')->widget(DepDrop::classname(), [
                'options' => ['placeholder' => 'Select ...', 'id' => 'provinceId'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['countryId'],
                    'url' => Url::to(['child-states-address']),
                    'loadingText' => 'Loading province ...',
                    // 'tags' => '2526',
                    'initialize' => true,
                    //'params' => ['model_id1']
                    'params' => ['input-type-1', 'input-type-2']
                ]
            ])->label('จังหวัด');
            ?>

            <?php
            // Child level 2
            //echo Html::hiddenInput('model_id2', '79745', ['id' => 'model_id2']);
            echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
            echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
            // echo Html::hiddenInput('input-type-33', $hash, ['id' => 'input-type-33']);
            echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                'options' => ['placeholder' => 'Select ...', 'id' => 'amphurId'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['provinceId'],
                    'url' => Url::to(['child-amphur-address']),
                    'loadingText' => 'Loading amphur ...',
                    'params' => ['input-type-11', 'input-type-22']
                //'initialize' => true,
                ]
            ])->label('เขต/อำเภอ');
            ?>

            <?= $form->field($model, 'ip')->textInput(['maxlength' => 100]) ?>
            <?= $form->field($model, 'macAddress')->textInput(['maxlength' => 100]) ?>
            <?= $form->field($model, 'authCode')->textInput(['maxlength' => 100]) ?>
            <?= $form->field($model, 'mapImages', ['options' => ['class' => 'row form-group']])->fileInput() ?>

            <?= (isset($model->mapImages) && !empty($model->mapImages)) ? Html::hiddenInput((new ReflectionClass($model))->getShortName() . '[imageOld]', $model->mapImages) : ''; ?>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3 text-left">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <?= Html::a('Back', ['index?receive=' . $receive, 'pickingId' => $model->pickingId], ['class' => 'btn btn-warning']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
    <?php $this->registerJs("
           init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#pickingpoint-descriptionx').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            }
        });

", \yii\web\View::POS_END); ?>