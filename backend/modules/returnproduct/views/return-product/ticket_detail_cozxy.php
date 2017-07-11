
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\Order;
use common\models\costfit\Ticket;
use common\models\costfit\User;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Product;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">รายละเอียดการขอคืน</h3></span>
        </div>
        <div class="row">
            <br>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div style="font-size: 11pt;padding-left: 5px;">
                    OrderNo : <?= Order::findOrderNo($orderId) ?>&nbsp;&nbsp;&nbsp;
                    Invoice : <?= Order::invoiceNo($orderId) ?><br>
                    Customer: <?= Order::findReciever($orderId) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Tel : <?= User::userTel($ticket->userId) ?><br>
                    TicketNo : <?= $ticket->ticketNo ?><br>
                    ReturnPoint : <?= $textReturn ?>
                    <hr>
                    <strong>Title : </strong><?= $ticket->title ?><br>
                    <strong>Description :</strong>

                    <?= $ticket->description ?><br>

                </div>
                <br>
                <?php
                $form = ActiveForm::begin([
                            'method' => 'POST',
                            'id' => 'confirmation',
                            'action' => ['return-product/approve-ticket-cozxy'],
                ]);
                ?>
                <input type="hidden" name="orderId" value="<?= $orderId ?>">
                <div class="pull-left"><h4>สินค้าที่ต้องการคืน</h4></div>
                <div class="pull-left" style="color:red;"><?= isset($ms) && $ms != '' ? ' * ' . $ms : '' ?></div>
                <div class="pull-right">สถานะปัจจุบัน : <?= Ticket::statusText($ticket->ticketId) ?></div>
                <table class="table" style="width:100%;">
                    <tr style="height: 50px;background-color: #999999;">
                        <th style="vertical-align: middle;text-align: center;width: 5%;">No.</th>
                        <th style="vertical-align: middle;text-align: center;width: 20%;">สินค้า</th>
                        <th style="vertical-align: middle;text-align: center;width: 5%;">จำนวน</th>
                        <th style="vertical-align: middle;text-align: center;width: 15%;">Coin</th>
                        <th style="vertical-align: middle;text-align: center;width: 15%;">Date</th>
                        <th style="vertical-align: middle;text-align: center;width: 20%;">Remark</th>
                        <th style="vertical-align: middle;text-align: center;width: 30%;">Return</th>
                    </tr>
                    <?php foreach ($returnProduct as $i => $item): ?>
                        <tr class="text-center">
                            <td><?= $i + 1 ?></td>
                            <td>
                                <img src="<?= $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($item->productSuppId)[0]->image ?>" style="width:100px;height: 80px;">
                                <br><?= ProductSuppliers::productSupplierName($item->productSuppId)->title ?>
                            </td>
                            <td><?= $item->quantity ?></td>
                            <td><?= number_format($item->credit, 2) ?></td>
                            <td><?= substr($this->context->dateThai($item->updateDateTime, 3, true), 0, -8) ?></td>
                            <td><?= $item->remark ?></td>
                            <?php
                            if ($item->status == 4) {
                                ?>
                                <td><input type="radio" name="isAccept[<?= $item->returnProductId ?>]" id="accept<?= $item->returnProductId ?>" value="1" onclick="javascript:hideRemark(<?= $item->returnProductId ?>)"> รับคืน&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="isAccept[<?= $item->returnProductId ?>]" id="notAccept<?= $item->returnProductId ?>" value="0" onclick="javascript:showRemark(<?= $item->returnProductId ?>)"> ไม่รับคืน
                                    <textarea style="width: 100%;height: 70px;margin-top: 10px;display: none;" id="remark<?= $item->returnProductId ?>" name="remark[<?= $item->returnProductId ?>]"></textarea>
                                </td>
                                <?php
                            } else {
                                if ($item->status == 5) {
                                    echo '<td>Cozxy approve</td>';
                                } else if ($item->status == 6) {
                                    echo '<td>Cozxy not approve</td>';
                                } else {
                                    echo '<td>booth not approve</td>';
                                }
                            }
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <input type="hidden" value="<?= $ticket->ticketId ?>" id="ticketId" name="ticketId">
                <?php if ($ticket->status == Ticket::TICKET_STATUS_WAIT_COZXY) { ?>
                    <button class="btn-lg pull-right"  style="background-color: #000;color: #ffcc00;cursor: pointer;" type="submit"><i class="fa fa-check-circle-o" aria-hidden="true"></i>ยืนยัน</button>
                        <!--<a class="btn-lg pull-right" id="not-approve-cozxy" style="background-color: #999999;color: #000;cursor: pointer;margin-right: 5px;"><i class="fa fa-times-circle-o" aria-hidden="true"></i>Not Approve</a>-->
                <?php } ?>
                <a href="<?= $baseUrl . 'cozxy-approve-return' ?>" class="btn-lg pull-right"  style="margin-right: 5px;background-color: #ffcc00;;color: #000;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<!--    <div id="printableArea">
        <h1>Print me</h1>
    </div>-->
