<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<table class="table table_bordered" width="100%"  cellpadding="2" cellspacing="8" style="border-color: #ffffff;">
    <tr>
        <td colspan="2" style="padding: 5px; vertical-align: text-top; text-align: center;border:solid 0px #ffffff;">
            <h2>
                ใบสั่งซื้อ / Purchase Order
            </h2>
            <h3>บริษัท ไดอิ กรุ๊ป จำกัด (มหาชน)</h3>
            เลขที่ 1 ซ.ลาดพร้าว 19 ถ.ลาดพร้าว แขวงจอมพล เขตจตุจักร จังหวัดกรุงเทพฯ 10900 โทร.02-938-3463 (Auto) โทรสาร.02-938-3463
        </td>
    </tr>
</table>

