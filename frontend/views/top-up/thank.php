<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<br><br>

<div class="top-up-index" style="width: 60%;margin: auto;">

    <div class="bs-example" data-example-id="btn-tags" style="margin: auto;height:85px;color: #000; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
        <h3 style="margin-top: 20px;">Cozxy.com</h3>
    </div>
    <?php
    if ($type == 'success') {
        ?>
        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: auto;text-align: center;color: #000;margin-bottom: 20px;">
            <h3 style="color: #000;"><b> Top up :: SUCCESSFUL</b></h3>
            <h4>You have <?= $currentPoint ?> Points.</h4>
            <?php if ($fromCheckout == 'yes') {
                ?>
                <a href="<?= Yii::$app->homeUrl . 'checkout/order-summary-topup/' . $order->encodeParams(['orderId' => $order->orderId]) ?>" class = "btn btn-info">
                    Check out
                </a>
            <?php } ?>
        </div>

    <?php } else {
        ?>
        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: auto;text-align: center;color: #000;margin-bottom: 20px;">
            <h3 style="color: #009999;"><b> Top up :: FAIL</b></h3>
            <h4>Please contact to your bank.</h4>
        </div>
    <?php } ?>
</div>
<?php
if (isset($topUpId)) {
    $epay = common\models\ModelMaster::encodeParams($topUpId);
    $bill = "var topUpId='$epay';window.open('" . Yii::$app->homeUrl . "' + 'top-up/billpay?epay='+topUpId,'_blank');";
    ?>
    <?= $this->registerJs($bill); ?>
<?php } ?>