<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\ProductSuppliers */

$this->title = 'Stock : '. $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-suppliers-create">

    <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data'
                ],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-9">{input}</div>',
                    'labelOptions' => [
                        'class' => 'col-sm-3 control-label'
                    ]
                ]
            ]); ?>

            <?= $form->field($model, 'result')->textInput(['disabled'=>true, 'id'=>'currentStock'])->label('Curretn Stock') ?>
            <?= $form->field($model, 'addStock')->textInput(['value'=>0, 'id'=>'productStock', 'type'=>'number'])->label('Add Stock') ?>
            <div class="col-md-9 col-md-offset-3">
                <?=Html::submitButton('Add Stock', ['class'=>'btn btn-primary btn-block btn-lg'])?>
            </div>

            <?php ActiveForm::end();?>
        </div>
    </div>

</div>
<?php
$this->registerJs("
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

$('#productStock').blur(function(){
    var currentStock = Number($('#currentStock').val());
    var productStock= Number($(this).val());
    
    var stock = currentStock + productStock;
    
    if(stock < 0) {
        alert('Stock ไม่สามารถติดลบได้');
        $(this).val(0).focus().select();
    }
});

$('#productStock').focus(function(){
    $(this).select();
});

$(document).ready(function() {
    $('#productStock').keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    }); 
})
");
?>