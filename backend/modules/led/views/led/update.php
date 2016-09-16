<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Led */

$this->title = 'Update Led: ' . $model->ledId;
$this->params['breadcrumbs'][] = ['label' => 'Leds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ledId, 'url' => ['view', 'id' => $model->ledId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="led-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
