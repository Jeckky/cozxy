<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Led */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="led-form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><h4></h4></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin();
            $color = '255, 255, 255';
            ?>

            <div class="row">
                <div class="col-md-3">  <?= $form->field($model, 'r')->textInput(['maxlength' => true, 'style' => 'border-color: #ff9999;', 'value' => isset($model->r) ? $model->r : 0]) ?></div>

                <div class="col-md-3"><?= $form->field($model, 'g')->textInput(['maxlength' => true, 'style' => 'border-color: #99ff99;', 'value' => isset($model->g) ? $model->g : 0]) ?></div>

                <div class="col-md-3"> <?= $form->field($model, 'b')->textInput(['maxlength' => true, 'style' => 'border-color: #99ccff;', 'value' => isset($model->b) ? $model->b : 0]) ?></div>
                <?php
                if (isset($model->r)) {
                    $r = $model->r;
                } else {
                    $r = '255';
                }
                if (isset($model->g)) {
                    $g = $model->g;
                } else {
                    $g = '255';
                }if (isset($model->b)) {
                    $b = $model->b;
                } else {
                    $b = '255';
                }
                $color = $r . ', ' . $g . ', ' . $b;
                ?>
                <div class="col-md-3 showColor" style="margin-top: 23px;"><input type="text" name="result" class="form-control" disabled style="background-color: rgb(<?= $color; ?>);"></div>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

