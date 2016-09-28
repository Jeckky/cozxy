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
                    $product = common\models\costfit\StoreProductArrange::findItems($slot);
                    $couuntProduct = 0;
                    if (isset($product) && !empty($product)) {
                        foreach ($product as $productId):
                            $total = 0;
                            foreach ($allOrderId as $orderId):
                                $item = common\models\costfit\OrderItem::findOrderItems($orderId, $productId->productId);
                                if (isset($item) && !empty($item)) {
                                    ?><tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo Product::findProductName($item->productId); ?></td>
                                        <td><?php echo $item->quantity; ?></td>
                                        <td><?php echo Order::findOrderNo($item->orderId); ?></td>
                                        <td><?=
                                            ($item->status != 5) ?
                                                    Html::a('<i aria-hidden="true"></i> หยิบ', ['pick-item',
                                                        'orderId' => $item->orderId,
                                                        'orderItemId' => $item->orderItemId,
                                                        'productId' => $item->productId,
                                                        'orderQuantity' => $item->quantity,
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
                                    $i++;
                                    $total+=$item->quantity;
                                }
                            endforeach;
                            ?><tr>
                                <?php if (isset($item) && !empty($item)) { ?>
                                    <td colspan="2" class="text-right"><b>Total ( <?php echo Product::findProductName($item->productId); ?> )</b></td>
                                    <td><b><?php echo $total; ?></b></td>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                <?php } else {
                                    ?>
                                    <td colspan="2" class="text-right"><b>Total ( <?php echo Product::findProductName($productId->productId); ?> )</b></td>
                                    <td><b><?php echo $total; ?></b></td>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <?php
                                }
                                ?>
                            </tr><?php
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
            <?php
        endforeach;
        ?>
    </div>
</div>
