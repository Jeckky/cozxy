<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\receive */

$this->title = 'Update Receive: ' . ' ' . $model->receiveId;
$this->params['breadcrumbs'][] = ['label' => 'Receives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->receiveId, 'url' => ['view', 'id' => $model->receiveId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="receive-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
