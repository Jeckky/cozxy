<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\areawow\User; 
use common\models\areawow\Country; 
use common\models\areawow\Province; 
use common\models\areawow\Amphur; 
use common\models\areawow\District; 

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

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

		<?= $form->field($model, 'userId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(User::find()->all(), 'userId', 'title'), ['prompt' => '-- Select User --']) ?>

		<?= $form->field($model, 'firstname',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 200]) ?>

		<?= $form->field($model, 'lastname',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 200]) ?>

		<?= $form->field($model, 'company',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 200]) ?>

		<?= $form->field($model, 'tax',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 45]) ?>

		<?= $form->field($model, 'address',['options'=>['class'=>'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

		<?= $form->field($model, 'countryId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(Country::find()->all(), 'countryId', 'title'), ['prompt' => '-- Select Country --']) ?>

		<?= $form->field($model, 'provinceId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(Province::find()->all(), 'provinceId', 'title'), ['prompt' => '-- Select Province --']) ?>

		<?= $form->field($model, 'amphurId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(Amphur::find()->all(), 'amphurId', 'title'), ['prompt' => '-- Select Amphur --']) ?>

		<?= $form->field($model, 'districtId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(District::find()->all(), 'districtId', 'title'), ['prompt' => '-- Select District --']) ?>

		<?= $form->field($model, 'zipcode',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'tel',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 45]) ?>

		<?= $form->field($model, 'type',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'isDefault',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'longitude',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 150]) ?>

		<?= $form->field($model, 'latitude',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 150]) ?>

		<?= $form->field($model, 'email',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 100]) ?>

		<?= $form->field($model, 'fax',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 45]) ?>

                <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
