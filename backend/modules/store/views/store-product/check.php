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
                    <th colspan="4"><center>From PO</center></th>
            <th colspan="2"><center>Check</center></th></tr>
            <tr>
                <th>No.</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            </thead>

        </table>
    </div>
</div>
<?php Pjax::end(); ?>
