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
<p style="font-size: 12px;">
    <?php
    echo ++$index . '. ';
    echo ($model->company) ? $model->company : $model->company . ' ,';
    echo ($model->address) ? $model->address : '' . ' ,';
    echo ($model->district['localName']) ? $model->district['localName'] : '' . ' ,';
    echo ($model->cities['cityName']) ? $model->cities['cityName'] : '' . ' ,';
    echo ($model->states['stateName']) ? $model->states['stateName'] : '' . ' ,';
    echo '<br>' . ($model->countries['localName']) ? $model->countries['localName'] : '' . ' ,';
    echo '<br>Zipcode ' . $model->zipcode;
    echo '<a href="' . Yii::$app->homeUrl . 'profile/shipping-address?id=' . $model->addressId . '"><span style ="color:#b11010; cursor: hand;" > (edit ,</span></a>';
    echo '<span class= "obutton feature2"  data-id="' . $model->addressId . '" data-toggle="modal" data-target="#modal-delete-item">'
    . '<span style ="color:#b11010; cursor: hand;" class="get-shipping-address"> del)</span></span>';
    echo $this->render('@frontend/views/modal/modal_delete_item');
    ?>
<hr>
</p>