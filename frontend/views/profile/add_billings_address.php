<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
// https://github.com/kartik-v/yii2-widget-depdrop //
?>
<p>
<?php
echo ++$index . '. ';
echo $model->company . ' ,';
echo $model->address . ' ,';
echo $model->countryId . ' ,';
echo $model->amphurId . ' ,';
echo $model->provinceId . ' ,';
echo $model->districtId . ' ,';
echo '<br>Zipcode ' . $model->zipcode;
?>
</p>