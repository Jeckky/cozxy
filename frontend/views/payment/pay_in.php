<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $order->orderId]);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<table class="table-bordered-pay-in" width="100%" cellpadding="3" cellspacing="0">
    <tr>
        <td style="text-align: left;">
            แบบฟอร์มสำหรับชำระเงิน (Bill Payment / Pay-in Slip)
        </td>
        <td style="text-align: right;">
            ส่วนที่ 1 สำหรับธนาคาร
        </td>
    </tr>
    <tr>
        <td style="font-weight: bold;">
            เพื่อนำเข้าบัญชี บจก. กินซ่า โฮม / เลขประจำตัวผู้เสียภาษี 0105552077368
        </td>
    </tr>
    <tr>
        <td style="font-size: 10px;">
            สำนักงานแห่งใหญ่ เลขที่ 1 ซ.ลาดพร้าว 19 ถ.ลาดพร้าว 10900 โทร.02-938-3464
        </td>
    </tr>
</table>

<table class="table" width="100%" cellpadding="2" cellspacing="0" border="0" style="margin-bottom: 8px;">
    <tr>
        <td>
            <img src="<?php echo $baseUrl; ?>/images/PaymentMethod/payin-cut.png" alt="Cost Fit" broder ="0">
        </td>
    </tr>
</table>

<table class="table table-bordered-pay-in" width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td>
            แบบฟอร์มสำหรับชำระเงิน (Bill Payment / Pay-in Slip)
        </td>
    </tr>
</table>
