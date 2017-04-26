<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Topup */

$this->title = 'Update Topup: ' . $model->topUpId;
$this->params['breadcrumbs'][] = ['label' => 'Topups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->topUpId, 'url' => ['view', 'id' => $model->topUpId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="topup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
