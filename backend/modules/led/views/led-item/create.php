<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\LedItem */

$this->title = 'Create Led Item';
$this->params['breadcrumbs'][] = ['label' => 'Led Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="led-item-create">



    <?=
    $this->render('_form', [
        'model' => $model,
        'defultColor' => $defultColor,
        'oldColor' => $oldColor,
        'sort' => $sort
    ])
    ?>

</div>
