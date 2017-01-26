<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;

//use kartik\;
//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$createDateTime = $this->context->dateThai(Yii::$app->user->identity->createDateTime, 1);
if (isset($tickets) && !empty($tickets)) {
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
                    <span class="profile-title-head">ส่วนติดต่อ COZXY </span>
                </h4>
                <?= $this->render('messege') ?>
            </div>
        </div>
        <!-- Zone left -->

    </div>

