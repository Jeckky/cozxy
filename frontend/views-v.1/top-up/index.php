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
<?php
$form = ActiveForm::begin([
    'id' => 'top-up'
]);
if (isset($paymentMethod) && count($paymentMethod) > 0) {
    $count = count($paymentMethod);
}
?>
<div class="top-up-index" style="width: 80%;margin: auto;">

    <div class="bs-example" data-example-id="btn-tags" style="margin: auto;background-color:#3cc;height:45px; padding: 10px 12px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
        <span style="float: left; text-align: left;"><?= $this->title ?></span>
        <span style="float: right; text-align: right;"><?php
            if (isset($ms) && $ms != '') {
                if ($needMore == 0) {
                    echo $ms;
                } else {
                    echo $ms . ' ' . $needMore . ' Points Please ' . number_format($needMore, 2) . ' THB';
                }
            }
            ?>
        </span>
    </div>
    <?php if (isset($ms) && $ms != '') { ?>
        <input type="hidden" name="checkout" value="checkout">
        <input type="hidden" name="needMore" value="<?= $needMore ?>">
    <?php }
    ?>
    <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: auto;text-align: center;color: #000;margin-bottom: 20px;">

        <table style="width: 100%">
            <tr style="height: 50px;">
                <td colspan="2" style="width: 70%;height: 60px;color: #006666;">By placing your order, you agree to Cozxy's payment policy and condition of use.</td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Email Account :</td>
                <td style="text-align: left;width:50%;"><span style="margin-left: 20px;"><?= $data["email"] ?></span></td>
            </tr>

            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Name :</td>
                <td style="text-align: left;width:50%;"><span style="margin-left: 20px;"><?= $data["name"] ?></span></td>
            </tr>
            <tr style="vertical-align: middle">
                <td style="text-align: right;width:50%;vertical-align: top; padding-top: 10px;" rowspan="<?= $count == 1 ? 0 : $count ?>">Payment method :</td>
                <?php
                if (isset($paymentMethod) && count($paymentMethod) > 0) {
                    foreach ($paymentMethod as $payment):
                        if ($payment->type == 2) {//credit
                            ?>
                            <td style="text-align: left;">
                                <div class="radio">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="checkout_select_address">
                                            <input type="radio" name="paymentType"  id="paymentMethod" value="credit"<?= count($paymentMethod) == 1 ? 'checked' : '' ?>><?= $payment->title ?><br>
                                            <img src="<?= $baseUrl . '/images/Bank/master.png' ?>" style="float: left;width:50px;height:30px;margin-right: 10px;border: #009999 thin solid;">
                                            <img src="<?= $baseUrl . '/images/Bank/visa.png' ?>" style="float: left;width:50px;height:30px;margin-right: 10px;border: #009999 thin solid;">
                                            <img src="<?= $baseUrl . '/images/Bank/jcb.png' ?>" style="float: left;width:50px;height:30px;margin-right: 10px;border: #009999 thin solid;">
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <?php
                        }
                    endforeach;
                }
                if ($count != 1) {
                    ?>
                </tr>
                <?php
            }
            if (isset($paymentMethod) && count($paymentMethod) > 0) {
                foreach ($paymentMethod as $payment):
                    if ($payment->type == 1) {//bill payment
                        if ($count != 1) {
                            ?>
                            <tr style="vertical-align: top;">
                            <?php } ?>
                            <td style="text-align: left;">
                                <div class="radio">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="checkout_select_address">
                                            <input type="radio" name="paymentType"  id="paymentMethod2" value="bill"<?= count($paymentMethod) == 1 ? 'checked' : '' ?>><?= $payment->title ?>
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <?php if ($count != 1) { ?>
                            </tr>
                            <?php
                        }
                    }
                endforeach;
            }
            ?>

            <tr style="height: 50px;">
                <td style="text-align: right;width:50%;">Captcha :</td>
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