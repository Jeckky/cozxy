<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;
use common\models\costfit\Ticket;

//use kartik\;
//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$createDateTime = $this->context->dateThai(Yii::$app->user->identity->createDateTime, 1);
if (isset($tickets) && !empty($tickets)) {// LEFT
    ?>
    <div class="row cs-page">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <div class="bs-callout bs-callout-warning">
                <h4 class="profile-title-head">
                    <span class="profile-title-head">แบบคำขอคืนสินค้า ( * กรุณากรอกข้อมูลให้ครบทุกช่อง )</span>
                </h4>
                Invoice Nunber <input type="text" name="invoiceNo" id="invoiceNo" class="form-control" disabled="true">
                <br>
                หัวข้อ <input type="text" name="tickeTitle" id="tickeTitle" class="form-control" disabled="true">
                <br>
                คำอธิบายเพิ่มเติม <textarea name="ticketDescription" id="description" class="form-control input-lg" style="height: 100px;" disabled="true"></textarea>
                <br><a class="btn btn-black pull-right" id="sendTicket" disabled="true">ส่งแบบคำขอคืนสินค้า</a><br><br>
            </div>
        </div>
        <?php
    } else {
        $form = ActiveForm::begin([
                    'method' => 'POST',
                    'id' => 'ticket-form',
        ]);
        ?>
        <div class="row cs-page">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <div class="bs-callout bs-callout-warning">
                    <h4 class="profile-title-head">
                        <span class="profile-title-head">แบบคำขอคืนสินค้า ( * กรุณากรอกข้อมูลให้ครบทุกช่อง )</span>
                    </h4>
                    Invoice Nunber <input type="text" name="invoiceNo" id="invoiceNo" class="form-control">
                    <br>
                    หัวข้อ <input type="text" name="tickeTitle" id="tickeTitle" class="form-control">
                    <br>
                    คำอธิบายเพิ่มเติม <textarea name="ticketDescription" id="description" class="form-control input-lg" style="height: 100px;"></textarea>
                    <br><a class="btn btn-black pull-right" id="sendTicket">ส่งแบบคำขอคืนสินค้า</a><br><br>
                </div>
            </div>
            <?php
            ActiveForm::end();
        }
        ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="bs-callout bs-callout-warning">
                <h4 class="profile-title-head">
                    <span class="profile-title-head">COZXY </span>
                </h4>
                <?php
                if (isset($tickets) && !empty($tickets)) {
                    if ($tickets->status == Ticket::TICKET_STATUS_CREATE || $tickets->status == Ticket::TICKET_STATUS_WAIT) {
                        ?>
                        <div class="text-center" style="color: #000;">
                            <h3>อยู่ระหว่างการดำเนินการ <i class="fa fa-spinner" aria-hidden="true"></i></h3>
                            <hr>
                            <div class="text-center">
                                <h2> กรุณารอการติดต่อกลับจากทาง COZXY </h2>
                            </div>
                        </div>
                    <?php } else {
                        ?>

                        <?= $this->render('messege', [
                            'ticketId' => $tickets->ticketId])
                        ?>
                        <div class="row">
                            <div class="col-lg-11 col-sm-11 col-md-11 col-xs-11" >
                                <input type="text" name="message" class="form-control" placeholder="Messege" id="messege">
                            </div>
                            <input type="hidden" name="orderId" value="<?= $tickets->orderId ?>" id="orderId">
                            <input type="hidden" name="userId" value="<?= $tickets->userId ?>"  id="userId">
                            <input type="hidden" name="ticketId" value="<?= $tickets->ticketId ?>"  id="ticketId">
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="margin-left: -20px;">
                                <h1 style="color: #ff9900;margin-top: -1px;cursor: pointer;" id="sendMessege"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i></h1>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="text-center" style="color: #000;">
                        <h4>ขั้นตอนและเงื่อนไขในการขอคืนสินค้า</h4>
                        <div class="text-left">
                            <p>1.</p>
                            <p>2.</p>
                            <p>3.</p>
                            <p>4.</p>
                        </div>
                    </div>
<?php } ?>
            </div>

        </div>
        <!-- Zone left -->

    </div>

