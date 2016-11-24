<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\ProductSupp;
use common\models\costfit\ShippingType;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductShippingPriceSuppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-shipping-price-suppliers-form">

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

        <?php
        echo $form->field($model, 'productSuppId')->hiddenInput(['value' => $_GET['id']])->label(false);
        ?>
        <?= $form->field($model, 'shippingTypeId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ShippingType::find()->all(), 'shippingTypeId', 'title'), ['prompt' => '-- Select ShippingType --']) ?>

        <?//= $form->field($model, 'date', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 20]) ?>

        <?= $form->field($model, 'discount', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <?= $form->field($model, 'type', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
