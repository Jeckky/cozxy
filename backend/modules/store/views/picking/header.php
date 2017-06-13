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
        <td colspan="2" style="text-align: center; vertical-align: middle;">
            <img src="<?php echo $baseUrl; ?>/images/logo/cozxy.png" alt="cozxy.com" width="93" height="48" broder ="0">
        </td>
        <td colspan="3" style="padding: 5px; vertical-align: text-top; text-align: center;">
            <h2>
                บริษัท คอซซี่ดอทคอม
            </h2>
            เลขประจำตัวผู้เสียภาษี : 0105553036789 <br>
            สำนักงานใหญ่ เลขที่ 5 ซอยรามอินทรา 5 แยก 4  <br>แขวงอนุสาวรีย์ เขตบางเขน จังหวัดกรุงเทพมหานคร 10900
        </td>
        <td colspan="2" style="vertical-align: text-top; text-align: right; ">
    <?php //echo $title; ?><br><br><center> <?= isset($title) ? $title : "ใบหยิบสินค้า" ?></center>
</td>
</tr>
</table>

