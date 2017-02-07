<?php

use yii\helpers\Html;
use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\Product;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?><?php
//$id = Order::findOrderId($orderId);
?>
<table class="table table_bordered" width="100%"  cellpadding="3" cellspacing="0" style="border: 0px;">
    <tr>
        <td style="text-align: center;width:20%">Order No</td>
        <td style="text-align: center;width:20%">Supplier</td>
        <td style="text-align: center;width:25%">Product</td>
        <td style="text-align: center;width:10%">Quantity</td>
        <td style="text-align: center;width:10%">Price</td>
        <td style="text-align: center;width:15%">Total</td>
    </tr>
</table>

<table class="table table_bordered" width="100%"  cellpadding="3" cellspacing="0">
    <tr>
        <td colspan="3"><center><b>สินค้า</b></center></td>
</tr>
<tr>

    <td><center>No.</center></td>
<td><center>สินค้า</center></td>
<td><center>จำนวน</center></td>
</tr>
<tbody>

</tbody>
</table>

