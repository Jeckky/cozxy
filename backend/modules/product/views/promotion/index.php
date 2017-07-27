<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\User;
use common\models\costfit\ProductGroup;
use common\models\costfit\Category;
use common\models\costfit\Brand;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

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
        <span class="panel-title">Product Promotions</span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>

        <?php
        // Multiple select without model
        echo kartik\select2\Select2::widget([
            'name' => "Configuration[value]",
            'value' => $promotionIds, // initial value
//            'data' => $productSupps,
            'maintainOrder' => true,
            'toggleAllSettings' => [
                'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Tag All',
                'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Untag All',
                'selectOptions' => ['class' => 'text-success'],
                'unselectOptions' => ['class' => 'text-danger'],
            ],
            'options' => ['placeholder' => 'ระบุได้หลาย Option ที่มี เช่นสี เป็น Red,Green,Yellow', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 20
            ],
        ]);
        ?>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
