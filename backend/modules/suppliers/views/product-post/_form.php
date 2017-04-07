<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\costfit;
use yii\jui\DatePicker;
use common\models\costfit\ProductSupp;
use common\models\costfit\Brand;
use common\models\costfit\User;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-post-form">

    <?php
    $form = ActiveForm::begin([
        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-3 control-label'
            ]
        ]
    ]);
    ?>

    <div class="panel-heading">
        <span class="panel-title"><?= $title ?></span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'productSuppId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(costfit\ProductSuppliers::find()->all(), 'productSuppId', 'title'), ['prompt' => '-- Select ProductSupp --']) ?>

        <?= $form->field($model, 'brandId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Brand::find()->all(), 'brandId', 'title'), ['prompt' => '-- Select Brand --']) ?>

        <?= $form->field($model, 'userId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(User::find()->all(), 'userId', 'title'), ['prompt' => '-- Select User --']) ?>

        <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
