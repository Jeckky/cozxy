<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-form">

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

        <div class="row form-group field-coupon-ordersummarytodiscount">
            <label class="col-sm-3 control-label" >Owner </label>
            <div class="col-sm-9">
                <img src="<?= Yii::$app->homeUrl . $model->couponOwner->image ?>" style="width:150px" >
                <?= $model->couponOwner->name; ?></div>
        </div>

        <?= $form->field($model, 'code', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 50, 'readOnly' => TRUE]) ?>

        <?//= $form->field($model, 'couponOwnerId', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?= $form->field($model, 'noCoupon', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?= $form->field($model, 'oneTimeUse', ['options' => ['class' => 'row form-group']])->checkbox()->label("") ?>

        <?= $form->field($model, 'orderSummaryToDiscount', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'discountValue', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15]) ?>

        <?= $form->field($model, 'discountPercent', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 5]) ?>


        <?=
        $form->field($model, 'startDate', ['options' => ['class' => 'row form-group']])->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
        ])
        ?>

        <?=
        $form->field($model, 'endDate', ['options' => ['class' => 'row form-group']])->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
        ])
        ?>



        <?= (isset($model->image) && !empty($model->image)) ? Html::img(Yii::$app->homeUrl . $model->image, ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : ''; ?>

        <?= $form->field($model, 'image', ['options' => ['class' => 'row form-group']])->fileInput() ?>

        <?= (isset($model->image) && !empty($model->image)) ? Html::hiddenInput((new ReflectionClass($model))->getShortName() . '[imageOld]', $model->image) : ''; ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
