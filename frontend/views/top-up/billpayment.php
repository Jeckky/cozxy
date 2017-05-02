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
        - กรุณาตรวจสอบข้อมูลให้ถูกต้อง จากนั้นกด Print เพื่อนำใบ Bill payment ไปชำระเงิน<br>
        - เมื่อชำระเงินเรียบร้อยคุณจะใช้  point จากการเติมเงินได้ภายใน 24 ชั่วโมง
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
            <p style="margin-left:20px"><image src = "<?php // $baseUrl . '/images/Bank/payin-cut.png'   ?>" style = "width: 100%;height: 30px;" /><p>
        </div>-->
    <!--    <div class="col-lg-12" style="margin-top: 30px;">
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
      ]); */
    ?>
        </div>-->
</div>
