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
        <a href="<?= Yii::$app->homeUrl . 'top-up/print-payment-form-topdf?amount=' . $amount . '&customerName=' . $customerName . '&customerTel=' . $customerTel . '&topUpNo=' . $topUpNo . '&taxId=' . $taxId . '&barCode=' . $barCode . '&data=' . $data ?>" class="btn btn-sm" target="_blank">
            <i class="fa fa-print" aria-hidden="true"></i> Print
        </a>
    </div>

</div>

<div style="margin-bottom: 1200px;">

    <div class="col-lg-12">
        <?=
        $this->render('forbank1', [
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
    <!--    <div class="col-lg-12" style="margin-top: 20px;">
            <p style="margin-left:20px"><image src = "<?php // $baseUrl . '/images/Bank/payin-cut.png'       ?>" style = "width: 100%;height: 30px;" /><p>
        </div>
        <div class="col-lg-12" style="margin-top: 30px;">
    <?php /*
      $this->render('forcustomer1', [
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
        </div>-->
</div>
