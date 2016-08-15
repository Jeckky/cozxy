<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $order->orderId]);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<table class="table-bordered-pay-in" width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td>
            แบบฟอร์มสำหรับชำระเงิน (Bill Payment / Pay-in Slip)
        </td>
    </tr>
    <tr>
        <td>
            แบบฟอร์มสำหรับชำระเงิน (Bill Payment / Pay-in Slip) 
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
