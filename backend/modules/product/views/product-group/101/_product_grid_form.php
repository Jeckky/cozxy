<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<?php yii\widgets\Pjax::begin(['id' => 'editProduct']) ?>
<?php
$form = ActiveForm::begin([
    'id' => 'product-form' . $id,
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

            <?= $form->field($model, 'productId')->hiddenInput(['value' => $id, 'name' => 'productId']) ?>
            <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]); ?>

            <div class="row form-group field-product-title required has-success">
                <label class="col-sm-3 control-label" for="product-title">Option</label>
                <div class="col-sm-9">
                    <?php
                    $options = \common\models\costfit\ProductGroupOptionValue::find()->where("productId =" . $model->productId . " AND productSuppId IS NULL")->all();
                    $optionStr = "";
                    foreach ($options as $option) {
                        $optionStr.= $option->productGroupOption->name . "-" . $option->value . "<br>";
                    }
                    echo $optionStr;
                    ?>
                </div>
            </div>



            <?//= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6', 'id' => 'description' . $id]) ?>

            <?//= $form->field($model, 'specification', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6', 'id' => 'specification' . $id]) ?>

            <?//= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15])->label("Market Price"); ?>

            <!--            <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading"  >
                                        <span class="panel-title"><h3 >Product Supplier</h3></span>
                                    </div>
                                    <div class="panel-body">
                                        <?//= $form->field($prodSupp, 'quantity', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15])->label("Stock"); ?>
                                        <?//= $form->field($prodPriceSupp, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15])->label("Selling Price"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>-->
            <div class="row">
                <div class="col-lg-12">
                    <?php
//                    echo $this->render("_image_grid", ['id' => $model->productId]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <?php
//                    echo $this->render("_image_form", ["id" => $model->productId]);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <?= Html::button($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => "submit$id"]) ?>
                </div>
            </div>


        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end() ?>

<?php $this->registerJs("
           init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#description$id').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    },toolbar: [
                        ['fontsize', ['fontsize']]
                      ],
                    fontNames: ['Maledpan', 'Tahoma', 'Arial Unicode MS', 'MS Gothic', 'Helvetica', 'sans-serif'],
                      fontNamesIgnoreCheck: ['Maledpan', 'Tahoma']
                });
                $('#specification$id').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    },toolbar: [
                        ['fontsize', ['fontsize']]
                      ],
                    fontNames: ['Maledpan', 'Tahoma', 'Arial Unicode MS', 'MS Gothic', 'Helvetica', 'sans-serif'],
                      fontNamesIgnoreCheck: ['Maledpan', 'Tahoma']
                });
            }

        });

        $('#submit$id').on('click',function(){
         $.ajax({
            type: 'POST',
            url : '" . Url::home() . "product/product-group/update-grid-edit?step=" . $_GET['step'] . "&productGroupTemplateId=" . $_GET['productGroupTemplateId'] . "&productGroupId=" . $_GET['productGroupId'] . "',
            data : $('#product-form" . $id . "').serialize(),
            success : function(data) {
                $('#productModalBody').html(data);
                $('#productModal').modal('hide');
                refreshGrid();
            }
        });
        });

", \yii\web\View::POS_END); ?>

<?php
//$this->registerJs(
//'$("document").ready(function(){
//        $("#editProduct").on("pjax:end", function() {
//        alert(111);
//            $.pjax.reload({container:"#pjax' . $gridId . '"});  //Reload GridView
//        });
//    });'
//);
?>