<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Product Suppliers</div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'product-suppliers-form',
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
                    <table class="table table-bordered">
                        <tr>
                            <th>Product</th>
                            <th>Market Price</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                        <?php $i = 0; ?>
                        <?php foreach($product->products as $child): ?>
                            <tr>
                                <td><?= $child->title ?> (<?= implode(', ', $child->productOptions()) ?>)</td>
                                <td id="marketPrice<?=$child->productId?>"><?= $child->price ?></td>
                                <td><?= Html::textInput("ProductSuppliers[$child->productId][price]", 0, ['class' => 'form-control productPrice', 'data-id'=>$child->productId]) ?></td>
                                <td><?= Html::textInput("ProductSuppliers[$child->productId][result]", 0, ['class' => 'form-control productStock']) ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </table>
                    <?= Html::submitButton('Create Product Suppliers', ['class' => 'btn btn-primary btn-block btn-lg', 'name' => 'createProductSuppliers']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
$this->registerJs("
$('.productPrice').blur(function(e){
    var id = $(this).attr('data-id');
    var marketPrice = Number($('#marketPrice'+id).html());
    var productPrice= Number($(this).val());
    
    if(marketPrice < productPrice) {
        alert('ราคาขายต้องไม่เกิน Market Price');
        $(this).val(0).focus().select();
    }
});

$('.productStock').blur(function(e){
    if($(this).val() < 0) {
        alert('Stock ต้อง > 0');
        $(this).val(0).focus().select();
    }
});

$(document).ready(function() {
    $('.productPrice').keydown(function (e) {
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
    
    $('.productStock').keydown(function (e) {
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
});

$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
");
?>
