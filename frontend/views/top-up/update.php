<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\TopUp */

$this->title = 'Update Top Up: ' . $model->topUpId;
$this->params['breadcrumbs'][] = ['label' => 'Top Ups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->topUpId, 'url' => ['view', 'id' => $model->topUpId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="top-up-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
