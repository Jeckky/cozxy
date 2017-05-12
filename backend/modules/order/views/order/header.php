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
                Purchase Order
            </h2>
            <h3>Cozxy Dot Com Co.,Ltd.</h3>
            5 Soi Ram Intra 5 Yeak 4, Anusawari, Bang Ken, Bangkok 10220 TEL.02-101-0689 (Auto) FAX.02-101-0689
        </td>
    </tr>
</table>
