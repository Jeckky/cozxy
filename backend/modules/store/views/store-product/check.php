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
            <th colspan="3"><center>From PO</center></th>
            <th rowspan="2"><center>Check</center></th></tr>
            <tr>
                <th><center>No.</center></th>
            <th><center>Product</center></th>
            <th><center>Quantity</center></th>
            <th><center>Units</center></th>
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
                <td><center><?php echo $product->products->title; ?></center><br><br>
                <?php echo isset($product->products->image) ? $product->products->title : NULL ?>
                </td>
                <td><center><?php echo $product->quantity; ?></center></td>
                <td><center><?php echo $product->products->units->title; ?></center></td>
                <td class="text-right"><?php echo number_format($product->price, 2); ?></td>
                <td><center>
                    <input type="radio" name="check<?= $product->storeProductId ?>" value="1"> ครบ &nbsp;&nbsp;&nbsp;
                    <input type="radio"  name="check<?= $product->storeProductId ?>" value="2" onclick="change(<?= 0, $product->storeProductId ?>)"> ไม่ครบ &nbsp;&nbsp;&nbsp;
                    <input type="radio"  name="check<?= $product->storeProductId ?>" value="0" onclick="change(<?= 2, $product->storeProductId ?>)"> ไม่รับ<br><br>
                    <input type="text" id="notAll" name="Quantity<?= $product->storeProductId ?>" style="width: 100px;display: none;" placeholder="จำนวนที่รับ">&nbsp;&nbsp;&nbsp;
                    <textarea id="all" name="Quantity<?= $product->storeProductId ?>" style="height: 50px;display: none;" placeholder="Remark"></textarea>

                </center>
                </td>
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
<script>
    function change(value, id)
    {
        alert(value);
        if (value == 2) {
            $('#all').show();
            $('#notAll').show();
        } else {
            $('#contact').hide();
        }
        if (value == 0) {
            $('#all.id').show();
        } else {
            $('#bookingbudget').hide();
        }
    }
</script>