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
    echo ($model->company) ? $model->company : $model->company . ' ,';
    echo ($model->address) ? $model->address : '' . ' ,';
    echo ($model->district['localName']) ? $model->district['localName'] : '' . ' ,';
    echo ($model->cities['cityName']) ? $model->cities['cityName'] : '' . ' ,';
    echo ($model->states['stateName']) ? $model->states['stateName'] : '' . ' ,';
    echo '<br>' . ($model->countries['localName']) ? $model->countries['localName'] : '' . ' ,';
    echo '<br>Zipcode ' . $model->zipcode;
    ?>
</p>