<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php
$form = ActiveForm::begin([
    'enableClientValidation' => FALSE,
    'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div>',
        'labelOptions' => [
            'class' => 'col-sm-3 control-label'
        ]
    ]
]);
?>
<div class="product-group-form">



    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">Product <?= $model->title; ?> Edit</h3></span>
        </div>
        <div class="panel-body">

            <?= $form->errorSummary($model) ?>

            <?//= $form->field($model, 'productGroupTemplateId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(common\models\costfit\ProductGroupTemplate::find()->all(), 'productGroupTemplateId', 'title'), ['prompt' => '-- Select Option Template --']) ?>

            <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]); ?>

            <div class="row form-group field-product-title required has-success">
                <label class="col-sm-3 control-label" for="product-title">Option</label>
                <div class="col-sm-9">
                    <?php
                    $options = \common\models\costfit\ProductGroupOptionValue::find()->where("productId =" . $model->productId)->all();
                    $optionStr = "";
                    foreach ($options as $option) {
                        $optionStr.= $option->productGroupTemplateOption->title . "-" . $option->value . "<br>";
                    }
                    echo $optionStr;
                    ?>
                </div>
            </div>

            <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

            <?= $form->field($model, 'specification', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

            <div class="row">
                <div class="col-lg-12">
                    <?php
                    echo $this->render("_image_grid", ['id' => $model->productId]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <?php
                    echo $this->render("_image_form", ["id" => $model->productId]);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php $this->registerJs("
           init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#product-description').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
                $('#product-specification').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            }

        });

", \yii\web\View::POS_END); ?>