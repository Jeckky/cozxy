<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?= isset($ms) ? '[ ' . $ms . ' ]' : '' ?>
<table class="table" width="100%"  cellpadding="2" cellspacing="8" style="border-color: #ffffff;margin-top: -20px;">
    <tr>
        <td colspan="2" style="padding: 5px; vertical-align: text-top; text-align: left;border:solid 0px #ffffff;width: 25%;">

            <img src="<?php echo $baseUrl . $logo ?>" style="width: 80px;height: 50px;">

        </td>
        <td style="width: 50%;text-align: center;"> <h3>Cozxy Dot Com Co., Ltd.</h3></td>
        <td style="width: 25%;">
            <h3>
                ใบเสร็จรับเงินล่วงหน้า
            </h3>
        </td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: left;font-size: 9pt;">
            สำนักงานใหญ่ : เลขที่ 5 ถนน รามอินทรา ซอย 5 แยก 4 แขวงจอนุสาวรีย์ เขตบางเขน จังหวัดกรุงเทพมหานคร 10220
        </td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: left;font-size: 9pt;">
            โทร : 02-101-0689<br>
        </td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: left;font-size: 9pt;">
            เลขประจำตัวผู้เสียภาษีอากร : 0 1055 53036 78 9<br>
        </td>
    </tr>
</table>

