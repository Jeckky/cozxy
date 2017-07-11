<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;
use common\models\costfit\Ticket;
use common\models\costfit\Order;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ReturnProduct;

//use kartik\;
//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$createDateTime = $this->context->dateThai(Yii::$app->user->identity->createDateTime, 1);
?>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">Return Ticket No. #<?= $ticket->ticketNo ?></p>
        </div>
        <div class="bg-white size18 b">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bg-white size18 b" style="padding:20px 18px 20px;">
                        <h4>Title : </h4>
                        <div style="width: 100%;min-height: 70px;padding-left: 10px;padding-top: 10px; margin-bottom: -10px;font-size: 11pt;color: #000;">
                            <?= $ticket->title ?>
                        </div>
                        <h4>Description : </h4>
                        <div style="width: 100%;min-height: 70px;padding-left: 10px;padding-top: 0px; margin-bottom: -10px;font-size: 11pt;color: #000;">
                            <?= $ticket->description ?>
                        </div>
                        <h4>Return Point</h4>
                        <div style="width: 100%;min-height: 70px;padding-left: 10px;padding-top: 0px; margin-bottom: -10px;font-size: 11pt;color: #000;">
                            <?= $textReturn ?>
                        </div>
                        <hr>
                        <h4>Item(s) return</h4>
                        <table class="table">
                            <tr>
                                <td  style="text-align: center;color: #000;">Item</td>
                                <td  style="text-align: center; color:#000;">Quantity</td>
                                <td  style="text-align: center;color: #000;">Coin</td>
                                <td  style="text-align: center;color: #000;">Total coin</td>
                                <td  style="text-align: center;color: #000;">Date</td>
                                <td  style="text-align: center;color: #000; width: 15%;">Status</td>
                            </tr>
                            <?php
                            if (isset($returnProducts) && !empty($returnProducts)) {
                                $returnCoin = 0;
                                foreach ($returnProducts as $item):
                                    ?>
                                    <tr>
                                        <td  style="color:#000;text-align: center;"><center><img src="<?= $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($item->productSuppId)[0]->image ?>" style="width:120px;height: 100px;"></center><br>
                                    <?= ProductSuppliers::productSupplierName($item->productSuppId)->title ?>
                                    </td>
                                    <td  style="text-align: center;color:#000;vertical-align: middle;"><?= $item->quantity ?></td>
                                    <td  style="text-align: center;color:#000;vertical-align: middle;"><?= number_format($item->price, 2) ?></td>
                                    <td  style="text-align: center;color:#000;vertical-align: middle;"><?= number_format($item->totalPrice, 2) ?></td>
                                    <td  style="text-align: center;color:#000;vertical-align: middle;"><?= frontend\controllers\MasterController::dateThai($item->updateDateTime, 4) ?></td>
                                    <td  style="text-align: center;color:#000;vertical-align: middle;"><?= ReturnProduct::statusText($item->returnProductId) ?><br>
                                        <div style="font-size: 10pt;color: #999999;text-align: left;">
                                            <?php
                                            if ($item->status == ReturnProduct::TICKET_STATUS_BOOT_NOTAPPROVED) {
                                                echo '<u>Remark</u> : ' . $item->remark;
                                            } else if ($item->status == ReturnProduct::TICKET_STATUS_COZXY_NOTAPPROVED) {
                                                echo '<u>Booth remark</u> : ' . $item->remark . '<br>';
                                                echo '<u>Cozxy remark</u> : ' . $item->cozxyRemark;
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    </tr>
                                    <?php
                                    if ($item->status == 5) {
                                        $returnCoin += $item->totalPrice;
                                    }
                                endforeach;
                                ?>
                                <tr>
                                    <td></td>
                                    <td  style="text-align:center;">Return coin</td>
                                    <td  style="text-align: center;"><?= number_format($returnCoin, 2) ?></td>
                                    <td  colspan="3"></td>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td  style="text-align: center;background-color:#cccccc;" colspan="6">Item not found</td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="col-xs-12 bg-yellow3" style="padding:18px 18px 10px;">
                        <p class="size20 size18-xs">Conversation history</p>
                    </div>
                    <div style="display: block;height: 500px;width:100%;overflow: auto;overflow-y:scroll;padding-top: 10px;padding-left: 5px;padding-right: 5px;" id="showBnMassege">
                        <?php
                        if (isset($chats) && !empty($chats)) {
                            $ms = '';
                            $oldDay = '0000-00-00';
                            foreach ($chats as $chat):
                                $newDay = substr($chat->createDateTime, 0, 10);
                                if ($newDay > $oldDay) {
                                    $ms = $ms . '<div class="col-lg-12" style="font-size:9pt;color:#999999;text-align:center;">' . $this->context->dateThai($chat->createDateTime, 4) . '</div><div class="col-lg-12"></div>';
                                }
                                $setFull = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
                                $showTime = substr($chat->createDateTime, 11, 5);
                                if ($chat->messageType == 1) {//ข้อความทางฝั่ง customer ชิดขวา
                                    $ms = $ms . '<div class="message-yellow-right">' . $chat->message . '</div><div class="pull-right" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-right:2px;">' . $showTime . '</div><div class="' . $setFull . '"></div>';
                                } else {///ฝั่ง cozxy ชิดซ้าย
                                    $ms = $ms . '<div class="message-black-left">' . $chat->message . '</div><div class="pull-left" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-left:2px;">' . $showTime . '</div><div class="' . $setFull . '"></div>';
                                }
                                $oldDay = $newDay;
                            endforeach;
                        } else {
                            $ms = '<div style="width:100%;min-height:50px;color:#000;background-color:#cccccc;padding-top:15px;"><center>Conversation not found</center></div><div class="col-lg-12"></div>';
                        }
                        echo $ms;
                        ?>

                    </div>
                    <a href="<?= Yii::$app->request->referrer ?>" class="btn-lg pull-right"  style="margin-right: 5px;background-color: #ffcc00;color: #000;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>

                </div>

            </div>
            <!-- Zone left -->

        </div>
    </div>
</div>

