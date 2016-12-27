<table class="table">
    <tr style="height: 50px;background-color: #F0FFFF;">
        <th style="vertical-align: middle;text-align: center;width: 10%;">ลำดับที่</th>
        <th style="vertical-align: middle;text-align: center;width: 30%;">Order Invoice.</th>
        <th style="vertical-align: middle;text-align: center;width: 15%;">จำนวนรายการ</th>
        <th style="vertical-align: middle;text-align: center;width: 30%;">สถานะ</th>
    </tr>
    <?php
    //$a = Yii::$app->homeUrl;
    //throw new \yii\base\Exception($a);
    if (isset($model) && !empty($model)) {
        $i = 1;
        $a = 0;
        $orderId = [];
        foreach ($model as $order):
            ?>
            <tr>
                <td style="vertical-align: middle;text-align: center;width: 5%;"><?= $i ?></td>
                <td style="vertical-align: middle;text-align: center;width: 30%;"><?= $order->invoiceNo ?></td>
                <td style="vertical-align: middle;text-align: center;width: 15%;"><?= common\models\costfit\Order::countOrderItem($order->orderId) ?> รายการ</td>
                <td style="vertical-align: middle;text-align: center;width: 15%;"><?= $order->getStatusText($order->status) ?></td>
            </tr>
            <?php
            $orderId[$a] = $order->orderId;
            $a++;
            $i++;
        endforeach;
    } else {
        ?>
        <tr><td colspan="5" style="text-align: center; background-color: #cccccc;"><h4> ไม่มีข้อมูล</h4></td></tr>
    <?php }
    ?>
</table>

<?php
if (isset($model) && !empty($model)) {
    echo '<div class="pull-right">' . Html::a('<i class="fa fa-check-square-o" aria-hidden="true">  สร้างใบ PO</i>', ['create-po', 'orderId' => $orderId], ['class' => 'btn btn-lg btn-success pono', 'target' => '_blank']) . '</div>';
}
?>


<table class="table" >
    <tr style="height: 50px;background-color: #ffffcc;">
        <th style="vertical-align: middle;text-align: center;width: 10%;">ลำดับที่</th>
        <th style="vertical-align: middle;text-align: center;width: 30%;">PO NO.</th>
        <th style="vertical-align: middle;text-align: center;width: 15%;">วันที่สร้าง</th>
        <th style="vertical-align: middle;text-align: center;width: 30%;">สถานะ</th>
        <th style="vertical-align: middle;text-align: center;width: 30%;">พิมพ์ซ้ำ</th>
    </tr>

    <?php
    $poes = \common\models\costfit\StoreProductGroup::allPurchaseOrder();

    if (isset($poes) && !empty($poes)) {
        $i = 1;
        $a = 0;
        $orderId = [];
        foreach ($poes as $po):
            ?>
            <tr>
                <td style="vertical-align: middle;text-align: center;width: 5%;"><?= $i ?></td>
                <td style="vertical-align: middle;text-align: center;width: 30%;"><?= $po->poNo ?></td>
                <td style="vertical-align: middle;text-align: center;width: 15%;"><?= $this->context->dateThai($po->createDateTime, 1) ?></td>
                <td style="vertical-align: middle;text-align: center;width: 15%;"><?= \common\models\costfit\StoreProductGroup::getStatusText($po->status) ?></td>
                <td style="vertical-align: middle;text-align: center;width: 15%;"><?= Html::a('<i class="fa fa-print" aria-hidden="true"></i> พิมพ์ซ้ำ', ['reprint-po', 'storeProductGroupId' => $po->storeProductGroupId], ['class' => 'btn btn-md btn-warning pono', 'target' => '_blank']) ?></td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>

        <?php
    } else {
        ?>
        <tr><td colspan="5" style="text-align: center; background-color: #cccccc;"><h4> ไม่มีข้อมูล</h4></td></tr>
    <?php }
    ?>
</table>