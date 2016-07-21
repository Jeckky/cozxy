<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
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
