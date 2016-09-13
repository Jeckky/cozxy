<?php

use yii\helpers\Html; ?>
<div class="panel-heading" >
    <div class="row">
        <div class="col-md-6"><h4><?= isset($userName) ? $userName : '=' ?></h4></div>

    </div>
</div>
<div class="panel-body">
    <div class="col-md-12 col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Order No.</th>
                    <th class="text-center">Invoice No.</th>
                    <th class="text-center">CreateDate</th>
                    <th class="text-center">Status</th>
                    <th class="text-right">Summary (THB.)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $total = 0;
                foreach ($model as $order) {
                    echo '<tr>';
                    echo '<td class="text-center">' . $i . '</td>';
                    echo '<td class="text-center">' . $order->orderNo . '</td>';
                    echo '<td class="text-center">' . $order->invoiceNo . '</td>';
                    echo '<td class="text-center">' . $order->createDateTime . '</td>';
                    echo '<td class="text-center">' . $order->getStatusText($order->status) . '</td>';
                    echo '<td class="text-right">' . number_format($order->summary, 2) . '</td>';
                    echo '<td>' . Html::a('<span style="margin-left:30px;">รายละเอียด</span>', Yii::$app->homeUrl . "order/order/view/" . $order->encodeParams(['id' => $order->orderId])) . '</td>';
                    echo '</tr>';
                    $total+=$order->summary;
                    $i++;
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total</th>
                    <th class="text-right"><?php echo number_format($total, 2); ?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php

