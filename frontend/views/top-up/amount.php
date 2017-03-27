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

    <div class="bs-example" data-example-id="btn-tags" style="margin: auto;background-color:#3cc;height:85px;color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
        <h3 style="color: #fff;margin-top: 20px;">Cozxy.com</h3>
    </div>

    <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: auto;text-align: center;color: #000;margin-bottom: 20px;">
        <h3 style="text-align: left;color: #009999;"><b>:: Top up</b></h3><hr>
        <table style="width: 100%">

            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Payment :</td>
                <td style="text-align: left;width:50%;"><span style="margin-left: 20px;">Credit Card</span></td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Name :</td>
                <td style="text-align: left;width:50%;"><span style="margin-left: 20px;"><?= $data["name"] ?></span></td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Amount :</td>
                <td style="text-align: left;width:50%;">
                    <span style="margin-left: 20px;">
                        <input type="text" id="amount" name="amount" style="width: 100px;text-align: right;"autofocus="true">
                        <span>&nbsp;&nbsp;THB.</span>
                    </span>
                </td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;"></td>
                <td style="text-align: left;width:50%;">
                    <span style="margin-left: 20px;">
                        <a class = "btn" style = "background-color: #3cc; color: #fff;font-size: 12pt;" id="confirm-topup">
                            ยืนยัน
                        </a>
                    </span>
                </td>
            </tr>
        </table>


    </div>
</div>
<?php ActiveForm::end(); ?>