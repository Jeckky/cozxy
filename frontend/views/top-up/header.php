<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?= isset($ms) ? '[ ' . $ms . ' ]' : '' ?>
<table class="table table_bordered" width="100%"  cellpadding="2" cellspacing="8" style="border-color: #ffffff;margin-top: -20px;">
    <tr>
        <td colspan="2" style="padding: 5px; vertical-align: text-top; text-align: center;border:solid 0px #ffffff;">
            <h2>
                ใบเสร็จรับเงินล่วงหน้า
            </h2>
            <h3>บริษัท คอซซี่ดอทคอม จำกัด</h3>
            สำนักงานใหญ่ : 5 ซอยรามอินทรา 5 แยก 4 แขวงอนุสาวรีย์ เขตบางเขน กรุงเทพมหานคร 10220<br>
            โทร : 02-123-0000<br>
            เลขประจำตัวผู้เสียภาษีอากร : 0 1055 53036 78 9<br>
        </td>
    </tr>
</table>

