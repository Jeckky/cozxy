<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

Pjax::begin(['id' => 'employee-grid-view']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">PO No. <?= $model->poNo ?></div>
            <div class="col-md-6 text-right">Supplier : <?= $model->supplierName->name; ?></div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr >
                    <th colspan="2"><center>Product</center></th>
            <th colspan="2"><center>From PO</center></th>
            <th colspan="2"><center>Check</center></th></tr>
            <tr>
                <th><center>No.</center></th>
            <th><center>Product</center></th>
            <th><center>Quantity</center></th>
            <th><center>Price</center></th>
            <th><center>Quantity</center></th>
            <th><center>Price</center></th>
            </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($model->storeProducts as $product):
                    ?>
                    <tr>
                        <td><center><?php echo $i; ?></center></td>
                <td><center><?php echo $product->products->title; ?></center></td>
                <td><center><?php echo $product->quantity; ?></center></td>
                <td class="text-right"><?php echo $product->price; ?></td>
                <td><input type="text" name="quantity<?= $product->storeProductId ?>" class="form-control"></td>
                <td><input type="text" name="price<?= $product->storeProductId ?>" class="form-control"></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php Pjax::end(); ?>
