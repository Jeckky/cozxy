<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPointItems */

$this->title = 'Update Picking Point Items: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Picking Point Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->pickingItemsId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="picking-point-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
