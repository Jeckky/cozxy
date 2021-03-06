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
                        <th>poId</th>
                        <th>poNo</th>
                        <th>summary</th>
                        <th>วันที่สร้าง ใบ​สั่ง​ซื้อ / Purchase Order</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num = 1;
                    foreach ($Po as $value) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $num++; ?></th>
                            <td><?php echo $value['poId']; ?></td>
                            <td><?php echo $value['poNo']; ?></td>
                            <td><?php echo $value['summary']; ?></td>
                            <td><?php echo $value['createDateTime']; ?></td>
                            <td>
                                <a class="btn btn-warning" href="<?php echo Yii::$app->homeUrl; ?>order/order/reprint-po?poId=<?php echo $value['poId']; ?>"><i class="fa fa-eye" aria-hidden="true"></i> ดูใบ​สั่ง​ซื้อ / Purchase Order</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>