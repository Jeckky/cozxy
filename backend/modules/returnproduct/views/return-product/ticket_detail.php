
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
            <span class="panel-title"><h3 style="color:#ffcc00;">รายละเอียดการสั่งซื้อ</h3></span>
        </div>
        <div class="row">
            <br>
            <div class="col-lg-7 col-md-7 col-xs-12">
                <div style="font-size: 11pt;padding-left: 5px;">
                    OrderNo : <?= Order::findOrderNo($orderId) ?>&nbsp;&nbsp;&nbsp;
                    Invoice : <?= Order::invoiceNo($orderId) ?><br>
                    Customer: <?= Order::findReciever($orderId) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Tel : <?= User::userTel($ticket->userId) ?><br>
                    TicketNo : <?= $ticket->ticketNo ?>
                    <hr>
                </div>
                <br>
                <div class="pull-right">สถานะปัจจุบัน : <?= Ticket::statusText($ticket->ticketId) ?></div>
                <table class="table" style="margin-left: 5px;">
                    <tr style="height: 50px;background-color: #999999;">
                        <th style="vertical-align: middle;text-align: center;width: 5%;">No.</th>
                        <th style="vertical-align: middle;text-align: center;width: 50%;">สินค้า</th>
                        <th style="vertical-align: middle;text-align: center;width: 10%;">จำนวน</th>
                        <th style="vertical-align: middle;text-align: center;width: 35%;">Receive Date</th>
                    </tr>
                    <?php foreach ($orderItems as $i => $item): ?>
                        <tr class="text-center">
                            <td><?= $i + 1 ?></td>
                            <td><img src="<?= $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($item->productSuppId)[0]->image ?>" style="width:100px;height: 80px;"></td>
                            <td><?= $item->quantity ?></td>
                            <td><?= substr($this->context->dateThai($item->updateDateTime, 1, true), 0, -8) ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>
                <input type="hidden" value="<?= $ticket->ticketId ?>" id="ticketId">
                <?php if ($ticket->status == Ticket::TICKET_STATUS_CREATE) { ?>
                    <a class="btn-lg pull-right" id="approve" style="background-color: #000;color: #ffcc00;cursor: pointer;"><i class="fa fa-check-circle-o" aria-hidden="true"></i>Approve</a>
                    <a class="btn-lg pull-right" id="not-approve" style="background-color: #999999;color: #000;cursor: pointer;margin-right: 5px;"><i class="fa fa-times-circle-o" aria-hidden="true"></i>Not Approve</a>
                <?php } else if ($ticket->status == Ticket::TICKET_STATUS_NOT_APPROVE) { ?>
                    <a class="btn-lg pull-right" id="approve" style="background-color: #000;color: #ffcc00;cursor: pointer;"><i class="fa fa-check-circle-o" aria-hidden="true"></i>Approve</a>
                <?php } ?>
                <a href="<?= $baseUrl . 'request-ticket' ?>" class="btn-lg pull-right"  style="margin-right: 5px;background-color: #ffcc00;;color: #000;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
            </div>
            <div style="font-size: 12pt;" class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
                Title : <?= $ticket->title ?><br><br>
                Description
                <div style="background-color: #ffffcc;min-height:50px;padding-left:15px;padding-bottom: 5px;padding-top: 5px;margin-right: 3px;border: #ffcc00 solid thin;">
                    <?= $ticket->description ?>
                </div >
            </div>
            <div class="col-lg-5 col-md-5 col-xs-12" id="remark" style="margin-top: 10px;display: none;">
                <b> Remark (ไม่อนุมัติเนื่องจาก)</b><br>
                <input type="hidden" name="ticketId" value="<?= $ticket->ticketId ?>"  id="ticketId">
                <textarea style="width: 100%;height: 100px;margin-top: 10px;" id="remark"></textarea>
                <a class="btn-lg pull-right" id="send-remark" style="background-color: #000;color: #ffcc00;cursor: pointer;"><i class="fa fa-check-circle-o" aria-hidden="true"></i> OK</a>

            </div>
        </div>
    </div>
</div>
<!--    <div id="printableArea">
        <h1>Print me</h1>
    </div>-->
