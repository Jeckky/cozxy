<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\costfit\StoreProductGroup;

Pjax::begin(['id' => 'employee-grid-view']);
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">PO No. <?= $model->poNo ?></div>
            <div class="col-md-6 text-right">Supplier : <?= isset($model->supplierAddress->company) && !empty($model->supplierAddress->company) ? $model->supplierAddress->company : ''; ?></div>
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
                foreach ($model->poItem as $product):
                    //throw new \yii\base\Exception($product->products->units);
                    $form = ActiveForm::begin(['options' => [
                                    'enctype' => 'multipart/form-data'],
                                'method' => 'POST',
                                'action' => ['store-product/check']]); //อาจจะผิดตรงนี้
                    ?>

                    <tr>
                        <td><center><?php echo $i; ?></center></td>
                <td><center><?= isset($product->products->title) ? $product->products->title : '' ?></center><br><br>
                <?= isset($product->products->images->image) ? Html::img($baseUrl . '/' . $product->products->images->image, ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) : Html::img($baseUrl . "/images/ContentGroup/DUHWYsdXVc.png", ['style' => 'width:150px', 'class' => 'col-lg-offset-3']) ?>
                </td>
                <td><center><?php echo $product->quantity; ?></center></td>
                <td><center><?= isset($product->products->units->title) ? $product->products->units->title : '' ?></center></td>
                <td class="text-right"><?php echo number_format($product->price, 2); ?></td>
                <td class="text-right"><?php echo number_format($product->price * $product->quantity, 2); ?></td>
                <td><center>
                    <?php
                    if ($product->status == 1) {//ปกติ ยังไม่มีการกดรับ
                        ?>
                        <input type="radio" name="check[<?= $product->poItemId ?>]" value="1" onclick="hide(<?= $product->poItemId ?>)">&nbsp; ครบ &nbsp;&nbsp;&nbsp;
                        <input type="radio"  name="check[<?= $product->poItemId ?>]" value="2" onclick="show(<?= $product->poItemId ?>)">&nbsp; ไม่ครบ &nbsp;&nbsp;&nbsp;<br><br>
                        <div id="notAll<?= $product->poItemId ?>" style="display: none;">
                            <?php // throw new \yii\base\Exception($product->storeProductId);   ?>
                            <input type="text"  name="quantity[<?= $product->poItemId ?>]" style="width: 100px;" placeholder="จำนวนที่รับ"><?= isset($product->products->units->title) ? $product->products->units->title : '' ?>
                        </div>
                        <br>
                        <input type="hidden" name="poItemId" value="<?= $product->poItemId ?>">
                        <input type="hidden" name="poId" value="<?= $model->poId ?>">
                        <div id="all<?= $product->poItemId ?>" style="display: none;">
                            <textarea  name="remark[<?= $product->poItemId ?>]" style="height: 50px;" placeholder="Remark"></textarea>
                        </div>
                        <?php if ($product->products->isbn == null || $product->products->isbn == '') { ?>
                            <a class="btn btn-warning btn-md" id ="addIsbn<?= $product->poItemId ?>" data-toggle="modal" data-target="#isbn<?= $product->poItemId ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="margin:14px auto 2px;padding: 6px 16px;">
                                <i class='glyphicon glyphicon-plus'></i> ISBN</a>
                            <?=
                            Html::submitButton('<i class=\'glyphicon glyphicon-check\'></i> ยืนยัน', ['class' => 'btn btn-success btn-md',
                                'id' => "submit$product->poItemId",
                                'style' => 'display:none;'
                            ])
                            ?>
                        <?php } else {
                            ?>
                            <?=
                            Html::submitButton('<i class=\'glyphicon glyphicon-check\'></i> ยืนยัน', ['class' => 'btn btn-success btn-md',
                                'id' => "submit$product->poItemId",
                            ])
                            ?>
                            <?php
                        }
                    } else if ($product->status == 3) {//รับครบ
                        ?><b>Received</b><?php
                        } else if ($product->status == 2) {//รับแล้วแต่ยังไม่ครบ
                            echo "<b>Received " . $product->importQuantity . " " . $product->products->units->title . "</b><br><br>";
                            ?>
                        <input type="radio" name="check[<?= $product->poItemId ?>]" value="1" onclick="hide(<?= $product->poItemId ?>)">&nbsp; ครบ &nbsp;&nbsp;&nbsp;
                        <input type="radio"  name="check[<?= $product->poItemId ?>]" value="2" onclick="show(<?= $product->poItemId ?>)">&nbsp; ไม่ครบ &nbsp;&nbsp;&nbsp;<br><br>
                        <div id="notAll<?= $product->poItemId ?>" style="display: none;">
                            <input type="text"  name="quantity[<?= $product->poItemId ?>]" style="width: 100px;" placeholder="จำนวนที่รับ"><?php echo $product->products->units->title; ?>
                        </div>
                        <br>
                        <input type="hidden" name="poItemId" value="<?= $product->poItemId ?>">
                        <input type="hidden" name="poId" value="<?= $model->poId ?>">
                        <div id="all<?= $product->poItemId ?>" style="display: none;">
                            <textarea  name="remark[<?= $product->poItemId ?>]" style="height: 50px;" placeholder="Remark"></textarea>
                        </div>

                        <?= Html::submitButton('<i class=\'glyphicon glyphicon-plus\'></i> ยืนยัน', ['class' => 'btn btn-warning btn-md']) ?>
                        <?php
                    }
                    if ($product->poItemId == $errorId) {
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
<?php
$this->registerJS("function show(id)
    {
        //alert(id);
        $('#all' + id).show();
        $('#notAll' + id).show();

    }
    function hide(id)
    {
        //alert(id);
        $('#all' + id).hide();
        $('#notAll' + id).hide();

    }");
?>
<?php foreach ($model->poItem as $product): ?>
    <div class="modal fade" id="isbn<?= $product->poItemId ?>" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWishlistModal"><i class="fa fa-times"></i>
                    </button>
                    <h4>ADD ISBN : <b><?= $product->products->title ?></b></h4>
                </div>
                <div class="modal-body" style="padding: 40px;">
                    <h4>Scan product's isbn</h4><br>
                    <input type="text" class="form-control" id="inputIsbn<?= $product->poItemId ?>" style="height: 50px;"><br>
                    <button class="btn btn-primary btn-lg pull-right" onclick="javascript:saveIsbn(<?= $product->products->productSuppId ?>,<?= $product->poItemId ?>)">OK</button><br>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
<?php endforeach;
?>
<!--<script>

//    function show(id)
//    {
//        //alert(id);
//        $('#all' + id).show();
//        $('#notAll' + id).show();
//
//    }
//    function hide(id)
//    {
//        //alert(id);
//        $('#all' + id).hide();
//        $('#notAll' + id).hide();
//
//    }
</script>-->