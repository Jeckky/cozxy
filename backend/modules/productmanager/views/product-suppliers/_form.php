<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\ProductSuppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-suppliers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brandId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoryId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'suppCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'merchantCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'optionName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shortDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'specification')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'depth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smallUnit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'createDateTime')->textInput() ?>

    <?= $form->field($model, 'updateDateTime')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'result')->textInput() ?>

    <?= $form->field($model, 'approve')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'productId')->textInput() ?>

    <?= $form->field($model, 'approveCreateBy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approvecreateDateTime')->textInput() ?>

    <?= $form->field($model, 'receiveType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'warrantyType')->textInput() ?>

    <?= $form->field($model, 'warrantyPeriod')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
