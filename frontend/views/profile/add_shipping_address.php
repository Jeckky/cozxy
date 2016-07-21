<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
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
