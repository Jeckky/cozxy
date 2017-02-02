
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
        <div class="panel-body">
            <div class="row">
                <br>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" id="chatbox" style="font-size: 11pt;">
                    <h4>คุณ <?= User::userName($ticket->userId) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; โทร . <?= User::userTel($ticket->userId) ?></h4>
                    <?=
                    $this->render('messege', [
                        'ticketId' => $ticket->ticketId])
                    ?>
                    <div class="row">
                        <div class="col-lg-11 col-sm-11 col-md-11 col-xs-11" >
                            <input type="text" name="message" class="form-control" placeholder="Messege" id="messege" style="height: 45px;">
                        </div>
                        <input type="hidden" name="orderId" value="<?= $ticket->orderId ?>" id="orderId">
                        <input type="hidden" name="userId" value="<?= $ticket->userId ?>"  id="userId">
                        <input type="hidden" name="ticketId" value="<?= $ticket->ticketId ?>"  id="ticketId">
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="margin-left: -20px;">
                            <button style="color: #ffcc00;cursor: pointer;background-color: #000000;height: 45px;border: 0px;" id="sendMessege">Enter</button>

                        </div>
                    </div><br>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <h4>รายละเอียดการขอคืนสินค้า</h4><br>
                    <h4>เลขที่ <?= $ticket->ticketNo ?></h4>
                    <h4>Title</h4>
                    <div style="width: 100%;background-color: #ffffcc;min-height: 70px;border: #ffcc00 solid thin;padding-left: 10px;padding-top: 10px;font-size: 11pt;">
                        <?= $ticket->title ?>
                    </div><br>
                    <h4>Description</h4>
                    <div style="width: 100%;background-color: #ffffcc;min-height: 70px;border: #ffcc00 solid thin;padding-left: 10px;padding-top: 10px;font-size: 11pt;">
                        <?= $ticket->description ?>
                    </div><br>
                    <a href="<?= $baseUrl . 'index?ticketId=' . $ticket->ticketId ?>" class="btn-lg pull-right"  style="margin-right: 5px;background-color: #000;color: #ffcc;"><i class="fa fa-paper-plane" aria-hidden="true"></i> คืนสินค้า</a>
                    <a href="<?= $baseUrl . 'request-ticket' ?>" class="btn-lg pull-right"  style="margin-right: 5px;background-color: #ffcc00;color: #000;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>

                </div>
            </div>
        </div>
    </div>
    <!--    <div id="printableArea">
            <h1>Print me</h1>
        </div>-->
