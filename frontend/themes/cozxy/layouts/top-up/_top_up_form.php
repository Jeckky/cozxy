<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment History';
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
<div class="top-up-index">

    <div class="bs-example" data-example-id="btn-tags" >
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

        <table class="table">
            <tr style="height: 50px;">
                <td colspan="2">By placing your order, you agree to Cozxy's payment policy and condition of use.</td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;">Email Account :</td>
                <td style="text-align: left;"><span style="margin-left: 20px;"><?= $data["email"] ?></span></td>
            </tr>

            <tr style="height: 50px;">
                <td style="text-align: right;">Name :</td>
                <td style="text-align: left;"><span style="margin-left: 20px;"><?= $data["name"] ?></span></td>
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
                            <td style="text-align: left; ">
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
                <td style="text-align: right;padding: 8px">Captcha :</td>
                <td style="text-align: left;margin-top:0px; padding: 0px;">
                    <span style="margin-left: 20px;  padding: 0px;">
                        <input type="text" id="inputPass" name="inputPass" maxlength="6" style="width: 150px;text-align: center; margin-top:0px; padding: 0px; " required="true">
                        <input type="text" id="passwordPic" style="width:80px;height: 28px;background-color: #000;color:#ffcc33;text-align: center;border: 0 #000 solid;" disabled="true" value="<?= $data["number"] ?>">
                        <span>&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true" id="refreshPass" style="color: #fc0;font-size: 14pt;cursor: pointer;"></i></span>
                    </span>
                </td>
            </tr>
            <tr style="height: 50px;">
                <td style="text-align: right;"></td>
                <td style="text-align: left;">
                    <span style="margin-left: 20px;">
                        <!--<a class = "b btn-yellow" style ="margin:24px auto 12px" id="checkBot">
                            ยืนยัน
                        </a>-->
                        <input type="button" value="ยืนยัน" id="checkBot" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">
                    </span>
                </td>
            </tr>
        </table>


    </div>
</div>
<?php ActiveForm::end(); ?>