<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\Product;
use common\models\costfit\Order;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Picking Order Slots';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-7"><?= $this->title ?></div>
            <div class="col-md-5">
                <div class="btn-group">
                    Led Color : <input type="text" style="background-color: <?= $color ?>;" disabled="true"/>
                </div>
                <div class="btn-group pull-right">
                    <?=
                    Html::a('<i class="fa fa-print" aria-hidden="true"></i> Print Order', ['print-order',
                        'order' => $allOrderId
                    ], ['class' => 'btn btn-sm btn-success', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
            'method' => 'GET',
            'action' => ['picking/index'],
        ]);
        foreach ($selection as $select):
            echo '<input type="hidden" name="selection[]" value="' . $select . '">';
        endforeach;
        ?>

        <h4>   Slot QR code : <input type="text" name="qrSlot" autofocus="true" id="qrSlot"></h4>

        <?= $this->registerJS("
                            $('#qrSlot').blur(function(event){
                                if(event.which == 13 || event.keyCode == 13)
                                {
                                   $('#form').submit();
                                }
                            });
                ") ?>
        <?php ActiveForm::end(); ?>
        <br>
        <?php
        //throw new \yii\base\Exception(print_r($slots, true));
        foreach ($slots as $slot):
            $i = 1;
            ?>
            <h4>Slot : <?php
                if ($slot == 'a') {
                    echo 'ไม่มีข้อมูล';
                } else {
                    echo "<font color='$color'><b>" . $allSlot->getSlotName($slot) . '</b></font>';
                }
                ?></h4>
            <table class="table table-condensed" style="text-align: center;">
                <thead>
                    <tr >
                        <th><center>No.</center></th>
                <th><center>Products</center></th>
                <th><center>Quantity</center></th>
                <th><center>Order No.</center></th>
                <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    // throw new \yii\base\Exception(print_r($allOrderId, true));
                    $product = common\models\costfit\StoreProductArrange::findItems($slot, $allOrderId);
                    $couuntProduct = 0;
                    $a = 0;
                    $total = 0;
                    $oldProductId = '';
                    $oldOrderId = '';
                    if (isset($product) && !empty($product)) {
                        foreach ($product as $productId):
                            $item = common\models\costfit\OrderItem::findOrderItems($productId->orderId, $productId->productId);

                            if (isset($item) && !empty($item)) {
                                if (($oldProductId != $productId->productId) || ($oldOrderId != $productId->orderId)) {
                                    ?><tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo Product::findProductName($productId->productId); ?></td>
                                        <td><?php echo common\models\costfit\StoreProductArrange::sumQuantitiy($productId->productId, $productId->orderId, $slot); ?></td>
                                        <td><?php echo Order::findOrderNo($productId->orderId); ?></td>
                                        <td><?=
                                            ($productId->status == 99) ?
                                            Html::a('<i aria-hidden="true"></i> หยิบ', ['pick-item',
                                                'arrangeId' => $productId->storeProductArrangeId,
                                                'orderId' => $item->orderId,
                                                'orderItemId' => $item->orderItemId,
                                                'productId' => $item->productId,
                                                'orderQuantity' => -($productId->quantity),
                                                'slot' => $slot,
                                                'arraySlots' => $slots,
                                                'colorId' => $colorId,
                                                'color' => $color,
                                                'allOrderId' => $allOrderId,
                                                'selection' => $selection
                                            ], ['class' => 'btn btn-warning']) : Html::a('<i class="fa fa-check" aria-hidden="true"></i> หยิบแล้ว', ['pick-item'
                                            ], ['class' => 'btn btn-defult', 'disabled' => true]);
                                            // throw new \yii\base\Exception($item->orderItemId);
                                            ?></td>
                                    </tr>

                                    <?php
                                }
                                $oldProductId = $productId->productId;
                                $oldOrderId = $productId->orderId;
                                $checkId = \common\models\costfit\StoreProductArrange::checkProductId($a, $allOrderId, $slot);
                                // $array[$a] = $productId->productId;
                                // $a++;
                                if ($checkId) {

                                    $total = \common\models\costfit\StoreProductArrange::findProductInSlot($slot, $allOrderId, $productId->productId);
                                    ?>
                                    <tr style="background-color: #F5F5F5;">
                                        <td colspan="2" class="text-right"><b>Total ( <?php echo Product::findProductName($item->productId); ?> )</b></td>
                                        <td><b><?php echo $total; ?></b></td>
                                        <td><b></b></td>
                                        <td><b></b></td>

                                    </tr>
                                    <?php
                                }
                                $a++;
                                $i++;
                            }
                        endforeach;
                        // throw new \yii\base\Exception(print_r($array, true));
                    }
                    ?>
                </tbody>
            </table>
            <?php
        endforeach;
        ?>
    </div>
</div>
