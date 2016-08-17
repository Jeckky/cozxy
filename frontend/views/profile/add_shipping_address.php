<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => '']);
?>
<p style="font-size: 12px;">
    <?php
    echo ++$index . '. ';
    echo ($model->firstname) ? 'คุณ' . $model->firstname : '-';
    echo ($model->lastname) ? '&nbsp;' . $model->lastname : '-' . '<br>';
    echo ($model->company) ? $model->company : $model->company . ' ,';
    echo ($model->address) ? $model->address : '' . ' ,';
    echo ($model->district['localName']) ? $model->district['localName'] : '' . ' ,';
    echo ($model->cities['cityName']) ? $model->cities['cityName'] : '' . ' ,';
    echo ($model->states['stateName']) ? $model->states['stateName'] : '' . ' ,';
    echo '<br>' . ($model->countries['localName']) ? $model->countries['localName'] : '' . ' ,';
    echo '<br>Zipcode ' . $model->zipcode;
    echo '<a href="' . Yii::$app->homeUrl . 'profile/shipping-address/' . \common\models\ModelMaster::encodeParams(['addressId' => $model->addressId]) . '"><span style ="color:#b11010; cursor: hand;" > (edit ,</span></a>';
    echo '<span class= "obutton feature2"  data-id="' . $model->addressId . '" data-toggle="modal" data-target="#modal-delete-item">'
    . '<span style ="color:#b11010; cursor: hand;" class="get-shipping-address"> del)</span></span>';
    echo $this->render('@frontend/views/modal/modal_delete_item');
    ?>
<hr>
</p>
