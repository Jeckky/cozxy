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
$js = "$(document).on('keypress', '#amount', function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code > 57) {
        return false;
    } else if (code < 48 && code != 8) {
        return false;
    }
});
$(document).on('click', '#confirm-topup', function (e) {
var amount = $(this).parent().parent().parent().parent().find('#amount').val();
var currentAmount = $(this).parent().parent().parent().parent().parent().find('#currentAmount').val();
   if(amount==''){
        if(currentAmount==''){
            alert('empty amount');
           //amount.focus();
            return false;
        }else{
            if(!confirm(':: Confirm Amount '+currentAmount+' THB ?')){
                return false;
            }
        }
    }else{
        if(!confirm(':: Confirm Amount '+amount+' THB ?')){
            return false;
        }
    }
});";
$this->registerJs($js);
$form = ActiveForm::begin([
        ]);
?>
<div class="top-up-index" style="width: 80%;margin: auto;">

    <div class="bs-example" data-example-id="btn-tags" style="margin: auto;background-color:#3cc;height:85px;color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
        <span style="float: left; text-align: left;width: 30%;">Cozxy.com</span>
    </div>
    <?php if (isset($fromCheckout) && $fromCheckout != 'no') { ?>
        <input type="hidden" name="fromCheckout" value="yes">
    <?php } ?>
    <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: auto;text-align: center;color: #000;margin-bottom: 20px;">
        <div class="row">
            <div class="col-lg-3 pull-left text-left" style="text-align: left;color: #009999;">
                <h3 style="text-align: left;color: #009999;"><b>:: Top up</b></h3>
            </div>
        </div>
        <hr>
        <table style="width: 100%">

            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Payment :</td>
                <td style="text-align: left;width:50%;"><span style="margin-left: 20px;"><?= $data["paymentType"] ?></span></td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Name :</td>
                <td style="text-align: left;width:50%;"><span style="margin-left: 20px;"><?= $data["name"] ?></span></td>
            </tr>
            <?php
            if (isset($needMore) && $needMore != 0) {
                echo '<h4 style="color: #006666;">ต้องเติมอีก ' . $needMore . ' Points เป็นเงิน ' . number_format($needMore, 2) . ' บาท</h4>';
                ?>
                <tr style="height: 50px;">
                    <td style="text-align: right;width:50%;">
                        Current Balance due :
                    </td>
                    <td style="text-align: left;width:50%;">
                        <span style="margin-left: 20px;">
                            <input type="hidden" id="currentAmount" name="currentAmount" value="<?= $needMore ?>">
                            <span><?= number_format($needMore, 2) ?>&nbsp;&nbsp;THB.</span>
                        </span>
                    </td>
                </tr>
                <tr style="height: 50px;">
                    <td style="text-align: right;width:50%;">

                        Or other Amount:
                    <td style="text-align: left;width:50%;">
                        <span style="margin-left: 20px;">
                            <input type="text" id="amount" name="otherAmount" style="width: 100px;text-align: right;">
                            <span>&nbsp;&nbsp;THB.</span>
                        </span>
                    </td>
                </tr>
                <?php
            } else {
                ?>
                <tr style="height: 50px;">
                    <td style="text-align: right;width:50%;">Amount :</td>
                    <td style="text-align: left;width:50%;">
                        <span style="margin-left: 20px;">
                            <input type="text" id="amount" name="amount" style="width: 100px;text-align: right;"autofocus="true">
                            <span>&nbsp;&nbsp;THB.</span>
                        </span>
                    </td>
                </tr>
            <?php } ?>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;"></td>
                <td style="text-align: left;width:50%;">
                    <span style="margin-left: 20px;">
                        <button type="submit" class = "btn" style = "background-color: #3cc; color: #fff;font-size: 12pt;" id="confirm-topup">
                            Confirm
                        </button>
                    </span>
                </td>
            </tr>
        </table>


    </div>
</div>
<?php ActiveForm::end(); ?>