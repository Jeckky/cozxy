<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<table class="table table_bordered" width="100%"  cellpadding="2" cellspacing="0" >
    <tr>
        <td colspan="2" style="text-align: left; vertical-align: text-top;">
            <img src="<?php echo $baseUrl; ?>/images/logo/costfit.png" alt="Cost Fit" width="93" height="48" broder ="0">
        </td>
        <td colspan="3" style="padding: 5px; vertical-align: text-top; text-align: center;">
            <h2>
                บริษัท คอทซี่ ดอทคอม จำกัด
            </h2>
            เลขประจำตัวผู้เสียภาษี : 0105546109903 <br>
            สำนักงานใหญ่ เลขที่ 1 ซ.ลาดพร้าว 19 ถ.ลาดพร้าว <br>แขวงจอมพล เขตจตุจักร จังหวัดกรุงเทพมหานคร 10900
        </td>
        <td colspan="2" style="vertical-align: text-top; text-align: right; ">
    <?php //echo $title; ?><br><br><center> ใบหยิบสินค้า</center>
</td>
</tr>
</table>

