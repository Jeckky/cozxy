<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\LedItem */

$this->title = 'Update Led Item: ' . $model->ledItemId;
$this->params['breadcrumbs'][] = ['label' => 'Led Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ledItemId, 'url' => ['view', 'id' => $model->ledItemId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="led-item-update">
    <?=
    $this->render('_form', [
        'model' => $model,
        //'defultColor' => $defultColor,
        'oldColor' => $oldColor,
        'sort' => $sort,
        'allColor' => $allColor
    ])
    ?>

</div>
