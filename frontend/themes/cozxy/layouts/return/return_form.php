<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;
use common\models\costfit\Ticket;
use common\models\costfit\Order;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

//use kartik\;
//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$createDateTime = $this->context->dateThai(Yii::$app->user->identity->createDateTime, 1);
?>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">Return</p>
        </div>
        <div class="bg-white size18 b" style="padding:100px 18px 10px;">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="col-xs-12 bg-yellow3" style="padding:18px 18px 10px;">
                        <p class="size20 size18-xs">Request a return ( * Please fill in the form below. )</p>
                    </div>
                    <div class="bg-white size18 b" style="padding:18px 18px 10px;">
                        <?php
                        if (isset($tickets) && !empty($tickets)) {// LEFT
                            ?>

                            Invoice Nunber <input type="text" name="invoiceNo" id="invoiceNo" class="form-control" disabled="true" value="<?= $invoiceNo ?>">
                            <br>
                            Why are you returning it: <input type="text" name="tickeTitle" id="tickeTitle" class="form-control" disabled="true">
                            <br>
                            Please describe further detail: <textarea name="ticketDescription" id="description" class="form-control input-lg" style="height: 100px;" disabled="true"></textarea>
                            <br><a class="btn btn-black pull-right" id="sendTicketDisable" disabled="true">Submit</a><br><br>
                            <?php
                        } else {
                            $form = ActiveForm::begin([
                                        'method' => 'POST',
                                        'id' => 'ticket-form',
                            ]);
                            ?>
                            Invoice Nunber <input type="text" name="invoice" id="invoiceNo" class="form-control" disabled="true" value="<?= $invoiceNo ?>">
                            <input type="hidden" name="invoiceNo" id="invoiceNo" value="<?= $invoiceNo ?>">
                            <?php
                            if (isset($orderItem) && count($orderItem) > 0) {
                                ?>
                                Which product(s): <?= isset($ms) ? '<span style="color:red;">' . $ms . '</span>' : '' ?>
                                <table class="table table-hover">
                                    <thead style="font-size: 12pt;">
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Return</th>
                                            <th>Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($orderItem as $item):
                                            ?>
                                            <tr>
                                                <td style="width: 50%;text-align: center;">
                                                    <img src="<?= Yii::$app->homeUrl . common\models\costfit\ProductSuppliers::productImageSuppliersSmall($item->productSuppId) ?>"style="width: 120px;height: 110px;"/><br>
                                                    <span style="font-size: 12pt;"><?= common\models\costfit\ProductSuppliers::productSupplierName($item->productSuppId)->title ?></span>
                                                </td>
                                                <td style="width: 20%;"><?= $item->quantity ?></td>
                                                <td style="width: 20%;">
                                                    <input type="text" onkeyup="javascript:checkReturnQuantity(<?= $item->orderItemId ?>)" class="form-control" id="quantity-<?= $item->orderItemId ?>"value="1" name="quantity[<?= $item->orderItemId ?>]" style="width: 50px;height: 30px;margin-top: 2px;" />
                                                </td>
                                                <td style="width: 10%;"><input type="checkbox" name="selectProduct[<?= $item->orderItemId ?>]" value="<?= $item->productSuppId ?>"></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <br>
                            Why are you returning it: <input type="text" name="tickeTitle" id="tickeTitle" class="form-control">

                            <br>
                            Please describe further detail: <textarea name="ticketDescription" id="description" class="form-control input-lg" style="height: 100px;"></textarea>
                            <div class="cart-detail">
                                <div class="row">
                                    <div class="col-lg-12">
                                        Where do you want to return it:
                                        <!--   <a href="chk-edit1.php" class="pull-right btn-g999 p-edit">Edit</a></div><div class="col-xs-12 size6">&nbsp;-->
                                    </div>
                                </div>
                                <div class="size18">&nbsp;</div>

                                <div class="row fc-g999">
                                    <div class="col-md-4 col-xs-12">
                                        <?php
                                        echo $form->field($model, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                                            'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->asArray()->all(), 'stateId', 'localName'),
                                            'pluginOptions' => [
                                                'placeholder' => 'Select...',
                                                'loadingText' => 'Loading States ...',
                                            ],
                                            'options' => ['placeholder' => 'Select States ...', 'name' => 'provinceId', 'id' => 'stateId'],
                                        ])->label(FALSE);
                                        ?>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <?php
                                        echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
                                        echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
                                        echo Html::hiddenInput('input-type-33', 'add', ['id' => 'input-type-33']);
                                        echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                                            //'data' => [9 => 'Savings'],
                                            'options' => ['placeholder' => 'Select ...', 'name' => 'amphurId', 'id' => 'amphurId'],
                                            'type' => DepDrop::TYPE_SELECT2,
                                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                            'pluginOptions' => [
//                                        'initialize' => false,
                                                'depends' => ['stateId'],
                                                'url' => Url::to(['child-amphur-address-picking-point-checkouts']),
                                                'loadingText' => 'Loading amphur ...',
                                                'params' => ['input-type-11', 'input-type-22', 'input-type-33']
                                            ]
                                        ])->label(FALSE);
                                        ?>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <?php
                                        echo Html::hiddenInput('input-type-13', $pickingPoint_booth->provinceId, ['id' => 'input-type-13']);
                                        echo Html::hiddenInput('input-type-23', $pickingPoint_booth->amphurId, ['id' => 'input-type-23']);
                                        echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
                                        echo $form->field($pickingPoint_booth, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                                            'model' => $pickingPoint_booth->pickingId,
                                            'attribute' => 'pickingId',
                                            'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId', 'name' => 'LcpickingId'],
                                            'type' => DepDrop::TYPE_SELECT2,
                                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                            'pluginOptions' => [
                                                //                                        'initialize' => false,
                                                'depends' => ['amphurId'],
                                                'url' => Url::to(['child-picking-point']),
                                                'loadingText' => 'Loading picking point ...',
                                                'params' => ['input-type-13', 'input-type-23', 'lockers-cool-input-type-33']
                                            ]
                                        ])->label(FALSE);
                                        ?>
                                    </div>
                                </div>

                                <div class="size18">&nbsp;</div>
                            </div>
                            <br>
                            <a class="btn btn-yellow pull-right" id="sendTicket">Submit</a><br><br>

                            <?php
                            ActiveForm::end();
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="col-xs-12 bg-yellow3 b" style="padding:18px 18px 10px;">
                        <p class="size20 size18-xs">COZXY</p>
                    </div>
                    <div class="bg-white size18 b" style="padding:18px 18px 10px;">
                        <?php
                        if (isset($tickets) && !empty($tickets)) {

                            if ($tickets->status == Ticket::TICKET_STATUS_CREATE) {
                                ?>
                                <div class="bg-white size18 b text-center" style="padding:18px 18px 10px;">
                                <?php } else if ($tickets->status == Ticket::TICKET_STATUS_APPROVED) {
                                    ?>
                                    <div class="row">
                                        <?=
                                        $this->render('messege', [
                                            'ticketId' => $tickets->ticketId])
                                        ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-11 col-sm-11 col-md-11 col-xs-11" >
                                            <input type="text" name="message" class="fullwidth" placeholder="Message" id="message">
                                        </div>
                                        <input type="hidden" name="orderId" value="<?= $tickets->orderId ?>" id="orderId">
                                        <input type="hidden" name="userId" value="<?= $tickets->userId ?>"  id="userId">
                                        <input type="hidden" name="ticketId" value="<?= $tickets->ticketId ?>"  id="ticketId">
                                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="margin-left: -15px;">
                                            <span style="color: #ff9900;margin-top: 25px;cursor: pointer;font-size: 35pt;" id="sendMessage"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <?php
                                } else if ($tickets->status == Ticket::TICKET_STATUS_NOT_APPROVE) {
                                    ?>
                                    <h4>รายการ " <?= $tickets->ticketNo ?> " Reject</h4>
                                    <div style="color: #000;font-size: 12pt;">Remark</div>
                                    <div style="width:100%;background-color: #ffffcc;border: #ff9900 solid thin;min-height: 200px;padding-top: 5px;padding-left: 10px;color:#666666;">
                                        <?= $tickets->remark ?>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="text-center" style="color: #000;">
                                        <h4>Process and condition</h4>
                                        <div class="text-left">
                                            <p>1.</p>
                                            <p>2.</p>
                                            <p>3.</p>
                                            <p>4.</p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="bg-white size18 b" style="padding:18px 18px 10px;">
                            Return history
                            <table class="table table-hover" style="color: #000;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</td>
                                        <th style="text-align: center">Invoice #</th>
                                        <th style="text-align: center">Request</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Details</th>
                                    </tr>
                                </thead>
                                <?php
                                if (isset($histories) && !empty($histories)) {
                                    $i = 1;
                                    foreach ($histories as $history):
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?= $i ?></td>
                                            <td style="text-align: center"><?= Order::invoiceNo($history->orderId) ?></td>
                                            <td style="text-align: center"><?= $history->ticketNo ?></td>
                                            <td style="text-align: center"><?= Ticket::statusText($history->ticketId) ?></td>
                                            <td style="text-align: center"><a href="<?= $baseUrl . 'ticket-detail?ticketId=' . $history->ticketId ?>">Detail</a></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;
                                } else {
                                    ?>
                                    <td style="text-align: center" colspan="5">You do not have any returns</td>
                                <?php }
                                ?>
                            </table>
                        </div>
                        <!-- Zone left -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="size32">&nbsp;</div>