<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\ProductSuppliers */

$this->title = 'Price : '. $model->title;
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

            <div class="form-group field-productpricesuppliers-price required">
                <label class="col-sm-3 control-label" for="marketPrice">Market Price</label>
                <div class="col-sm-9"><input type="text" id="marketPrice" class="form-control" name="marketPrice" value="<?=$model->product->price?>" disabled="" aria-required="true"></div>
            </div>
            <?= $form->field($model->productPriceSuppliers, 'price')->textInput(['disabled'=>true, 'name'=>'currentPrice'])->label('Curretn Price') ?>
            <?= $form->field($productPriceSuppliers, 'price')->textInput(['value'=>0, 'id'=>'productPrice'])->label('New Price') ?>
            <div class="col-md-9 col-md-offset-3">
                <?=Html::submitButton('Change Price', ['class'=>'btn btn-primary btn-block btn-lg'])?>
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

$('#productPrice').blur(function(){
    var marketPrice = Number($('#marketPrice').val());
    var productPrice= Number($(this).val());
    
    if(marketPrice < productPrice) {
        alert('ราคาขายต้องไม่เกิน Market Price');
        $(this).val(0).focus().select();
    }
});

$('#productPrice').focus(function(){
    $(this).select();
});

$(document).ready(function() {
    $('#productPrice').keydown(function (e) {
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