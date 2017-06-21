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
]);
?><div class="container login-box">
    <div class="row">
        <?php if (isset($fromCheckout) && $fromCheckout != 'no') { ?>
            <input type="hidden" name="fromCheckout" value="yes">
        <?php } ?>
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">Cozxy.com - Payment is complete.</p>
        </div>
        <div class="col-xs-12 bg-white size18 b" style="padding: 20px;">
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
                    echo '<h4 style="color: #006666;">TOP UP ' . $needMore . ' Points Gross ' . number_format($needMore, 2) . ' THB</h4>';
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
                                <input type="text" id="amount" name="otherAmount" style="height: 1cm;width: 150px;text-align: right;">
                                <span>&nbsp;&nbsp;THB.</span>
                            </span>
                        </td>
                    </tr>
                    <?php
                } else {//ถ้าไม่ได้มาจากหน้าเชคเอ้า
                    ?>
                    <tr style="height: 50px;">
                        <td style="text-align: right;width:50%;">Amount :</td>
                        <td style="text-align: left;width:50%;">
                            <span style="margin-left: 20px;">
                                <input type="text" id="amount" name="amount" style="height: 1cm;width: 150px;text-align: right;"autofocus="true">
                                <span>&nbsp;&nbsp;THB.</span>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
                <tr style="height: 50px;">
                    <td style="text-align: right;width:50%;"></td>
                    <td style="text-align: left;width:50%;">
                        <span style="margin-left: 20px;">
                            <button type="submit" class = "subs-btn size14-xs" id="confirm-topup">
                                Confirm
                            </button>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div><br>
<?php ActiveForm::end(); ?>