<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-heading">
    <div class="row">
        <div class="col-md-6"><h4><?= $this->title ?></h4></div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
            </div>
        </div>
    </div>
</div>

<div class="panel-body">
    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'disabled' => true]) ?>

        <?//= $form->field($model, 'password_hash')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

        <?//= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'token')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'type')->textInput() ?>

        <?//= $form->field($model, 'auth_key')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'auth_type')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= $form->field($model, 'createDateTime')->textInput() ?>

        <?= $form->field($model, 'updateDateTime')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>