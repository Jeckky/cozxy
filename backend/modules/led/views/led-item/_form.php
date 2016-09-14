<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\LedItem */
/* @var $form yii\widgets\ActiveForm */
$sort = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
?>

<div class="led-item-form">
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
            <?php $form = ActiveForm::begin(); ?>
            <div  style="background-color: #00cc66;height: 50px;width: 300px;"><input type="radio" value="1" name="color"/></div><br>
            <div  style="background-color: #F00;height: 50px;width: 300px;"><input type="radio" value="2" name="color"/></div><br>
            <div  style="background-color: #003eff;height: 50px;width: 300px;"><input type="radio" value="3" name="color"/></div><br>
            <div  style="background-color: #ff99ff;height: 50px;width: 300px;"><input type="radio" value="4" name="color"/></div><br>
            <div  style="background-color: #ffff00;height: 50px;width: 300px;"><input type="radio" value="5" name="color"/></div><br>
            <div  style="height: 50px;width: 300px;"><?= $form->field($model, 'sortOrder')->dropDownList($sort) ?></div><br>
            <?//= $form->field($model, 'color')->textInput() ?>



            <?//= $form->field($model, 'status')->textInput() ?>

            <?//= $form->field($model, 'createDateTime')->textInput() ?>

            <?//= $form->field($model, 'updateDateTime')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
