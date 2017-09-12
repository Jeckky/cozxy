<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$logo = common\models\costfit\ContentGroup::find()->where("lower(title)='logoimage'")->one();
?>
<span style="font-size: 7pt;">สาขาที่ออกใบกำกับภาษี : สำนักงานใหญ่</span>
<table class="table table_bordered" width="100%"  cellpadding="2" cellspacing="0" >
    <tr>
        <td colspan="2" style="text-align: center; vertical-align: text-top;"><br><br>
            <img src="<?php echo $baseUrl . $logo->image; ?>" alt=" " alt="Cost Fit" width="93" height="48" broder ="0" class="img-responsive"/>
        </td>
        <td colspan="3" style="padding: 5px; vertical-align: text-top; text-align: center;">
            <h2>
                บริษัท คอซซี่ ดอทคอม จำกัด
            </h2>
            <br> เลขประจำตัวผู้เสียภาษี : 0105553036789 <br>
            ที่อยู่ : เลขที่  5 ซอยรามอินทรา 5 แยก 4  <br>แขวงอนุสวรีย์ เขตบางเขน กทม. 10220<br>
            <span style="font-size: 9pt;">Tel : 02-101-0689, 064-184-7414</span>
        </td>
        <td colspan="2" style="vertical-align: text-top; text-align: right; "><br><br>
            <?php echo $title; ?><br><span style="font-size: 7pt;">RECEIPT / TAX INVOICE</span><br><br>
    <center>ต้นฉบับ<br><span style="font-size: 7pt;">ORIGINAL</span> </center>
</td>
</tr>
</table>
