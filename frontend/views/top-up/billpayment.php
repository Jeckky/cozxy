<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'Top Up';
$this->params['breadcrumbs'][] = $this->title;
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<br><br>
<div class="row">
    <div class="col-lg-6 text-left pull-left" style="padding-left: 45px;color:#000;">
        - Please check the accuracy of your information and click Print to print this bill payment slip.<br>
        - An email will be sent to you regarding the details of this payment.<br>
        - if you do not receive CozxyCoins within 24 hours after payment, please contact our customer care.

    </div>
    <div class="col-lg-6 text-right" style="padding-right: 35px;">
        <a href="<?= Yii::$app->homeUrl ?>top-up/history" class="b btn-black">
            < < Go to top up histories
        </a>
        <a href="<?= Yii::$app->homeUrl . 'top-up/print-payment-form-topdf?amount=' . $amount . '&customerName=' . $customerName . '&customerTel=' . $customerTel . '&topUpNo=' . $topUpNo . '&taxId=' . $taxId . '&barCode=' . $barCode . '&data=' . $data ?>" class="b btn-yellow" target="_blank">
            Print
        </a>
    </div>

</div>

<div style="margin-bottom: 1200px;">

    <div class="col-lg-12">
        <?=
        $this->render('forbank', [
            'title' => 'ส่วนที่ 1 สำหรับธนาคาร',
            'amount' => $amount,
            'customerName' => $customerName,
            'customerTel' => $customerTel,
            'topUpNo' => $topUpNo,
            'taxId' => $taxId,
            'barCode' => $barCode,
            'data' => $data,
            'allBank' => $allBank
        ]);
        ?>
    </div>

    <div class="col-lg-12" style="margin-top: 30px;">
        <?php /*
          $this->render('forcustomer', [
          'title' => 'ส่วนที่ 2 สำหรับลูกค้า',
          'amount' => $amount,
          'customerName' => $customerName,
          'customerTel' => $customerTel,
          'topUpNo' => $topUpNo,
          'taxId' => $taxId,
          'barCode' => $barCode,
          'data' => $data,
          'allBank' => $allBank
          ]);
         */ ?>
    </div>
</div>
