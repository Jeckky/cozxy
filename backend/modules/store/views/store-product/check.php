<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
            <th colspan="4"><center>From PO</center></th>
            <th rowspan="2"><center>Check</center></th></tr>
            <tr>
                <th><center>No.</center></th>
            <th><center>Product</center></th>
            <th><center>Quantity</center></th>
            <th><center>Units</center></th>
            <th><center>Price</center></th>
            <th><center>Amount</center></th>

            </tr>
            </thead>
            <tbody>

                <?php
                $i = 1;
                foreach ($model->storeProducts as $product):
                    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                                'method' => 'POST',
                                'action' => ['store-product/check']]);
                    ?>

                    <tr>
                        <td><center><?php echo $i; ?></center></td>
                <td><center><?php echo $product->products->title; ?></center><br><br>
                <?= isset($product->products) ? Html::img(Yii::$app->homeUrl . $product->products->images->image, ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : NULL ?>
                </td>
                <td><center><?php echo $product->quantity; ?></center></td>
                <td><center><?php echo $product->products->units->title; ?></center></td>
                <td class="text-right"><?php echo number_format($product->price, 2); ?></td>
                <td class="text-right"><?php echo number_format($product->price * $product->quantity, 2); ?></td>
                <td><center>
                    <?php
                    if ($product->status == 1) {//ปกติ ยังไม่มีการกดรับ
                        ?>
                        <input type="radio" name="check[<?= $product->storeProductId ?>]" value="1" onclick="hide(<?= $product->storeProductId ?>)">&nbsp; ครบ &nbsp;&nbsp;&nbsp;
                        <input type="radio"  name="check[<?= $product->storeProductId ?>]" value="2" onclick="show(<?= $product->storeProductId ?>)">&nbsp; ไม่ครบ &nbsp;&nbsp;&nbsp;<br><br>
                        <div id="notAll<?= $product->storeProductId ?>" style="display: none;">
                            <input type="text"  name="quantity[<?= $product->storeProductId ?>]" style="width: 100px;" placeholder="จำนวนที่รับ"><?php echo $product->products->units->title; ?>
                        </div>
                        <br>
                        <input type="hidden" name="storeProductId" value="<?= $product->storeProductId ?>">
                        <input type="hidden" name="storeProductGroupId" value="<?= $model->storeProductGroupId ?>">
                        <div id="all<?= $product->storeProductId ?>" style="display: none;">
                            <textarea  name="remark[<?= $product->storeProductId ?>]" style="height: 50px;" placeholder="Remark"></textarea>
                        </div>

                        <?= Html::submitButton('<i class=\'glyphicon glyphicon-plus\'></i> ยืนยัน', ['class' => 'btn btn-warning btn-md']) ?>
                        <?php
                    } else if ($product->status == 2) {//รับครบ
                        ?><b>Received</b><?php
                    } else if ($product->status == 3) {//รับแล้วแต่ยังไม่ครบ
                        echo "<b>Received " . $product->importQuantity . " " . $product->products->units->title . "</b><br><br>";
                        ?>
                        <input type="radio" name="check[<?= $product->storeProductId ?>]" value="1" onclick="hide(<?= $product->storeProductId ?>)">&nbsp; ครบ &nbsp;&nbsp;&nbsp;
                        <input type="radio"  name="check[<?= $product->storeProductId ?>]" value="2" onclick="show(<?= $product->storeProductId ?>)">&nbsp; ไม่ครบ &nbsp;&nbsp;&nbsp;<br><br>
                        <div id="notAll<?= $product->storeProductId ?>" style="display: none;">
                            <input type="text"  name="quantity[<?= $product->storeProductId ?>]" style="width: 100px;" placeholder="จำนวนที่รับ"><?php echo $product->products->units->title; ?>
                        </div>
                        <br>
                        <input type="hidden" name="storeProductId" value="<?= $product->storeProductId ?>">
                        <input type="hidden" name="storeProductGroupId" value="<?= $model->storeProductGroupId ?>">
                        <div id="all<?= $product->storeProductId ?>" style="display: none;">
                            <textarea  name="remark[<?= $product->storeProductId ?>]" style="height: 50px;" placeholder="Remark"></textarea>
                        </div>

                        <?= Html::submitButton('<i class=\'glyphicon glyphicon-plus\'></i> ยืนยัน', ['class' => 'btn btn-warning btn-md']) ?>
                        <?php
                    }
                    if ($product->storeProductId == $errorId) {
                        echo "<br><code>" . $msError . "</code>";
                    }
                    ?>
                </center>
                </td>

                </tr>
                <?php
                $i++;
                ActiveForm::end();
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php Pjax::end(); ?>
<script>
    function show(id)
    {
        // alert(id);
        $('#all' + id).show();
        $('#notAll' + id).show();

    }
    function hide(id)
    {
        // alert(id);
        $('#all' + id).hide();
        $('#notAll' + id).hide();

    }
</script>