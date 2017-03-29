<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Top Up';
$this->params['breadcrumbs'][] = $this->title;
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<br><br>
<?php
$form = ActiveForm::begin([
            'id' => 'top-up'
        ]);
?>
<div class="top-up-index" style="width: 80%;margin: auto;">

    <div class="bs-example" data-example-id="btn-tags" style="margin: auto;background-color:#3cc;height:45px; padding: 10px 12px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
        <span style="float: left; text-align: left;"><?= $this->title ?></span>
        <span style="float: right; text-align: right;"><?= isset($ms) ? $ms : '' ?></span>
    </div>

    <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: auto;text-align: center;color: #000;margin-bottom: 20px;">

        <table style="width: 100%">
            <tr style="height: 50px;">
                <td colspan="2" style="width: 70%;height: 60px;color: #006666;">กรุณาตรวจสอบรายละเอียดให้ถูกต้อง ระบบไม่สามารถแก้ไขได้ หากทำรายการเสร็จสิ้นแล้ว และบริษัทขอสงวนสิทธิ์ในการไม่คืนเงินไม่ว่ากรณีใดๆ ทั้งสิ้น</td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Email Account :</td>
                <td style="text-align: left;width:50%;"><span style="margin-left: 20px;"><?= $data["email"] ?></span></td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Name :</td>
                <td style="text-align: left;width:50%;"><span style="margin-left: 20px;"><?= $data["name"] ?></span></td>
            </tr>
            <tr style="height: 70px; vertical-align: middle">
                <td style="text-align: right;width:50%;">Credit Card :</td>
                <td style="text-align: left;width:50%;padding-left: 20px;">
                    <img src="<?= $baseUrl . '/images/Bank/master.png' ?>" style="float: left;width:50px;height:30px;margin-right: 10px;border: #009999 thin solid;">
                    <img src="<?= $baseUrl . '/images/Bank/visa.png' ?>" style="float: left;width:50px;height:30px;margin-right: 10px;border: #009999 thin solid;">
                    <img src="<?= $baseUrl . '/images/Bank/jcb.png' ?>" style="float: left;width:50px;height:30px;margin-right: 10px;border: #009999 thin solid;">
                </td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Password :</td>
                <td style="text-align: left;width:50%;">
                    <span style="margin-left: 20px;">
                        <input type="text" id="inputPass" name="inputPass" maxlength="6" style="width: 100px;text-align: center;" required="true">
                        <input type="text" id="passwordPic" style="width:80px;height: 28px;background-color: #000;color:#ffcc33;text-align: center;border: 0 #000 solid;" disabled="true" value="<?= $data["number"] ?>">
                        <span>&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true" id="refreshPass" style="color: #3cc;font-size: 14pt;cursor: pointer;"></i></span>
                    </span>
                </td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;"></td>
                <td style="text-align: left;width:50%;">
                    <span style="margin-left: 20px;">
                        <a class = "btn" style = "background-color: #3cc; color: #fff;font-size: 12pt;" id="checkBot">
                            ยืนยัน
                        </a>
                    </span>
                </td>
            </tr>
        </table>


    </div>
</div>
<?php ActiveForm::end(); ?>