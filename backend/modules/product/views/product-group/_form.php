<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-group-form">

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

    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $title ?></h3></span>
        </div>

        <div class="panel-body">
            <?= $form->errorSummary($model) ?>

            <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200, 'value' => isset($title) ? $title : false]) ?>

            <?=
                    $form->field($model, 'description', ['options' => ['class' => 'row form-group']])
                    ->textarea(['value' => isset($description) ? $description : false, 'style' => 'height:150px;'])
            ?>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <?= $ms != '' ? '<i style="color:#ff0000;">* ' . $ms . '</i>' : '' ?><br>
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
