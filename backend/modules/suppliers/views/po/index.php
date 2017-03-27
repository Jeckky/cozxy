<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'รายการใบ​สั่ง​ซื้อ / Purchase Order';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-image-suppliers-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        รายการใบ​สั่ง​ซื้อ / Purchase Order
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>orderId</th>
                        <th>orderNo</th>
                        <th>invoiceNo</th>
                        <th>วันที่สร้าง</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num = 1;
                    foreach ($Po as $value) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $num++; ?></th>
                            <td><?php echo $value['orderId']; ?></td>
                            <td><?php echo $value['orderNo']; ?></td>
                            <td><?php echo $value['invoiceNo']; ?></td>
                            <td><?php echo $this->context->dateThai($value['updateDateTime'], 1, TRUE); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>