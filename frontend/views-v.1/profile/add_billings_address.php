<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
// https://github.com/kartik-v/yii2-widget-depdrop //

if ($model->isDefault == '1') {
    $bg = '#f9f9f9 ; padding: 5px;';
} else if ($model->isDefault == '0') {
    $bg = '#ffffff';
} else {
    $bg = '#ffffff';
}
?>
<p style="font-size: 12px; background-color: <?php echo $bg; ?>">
    <?php
    echo ++$index . '. ';
    if (isset($model->company)) {
        echo ($model->company) ? $model->company : $model->company . ' , ';
    } else {
        echo ($model->firstname) ? 'คุณ ' . $model->firstname : ' - ';
        echo ($model->lastname) ? '&nbsp;' . $model->lastname : ' - ';
    }
    echo '<br>';

    echo ($model->address) ? "Address : " . $model->address . "<br>" : '' . ' , ';
    echo ($model->district['localName']) ? $model->district['localName'] . ", " : '' . ' , ';
    echo ($model->cities['localName']) ? $model->cities['localName'] . ", " : '' . ' , ';
    echo ($model->states['localName']) ? $model->states['localName'] . ", " : '' . ' , ';
    echo '<br>' . ($model->countries['localName']) ? $model->countries['localName'] : '' . ' , ';
    echo '<br>Zipcode ' . $model->zipcode;
    echo '&nbsp;<a href="' . Yii::$app->homeUrl . 'profile/billings-address/' . \common\models\ModelMaster::encodeParams(['addressId' => $model->addressId]) . '"><span style ="color:#b11010; cursor: hand;" >( <i class="fa fa-pencil-square-o" aria-hidden="true"></i> ,</span></a>';
    echo '<span class= "obutton feature2"  data-id="' . $model->addressId . '" data-toggle="modal" data-target="#modal-delete-item">'
    . '<span style ="color:#b11010; cursor: hand;" class="get-shipping-address"> <i class="fa fa-trash" aria-hidden="true"></i> )</span></span>';
    echo $this->render('@frontend/views/modal/modal_delete_item');
    ?>
<hr>
</p>