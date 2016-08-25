<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\areawow\Product; 

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductHot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-hot-form">

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

		<?= $form->field($model, 'productId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(Product::find()->all(), 'productId', 'title'), ['prompt' => '-- Select Product --']) ?>

		<?= $form->field($model, 'price',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 15]) ?>

		<?= $form->field($model, 'startDate',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'endDate',['options'=>['class'=>'row form-group']])->textInput() ?>

                <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
