<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>

<!-- <p>
    1. 7th floor Ladproa 19,
    Ladproa Road , Chatuchak , Bangkok , THA Zipcode 10900
</p> -->
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
