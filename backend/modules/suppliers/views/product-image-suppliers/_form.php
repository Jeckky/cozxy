<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\areawow\ProductSupp;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductImageSuppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-image-suppliers-form">

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

        <?= $form->field($model, 'productSuppId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(ProductSupp::find()->all(), 'productSuppId', 'title'), ['prompt' => '-- Select ProductSupp --']) ?>

        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

        <?= $form->field($model, 'original_name', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 500]) ?>

        <?= (isset($model->image) && !empty($model->image)) ? Html::img(Yii::$app->homeUrl . $model->image, ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : ''; ?>

        <?= $form->field($model, 'image', ['options' => ['class' => 'row form-group']])->fileInput() ?>  

        <?= (isset($model->image) && !empty($model->image)) ? Html::hiddenInput((new ReflectionClass($model))->getShortName() . '[imageOld]', $model->image) : ''; ?>

        <?= (isset($model->imageThumbnail1) && !empty($model->imageThumbnail1)) ? Html::img(Yii::$app->homeUrl . $model->imageThumbnail1, ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : ''; ?>

        <?= $form->field($model, 'imageThumbnail1', ['options' => ['class' => 'row form-group']])->fileInput() ?>

        <?= (isset($model->imageThumbnail1) && !empty($model->imageThumbnail1)) ? Html::hiddenInput((new ReflectionClass($model))->getShortName() . '[imageOld]', $model->imageThumbnail1) : ''; ?>

        <?= (isset($model->imageThumbnail2) && !empty($model->imageThumbnail2)) ? Html::img(Yii::$app->homeUrl . $model->imageThumbnail2, ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : ''; ?>

        <?= $form->field($model, 'imageThumbnail2', ['options' => ['class' => 'row form-group']])->fileInput() ?>

<?= (isset($model->imageThumbnail2) && !empty($model->imageThumbnail2)) ? Html::hiddenInput((new ReflectionClass($model))->getShortName() . '[imageOld]', $model->imageThumbnail2) : ''; ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>

</div>
