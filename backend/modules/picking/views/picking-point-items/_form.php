<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPointItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picking-point-items-form">
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

            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'portIndex')->textInput(['maxlength' => 100]) ?>

            <?= $form->field($model, 'height')->textInput(['maxlength' => 10]) ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a('Back', ['index', 'pickingId' => $model->pickingId], ['class' => 'btn btn-warning']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>
