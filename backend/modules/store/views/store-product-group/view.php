<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\StoreProductGroup */

$this->title = $model->storeProductGroupId;
$this->params['breadcrumbs'][] = ['label' => 'Store Product Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="store-product-group-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->storeProductGroupId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->storeProductGroupId], [
                    'class' => 'btn btn-xs btn-outline btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-3" style="font-weight: bold">PO No</div>
                <div class="col-lg-9"><?= $model->poNo; ?></div>
            </div>
            <div class="row">
                <div class="col-lg-3" style="font-weight: bold">PO Date</div>
                <div class="col-lg-9"><?= $this->context->dateThai($model->receiveDate, 1) ?></div>
            </div>
            <div class="row">
                <div class="col-lg-3" style="font-weight: bold">Supplier</div>
                <div class="col-lg-9"><?= isset($model->supplier) ? $model->supplier->name : "-" ?></div>
            </div>
            <div class="row">
                <div class="col-lg-3" style="font-weight: bold">No of product</div>
                <div class="col-lg-9"><?= count($model->storeProducts) ?></div>
            </div>
            <div class="row">
                <div class="col-lg-3" style="font-weight: bold">Create Date</div>
                <div class="col-lg-9"><?= $this->context->dateThai($model->createDateTime, 1) ?></div>
            </div>
            <div class="row">
                <div class="col-lg-3" style="font-weight: bold">Last Update Date</div>
                <div class="col-lg-9"><?= $this->context->dateThai($model->updateDateTime, 1) ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Seq</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($model->storeProducts as $item):
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $item->product->title; ?></td>
                                    <td><?= number_format($item->quantity); ?></td>
                                    <td><?= number_format($item->price); ?></td>
                                    <td><?= number_format($item->total); ?></td>
                                </tr>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right" style="font-weight: bold">Summary</td>
                                <td style="color: red;font-weight: bold"><?= number_format($model->summary) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
