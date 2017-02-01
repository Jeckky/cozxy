
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\Order;
use common\models\costfit\Ticket;
use common\models\costfit\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="order-index">

    <?php if (isset($tickets) && !empty($tickets)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
                <span class="panel-title"><h3 style="color:#ffcc00;">รายการขอคืนสินค้า</h3></span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr style="height: 50px;background-color: #999999;">
                        <th style="vertical-align: middle;text-align: center;width: 5%;">No.</th>
                        <th style="vertical-align: middle;text-align: center;width: 15%;">orderNo.</th>
                        <th style="vertical-align: middle;text-align: center;width: 15%;">Invoice</th>
                        <th style="vertical-align: middle;text-align: center;width: 15%;">TicketCode</th>
                        <th style="vertical-align: middle;text-align: center;width: 15%;">Customer</th>
                        <th style="vertical-align: middle;text-align: center;width: 20%;">Receive Date</th>
                        <th style="vertical-align: middle;text-align: center;width: 15%;">Detail</th>
                    </tr>

                    <tr style="height: 48px;">
                        <td  colspan="7"><input type="text" id="search-wait" class="col-lg-6 col-md-12 col-sm-12 col-sx-12" placeholder="Search Ticket" style="height: 45px;font-size: 12pt;"></td>
                    </tr>
                </table>
                <table class="table" id="search-w">
                    <?php
                    foreach ($tickets as $i => $ticket):
                        ?>
                        <tr>
                            <td style="text-align: center;width: 5%;"><?= $i + 1 ?></td>
                            <td style="text-align: center;width: 15%;"><?= Order::findOrderNo($ticket->orderId) ?></td>
                            <td style="text-align: center;width: 15%;"><?= Order::invoiceNo($ticket->orderId) ?></td>
                            <td style="text-align: center;width: 15%;"><?= $ticket->ticketNo ?></td>
                            <td style="text-align: center;width: 15%;"><?= User::userName($ticket->userId) ?></td>
                            <td style="text-align: center;width: 20%;"><?= substr($this->context->dateThai(Order::recieveDate($ticket->orderId), 1, true), 0, -8) ?></td>
                            <td style="text-align: center;width: 15%;"><a href="<?= $baseUrl . 'ticket-detail?ticketId=' . $ticket->ticketId ?>" >รายละเอียด</a></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </table>
                <br>

            </div>

        </div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="row">
            <?php if (isset($approved) && !empty($approved)) { ?>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="panel-heading"  style="background-color:#999999;vertical-align: middle;">
                        <span class="panel-title"><h3 style="color:#000;">อนุมัติ</h3></span>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr style="height: 50px;background-color: #999999;">
                                <th style="vertical-align: middle;text-align: center;width: 15%;">Invoice</th>
                                <th style="vertical-align: middle;text-align: center;width: 35%;">Customer</th>
                                <th style="vertical-align: middle;text-align: center;width: 35%;">Ticket Code</th>
                                <th style="vertical-align: middle;text-align: center;width: 15%;">รายละเอียด</th>
                            </tr>

                            <tr style="height: 48px;">
                                <td  colspan="4"><input type="text" id="search-approve" class="form-control" placeholder="Search Ticket" style="height: 45px;font-size: 12pt;"></td>
                            </tr>
                        </table>
                        <table class="table" id="search-a">
                            <?php
                            foreach ($approved as $i => $approve):
                                ?>
                                <tr id="status-approve">
                                    <td style="text-align: center;width: 15%;"><?= Order::invoiceNo($approve->orderId) ?></td>
                                    <td style="text-align: center;width: 35%;"><?= User::userName($approve->userId) ?></td>
                                    <td style="text-align: center;width: 35%;"><?= $approve->ticketNo ?></td>
                                    <td style="text-align: center;width: 15%;"><a href="<?= $baseUrl . 'contact?ticketId=' . $approve->ticketId ?>" >รายละเอียด</a></td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </table>
                    </div>
                </div><?php
            }
            if (isset($notApproved) & !empty($notApproved)) {
                ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel-heading"  style="background-color: #999999;vertical-align: middle;">
                        <span class="panel-title"><h3 style="color:#000;">ไม่อนุมัติ</h3></span>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr style="height: 50px;background-color: #999999;">
                                <th style="vertical-align: middle;text-align: center;width: 15%;">Invoice</th>
                                <th style="vertical-align: middle;text-align: center;width: 20%;">Ticket Code</th>
                                <th style="vertical-align: middle;text-align: center;width: 15%;">รายละเอียด</th>
                            </tr>
                            <tr style="height: 48px;">
                                <td  colspan="3"><input type="text" id="search-notApprove" class="form-control" placeholder="Search Ticket" style="height: 45px;font-size: 12pt;"></td>
                            </tr>
                        </table>
                        <table class="table" id="search-n">
                            <?php
                            foreach ($notApproved as $i => $notApprove):
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?= Order::invoiceNo($notApprove->orderId) ?></td>
                                    <td style="text-align: center;"><?= $notApprove->ticketNo ?></td>
                                    <td style="text-align: center;"><a href="<?= $baseUrl . 'ticket-detail?orderId=' . $notApprove->orderId ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!--    <div id="printableArea">
        <h1>Print me</h1>
    </div>-->
