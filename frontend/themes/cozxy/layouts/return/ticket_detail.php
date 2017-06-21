<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;
use common\models\costfit\Ticket;
use common\models\costfit\Order;
use common\models\costfit\ProductSuppliers;

//use kartik\;
//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$createDateTime = $this->context->dateThai(Yii::$app->user->identity->createDateTime, 1);
?>
<div class="row cs-page">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="bs-callout bs-callout-warning">
            <h4 class="profile-title-head">
                <span class="profile-title-head">รายละเอียด</span>
            </h4>
            <h4>เลขที่ <?= $ticket->ticketNo ?></h4>
            <h4>Title</h4>
            <div style="width: 100%;background-color: #ffffcc;min-height: 70px;border: #ffcc00 solid thin;padding-left: 10px;padding-top: 10px;font-size: 11pt;color: #000;">
                <?= $ticket->title ?>
            </div><br>
            <h4>Description</h4>
            <div style="width: 100%;background-color: #ffffcc;min-height: 70px;border: #ffcc00 solid thin;padding-left: 10px;padding-top: 10px;font-size: 11pt;color: #000;">
                <?= $ticket->description ?>
            </div><br>
            <h4>รายการสินค้าคืน</h4>
            <table class="table">
                <tr>
                    <td  style="text-align: center;width:80%;color: #000;">สินค้า</td>
                    <td  style="text-align: center;width:20%; color:#000;">จำนวน</td>
                </tr>
                <?php
                if (isset($returnProducts) && !empty($returnProducts)) {
                    foreach ($returnProducts as $item):
                        ?>
                        <tr>
                            <td  style="color:#000;text-align: center;"><center><img src="<?= $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($item->productSuppId)[0]->image ?>" style="width:120px;height: 100px;"></center><br>
                        <?= ProductSuppliers::productSupplierName($item->productSuppId)->title ?>
                        </td>
                        <td  style="text-align: center;color:#000;vertical-align: middle;"><?= $item->quantity ?></td>
                        </tr>
                        <?php
                    endforeach;
                } else {
                    ?>
                    <tr>
                        <td  style="text-align: center;" colspan="2">ไม่มีรายการสินค้า</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="bs-callout bs-callout-warning">
            <h4 class="profile-title-head">
                <span class="profile-title-head">ประวัติการสนทนา</span>
            </h4>
            <div style="display: block;height: 500px;width:100%;overflow: auto;overflow-y:scroll;border: #ffcc99 thin solid;padding-top: 10px;padding-left: 5px;padding-right: 5px;" id="showBnMassege">
                <?php
                if (isset($chats) && !empty($chats)) {
                    $ms = '';
                    $oldDay = '0000-00-00';
                    foreach ($chats as $chat):
                        $newDay = substr($chat->createDateTime, 0, 10);
                        if ($newDay > $oldDay) {
                            $ms = $ms . '<div class="col-lg-12" style="font-size:9pt;color:#999999;text-align:center;">' . $this->context->dateThai($chat->createDateTime, 2) . '</div><div class="col-lg-12"></div>';
                        }
                        $showTime = substr($chat->createDateTime, 11, 5);
                        if ($chat->messegeType == 1) {//ข้อความทางฝั่ง customer ชิดขวา
                            $ms = $ms . '<div class="message-yellow-right">' . $chat->messege . '</div><div class="pull-right" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-right:2px;">' . $showTime . '</div><div class="col-lg-12"></div>';
                        } else {///ฝั่ง cozxy ชิดซ้าย
                            $ms = $ms . '<div class="message-black-left">' . $chat->messege . '</div><div class="pull-left" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-left:2px;">' . $showTime . '</div><div class="col-lg-12"></div>';
                        }
                        $oldDay = $newDay;
                    endforeach;
                } else {
                    $ms = '<div style="width:100%;min-height:50px;color:#000;background-color:#cccccc;padding-top:15px;"><center>ไม่พบข้อมูลการสนทนา</center></div><div class="col-lg-12"></div>';
                }
                echo $ms;
                ?>

            </div>

        </div>

        <a href="<?= Yii::$app->homeUrl . 'returning' ?>" class="btn-lg pull-right"  style="margin-right: 5px;background-color: #ffcc00;color: #000;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
    </div>
    <!-- Zone left -->

</div>

