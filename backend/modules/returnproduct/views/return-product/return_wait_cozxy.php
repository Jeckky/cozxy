
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


    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">รายการขอคืน รอตรวจสอบจาก Cozxy</h3></span>
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
                <?php if (isset($waitCozxyApprove) && !empty($waitCozxyApprove)) { ?>
                    <tr style="height: 48px;">
                        <td  colspan="7"><input type="text" id="search-wait-cozxy-confirm" class="col-lg-6 col-md-12 col-sm-12 col-sx-12" placeholder="Search Ticket" style="height: 45px;font-size: 12pt;"></td>
                    </tr>
                <?php } else { ?>
                    <tr style="height: 48px;">
                        <td  colspan="7"> ไม่มีรายการขอคืนสินค้า</td>
                    </tr>
                <?php } ?>
            </table>
            <?php if (isset($waitCozxyApprove) && !empty($waitCozxyApprove)) { ?>
                <table class="table" id="search-wcc">
                    <?php
                    foreach ($waitCozxyApprove as $i => $ticket):
                        ?>
                        <tr>
                            <td style="text-align: center;width: 5%;"><?= $i + 1 ?></td>
                            <td style="text-align: center;width: 15%;"><?= Order::findOrderNo($ticket->orderId) ?></td>
                            <td style="text-align: center;width: 15%;"><?= Order::invoiceNo($ticket->orderId) ?></td>
                            <td style="text-align: center;width: 15%;"><?= $ticket->ticketNo ?></td>
                            <td style="text-align: center;width: 15%;"><?= User::userName($ticket->userId) ?></td>
                            <td style="text-align: center;width: 20%;"><?= substr($this->context->dateThai(Order::recieveDate($ticket->orderId), 1, true), 0, -8) ?></td>
                            <td style="text-align: center;width: 15%;"><a href="<?= $baseUrl . 'cozxy-confirm?ticketId=' . $ticket->ticketId ?>" >รายละเอียด</a></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </table>
            <?php } ?>
            <br>
            <?php if (isset($cozxyApprove) && count($cozxyApprove) > 0) { ?>
                <hr>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="panel-heading"  style="background-color:#999999;vertical-align: middle;">
                        <span class="panel-title"><h4 style="color:#000;">อนุมัติ</h4></span>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr style="height: 40px;background-color: #999999;">
                                <th style="vertical-align: middle;text-align: center;width: 15%;">Invoice</th>
                                <th style="vertical-align: middle;text-align: center;width: 35%;">Customer</th>
                                <th style="vertical-align: middle;text-align: center;width: 35%;">Ticket Code</th>
                                <th style="vertical-align: middle;text-align: center;width: 15%;">Detail</th>
                            </tr>

                            <tr style="height: 30px;">
                                <td  colspan="4"><input type="text" id="search-approve-cozxy" class="form-control" placeholder="Search Ticket" style="height: 30px;font-size: 12pt;"></td>
                            </tr>
                        </table>
                        <table class="table" id="search-ac">
                            <?php
                            foreach ($cozxyApprove as $i => $approve):
                                ?>
                                <tr id="status-approve">
                                    <td style="text-align: center;width: 15%;"><?= Order::invoiceNo($approve->orderId) ?></td>
                                    <td style="text-align: center;width: 35%;"><?= User::userName($approve->userId) ?></td>
                                    <td style="text-align: center;width: 35%;"><?= $approve->ticketNo ?></td>
                                    <td style="text-align: center;width: 15%;"><a href="<?= $baseUrl . 'cozxy-confirm?ticketId=' . $approve->ticketId ?>" >รายละเอียด</a></td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </table>
                    </div>
                </div><?php }
                        ?>
            <?php if (isset($cozxyReject) && count($cozxyReject) > 0) { ?>
                <hr>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="panel-heading"  style="background-color:#999999;vertical-align: middle;">
                        <span class="panel-title"><h4 style="color:#000;">ไม่อนุมัติ</h4></span>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr style="height: 40px;background-color: #999999;">
                                <th style="vertical-align: middle;text-align: center;width: 15%;">Invoice</th>
                                <th style="vertical-align: middle;text-align: center;width: 35%;">Customer</th>
                                <th style="vertical-align: middle;text-align: center;width: 35%;">Ticket Code</th>
                                <th style="vertical-align: middle;text-align: center;width: 15%;">Detail</th>
                            </tr>

                            <tr style="height: 30px;">
                                <td  colspan="4"><input type="text" id="search-not-approve-cozxy" class="form-control" placeholder="Search Ticket" style="height: 30px;font-size: 12pt;"></td>
                            </tr>
                        </table>
                        <table class="table" id="search-not-ac">
                            <?php
                            foreach ($cozxyReject as $i => $notApprove):
                                ?>
                                <tr id="status-approve">
                                    <td style="text-align: center;width: 15%;"><?= Order::invoiceNo($notApprove->orderId) ?></td>
                                    <td style="text-align: center;width: 35%;"><?= User::userName($notApprove->userId) ?></td>
                                    <td style="text-align: center;width: 35%;"><?= $notApprove->ticketNo ?></td>
                                    <td style="text-align: center;width: 15%;"><a href="<?= $baseUrl . 'cozxy-confirm?ticketId=' . $notApprove->ticketId ?>" >รายละเอียด</a></td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </table>
                    </div>
                </div><?php }
                        ?>
        </div>

    </div>

</div>
<!--    <div id="printableArea">
        <h1>Print me</h1>
    </div>-->
