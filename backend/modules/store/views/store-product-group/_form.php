<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\areawow\Supplier; 

/* @var $this yii\web\View */
/* @var $model common\models\costfit\StoreProductGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-product-group-form">

    <?php $form = ActiveForm::begin([
    'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
    'fieldConfig' => [
    'template' => '{label}<div class="col-sm-9">{input}</div>',
    'labelOptions'=>[
    'class'=>'col-sm-3 control-label'
    ]
    ]
    ]); ?>

    <div class="panel-heading">
        <span class="panel-title"><?=$title?></span>
    </div>

    <div class="panel-body">
        		<?= $form->errorSummary($model)?>

		<?= $form->field($model, 'supplierId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(Supplier::find()->all(), 'supplierId', 'title'), ['prompt' => '-- Select Supplier --']) ?>

		<?= $form->field($model, 'poNo',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 45]) ?>

		<?= $form->field($model, 'title',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 200]) ?>

		<?= $form->field($model, 'description',['options'=>['class'=>'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

		<?= $form->field($model, 'summary',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 15]) ?>

		<?= $form->field($model, 'receiveDate',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'receiveBy',['options'=>['class'=>'row form-group']])->textInput() ?>

                <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
