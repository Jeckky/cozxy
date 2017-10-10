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
                                <td><?= $child->price ?></td>
                                <td><?= Html::textInput("ProductSuppliers[$child->productId][price]", 0, ['class' => 'form-control']) ?></td>
                                <td><?= Html::textInput("ProductSuppliers[$child->productId][result]", 0, ['class' => 'form-control']) ?></td>
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

");
?>
