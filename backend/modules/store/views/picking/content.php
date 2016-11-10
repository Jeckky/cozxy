<?php

use yii\helpers\Html;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$j = 1;
//throw new \yii\base\Exception(print_r($orders, true));
?><?php
foreach ($orders as $order) {
    $i = 1;
    ?>
    <br><br><br><br><br>
    <table class="table table_bordered" width="100%"  cellpadding="3" cellspacing="0">
        <tr>
            <td colspan="4"><h4>Order No : <?= $order->orderNo ?></h4></td>
            <td style="text-align: right; vertical-align: text-top;"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?= $order->orderNo ?>"></td>
        </tr>
        <thead>
            <tr>
                <th><center>No.</center></th>
    <th><center>Item</center></th>
    <th><center>Quantity</center></th>
    <th><center>Unit</center></th>
    <th><center>Send Date</center></th>
    </tr>
    </thead>
    <tbody>
        <?php
        $items = \common\models\costfit\Order::orderItems($order->orderId);
        foreach ($items as $item):
            echo '<tr>';
            echo '<td><center>' . $i . '</center></td>';
            echo '<td><center>' . common\models\costfit\Product::findProductName($item->productId) . '</center></td>';
            echo '<td style="text-align: right;">' . $item->quantity . '</td>';
            echo '<td><center>' . common\models\costfit\Product::findUnit($item->productId) . '</center></td>';
            echo '<td><center>' . substr($item->sendDateTime, 0, 10) . '</center></td>';
            echo '</tr>';
            $i++;
        endforeach;
        ?>
    </tbody>
    </table>
    <?php
    // throw new \yii\base\Exception(count($orders));
    if ($j < count($orders)) {
        ?>
        <pagebreak />
        <?php
    }
    $j++;
}
?>

